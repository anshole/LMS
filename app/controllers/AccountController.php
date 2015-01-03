<?php

class AccountController extends  BaseController {

	public function getCreate() {
		return View::make('account.create');
	}

	public function postCreate() {
		$validator = Validator::make(Input::all(), 
			array(
				'email' => 'required | max:50 | email | unique:users',
				'first_name' => 'required',
				'last_name' => 'required',
				'username' => 'required | max:50 | min:3 | alpha_dash | unique:users',
				'category' => 'required',
				'course' => 'required_if:category,student',
				'branch' => 'required_if:category,student',
				'semester' => 'required_if:category,student',
				'class' => 'required_if:category,student | max:60 | alpha_dash',
				'rollno' => 'required_if:category,student',
				'password' => 'required | min:6',	
				'password_again' => 'required | same:password'
			)
		);

		if ($validator->fails()) {
			Log::info('failed here a');
			return Redirect::route('account-create')
						-> withErrors($validator)
						-> withInput();
		} else {
			$email = Input::get('email');
			$username = Input::get('username');
			$category = Input::get('category');
			$password = Input::get('password');



			$first_name = Input::get('first_name');
			$last_name = Input::get('last_name');

			// Activation code
			$code = str_random(60);
			
			$user = User::create(array(
				'email' => $email,
				'username' => $username,
				'category' => $category,
				'password' => Hash::make($password),
				'code' => $code,
				'active' => 0
			));
			
			if ((Input::get('category')) == 'student') {
				$class = Input::get('class');

				$student = Student::create(array(
						'student_id' => $user->id,
						'first_name' => $first_name,
						'last_name' => $last_name,
						'class' => $class
				));
			}
			

			if ($user) {
				// Send email
				Mail::send('emails.auth.activate', array('link'=> URL::route('account-activate', $code), 'username'=>$username), function($message) use ($user){
					$message->to($user->email, $user->username)->subject('Activate your account.');
				});
				
				return Redirect::route('home')
						-> with('global', 'Your account has been created! We have sent you an email to activate your account.');
			}

			Log::info('1');
		}

		Log::info('2');
	}

	public function getActivate($code) {
		$user = User::where('code', '=', $code)->where('active', '=', '0');
		
		if($user->count()) {
			$user = $user->first();
			
			// Update user to active state
			$user->active = 1;
			$user->code = '';
			
			if($user->save()) {
				return Redirect::route('home')
					->with('global', 'Activated! You can now sign in!');
				
			}
		}

		return Redirect::route('home')
				->with('global', 'We could not activae your account. Try again later.');
	}

	public function postLogin() {
		$validator = Validator::make(Input::all(), 
			array(
				'email' => 'required|email',
				'password' => 'required'
			)
		);
		
		if ($validator->fails()) {
			return Redirect::route('home')
				->withErrors($validator);
			//return View::make('account.create');
		} else {
			// Attemp user sign in
			
			$remember = (Input::has('remember')) ? true : false;
 			
			$auth = Auth::attempt(array(
				'email' => Input::get('email'),
				'password' => Input::get('password'),
				'active' => 1,
			), $remember);
			
			if($auth) {
				$firstname = Auth::user()->username;
				// Send Faculties to faculty page.
				if(Auth::user()->category == 'faculty') {
					return Redirect::route('facultyhome', $firstname)->with('firstname', $firstname);
				}
				// Send Students to student page.
				if(Auth::user()->category == 'student') {
					return Redirect::route('studenthome', $firstname)->with('firstname', $firstname);
				}
				// Redirec to intended page
				return Redirect::route('home')->with('global', 'thisisatejast');
			} else {
					return Redirect::route('home')
							->with('global', 'Wrong Email/Password, or account not activated.');
					//return View::make('account.create');
			}
		}
		
		// return Redirect::route('home')
				// ->with('global', 'There was a problem signing you in. Have you activated your account?');
			return View::make('account.create');
	}
	
	public function getSignOut() {
		Auth::logout();	
		return Redirect::route('home');
	}
}
