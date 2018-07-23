<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = "PAIN";


    public function payment_data()
    {
        return $this->hasMany('App\PaymentData', "PDNO", "PDNO");
    }
}
