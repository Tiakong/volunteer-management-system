<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VolunteerAccount extends Model
{
	protected $table = 'volunteer_accounts';
	public $timestamps = false;
    protected $fillable = [
		'vid',
		'username',
		'password'
	];
}
