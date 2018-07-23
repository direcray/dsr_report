<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'CUS';

    /**
     * Get the Employee that owns the phone.
     */
    public function employee()
    {
        return $this->belongsTo('App\Employee', 'EMDN', 'EMDN');
    }

    public function transactions()
    {
        return $this->hasMany('App\Transaction', "EMDN", "EMDN");
    }

    public function old_transactions()
    {
        return $this->hasMany('App\OldTransaction', "EMDN", "EMDN");
    }

    public function payments()
    {
        return $this->hasMany('App\Payment', "AC", "AC");
    }

    public function payment_data()
    {
        return $this->hasManyThrough(
            'App\PaymentData',
            'App\Payment', 
            "AC", 
            "PDNO",
            "AC",
            "PDNO"
        );
    }
}
