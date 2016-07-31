<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

// API ROUTES ==================================  
Route::group(array('prefix' => 'api'), function() {

    // since we will be using this just for CRUD, we won't need create and edit
    // Angular will handle both of those forms
    // this ensures that a user can't access api/create or api/edit when there's nothing there
   
    Route::get('getImageFolders', 'GoogleDriveController@getImageFolders');
    Route::get('authenticate/user', 'AuthenticateController@getAuthenticatedUser');
    Route::get('authenticate/users', 'AuthenticateController@index');
    Route::post('authenticate', 'AuthenticateController@authenticate');
    
});