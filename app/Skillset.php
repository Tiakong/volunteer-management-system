<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skillset extends Model
{
	protected $primaryKey = 'vid';
	public $timestamps = false;
	protected $table = 'skillsets';
    protected $fillable = [
		'vid',
		'langEN',
		'langZH',
		'langMS',
		'langHI',
		'mcrWord',
		'mcrExcel',
		'mcrPowerPoint',
		'pgrCpp',
		'pgrJs',
		'pgrPhp',
		'pgrSql',
		'pgrPython',
		'dsgPhotoshop',
		'dsgIllustrator',
		'dsgPremiumPro',
		'edgnAutocad',
		'edgnSolidWorks',
		'funding',
		'branding',
		'dgtIT',
		'dgtMultimedia',
		'dgtSocialMedia',
		'ctvArt',
		'ctvDraw',
		'ctvDance',
		'ctvThretre',
		'ctvMusic',
		'cmmMarket',
		'cmmMedia',
		'cmmPresentation',
		'business',
		'entrepreneurship'
	];
}
