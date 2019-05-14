<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'addresses';

    protected $fillable = ['name', 'address', 'number', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
