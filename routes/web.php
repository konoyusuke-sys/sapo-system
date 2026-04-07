<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('config:clear');

    return "Cache cleared!";
});

Route::impersonate();

Auth::routes();

Route::get('/mail_schedule', 'App\Http\Controllers\FrontController@mail_schedule');
Route::get('/test', 'App\Http\Controllers\FrontController@test');


Route::get('/', 'App\Http\Controllers\FrontController@index');
Route::get('/form_index', 'App\Http\Controllers\FrontController@form')->name('form_index');
Route::post('/display', 'App\Http\Controllers\FrontController@display')->name('display');
Route::post('/post_form', 'App\Http\Controllers\FrontController@post_form')->name('post_form');
Route::get('/thanks', 'App\Http\Controllers\FrontController@thanks')->name('thanks');
Route::get('/policy', 'App\Http\Controllers\FrontController@policy')->name('policy');
Route::get('/information', 'App\Http\Controllers\FrontController@information')->name('information');
Route::get('/disclaimer', 'App\Http\Controllers\FrontController@disclaimer')->name('disclaimer');

Route::get('/form', 'App\Http\Controllers\FormController@index')->name('form.index');
Route::get('/form/detail/{id}', 'App\Http\Controllers\FormController@detail')->name('form.detail');
Route::post('/form/detail/update', 'App\Http\Controllers\FormController@update_form')->name('form.update');

Route::get('/form/list/{form_id}/export', 'App\Http\Controllers\FormController@exportHistoryCsv')->name('form.list.export');
Route::get('/form/list/{id}', 'App\Http\Controllers\FormController@list')->name('form.list');

Route::get('/form/group/{id}', 'App\Http\Controllers\FormController@group_index')->name('form.group.index');
Route::get('/form/group/detail/{id}', 'App\Http\Controllers\FormController@group_detail')->name('form.group.detail');
Route::get('/form/group/add/{form_id}', 'App\Http\Controllers\FormController@group_add')->name('form.group.add');
Route::post('/form/group/update', 'App\Http\Controllers\FormController@update_group')->name('form.group.update');
Route::post('/form/group/delete', 'App\Http\Controllers\FormController@delete_group')->name('form.group.delete');

Route::get('/form/sender/index/{form_id}/{group_id}', 'App\Http\Controllers\FormController@sender_index')->name('form.sender.index');
Route::get('/form/sender/detail/{sender_id}', 'App\Http\Controllers\FormController@sender_detail')->name('form.sender.detail');
Route::get('/form/sender/add/{group_id}', 'App\Http\Controllers\FormController@sender_add')->name('form.sender.add');
Route::post('/form/sender/update', 'App\Http\Controllers\FormController@update_sender')->name('form.sender.update');
Route::post('/form/sender/delete', 'App\Http\Controllers\FormController@delete_sender')->name('form.sender.delete');

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');
Route::get('/config', 'App\Http\Controllers\ConfigController@index')->name('config');
Route::put('/config/update/{id}', 'App\Http\Controllers\ConfigController@update')->name('config.update');
Route::post('/config/store/permission_group', 'App\Http\Controllers\ConfigController@storePermissionGroup')->name('config.store.permission_group');
Route::put('/config/update/permission_group/{id}', 'App\Http\Controllers\ConfigController@updatePermissionGroup')->name('config.update.permission_group');
Route::post('/config/store/permission', 'App\Http\Controllers\ConfigController@storePermission')->name('config.store.permission');
Route::put('/config/update/permission/{id}', 'App\Http\Controllers\ConfigController@updatePermission')->name('config.update.permission');

Route::group(['namespace' => 'App\Http\Controllers\Profile'], function (){ 
	Route::get('/profile', 'ProfileController@index')->name('profile');
	Route::put('/profile/update/profile/{id}', 'ProfileController@updateProfile')->name('profile.update.profile');
	Route::put('/profile/update/password/{id}', 'ProfileController@updatePassword')->name('profile.update.password');
	Route::put('/profile/update/avatar/{id}', 'ProfileController@updateAvatar')->name('profile.update.avatar');
});

Route::group(['namespace' => 'App\Http\Controllers\Error'], function (){ 
	Route::get('/unauthorized', 'ErrorController@unauthorized')->name('unauthorized');
});

Route::group(['namespace' => 'App\Http\Controllers\User'], function (){ 
	//Users
	Route::get('/user', 'UserController@index')->name('user');
	Route::get('/user/create', 'UserController@create')->name('user.create');
	Route::post('/user/store', 'UserController@store')->name('user.store');
	Route::get('/user/edit/{id}', 'UserController@edit')->name('user.edit');
	Route::put('/user/update/{id}', 'UserController@update')->name('user.update');
	Route::get('/user/edit/password/{id}', 'UserController@editPassword')->name('user.edit.password');
	Route::put('/user/update/password/{id}', 'UserController@updatePassword')->name('user.update.password');
	Route::get('/user/show/{id}', 'UserController@show')->name('user.show');
	Route::get('/user/destroy/{id}', 'UserController@destroy')->name('user.destroy');
	// Roles
	Route::get('/role', 'RoleController@index')->name('role');
	Route::get('/role/create', 'RoleController@create')->name('role.create');
	Route::post('/role/store', 'RoleController@store')->name('role.store');
	Route::get('/role/edit/{id}', 'RoleController@edit')->name('role.edit');
	Route::put('/role/update/{id}', 'RoleController@update')->name('role.update');
	Route::get('/role/show/{id}', 'RoleController@show')->name('role.show');
	Route::get('/role/destroy/{id}', 'RoleController@destroy')->name('role.destroy');
});