<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected $table = 'offers';
    protected $primaryKey = 'id';

    protected $fillable = ['user_id', 'sendproduct_id', 'acceptor', 'product_id', 'accepted'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function acceptor()
    {
        return $this->belongsTo(User::class, 'acceptor_id');
    }

    public function sendproduct()
    {
        return $this->belongsTo(Product::class, 'sendproduct_id');
    }

}
