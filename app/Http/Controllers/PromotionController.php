<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PromotionController extends Controller
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
     * Show the promotion index
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('promotion.index');
    }

    /**
     * Show the promotion detail
     *
     * @param $promotion_id int
     *
     * @return \Illuminate\Http\Response
     */
    public function detail($promotion_id)
    {
        return view('promotion.detail', ['promotion_id' => $promotion_id]);
    }
}
