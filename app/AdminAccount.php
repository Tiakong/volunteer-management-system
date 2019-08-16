<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
//use Illuminate\Database\Eloquent\Model;

class AdminAccount extends Authenticatable
{
	use Notifiable;
	
	protected $primaryKey = 'id';
	protected $table = 'admin_accounts';
    protected $fillable = [
		'username',
		'password'
	];
}
