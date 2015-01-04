<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', array(
	'as' => 'home',
	'uses' => 'HomeController@home'
));

// Route::get('/account/{what}/', array( 'as' => 'account-login-post', function($what) {
	// return "Custom shit.".$what;
// }));

/*
 * File upload (test)
*/
Route::post('/faculty/zxczc', array(
	'uses' => 'AccountController@postUploadFile'
));

/*
 * Authenticated group
 */
 Route::group(array('before' => 'auth'), function() {
	/*
 	* Sign out (GET)
 	*/ 	
 	Route::get('/accout/sign-out', array(
		'as' => 'account-sign-out',
		'uses' => 'AccountController@getSignOut'
	));

	/*
	* Faculty home page.
	*/
	Route::get('/faculty/{firstname}/', array( 'as' => 'facultyhome', function($firstname) {
			return View::make('faculty');
	}));

	/*
	* Student home page
	*/
	Route::get('/student/{firstname}/', array( 'as' => 'studenthome', function($firstname) {
			return View::make('student');
	}));
 });

/*
 * Unauthenticated group
 */
Route::group(array('before' => 'guest'), function() {
	
	/*
	 *  CSRF protection group
	 */
	Route::group(array('before' => 'csrf'), function() {
		/*
		 *  Create account (POST)
		 */
		Route::post('/account/create', array(
			'as' => 'account-create-post',
			'uses' => 'AccountController@postCreate'
		));
		
		/*
		 *  Log in. 
		 */
		Route::post('/account/login', array(
			'as'=> 'account-login-post',
			'uses'=> 'AccountController@postLogin'
		));
	});
	
	/*
	 *  Create account (GET)
	 */
	Route::get('/account/create', array(
		'as' => 'account-create',
		'uses' => 'AccountController@getCreate'
	));
	
	Route::get('/account/activate/{code}', array(
		'as'=> 'account-activate',
		'uses'=> 'AccountController@getActivate'
	));
});
