<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuInventories extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'menus_inventories';
    protected $primaryKey = 'id';
	protected $fillable = [
		'menu_id',
		'inventory_id'
	];
}
