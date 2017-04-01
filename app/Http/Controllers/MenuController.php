<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenuController extends Controller
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
     * Show the menu index
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('menu.index');
    }

    /**
     * Show the menu detail
     *
     * @param $menu_id int
     *
     * @return \Illuminate\Http\Response
     */
    public function detail($menu_id)
    {
        return view('menu.detail', ['menu_id' => $menu_id]);
    }
}
