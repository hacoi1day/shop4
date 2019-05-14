<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryGlobal extends Model
{
    protected $table = 'category_globals';

    protected $fillable = ['category_global_name', 'category_global_name_u'];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
