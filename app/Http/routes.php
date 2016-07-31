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
   
   //---- API ROUTES TEST AND AUTH ==================================  
    Route::get('getImageFolders', 'GoogleDriveController@getImageFolders');
    Route::get('authenticate/user', 'AuthenticateController@getAuthenticatedUser');
    Route::get('authenticate/users', 'AuthenticateController@index');
    Route::post('authenticate', 'AuthenticateController@authenticate');

    Route::resource('blogEntries', 'BlogEntriesController');  
    Route::resource('tag', 'TagController');
    Route::resource('personalInformation', 'PersonalInformationController');
    Route::resource('navigationUrl', 'NavigationUrlController');
    Route::resource('blogEntries', 'BlogEntriesController');
    Route::post('addBlogEntriesComment', 'BlogEntriesController@addBlogEntriesComment');
    Route::get('getTagFilter/{name}', 'TagController@getTagFilter');
    Route::get('common/getStates', 'CommonController@getStates');
    Route::get('common/getConfiguration/{idConfiguration}', 'CommonController@getConfiguration');
    Route::get('getFileFolders', 'GoogleDriveController@getFileFolders');
    Route::get('getFiles/{folderId}', 'GoogleDriveController@getFiles');
    Route::get('getImages/{folderId}', 'GoogleDriveController@getImages');
    Route::get('getImageProfile', 'GoogleDriveController@getImageProfile');
    Route::get('getTagsByBlogEntriesId/{id}', 'TagController@getTagsByBlogEntriesId');
    Route::get('getAdminUrls', 'NavigationUrlController@getAdminUrls');
    Route::get('getPublicUrls', 'NavigationUrlController@getPublicUrls');
    Route::get('getBlogEntries/{headerUrl}', 'BlogEntriesController@getBlogEntries');
    Route::get('getBlogEntriesComments/{id}', 'BlogEntriesController@getBlogEntriesComments');
    Route::get('getPersonalInformation', 'PersonalInformationController@getPersonalInformation');
    Route::get('getPublicUrls', 'NavigationUrlController@getPublicUrls');
    
});