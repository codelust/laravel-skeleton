<?php

namespace Frontiernxt\Routes;

use Illuminate\Support\Facades\Route;
/*use Frontiernxt\Controllers\Auth\RegisterController;
use Frontiernxt\Controllers\Auth\LoginController;
use Frontiernxt\Controllers\Auth\ForgotPasswordController;
use Frontiernxt\Controllers\Auth\ResetPasswordController;
*/
/**
 * Re-implement some of the auth routes in the auth scaffolding.
 *
 * @return void
 */


Class Auth {

	public function routes()
	{
	 

		
		Route::get('register', ['as' => 'register', 'uses' => '\Frontiernxt\Controllers\Auth\RegisterController@showRegistrationForm']); 

		Route::post('register', ['uses' => '\Frontiernxt\Controllers\Auth\RegisterController@register']); 


	    // Authentication Routes...
	    Route::get('login', ['as' => 'login', 'uses' => '\Frontiernxt\Controllers\Auth\LoginController@showLoginForm']);

	    Route::post('login', ['uses' => '\Frontiernxt\Controllers\Auth\LoginController@login']); 

	    Route::post('logout', ['as' => 'logout', 'uses' => '\Frontiernxt\Controllers\Auth\LoginController@logout']);
		/*
	    Route::get('login', 'LoginController@showLoginForm')->name('login');
	    Route::post('login', 'LoginController@login');
	    Route::post('logout', 'LoginController@logout')->name('logout');*/

	    // Registration Routes...
	    /*Route::post('register', 'RegisterController@register');

	    Route::get('register', ['as' => 'register', 'uses' => '\Frontiernxt\Controllers\Auth\RegisterController@showRegistrationForm']); 


	    
		
	    // Password Reset Routes...
	    
	    /*Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm');
	    Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail');
	    Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm');
	    Route::post('password/reset', 'ResetPasswordController@reset');*/

	    Route::get('password/reset', ['uses' => '\Frontiernxt\Controllers\Auth\ForgotPasswordController@showLinkRequestForm']);

	    Route::post('password/email', ['uses' => '\Frontiernxt\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail']);

	    Route::get('password/reset/{token}', ['uses' => '\Frontiernxt\Controllers\Auth\ResetPasswordController@showResetForm']);

	    Route::post('password/reset', ['uses' => '\Frontiernxt\Controllers\Auth\ResetPasswordController@reset']);
	}	
}

