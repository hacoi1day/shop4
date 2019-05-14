<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = ['product_name', 'product_price', 'product_image', 'product_detail'];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
    public function getShop()
    {
        return $this->belongsToMany(Category::class)->first()->shop;
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
