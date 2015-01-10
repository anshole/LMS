<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Sheet_info extends Eloquent implements UserInterface, RemindableInterface {
	
	protected $fillable = array('id', 'sheet_name', 'sheet_creator');

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'sheet_info';

	/**
	* Get latest stored sheet id
	*/
	public static function getLastUploadedSheet() {

		return Sheet_info::orderby('created_at', 'desc')->first();
	}

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	//protected $hidden = array('password', 'remember_token');

}

