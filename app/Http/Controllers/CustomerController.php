<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the customer index
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('customer.index');
    }

    /**
     * Show the acustomer detail
     *
     * @param $customer_id int
     *
     * @return \Illuminate\Http\Response
     */
    public function detail($customer_id)
    {
        return view('customer.detail', ['customer_id' => $customer_id]);
    }
}
