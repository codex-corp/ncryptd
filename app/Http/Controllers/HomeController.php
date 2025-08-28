<?php namespace App\Http\Controllers;

use App\User;
use View;

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{

//		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		$users = User::orderBy('id', 'DESC')->take(9)->get();

		return view('index', compact('users'));
	}

	static function checkStaticPage($view){
		try
		{
			View::getFinder()->find('static.'.$view);
			return true;
		}
		catch (InvalidArgumentException $error)
		{
			// View does not exist...
			return false;
		}
	}

}
