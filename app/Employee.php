<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = "EMD";

    public function service_records()
    {
        return $this->hasMany('App\SRV', "EMDN", "EMDN");
    }

    public function transactions()
    {
        return $this->hasMany('App\Transaction', "EMDN", "EMDN");
    }

    public function old_transactions()
    {
        return $this->hasMany('App\OldTransaction', "EMDN", "EMDN");
    }

    public function customers()
    {
        return $this->hasMany('App\Customer', "EMDN", "EMDN");
    }
}
