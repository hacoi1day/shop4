<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = ['category_name', 'category_name_u', 'shop_id', 'category_global_id'];

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function categoryglobals()
    {
        return $this->belongsToMany(CategoryGlobal::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function get10products()
    {
        return $this->belongsToMany(Product::class)->limit(10);
    }

    public function totalProduct() {
        $product = DB::table('category_product')->where('category_id', $this->id)->get()->pluck('id')->toArray();
        return count($product);
    }
}
