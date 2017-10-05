<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

// Public Routes
Route::group(['middleware' => 'web'], function () {

    // Activation Routes
    Route::get('/activate', ['as' => 'activate', 'uses' => 'Auth\ActivateController@initial']);

    Route::get('/activate/{token}', ['as' => 'authenticated.activate', 'uses' => 'Auth\ActivateController@activate']);
    Route::get('/activation', ['as' => 'authenticated.activation-resend', 'uses' => 'Auth\ActivateController@resend']);
    Route::get('/exceeded', ['as' => 'exceeded', 'uses' => 'Auth\ActivateController@exceeded']);

    // Socialite Register Routes
    Route::get('/social/redirect/{provider}', ['as' => 'social.redirect', 'uses' => 'Auth\SocialController@getSocialRedirect']);
    Route::get('/social/handle/{provider}', ['as' => 'social.handle', 'uses' => 'Auth\SocialController@getSocialHandle']);

    // Route to for user to reactivate their user deleted account.
    Route::get('/re-activate/{token}', ['as' => 'user.reactivate', 'uses' => 'RestoreUserController@userReActivate']);

    // 
    // social
    Route::get('auth/github', 'Auth\AuthController@redirectToProvider');
    Route::get('auth/github/callback', 'Auth\AuthController@handleProviderCallback');
});

// Registered and Activated User Routes
Route::group(['middleware' => ['auth', 'activated']], function () {

    // Activation Routes
    Route::get('/activation-required', ['uses' => 'Auth\ActivateController@activationRequired'])->name('activation-required');

    Route::get('/logout', ['uses' => 'Auth\LoginController@logout'])->name('logout');

    //  Homepage Route - Redirect based on user role is in controller.
    // Route::get('/home', ['as' => 'public.home',   'uses' => 'UserController@index']);
    Route::get('/home', 'HomeController@index')->name('public.home');
});

// Registered, activated, and is admin routes.
Route::group(['middleware'=> ['auth', 'activated', 'role:admin']], function () {


	Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
});


