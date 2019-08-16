<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Officework extends Model
{
	use UsesUuid;
	protected $primaryKey = 'oid';
	protected $table = 'officeworks';
    protected $fillable = [
		'description',
		'serve_hour',
		'created_by',
	];
}
