<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Volunteer extends Model
{
	use UsesUuid;
	protected $primaryKey = 'vid';
	protected $table = 'volunteers';
    protected $fillable = [
		'id',
		'name',
		'email',
		'contact_no',
		'nric',
		'race',
		'gender',
		'nationality',
		'address',
		'education_level',
		'occupation',
		't_shirt_size',
		'em_person',
		'em_contact_no',
		'em_relation',
		'remark',	
		'acc_serve_hour',
		'last_login',
		'profile_image'
	];
}
