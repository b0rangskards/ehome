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

/* Public pages */
use App\Events\SampleEvent;
use App\Events\UserHasRegistered;
use App\Notification;
use App\Repositories\UserRepository;
use App\Task;
use App\TaskNote;
use App\User;

Route::get('/', ['as'   => 'public.landing', 'uses' => 'PublicController@showLandingPage']);
Route::get('/error', ['as' => 'public.error', 'uses' => 'PublicController@showErrorPage']);

/* Auth, Registration pages */
Route::group(['prefix' => 'auth', 'as' => 'auth.'], function(){
	// Sign in routes
	Route::get('login', ['as' => 'login', 'uses' => 'Auth\AuthController@getLogin']);
	Route::post('login', ['as' => 'login', 'uses' => 'Auth\AuthController@postLogin']);
	// Log out route
	Route::get('logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@getLogout']);
	// Registration routes
	Route::get('register', ['as' => 'register', 'uses' => 'Auth\AuthController@getRegister']);
	Route::post('register', ['as' => 'register', 'uses' => 'Auth\AuthController@postRegister']);
	Route::get('register/activate/{activationCode}', ['as' => 'register.activate', 'uses' => 'Auth\UserActivationController@activateAccount']);
	Route::post('register/activate/{activationCode}', ['as' => 'register.activate', 'uses' => 'Auth\UserActivationController@setupPassword']);
});

/* Admin pages */
Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
	Route::get('dashboard', ['as' => 'dashboard', 'uses' => 'Admin\AdminPagesController@getDashboard']);
	Route::get('users', ['as' => 'users.index', 'uses' => 'Admin\UsersController@index']);
});

/* Member pages */
Route::get('/home', ['as' => 'home', 'uses' => 'MemberPagesController@index']);
// Household pages
Route::resource('household', 'HouseholdsController');
Route::resource('household.member', 'HouseholdMembersController');
Route::resource('task', 'TasksController');
Route::patch('/task/{task}/confirm', ['as' => 'task.confirm', 'uses' => 'TasksController@confirm']);
Route::patch('/task/{task}/status', ['as' => 'task.update.status', 'uses' => 'TasksController@updateStatus']);
Route::post('/task/{task}/add-note', ['as' => 'task.add-note', 'uses' => 'TasksController@addNote']);

Route::get('/notifications', ['as' => 'notification.index', 'uses' => 'NotificationsController@index']);
Route::patch('/notification/markseen', ['as' => 'notification.markseen', 'uses' => 'NotificationsController@markSeen']);

Route::get('profile/{currentUser}', ['as' => 'profile.index', 'uses' => 'UserProfileController@index']);
Route::get('profile/{user}/edit', ['as' => 'profile.edit', 'uses' => 'UserProfileController@edit']);
Route::put('profile/{user}/update', ['as' => 'profile.update', 'uses' => 'UserProfileController@update']);
Route::get('profile/{currentUser}/settings', ['as' => 'profile.settings', 'uses' => 'UserProfileController@getSettings']);
Route::delete('profile/{user}/deactivate', ['as' => 'profile.deactivate', 'uses' => 'UserProfileController@deactivate']);

Route::get('/subscriptions', ['as' => 'subscriptions.index', 'uses' => 'UserSubscriptionsController@index']);


/* Test route */
Route::get('test', function () {
	dd(Auth::user()->tasks);
});

/* Route Model Binding */
Route::model('user', App\User::class);
Route::model('household', App\Household::class);
Route::model('member', App\HouseholdMember::class);
Route::model('task', App\Task::class);

