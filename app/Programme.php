<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Programme extends Model
{
	use UsesUuid;
	protected $primaryKey = 'pid';
	public $timestamps = false;
	protected $table = 'programmes';
    protected $fillable = [
		'code',
		'venue',
		'name',
		'description',
		'target',
		'contact',
		'start_month',
		'end_month',
		'start_year',
		'end_year',
	];
	
}
