<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function home () {
		
	//	Mail::send('emails.auth.test', array('name' => 'Alex'), function($message) {
	//		$message->to('farcry3tombraider001@gmail.com', 'Alex Garett')->subject('Test email');
	//d	});
		
		return View::make('home');
	}

	/**
	* Return view for the about page.
	*/
	public function getAbout() {
		return View::make('about');
	}
}
