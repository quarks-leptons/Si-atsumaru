<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Models used
use App\Customer;
use App\Menu;
use App\Promotion;

class POSController extends Controller
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
     * Show the pos index
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all customers
        $customers = Customer::all();
        // Get all menus
        $menus = Menu::all();
        // Get all promotions
        $promotions = Promotion::all();

        return view('pos.index', [
                'customers' => $customers,
                'menus' => $menus,
                'promotions' => $promotions
            ]);
    }
}
