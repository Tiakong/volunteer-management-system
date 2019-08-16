<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AwardHistory extends Model
{
	protected $primaryKey = 'vid';
	protected $table = 'award_histories';
    protected $fillable = [
		'vid',
		'description'
	];
}
