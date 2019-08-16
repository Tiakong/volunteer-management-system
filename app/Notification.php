<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
	use UsesUuid;
	protected $primaryKey = 'nid';
	protected $table = 'notifications';
    protected $fillable = [
		'title',
		'description',
		'category',
		'for_volunteer',
		'for_admin',
		'broadcast',
		'is_auto',
		'created_by',
	];
}
