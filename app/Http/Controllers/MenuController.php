<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;
use App\Inventory;
use App\MenuInventories;
use Validator;
use Log;

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
        $menus = Menu::all();
        $inventories = Inventory::all();
        $data = array(
            'menus'  => $menus,
            'inventories'   => $inventories
        );
        return view('menu.index')->with($data);
    }

    public function addMenu(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:40',
            'stock' => 'required|max:1000000',
            'price' => 'required|max:1000000'
        ]);

       if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }

        $menu_data = collect($request->only([
            'name',
            'stock',
            'price'
        ]))->all();

        $menu = Menu::create($menu_data);
        $menu_id = $menu->id;
        $madeof_menu =  $request->madeof;
        Log::info('menuuuuuu');
        Log::info(print_r($menu->id, true));
        Log::info(print_r($madeof_menu, true));

        foreach ($madeof_menu as $inventory_id){
            $menu_inventory = MenuInventories::create(['menu_id' => $menu_id, 'inventory_id' => $inventory_id]);
        }  

        /*$inventory_data = collect($request->only([
            'name',
            'stock',
            'price'
        ]))->all();

        $inven = Inventory::create($inventory_data);*/

        return redirect()->action("MenuController@index");
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
