<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transport extends Model
{
    protected $table = 'transports';

    protected $fillable = ['transport_name'];
}
