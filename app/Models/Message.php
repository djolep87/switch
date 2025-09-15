<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'offer_id',
        'message',
        'is_read',
        'read_at',
        'deleted_by_users'
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'read_at' => 'datetime',
        'deleted_by_users' => 'array'
    ];

    /**
     * Get the user who sent the message
     */
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    /**
     * Get the user who received the message
     */
    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    /**
     * Get the offer associated with the message
     */
    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }

    /**
     * Mark message as read
     */
    public function markAsRead()
    {
        $this->update([
            'is_read' => true,
            'read_at' => now()
        ]);
    }

    /**
     * Scope for unread messages
     */
    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    /**
     * Scope for messages between two users
     */
    public function scopeBetweenUsers($query, $userId1, $userId2)
    {
        return $query->where(function($q) use ($userId1, $userId2) {
            $q->where('sender_id', $userId1)->where('receiver_id', $userId2);
        })->orWhere(function($q) use ($userId1, $userId2) {
            $q->where('sender_id', $userId2)->where('receiver_id', $userId1);
        });
    }

    /**
     * Check if a user has deleted this conversation
     */
    public function isDeletedByUser($userId)
    {
        $deletedByUsers = $this->deleted_by_users ?? [];
        return in_array($userId, $deletedByUsers);
    }

    /**
     * Mark conversation as deleted by a user
     */
    public function markDeletedByUser($userId)
    {
        $deletedByUsers = $this->deleted_by_users ?? [];
        if (!in_array($userId, $deletedByUsers)) {
            $deletedByUsers[] = $userId;
            $this->update(['deleted_by_users' => $deletedByUsers]);
        }
    }

    /**
     * Check if conversation is deleted by both users
     */
    public function isDeletedByBothUsers($user1Id, $user2Id)
    {
        $deletedByUsers = $this->deleted_by_users ?? [];
        return in_array($user1Id, $deletedByUsers) && in_array($user2Id, $deletedByUsers);
    }
}