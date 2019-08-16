<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
	use UsesUuid;
	protected $primaryKey = 'eid';
	protected $table = 'events';
    protected $fillable = [
		'pid',
		'name',
		'description',
		'venue',
		'date',
		'start_time',
		'end_time',
		'created_by',
		'serve_hour',
		'cover_image'
	];
}
