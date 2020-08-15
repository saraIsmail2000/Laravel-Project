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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/test' , 'FacilitatorController@beginRounds')->name('khgu');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/approve', 'AdminController@approveUser')->name('approve');

Route::get('/approve', 'AdminController@approve')->name('app');

Route::post('/workshop/kick', 'FacilitatorController@kickUser')->name('kick');

Route::get('/workshop/kick', 'FacilitatorController@kick')->name('Kiko');

Route::post('/creatingworkshop' , 'FacilitatorController@createWorkshop')->name('create');

Route::post('/joiningworkshop' , 'UserController@joinWorkshop')->name('join');

Route::get('/workshop' , 'HomeController@viewWorkshop')->name('view');

Route::post('/workshop/begin' , 'FacilitatorController@beginWorkshop')->name('begin');

Route::post('/submitIdea' , 'UserController@submitSolution')->name('idea');

Route::post('/workshop/firstround' , 'FacilitatorController@beginRounds')->name('round1');

Route::post('/workshop/nextRound' , 'FacilitatorController@nextRound')->name('rounds');

Route::get('/workshop/rating' , 'UserController@ideatorate')->name('rate');

Route::post('/workshop/rated' , 'UserController@RateIdea')->name('submitRate');

Route::post('/workshop/makegroups' , 'FacilitatorController@makeGroups')->name('groups');

Route::get('/workshop/showgroups' , 'FacilitatorController@showGroups')->name('stage4');

Route::post('/workshop/joingroup' , 'UserController@joinGroup')->name('joinG');

Route::post('/workshop/exitgroup' , 'UserController@exitGroup')->name('exit');

Route::post('/workshop/kickfromgroup' , 'FacilitatorController@kickFromGroup')->name('kickG');

Route::post('/workshop/finish' , 'FacilitatorController@finish')->name('finish');

Route::post('/gohome' , 'FacilitatorController@home')->name('back');

Route::post('/viewhistory' , 'UserController@history')->name('back');

