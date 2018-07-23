<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Employee;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::paginate(30);

        return view('customer.index', compact('customers'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function view($id)
    {
        $customer = Customer::where('ID', $id)->first();

        return view('customer.view', compact('customer'));
    }

    /**
     * Get the Employee that owns the phone.
     */
    public function employee()
    {
        return $this->belongsTo('App\Employee', 'EMDN', 'EMDN');
    }
}
