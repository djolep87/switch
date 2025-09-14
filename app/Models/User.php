<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstName',
        'lastName',
        'email',
        'password',
        'country',
        'city',
        'address',
        'phone',
        'accepted',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function product()
    {
        return $this->hasMany(Product::class, 'user_id');
    }

    public function offer()
    {
        return $this->hasMany(Offer::class, 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }   

    public function likes()
    {
        return $this->hasMany(Like::class, 'liked_user_id')->where('liked', true)->count();
    }

    public function dislikes()
    {
        return $this->hasMany(Like::class, 'liked_user_id')->where('liked', false)->count();
    }

    /**
     * Get messages sent by this user
     */
    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    /**
     * Get messages received by this user
     */
    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }

    /**
     * Get unread messages for this user
     */
    public function unreadMessages()
    {
        return $this->receivedMessages()->where('is_read', false);
    }

    /**
     * Get count of unread conversations (unique senders with unread messages)
     */
    public function unreadConversationsCount()
    {
        return $this->receivedMessages()
            ->where('is_read', false)
            ->distinct('sender_id')
            ->count('sender_id');
    }
}
