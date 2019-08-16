<?php

namespace App;

use App\Event;
use App\Programme;

class Common
{	
	public static $Month = [
		1 => 'January',
		2 => 'February',
		3 => 'March',
		4 => 'April',
		5 => 'May',
		6 => 'June',
		7 => 'July',
		8 => 'August',
		9 => 'September',
		10 => 'October',
		11 => 'November',
		12 => 'December',
	];
	
	public static $volunteerGender = [
		'M'	=> 'Male',
		'F'	=> 'Female',
	];
	
	public static $educationLvl = [
		'1' => 'Primary School',
		'2' => 'Secondary School',
		'3' => 'Pre-University',
		'4' => 'Bachelor Degree',
		'5' => 'Master Degree',
		'6' => 'Doctoral Degree',
	];

	public static $tShirtSize =[
		'1'=> 'S',
		'2'=> 'M',
		'3'=> 'L',
		'4'=> 'XL',
	];
	public static $Strength=[
		'0'=>'Limited',
		'1'=>'Basic',
		'2'=>'Functional',
		'3'=>'Proficient',
		'4'=>'Excellent',
	];
	public static $Proficient=[
		'0'=>'No idea about this skill',
		'1'=>'Beginner',
		'2'=>'Intermediate',
		'3'=>'Expert',
	];
	
	public static $SkillsetsShortform = ['langEN', 'langZH', 'langMS', 'langHI', 'mcrExcel', 'mcrPowerPoint', 'pgrCpp', 'pgrJS', 'pgrPhp', 'pgrPython', 'pgrSQL', 'dsgPhotoShop', 'dsgIllustrator', 'dsgPremiumPro', 'edgnAutoCad', 'edgnSolidWorks', 'dgtMultimedia', 'dgtSocialMedia', 'dgtIT', 'ctvArt', 'ctvDraw', 'ctvDance', 'ctvThretre', 'ctvMusic', 'cmmMarket', 'cmmMedia', 'cmmPresentation','funding','branding','business', 'entrepreneurship'];
	
	public static $Skillsets = [
		'Microsoft' => [
			'mcrWord'			=>"Microsoft Word",
			'mcrExcel'			=>"Excel",
			'mcrPowerPoint'		=>"Power Point",
		],
		'Programing'=>[
			'pgrCpp'			=>"C++",
			'pgrJS' 			=>"Java Script",
			'pgrPhp'			=>"Php",
			'pgrPython'			=>"Python",
			'pgrSQL'			=>"SQL",
		],
		'Design'=>[
			'dsgPhotoShop'		=>"Photoshop",
			'dsgIllustrator'	=>"Illustrator",
			'dsgPremiumPro'		=>"Premium Pro",
		],
		'Engineering Design'=>[
			'edgnAutoCad'		=>"Auto CAD",
			'edgnSolidWorks'	=>"Solid Works",
		],
	];
	public static $Language = [
		'langEN'	=> "English",
		'langMS'	=> "Malay",
		'langZH'	=> "Mandarin",
		'langHI'	=> "Hindi",
	];
	
	public static $ContributeArea = [
		'Digital'	=>	[
			'dgtMultimedia' => 'Multimedia',
			'dgtSocialMedia'=> 'Social Media',
			'dgtIT' 		=> 'IT',
		],
		'Creative'	=> [
			'ctvArt'		=> 'Art',
			'ctvDraw'		=> 'Drawing',
			'ctvDance'		=> 'Dance',
			'ctvThretre'	=> 'Threter',
			'ctvMusic'		=> 'Music',
		],
		'Communication' => [
			'cmmMarket'			=>	'Market',
			'cmmMedia'			=>	'Media',
			'cmmPresentation'	=> 'Presentation',
		],
		'entrepreneurship'	=>	'Entrepreneurship',
		'business'			=>	'Business',
		'funding'			=>	'Funding',
		'branding'			=>	'Branding',
	];

	public static $SubContributeArea = [
		'Digital'	=>	[
			'dgtMultimedia' => 'Multimedia',
			'dgtSocialMedia'=> 'Social Media',
			'dgtIT' 		=> 'IT',
		],
		'Creative'	=> [
			'ctvArt'		=> 'Art',
			'ctvDraw'		=> 'Drawing',
			'ctvDance'		=> 'Dance',
			'ctvThretre'	=> 'Threter',
			'ctvMusic'		=> 'Music',
		],
		'Communication' => [
			'cmmMarket'			=>	'Market',
			'cmmMedia'			=>	'Media',
			'cmmPresentation'	=> 'Presentation',
		]
	];

	


	
	
	public static $SkillsetsCategory = [
		'lang' => 'Language',
		'mcr' => 'Microsoft',
		'pgr'=> 'Programming',
		'dsg'=>'Design',
		'edgn'=>'Engineering Design',
		'funding'=> 'Funding',
		'branding'=>'Branding',
		'dgt'=> 'Digital',
		'ctv'=>'Creative',
		'cmm'=>'Communication',
		'business'=>'Business',
		'entrepreneurship'=>'Entrepreneurship',
	];

	public static function GetProgrammes()
	{
		$programmes = Programme::select('code', 'name')->get();
		$ps = [];
		foreach($programmes as $i=>$p)
			$ps[$p->code] = $p->name;
		return $ps;
	}

	public static function GetValidProgrammes()
	{
		
		$programmes = Programme::select('code', 'name')
		->where('end_year',date('Y'))
		->where('end_month','>=',date('n'))
		->get();
		$ps = [];
		foreach($programmes as $i=>$p)
			$ps[$p->code] = $p->name;
		return $ps;
	}
	
	public static $ProgrammeTitle = 
	[
		'MAD' => 'M.A.D - Make A Difference',
		'STEP' => 'S.T.E.P - Self-empowering and Transition Employability Programme',
		'YER' => 'Y.E.R - Youth Entrepreneurship Programme',
		'TRC' => 'Tutor a Refugee Child',
		'CMP' => 'CMP - Change Makers’ Project'
	];
	
	public static $OfficeworkCategory = [
		'1' => 'Design',
		'2' => 'Creative',
	];
	
	public static $OfficeworkDescription = 
	[
		'1' => 'Design logo for upcoming event.',
		'2' => 'Create arts for upcoming event.',
	];
	
	public static $NotificationCategory = [
		'1' => 'Normal',
		'2' => 'Announcement',
		'3' => 'Reminder',
		'4' => 'Urgent',
	];
	
	public static $NotificationDescription = 
	[
		'1' => 'Normal',
		'2' => 'Announcement',
		'3' => 'Reminder',
		'4' => 'Urgent',
	];
	
	public static $DataExportGuidance = 
	[
		'1' => 'Get the attendance list for upcoming event',
		'2' => 'Show the list of events a volunteer registered before',
		'3' => 'Show the list of events under a specific programme a volunteer registered before',
		'4' => 'Show the list of events a volunteer registered before within a period of time',
		'5' => 'Show the list of events under a specific programme a volunteer registered before within a period of time',
		'6' => 'Show the list of inactive volunteers',
		'7' => 'Show the list of most active volunteer of all time',
		'8' => 'Show the list of most active volunteer in this year'
	];
	
	public static $guidanceJson = [
		'0' => ['programmeName'=>false, 'eventName'=>false, 'date'=>false, 'volunteerName'=>false],
		'1' => ['programmeName'=>true, 'eventName'=>true, 'date'=>true, 'volunteerName'=>false],
		'2' => ['programmeName'=>false, 'eventName'=>false, 'date'=>false, 'volunteerName'=>true],
		'3' => ['programmeName'=>true, 'eventName'=>false, 'date'=>false, 'volunteerName'=>true],
		'4' => ['programmeName'=>false, 'eventName'=>false, 'date'=>true, 'volunteerName'=>true],
		'5' => ['programmeName'=>true, 'eventName'=>false, 'date'=>true, 'volunteerName'=>true],
		'6' => ['programmeName'=>false, 'eventName'=>false, 'date'=>false, 'volunteerName'=>false],
		'7' => ['programmeName'=>false, 'eventName'=>false, 'date'=>false, 'volunteerName'=>false],
		'8' => ['programmeName'=>false, 'eventName'=>false, 'date'=>false, 'volunteerName'=>false],
	];
	
	public static $ranks = [
		 200 => 'Bronze IV',
		 150 => 'Bronze III',
		 100 => 'Bronze II',
		 50 => 'Bronze I',
	];
}
