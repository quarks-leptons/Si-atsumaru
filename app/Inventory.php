<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
	protected $table = 'inventories';
    protected $primaryKey = 'id';
	protected $fillable = [
		'inventory_id',
		'name',
		'stock',
		'price'
	];
}
