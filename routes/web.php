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

use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    if(!Auth::guest()) {
        return redirect('home');
    } else {
        return view('welcome');
    }
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/register', 'PageController@register')->name('register');
// messages controllers rout
Route::get('/messages/list', 'Message\IndexController@conversations')->name('conversations_list');
Route::get('/messages/{userId}', 'Message\IndexController@messages')->name('conversations_list');
Route::post('/messages/{userId}', 'Message\IndexController@send')->name('message');
// profile controllers rout
Route::get('/profile', 'Profile\IndexController@index')->name('profile');
Route::get('/profile/edit', 'Profile\IndexController@edit')->name('profile');
Route::post('/profile/edit', 'Profile\IndexController@saveProfile')->name('profile');
Route::get('/profile/{id}', 'Profile\IndexController@view')->name('profile_view');
// файлы пользователя
Route::post('/files/upload', 'Profile\FilesController@upload')->name('upload');
Route::get('/files/setAvatars/{id}', 'Profile\FilesController@setAvatars')->name('set_avatars');
Route::get('/files/show/{id}', 'Profile\FilesController@showImages')->name('show_images');
Route::post('/files/show/{id}', 'Profile\FilesController@commentImages')->name('show_images');
Route::get('/events/', 'Profile\EventsController@index')->name('events');


Route::group([
    'prefix' => 'admin',
    'middleware' => ['auth', 'roles'],
    'roles' => 'superadmin'],
    function () {
        Route::get('/', 'Admin\AdminController@index');
        Route::resource('/roles', 'Admin\RolesController');
        Route::resource('/permissions', 'Admin\PermissionsController');
        Route::resource('/users', 'Admin\UsersController');
        Route::post('/users/{userId}/fakelogin', 'Admin\UsersAttributeController@fakelogin');
        Route::get('/users_attribute', 'Admin\UsersAttributeController@index');
        Route::post('/users_attribute', 'Admin\UsersAttributeController@post');
        Route::post('/users_attribute/{id}', 'Admin\UsersAttributeController@update');
        Route::get('/users_attribute/{id}/edit', 'Admin\UsersAttributeController@edit');
        Route::get('/users_attribute/create', 'Admin\UsersAttributeController@create');
        Route::get('/generator', ['uses' => '\Appzcoder\LaravelAdmin\Controllers\ProcessController@getGenerator']);
        Route::post('/generator', ['uses' => '\Appzcoder\LaravelAdmin\Controllers\ProcessController@postGenerator']);
    }
    );
