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
        
        // Get all conversations for the current user (excluding those deleted by current user)
        $conversations = \App\Models\Message::with(['sender', 'receiver', 'offer'])
            ->where(function($query) use ($userId) {
                $query->where('sender_id', $userId)
                      ->orWhere('receiver_id', $userId);
            })
            ->whereRaw("JSON_EXTRACT(deleted_by_users, '$') IS NULL OR JSON_SEARCH(deleted_by_users, 'one', ?) IS NULL", [$userId])
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy(function($message) use ($userId) {
                // Group by the other user in the conversation
                return $message->sender_id == $userId ? $message->receiver_id : $message->sender_id;
            });

        $messages = [];
        
        foreach ($conversations as $otherUserId => $conversationMessages) {
            $latestMessage = $conversationMessages->first();
            $otherUser = $latestMessage->sender_id == $userId ? $latestMessage->receiver : $latestMessage->sender;
            
            // Get ad title from any message in the conversation that has an offer
            $adTitle = 'Razmena'; // Default fallback
            $messageWithOffer = $conversationMessages->first(function($message) {
                return $message->offer_id !== null;
            });
            
            // If no message with offer_id, try to find offers between these users
            if (!$messageWithOffer || !$messageWithOffer->offer) {
                $offer = \App\Models\Offer::with(['product', 'sendproduct'])
                    ->where(function($query) use ($userId, $otherUserId) {
                        $query->where('user_id', $userId)->where('acceptor', $otherUserId);
                    })->orWhere(function($query) use ($userId, $otherUserId) {
                        $query->where('user_id', $otherUserId)->where('acceptor', $userId);
                    })->orderBy('created_at', 'desc')->first();
                
                if ($offer) {
                    // Show the ad that belongs to the CURRENT user (the one viewing the messages)
                    if ($offer->user_id == $userId) {
                        // Current user is the offer creator - show what they're offering (product)
                        $adTitle = $offer->product ? $offer->product->name : 'Razmena';
                    } else {
                        // Other user is the offer creator - show what current user wants (sendproduct)
                        $adTitle = $offer->sendproduct ? $offer->sendproduct->name : 'Razmena';
                    }
                }
            } else {
                // Use the existing logic for messages with offer_id
                if ($messageWithOffer->offer->user_id == $userId) {
                    // Current user is the offer creator - show what they're offering (product)
                    $adTitle = $messageWithOffer->offer->product ? $messageWithOffer->offer->product->name : 'Razmena';
                } else {
                    // Other user is the offer creator - show what current user wants (sendproduct)
                    $adTitle = $messageWithOffer->offer->sendproduct ? $messageWithOffer->offer->sendproduct->name : 'Razmena';
                }
            }
            
            $messages[] = [
                'sender_name' => $otherUser->firstName,
                'ad_title' => $adTitle,
                'is_blocked' => false, // You can add blocked status logic here
                'time' => $latestMessage->created_at->format('d.m.Y. H:i'),
                'subject' => $latestMessage->offer ? $latestMessage->offer->product->name ?? 'Poruka' : 'Poruka',
                'preview' => \Illuminate\Support\Str::limit($latestMessage->message, 50),
                'is_read' => $latestMessage->is_read,
                'conversation_id' => $otherUserId
            ];
        }

        return view('messages.list', compact('messages', 'wishlists'));
    }

    /**
     * Display a specific chat conversation
     */
    public function show($id)
    {
        $wishlists = Wishlist::where('user_id', optional(Auth::user())->id)->withCount('products')->get();
        $userId = auth()->id();
        
        // Get the other user in the conversation
        $otherUser = \App\Models\User::findOrFail($id);
        
        // Get all messages between current user and the other user (excluding those deleted by current user)
        $messages = \App\Models\Message::with(['sender', 'receiver', 'offer.product', 'offer.sendproduct'])
            ->betweenUsers($userId, $id)
            ->whereRaw("JSON_EXTRACT(deleted_by_users, '$') IS NULL OR JSON_SEARCH(deleted_by_users, 'one', ?) IS NULL", [$userId])
            ->orderBy('created_at', 'asc')
            ->get();
        
        // Mark messages as read
        \App\Models\Message::where('receiver_id', $userId)
            ->where('sender_id', $id)
            ->where('is_read', false)
            ->update(['is_read' => true, 'read_at' => now()]);
        
        $contactName = $otherUser->firstName;
        
        // Get ad title and image based on user perspective
        $adTitle = null; // No default, will show nothing if no offer
        $adImage = null; // Default
        $messageWithOffer = $messages->first(function($message) {
            return $message->offer_id !== null;
        });
        
        // If no message with offer_id, try to find offers between these users
        if (!$messageWithOffer || !$messageWithOffer->offer) {
            $offer = \App\Models\Offer::with(['product', 'sendproduct'])
                ->where(function($query) use ($userId, $id) {
                    $query->where('user_id', $userId)->where('acceptor', $id);
                })->orWhere(function($query) use ($userId, $id) {
                    $query->where('user_id', $id)->where('acceptor', $userId);
                })->orderBy('created_at', 'desc')->first();
            
            if ($offer) {
                // Show the ad that belongs to the CURRENT user (the one viewing the chat)
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
            }
        } else {
            // Use the existing logic for messages with offer_id
            if ($messageWithOffer->offer->user_id == $userId) {
                // Current user is the offer creator - show what they're offering (product)
                $adTitle = $messageWithOffer->offer->product ? $messageWithOffer->offer->product->name : null;
                $adImage = $messageWithOffer->offer->product && !empty($messageWithOffer->offer->product->images) 
                    ? $messageWithOffer->offer->product->images 
                    : null;
            } else {
                // Other user is the offer creator - show what current user wants (sendproduct)
                $adTitle = $messageWithOffer->offer->sendproduct ? $messageWithOffer->offer->sendproduct->name : null;
                $adImage = $messageWithOffer->offer->sendproduct && !empty($messageWithOffer->offer->sendproduct->images) 
                    ? $messageWithOffer->offer->sendproduct->images 
                    : null;
            }
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
        
        return view('messages.chat', compact('contactName', 'itemTitle', 'adImage', 'messages', 'otherUser', 'wishlists'));
    }

    /**
     * Send a new message
     */
    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
            'receiver_id' => 'required|integer|exists:users,id',
            'offer_id' => 'nullable|integer|exists:offers,id'
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