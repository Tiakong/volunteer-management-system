<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Common;

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
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Home page
Route::get('/', 'MainController@index')->name('home');
//Login
Route::get('/login', 'LoginController@index')->name('login');
//authenticate access
Route::get('/login/auth', 'LoginController@auth')->name('auth');

Route::post('/login-validate', 'LoginController@login');
//Logout
Route::get('/logout', 'LoginController@logout')->name('logout');

//Register
Route::get('/register','VolunteerController@register')->name('volunteer.register');

Route::post('/register','VolunteerController@store')->name('volunteer.store');

Route::get('/password/change','VolunteerController@password')->name('volunteer.password');

Route::post('/password/change','VolunteerController@update_password')->name('volunteer.update_password');


/*
  =======================
  == Volunteer related ==
  =======================
*/
//Show profile
Route::get('/volunteer/show', 'VolunteerController@show')->name('volunteer.show');

Route::get('/volunteer/show-by-search/{id}', 'VolunteerController@show_by_search')->name('volunteer.show-by-search');
//Store volunteeer
//Edit profile
//Edit event must change to post
Route::get('/volunteer/edit/{id}','VolunteerController@edit')->name('volunteer.edit');
//Update event
Route::post('/volunteer/update','VolunteerController@update')->name('volunteer.update');

/*
  ===================
  == Query related ==
  ===================
*/

//Seach volunteer by name
Route::post('/query/search_volunteer_by_name','QueryController@searchVolunteerByName')->name('query.searchVolByName');
Route::post('/query/search_volunteer_by_criteria','QueryController@searchVolunteerByCriteria')->name('query.searchVolunteerByCriteria');
Route::post('/query/search_volunteer_by_programme','QueryController@searchVolunteerByProgramme')->name('query.searchVolunteerByProgramme');
Route::post('/query/combineSearchQuery','QueryController@combineSearchQuery')->name('query.combineSearchQuery');
//Retrive queried result
Route::post('/query/export_data','QueryController@exportData');
//Search volunteers in an office work
Route::post('/query/VO_get_volunteers', 'QueryController@VO_getVolunteers')->name('query.VO_getVolunteers');

//view volunteer profile
Route::get('/volunteer/show/{id}','VolunteerController@get_volunteer')->name('volunteer.get-volunteer');

//Get All Programmes
Route::post('/query/get-programmes', 'QueryController@getProgrammes')->name('query.get-programmes');

//Get All Programmes
Route::post('/query/get-events', 'QueryController@getEvents')->name('query.get-events');

//Export data back end
Route::post('/query/export-data', 'QueryController@exportData')->name('query.export-data');
//Export data guildance
Route::post('/query/export-data-guidance', 'QueryController@exportDataGuidance')->name('query.export-data-guidance');
/*
  ===================
  == Admin related ==
  ===================
*/

//Admin homepage (index)

//Search volunteer
Route::get('/admin/search-volunteer',function(){return view('admin.search-volunteer');})->name('admin.searchVolunteer');
//Export data
Route::get('/admin/export-data', function(){return view('admin.export-data');})->name('admin.export-data');

/*
  =======================
  == Programme related ==
  =======================
*/

Route::get('/programme/create','ProgrammeController@create')->name('programme.create');
Route::post('/programme/create','ProgrammeController@store')->name('programme.store');
Route::get('programme/','ProgrammeController@index')->name('programme.index');
Route::post('programme/show','ProgrammeController@show')->name('programme.show');
Route::get('programme/edit/{id}','ProgrammeController@edit')->name('programme.edit');
Route::put('programme/{id}','ProgrammeController@update')->name('programme.update');
Route::get('programme/tab','ProgrammeController@select_tab')->name('programme.select-tab');
Route::get('programme/delete/{id}','ProgrammeController@delete')->name('programme.delete');

/*
  ===================
  == Event related ==
  ===================
*/
//Event index
Route::get('/event/','EventController@index')->name('event.index');
//Create event
Route::get('/event/create','EventController@create')->name('event.create');
//Store event
Route::post('/event/create','EventController@store')->name('event.store');
//Edit event
Route::get('/event/edit/{id}','EventController@edit')->name('event.edit');
//Update event
Route::post('/event/update/{id}','EventController@update')->name('event.update');
//Delete event
Route::get('/event/delete/{id}','EventController@destroy')->name('event.destroy');

/*
  =================
  = Admin - Event =
  =================
*/
//Event index (admin)
Route::get('/event/admin-show/{code}','EventController@admin_show')->name('event.admin-show');
//Show event detail
Route::post('/event/admin-show-detail/','EventController@admin_show_detail')->name('event.admin-show-detail');

Route::get('/event/admin-show-detail/{id}','EventController@back_admin_show_detail')->name('event.admin-back-show-detail');

/*
  =====================
  = Volunteer - Event =
  =====================
*/
//Event index (volunteer)
Route::get('/event/volunteer-show/{code}','EventController@volunteer_show')->name('event.volunteer-show');
//Show event detail
Route::post('/event/volunteer-show-detail','EventController@volunteer_show_detail')->name('event.volunteer-show-detail');



Route::get('/event/admin-show/{code}/tab','EventController@select_tab')->name('event.select-tab');


//Get event volunteer list
Route::get('/event/show-volunteer-list/{id}','Volunteer_eventController@index')->name('volunteer_event.index');
//Search a volunteer
Route::get('/event/add-volunteer/{id}','Volunteer_eventController@create')->name('volunteer_event.create');
//
Route::get('/event/add-volunteer', 'Volunteer_eventController@action')->name('volunteer_event.action');
//Add a new volunteer
Route::post('/event/show-volunteer-list/{id}','Volunteer_eventController@update')->name('volunteer_event.update');

Route::post('/event/confirm/{id}','Volunteer_eventController@confirm')->name('volunteer_event.confirm');

Route::post('/event/delete/{id}','Volunteer_eventController@destroy')->name('volunteer_event.destroy');

Route::get('/event/volunteer-show/{code}/tab','EventController@volunteer_select_tab')->name('event.volunteer-select-tab');

Route::get('/event/reserve/{id}','EventController@reserve')->name('event.reserve');
/*
  ==========================
  == Notification related ==
  ==========================
*/
//Notification index
Route::get('/notification/', 'NotificationController@index')->name('notification.index');
//Create notifications
Route::get('/notification/create', 'NotificationController@create')->name('notification.create');
//Store notification
Route::post('/notification/create', 'NotificationController@store');
//Show notification detail
Route::get('/notification/show/{id}', 'NotificationController@show')->name('notification.show');
//Edit notification
Route::get('/notification/edit/{id}', 'NotificationController@edit')->name('notification.edit');
//Update notification
Route::match(['put', 'patch'], '/notification/update/{id}', 'NotificationController@update')->name('notification.update');
//Delete notifications
Route::get('/notification/{id}', 'NotificationController@destroy')->name('notification.delete');
Route::post('/notification/send', 'NotificationController@send')->name('notification.send');

/*
  =========================
  == Office work related ==
  =========================
*/
//Office work index
Route::get('/officework/', 'OfficeworkController@index')->name('officework.index');
//Assign(Create) office work
Route::get('/officework/create', 'OfficeworkController@create')->name('officework.create');
//Show office work detail
Route::get('/officework/show/{id}', 'OfficeworkController@show')->name('officework.show');
//Store notification
Route::post('/officework/create', 'OfficeworkController@store');
//Edit office work
Route::get('/officework/edit/{id}', 'OfficeworkController@edit')->name('officework.edit');
//Update office work
Route::match(['put', 'patch'], '/officework/update/{id}', 'OfficeworkController@update')->name('officework.update');
//Delete office work
Route::get('/officework/{id}', 'OfficeworkController@destroy')->name('officework.delete');


/*
  ==========================
  ====== Award related =====
  ==========================
*/

//show event volunteer list
Route::get('/award', 'MainController@award')->name('award');

// Front end

// Route::get('/', function(){return view('index');})->name('index');
// Route::get('/view', "TenantController@view")->name('view');
// Route::get('/map', function(){return view('map');});

//Login and logout
Route::get('/register', 'VolunteerController@register')->name('register');

