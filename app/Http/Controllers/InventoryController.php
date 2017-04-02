<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inventory;

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
    public function index(Request $request)
    {
        $inventories = Inventory::all();
        return view('inventory.index')->with("inventories",$inventories);
    }

    public function addInventory(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:190',
            'stock' => 'required|max:100000000',
            'price' => 'required|max:100000000'
        ]);

        $inventory_data = collect($request->only([
            'name',
            'stock',
            'price'
        ]));

        $inven = Inventory::create($inventory_data);

        return redirect()->action("InventoryController@index");
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
