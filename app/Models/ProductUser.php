<?php

namespace App\Models;

use App\Models\Product;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductUser extends Model
{
    use HasFactory;


    protected $table = 'product_users';

    protected $fillable = ['product_id', 'user_id', 'city', 'firstName'];
}
