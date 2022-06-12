<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Home extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsToMany('App\Models\Category');
    }

    public function Product()
    {
        return $this->belongsToMany('App\Models\Product');
    }
}
