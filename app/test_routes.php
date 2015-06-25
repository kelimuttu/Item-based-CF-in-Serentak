<?php 

Route::get('/test', function()
{
	return View::make('page.tentang');
});
//Route::get('/test', array('uses'=>'UsersController@index'));

Route::get('/login', function()
{
	Session::put('logged_in', true);
	Session::put('level', 'student');
});

Route::get('/login-admin', function()
{
	Session::put('logged_in', true);
	Session::put('level', 'admin');
});