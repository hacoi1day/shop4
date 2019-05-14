<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $table = 'bills';

    protected $fillable = ['user_id', 'transport_id', 'pay_id'];

    public function billDetail()
    {
        return $this->hasMany(BillDetail::class, 'bill_id', 'id');
    }

}
