<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'menus';
    protected $primaryKey = 'id';
	protected $fillable = [
		'inventory_id',
		'name',
		'price',
        'image'
	];
}
