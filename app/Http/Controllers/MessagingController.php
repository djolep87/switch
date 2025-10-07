<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Wishlist;

class MessagingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display the messages list
     */
    public function index()
    {
        $wishlists = Wishlist::where('user_id', optional(Auth::user())->id)->withCount('products')->get();
        $userId = auth()->id();
        
        // Get all offers where the current user is either the creator or acceptor
        $offers = \App\Models\Offer::with(['product', 'sendproduct', 'user', 'acceptor'])
            ->where(function($query) use ($userId) {
                $query->where('user_id', $userId)
                      ->orWhere('acceptor', $userId);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        $messages = [];
        
        foreach ($offers as $offer) {
            // Get the other user in this exchange
            $otherUserId = $offer->user_id == $userId ? $offer->acceptor : $offer->user_id;
            $otherUser = \App\Models\User::find($otherUserId);
            
            // Get the latest message for this specific offer
            $latestMessage = \App\Models\Message::with(['sender', 'receiver'])
                ->where('offer_id', $offer->id)
                ->where(function($query) use ($userId) {
                    $query->where('sender_id', $userId)
                          ->orWhere('receiver_id', $userId);
                })
                ->where(function($query) use ($userId) {
                    $query->whereNull('deleted_by_users')
                          ->orWhereRaw("JSON_SEARCH(deleted_by_users, 'one', ?) IS NULL", [$userId]);
                })
                ->orderBy('created_at', 'desc')
                ->first();
            
            // Count unread messages in this conversation (messages received by current user that are unread)
            $unreadCount = \App\Models\Message::where('offer_id', $offer->id)
                ->where('receiver_id', $userId)
                ->where('is_read', false)
                ->where(function($query) use ($userId) {
                    $query->whereNull('deleted_by_users')
                          ->orWhereRaw("JSON_SEARCH(deleted_by_users, 'one', ?) IS NULL", [$userId]);
                })
                ->count();
            
            // Skip if no messages for this offer or other user not found
            if (!$latestMessage || !$otherUser) {
                continue;
            }
            
            // Determine the ad title based on the current user's perspective
            if ($offer->user_id == $userId) {
                // Current user is the offer creator - show what they're offering (product)
                $adTitle = $offer->product ? $offer->product->name : 'Razmena';
            } else {
                // Other user is the offer creator - show what current user wants (sendproduct)
                $adTitle = $offer->sendproduct ? $offer->sendproduct->name : 'Razmena';
            }
            
            $messages[] = [
                'sender_name' => $otherUser->firstName,
                'ad_title' => $adTitle,
                'is_blocked' => false,
                'time' => $latestMessage->created_at->format('d.m.Y. H:i'),
                'subject' => $adTitle,
                'preview' => \Illuminate\Support\Str::limit($latestMessage->message, 50),
                'is_read' => $latestMessage->is_read,
                'unread_count' => $unreadCount,
                'has_unread' => $unreadCount > 0,
                'conversation_id' => $otherUser->id,
                'offer_id' => $offer->id,
                'latest_message_time' => $latestMessage->created_at // Add this for sorting
            ];
        }

        // Sort messages by latest message time (newest first)
        usort($messages, function($a, $b) {
            return $b['latest_message_time']->timestamp <=> $a['latest_message_time']->timestamp;
        });

        return view('messages.list', compact('messages', 'wishlists'));
    }

    /**
     * Mark all messages as read for a specific conversation
     */
    public function markConversationAsRead(Request $request)
    {
        $request->validate([
            'conversation_id' => 'required|integer',
            'offer_id' => 'required|integer'
        ]);

        $userId = auth()->id();
        $conversationId = $request->conversation_id;
        $offerId = $request->offer_id;

        // Mark all unread messages in this conversation as read
        \App\Models\Message::where('offer_id', $offerId)
            ->where('receiver_id', $userId)
            ->where('is_read', false)
            ->where(function($query) use ($userId) {
                $query->whereNull('deleted_by_users')
                      ->orWhereRaw("JSON_SEARCH(deleted_by_users, 'one', ?) IS NULL", [$userId]);
            })
            ->update([
                'is_read' => true,
                'read_at' => now()
            ]);

        return response()->json(['success' => true, 'message' => 'Poruke su označene kao pročitane']);
    }

    /**
     * Display a specific chat conversation
     */
    public function show(Request $request, $id, $offerId = null)
    {
        $wishlists = Wishlist::where('user_id', optional(Auth::user())->id)->withCount('products')->get();
        $userId = auth()->id();
        
        // If no offerId provided, redirect to messages list
        if (!$offerId) {
            return redirect()->route('messages.index');
        }
        
        // Get the specific offer
        $offer = \App\Models\Offer::with(['product', 'sendproduct', 'user', 'acceptor'])->findOrFail($offerId);
        
        // Get the other user in this exchange
        $otherUserId = $offer->user_id == $userId ? $offer->acceptor : $offer->user_id;
        $otherUser = \App\Models\User::findOrFail($otherUserId);
        
        // Get all messages for this specific offer
        $messages = \App\Models\Message::with(['sender', 'receiver'])
            ->where('offer_id', $offerId)
            ->where(function($query) use ($userId) {
                $query->where('sender_id', $userId)
                      ->orWhere('receiver_id', $userId);
            })
            ->where(function($query) use ($userId) {
                $query->whereNull('deleted_by_users')
                      ->orWhereRaw("JSON_SEARCH(deleted_by_users, 'one', ?) IS NULL", [$userId]);
            })
            ->orderBy('created_at', 'asc')
            ->get();
        
        // Mark messages as read
        \App\Models\Message::where('receiver_id', $userId)
            ->where('sender_id', $otherUser->id)
            ->where('offer_id', $offerId)
            ->where('is_read', false)
            ->update(['is_read' => true, 'read_at' => now()]);
        
        $contactName = $otherUser->firstName;
        
        // If this is an AJAX request, return JSON
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'messages' => $messages->map(function($message) use ($userId) {
                    return [
                        'id' => $message->id,
                        'message' => $message->message,
                        'sender_id' => $message->sender_id,
                        'receiver_id' => $message->receiver_id,
                        'created_at' => $message->created_at->format('H:i'),
                        'is_read' => $message->is_read
                    ];
                })
            ]);
        }
        
        // Get ad title and image based on the current user's perspective
        if ($offer->user_id == $userId) {
            // Current user is the offer creator - show what they're offering (product)
            $adTitle = $offer->product ? $offer->product->name : null;
            $adImage = $offer->product && !empty($offer->product->images) 
                ? $offer->product->images 
                : null;
        } else {
            // Other user is the offer creator - show what current user wants (sendproduct)
            $adTitle = $offer->sendproduct ? $offer->sendproduct->name : null;
            $adImage = $offer->sendproduct && !empty($offer->sendproduct->images) 
                ? $offer->sendproduct->images 
                : null;
        }
        
        $itemTitle = $adTitle;
        
        // Handle AJAX requests for message refresh
        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'messages' => $messages->map(function($message) {
                    return [
                        'id' => $message->id,
                        'message' => $message->message,
                        'sender_id' => $message->sender_id,
                        'receiver_id' => $message->receiver_id,
                        'created_at' => $message->created_at->format('H:i'),
                        'is_read' => $message->is_read
                    ];
                })
            ]);
        }
        
        return view('messages.chat', compact('contactName', 'itemTitle', 'adImage', 'messages', 'otherUser', 'wishlists', 'offerId'));
    }

    /**
     * Send a new message
     */
    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
            'receiver_id' => 'required|integer|exists:users,id',
            'offer_id' => 'required|integer|exists:offers,id'
        ]);

        try {
            $message = \App\Models\Message::create([
                'sender_id' => auth()->id(),
                'receiver_id' => $request->receiver_id,
                'offer_id' => $request->offer_id,
                'message' => $request->message,
                'is_read' => false
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Poruka je uspešno poslata',
                'data' => $message
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Došlo je do greške pri slanju poruke: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Mark message as read
     */
    public function markAsRead($id)
    {
        // Implement mark as read logic here
        
        return response()->json([
            'success' => true,
            'message' => 'Poruka je označena kao pročitana'
        ]);
    }

    /**
     * Delete a message
     */
    public function destroy($id)
    {
        // Implement delete message logic here
        
        return response()->json([
            'success' => true,
            'message' => 'Poruka je uspešno obrisana'
        ]);
    }

    /**
     * Get messages for AJAX requests
     */
    public function getMessages(Request $request)
    {
        $messages = [
            [
                'id' => 1,
                'sender_name' => 'Goran',
                'message' => 'Dogovoreno, pozdrav.',
                'time' => '14:41h',
                'is_sent' => true
            ],
            [
                'id' => 2,
                'sender_name' => 'Goran',
                'message' => 'Moze oko 17h ako vam odgovara, Zarkovo kad Super Vera da se nadjemo.',
                'time' => '11:14h',
                'is_sent' => true
            ],
            [
                'id' => 3,
                'sender_name' => 'Vi',
                'message' => 'Gorane, dosao bih danas da pogledam MacBook. Samo mi javite na koju adresu da dodjem.',
                'time' => '11:02h',
                'is_sent' => false
            ],
            [
                'id' => 4,
                'sender_name' => 'Vi',
                'message' => 'Moze, vidimo se',
                'time' => '11:15h',
                'is_sent' => false
            ],
            [
                'id' => 5,
                'sender_name' => 'Goran',
                'message' => 'Dogovoreno, samo mi javite kad krenete.',
                'time' => '11:16h',
                'is_sent' => true
            ],
            [
                'id' => 6,
                'sender_name' => 'Vi',
                'message' => 'Vazi.',
                'time' => '11:17h',
                'is_sent' => false
            ]
        ];

        return response()->json($messages);
    }

    /**
     * Soft delete an entire conversation for the current user
     */
    public function deleteConversation($otherUserId)
    {
        try {
            $userId = auth()->id();
            
            // Get all messages between current user and the other user
            $messages = \App\Models\Message::where(function($query) use ($userId, $otherUserId) {
                $query->where('sender_id', $userId)->where('receiver_id', $otherUserId);
            })->orWhere(function($query) use ($userId, $otherUserId) {
                $query->where('sender_id', $otherUserId)->where('receiver_id', $userId);
            })->get();
            
            $updatedCount = 0;
            $permanentlyDeletedCount = 0;
            
            foreach ($messages as $message) {
                // Mark as deleted by current user
                $message->markDeletedByUser($userId);
                $updatedCount++;
                
                // Check if both users have deleted the conversation
                if ($message->isDeletedByBothUsers($userId, $otherUserId)) {
                    // Permanently delete the message
                    $message->delete();
                    $permanentlyDeletedCount++;
                }
            }
            
            return response()->json([
                'success' => true, 
                'message' => 'Conversation deleted successfully',
                'updated_count' => $updatedCount,
                'permanently_deleted_count' => $permanentlyDeletedCount
            ]);
            
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Error deleting conversation: ' . $e->getMessage());
            return response()->json([
                'success' => false, 
                'message' => 'Error deleting conversation'
            ], 500);
        }
    }
}