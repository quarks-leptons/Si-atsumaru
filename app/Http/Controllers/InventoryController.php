<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InventoryController extends Controller
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
     * Show the inventory index
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('inventory.index');
    }

    /**
     * Show the inventory detail
     *
     * @param $inventory_id int
     *
     * @return \Illuminate\Http\Response
     */
    public function detail($inventory_id)
    {
        return view('inventory.detail', ['inventory_id' => $inventory_id]);
    }
}
