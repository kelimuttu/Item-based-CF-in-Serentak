<?php

include_once('test_routes.php');

Route::get('/', function()
{
	if(Session::has('logged_in') && Session::get('logged_in')=='1')
	{
		return View::make('dashboard');
	}
	else
	{
		return View::make('landing_page');
	}
});

Route::post('/signup', array('before'=>'csrf|belum_login', 'uses'=>'UsersController@daftar'));
Route::post('/validasi_daftar', array('before'=>'belum_login', 'uses'=>'UsersController@validasi_daftar'));
// Route::get('/bergabung', function(){
// 	return View::make('selamat_bergabung');
// });
Route::get('/bergabung', array('uses'=>'RecommendationController@get_random_kom'));
Route::post('/pencarian', array('uses'=>'RecommendationController@get_search_result'));

Route::get('/profile', array('before'=>'sudah_login', 'uses'=>'UsersController@profile'));
Route::get('/profile/{id}', array('before'=>'sudah_login', 'uses'=>'UsersController@userprofile'));
Route::post('profile/upload/', array('uses'=>'UsersController@update_avatar'));
Route::get('/profil/edit/', array('before'=>'sudah_login', 'uses'=>'UsersController@edit_profile'));
Route::post('/profil/edit/', array('before'=>'sudah_login', 'uses'=>'UsersController@update_profile'));

// Route::get('/tambah/komunitas/', function(){
// 	return View::make('tambah_komunitas');
// }); 
Route::get('/tambah/komunitas/', array('before'=>'sudah_login', 'uses'=>'KomunitasController@make_tambah_komunitas'));
Route::post('/tambah/komunitas/', array('before'=>'sudah_login', 'uses'=>'KomunitasController@tambah_komunitas'));
Route::get('/komunitas/{id}', array('before'=>'sudah_login', 'uses'=>'KomunitasController@profile'));
Route::get('/bergabung/{id}', array('uses'=>'KomunitasController@bergabung_komunitas'));
Route::get('/keluar/{id}', array('uses'=>'KomunitasController@batal_bergabung'));
Route::post('/komunitas/upload/{id}', array('uses'=>'KomunitasController@update_avatar'));
Route::get('/update/komunitas/{id}', array('before'=>'sudah_login', 'uses'=>'KomunitasController@edit_komunitas'));
Route::post('/update/komunitas/{id}', array('before'=>'sudah_login', 'uses'=>'KomunitasController@update_komunitas'));
Route::post('/rate/komunitas/{id}', array('uses'=>'KomunitasController@give_rate_by_id_kom'));
Route::get('/daftar-komunitas/', array('uses'=>'KomunitasController@fetch_community_list'));



Route::get('/tambah/acara/', array('before'=>'sudah_login', 'uses'=>'EventController@tambah_acara'));
Route::post('/tambah/acara/', array('before'=>'sudah_login', 'uses'=>'EventController@simpan_acara'));
Route::get('/acara/{id}', array('before'=>'sudah_login', 'uses'=>'EventController@acara'));
Route::get('/ikuti/{id}', array('uses'=>'EventController@bergabung_acara'));
Route::get('/batal/{id}', array('uses'=>'EventController@batal_bergabung'));
Route::post('/acara/upload/{id}', array('before'=>'sudah_login', 'uses'=>'EventController@update_poster'));
Route::get('/update/acara/{id}', array('before'=>'sudah_login', 'uses'=>'EventController@edit_acara'));
Route::post('/update/acara/{id}', array('before'=>'sudah_login', 'uses'=>'EventController@update_acara'));
Route::get('/daftar-acara/', array('uses'=>'EventController@fetch_event_list'));

Route::post('/login', array('before'=>'csrf', 'uses'=>'UsersController@proses_login'));
Route::get('/fblogin', array('uses'=>'FacebookController@masuk'));
//Route::get('/fblogin', function() {});
Route::get('/login/fb', function() {
    $facebook = new Facebook(Config::get('facebook'));
    $params = array(
        'redirect_uri' => url('/login/fb/callback'),
        'scope' => 'email',
    );
    return Redirect::to($facebook->getLoginUrl($params));
});
Route::get('login/fb/callback', function() {
    $code = Input::get('code');
    if (strlen($code) == 0) return Redirect::to('/')->with('message', 'There was an error communicating with Facebook');

    $facebook = new Facebook(Config::get('facebook'));
    $uid = $facebook->getUser();

    if ($uid == 0) return Redirect::to('/')->with('message', 'There was an error');

    $me = $facebook->api('/me');

    dd($me);
});
Route::get('/logout', function(){
	Session::flush();
	return Redirect::to('/');
});

Route::get('/tentang', function()
{
    return View::make('page.tentang');
});

Route::get('/beranda', array('before'=>'sudah_login', 'uses'=>'RecommendationController@get_data_for_dashboard'));

//Route Backend
Route::get('/beranda/users', array('uses'=>'UsersController@index'));
Route::post('/beranda/users/hapus/{id}', array('uses'=>'UsersController@hapus_user'));
Route::get('/beranda/komunitas', array('uses'=>'KomunitasController@index'));
Route::post('/beranda/komunitas/hapus/{id}', array('uses'=>'KomunitasController@hapus_komunitas'));
Route::get('/beranda/acara', array('uses'=>'EventController@index'));
Route::post('/beranda/acara/hapus/{id}', array('uses'=>'EventController@hapus_acara'));
// Route::get('/dashboard', function(){
// 	return View::make('dashboard');
// });
