<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = ['user_id', 'category_id', 'electricity', 'water', 'co2', 'name', 'condition', 'description', 'image', 'status'];

    public $primaryKey = 'id';

    public $timestamps = true;
    

    public function categories()
    {
        return $this->belongsToMany('App\Models\Category');
    }
    
    public function isInExchange()
    {
        return $this->offers()->whereIn('accepted', [1, 3])->exists();
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
        return $this->belongsToMany(Wishlist::class);
    }

    public function offers()
    {
        return $this->hasMany(Offer::class,);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class,);
    }

    protected static function boot()
{
    parent::boot();

    static::deleting(function ($product) {
        $productImages = $product->images;

        if ($productImages) {
            $imagePaths = explode(",", $productImages);
            foreach ($imagePaths as $image) {
                Storage::delete('public/Product_images' . '/' . $image);
            }
        }
    });
}


}
