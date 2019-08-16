<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProgrammeImage extends Model
{
	use UsesUuid;
	protected $primaryKey = 'id';
	public $timestamps = false;
	protected $table = 'programme_images';
    protected $fillable = [
		'pid',
		'filename'
	];
	
}
