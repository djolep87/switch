<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Image;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    public $primaryKey = 'id';

    public $timestamps = true;

    public function categories()
    {
        return $this->belongsToMany('App\Models\Category');
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
