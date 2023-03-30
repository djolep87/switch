<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Image;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = ['user_id', 'category_id', 'name', 'condition', 'description', 'image'];

    public $primaryKey = 'id';

    public $timestamps = true;

    

    public function categories()
    {
        return $this->belongsToMany('App\Models\Category');
    }

    public function image()
    {
        return $this->hasMany(Image::class);
    }

    public function images()
    {
        return $this->hasMany(Images::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function wishlists()
    {
        return $this->belongsTo(Wishlist::class);
    }
        
}
