<?php

namespace App\Http\Controllers;

use App\Common;
use Illuminate\Http\Request;
use App\AdminAccount;
use App\VolunteerAccount;
use App\Volunteer;
use App\Event;
use App\Programme;
use App\ProgrammeImage;
use App\InterestedProgramme;
use App\Officework;
use App\Notification;
use App\AwardHistory;
use App\Skillset;
use App\VolunteerEvent;
use App\VolunteerNotification;
use App\VolunteerOfficework;

class AdminController extends Controller
{	

	public function searchVolunteer()
	{
		return view('admin.search-volunteer');
	}
	
}
