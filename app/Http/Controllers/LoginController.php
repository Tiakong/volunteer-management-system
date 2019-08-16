<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\VolunteerAccount;
use App\AdminAccount;

class LoginController extends Controller
{
	public function index(){
		return view('/login');
	}

	public function auth(){
		Session::put('authority','null');
		return redirect()->route('login')->with('alert', 'Please login before you access the portal');
	}

	public function logout(){
		Session::forget('authority');
		Session::forget('user_id');
		return view('/login');
	}
	
	public function login(Request $request)
	{
		$username = $request->get('username');
		$password = $request->get('password');
		
		$this->validate($request, [
			'username' 	=> 'required',
			'password'	=> 'required'
		]);
		
		//Check if it's admin
		$a = AdminAccount::where('username', $username)->first();
		if($a && Hash::check($password, $a->password))
		{
			$request->session()->put('user_id', $a->username);
			$request->session()->put('authority', 'admin');
			return redirect()->route('home')->with('success', 'Welcome '.$username);
		}
		
		$this->validate($request, [
			'username' 	=> 'required',
			'password'	=> 'required'
		]);
		
		//Check if volunteer account exists
		$v = VolunteerAccount::where('username', $username)->first();
		if( $v && Hash::check($password, $v->password))
		{
			$request->session()->put('user_id', $v->vid);
			$request->session()->put('authority', 'volunteer');
			return redirect()->route('home')->with('success', 'Welcome '.$username);
		}
		else
		{
			return redirect()->route('login')->with('fail', 'Username not exists or incorrect password.');
		}
	}
}
