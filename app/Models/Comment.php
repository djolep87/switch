<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'product_user_id', 'body'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function productUser()
    {
        return $this->belongsTo(ProductUser::class, 'user_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class,);
    }

    public function productUsers()
    {
        return $this->belongsTo(ProductUser::class, 'user_id');
    }
}
