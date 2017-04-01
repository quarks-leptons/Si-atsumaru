<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
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
     * Show the order index
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('order.index');
    }

    /**
     * Show the order detail
     *
     * @param $order_id int
     *
     * @return \Illuminate\Http\Response
     */
    public function detail($order_id)
    {
        return view('order.detail', ['order_id' => $order_id]);
    }
}
