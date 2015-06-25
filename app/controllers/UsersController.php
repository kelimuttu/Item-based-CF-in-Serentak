<?php


class UsersController extends BaseController {

	public function __construct(){
		$this->user = new Users();
		$this->acara = new Acara();
		$this->komunitas = new Komunitas();
		$this->rating = new UserRating();
	}

	public function index(){
		$data['users'] = Users::get();
		return View::make('manage_user', $data);
	}

	public function daftar(){
		$data_input = array();
		$data_input['nama_depan'] = Input::get('nama_depan');
		$data_input['nama_belakang'] = Input::get('nama_belakang');
		$data_input['surel'] = Input::get('email');
		$data_input['telpon'] = Input::get('phone');
		$data_input['password'] = Fungsi::enkripsi_password(Input::get('pass'));

		$cekduplikasi = $this->user->cek_duplikasi_email($data_input['surel']);

		if ($cekduplikasi == TRUE) {
			return Redirect::to('/');
		} elseif ($cekduplikasi == FALSE) {
			Users::create($data_input);

			$id = Users::where('surel', '=', $data_input['surel'])->first()->id;
			$user_id = array();
			$user_id['id_user'] = $id;
			UserAvgRate::create($user_id);

			Session::put('logged_in', '1');
			Session::put('level', 'user');
			Session::put('user_id', $id);
			Session::put('user_name', $data_input['nama_depan']);

			return Redirect::to('/bergabung');
		}
		
	}

	public function validasi_daftar(){
		$feedback = array();

		$email = Input::get('email');
		$email_confirm = Input::get('email_confirm');
		$nomor_telepon = Input::get('nomor_telepon');

		$is_nomor_telepon = $this->validasi_nomor_telepon($nomor_telepon);
		$is_email = $this->cek_email_valid($email);
		$is_email_confirm = $this->cek_email_confirm($email, $email_confirm);


		$valid = true;
		$feedback['status'] = 'sukses';
		
		if (!($valid && $is_email['status'] == 'sukses')){
			$feedback['status'] = 'gagal';
			$feedback['issue'] = $is_email['issue'];
		} elseif (!($valid && $is_email_confirm['status'] == 'sukses')){
			$feedback['status'] = 'gagal';
			$feedback['issue'] = $is_email_confirm['issue'];
		} elseif (!($valid && $is_nomor_telepon['status'] == 'sukses')){
			$feedback['status'] = 'gagal';
			$feedback['issue'] = $is_nomor_telepon['issue'];
		}

		return Response::json($feedback);
	}

	public function proses_login()
	{
		//periksa dulu apakau username/email dan password benar
		$jml = Users::where(function($query){
					$query->where('surel', '=', Input::get('email'));
					})
					->where('password', '=', md5(strrev(md5(Input::get('password')))))
					->count();

		//jika benar, maka lanjutkan ke proses membuat session
		if($jml==1){
			$user = User::where(function($query){
						$query->where('surel', '=', Input::get('email'));
						})
						->where('password', '=', md5(strrev(md5(Input::get('password')))))
						->first();

			Session::put('logged_in', '1');
			Session::put('level', $user->level);
			Session::put('user_id', $user->id);
			Session::put('user_name', $user->nama_depan);

			return Redirect::to('/beranda');
		}
		else
		{
			return Redirect::to('/');
		}
	}

	public function profile()
	{
		$iduser = Users::find(Session::get('user_id'))->id;
		$data['user'] = Users::find(Session::get('user_id'));
		$data['komunitas'] = $this->user->get_komunitas_per_user_by_userid($iduser);
		$data['event'] = $this->user->get_event_per_user_by_userid($iduser);
		return View::make('profile', $data);
	}

	public function userprofile($id)
	{
		$data['temp'] = Users::find(Session::get('user_id'));
		$data['user'] = Users::where('id', '=', $id)->first();
		$data['komunitas'] = $this->user->get_komunitas_per_user_by_userid($id);
		$data['event'] = $this->user->get_event_per_user_by_userid($id);
		return View::make('profile', $data);
	}

	public function update_avatar()
	{
		$ava = Input::file('avatar');
		$filename = 'user-'.Session::get('user_id').'.'.Input::file('avatar')->getClientOriginalExtension();
		$path = public_path('assets/img/avatar/'.$filename);
		Image::make($ava->getRealPath())->resize(400, null, function($c){
			$c->aspectRatio();
			$c->upsize();
		})->save($path);
       	$data['foto'] = $filename;

       	Users::where('id', '=', Session::get('user_id'))->update($data);
       	//Users::where('id', '=', $id)->update($data);

		return Redirect::to('/profile');
	}

	public function edit_profile()
	{
		$data['user'] = Users::find(Session::get('user_id'));
		$data['minat'] = Kategori::get();
		$data['cal'] = Calendar::make();
		$data['cal']->setDayLabels(array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu')); 
		$data['cal']->setMonthLabels(array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Jeni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember')); 
		
		return View::make('edit_profile', $data);
	}

	public function update_profile(){
		$data = array(
			'nama_depan'=>Input::get('first_name'),
			'nama_belakang'=>Input::get('last_name'),
			'password' =>Fungsi::enkripsi_password(Input::get('pass')),
			'bio'=>Input::get('bio'),
			'tanggal_lahir'=>Input::get('bday'),
			//'tanggal_lahir'=>setDate(Input::get('bday')),
			'gender'=>Input::get('gender'),
			'alamat'=>Input::get('address'),
			'surel'=>Input::get('email'),
			'telpon'=>Input::get('phone'),
			'facebook'=>Input::get('facebook'),
			'twitter'=>Input::get('twitter'),
			'gplus'=>Input::get('gplus')
			);

		Users::where('id', '=', Session::get('user_id'))->update($data);
		// $cal = Calendar::make();
		// $cal->setDate(Input::get('bday'));
			
		// $data_minat = array();
		// $data_minat['id_user'] = Session::get('user_id');
		// $data_minat['id_genre'] = Input::get('minat');

		// foreach ( as checked) {
		// 	UserMinat::create($data_input);
		// }

		return Redirect::to('/profile');
	}

	public function hapus_user($id){
		Users::where('id', '=', $id)->delete();
		return Redirect::to('/beranda/users');
	}

//===========================================================================================================//	PRIVATE FUNCTION
//============================================================================================================
	
	private function cek_email_valid($email){
		$feedback = array();

		//cek email sudah benar
		$is_email = false;
		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$is_email = true;
		}

		if ($is_email){
			$sudah_dipakai = Users::where('email', '=', $email)->count();
			$feedback['status'] = 'sukses';

			//cek email sudah terpakai atau belum
			if ($sudah_dipakai){
				$feedback['status'] = 'gagal';
				$feedback['issue'] = 'email_terpakai';
			}
		} else {
			$feedback['status'] = 'gagal';
			$feedback['issue'] = 'bukan_email';
		}

		return $feedback;
	}

	private function cek_email_confirm($email, $email_confirm){
		$feedback = array();

		$feedback['status'] = 'sukses';
		//cek email dan email_confirm sama atau tidak
		if (!($email === $email_confirm)){
			$feedback['status'] = 'gagal';
			$feedback['issue'] = 'email_tidak_sama';
		}

		return $feedback;
	}

	private function validasi_nomor_telepon($nomor_telepon){
		$feedback = array();

		$feedback['status'] = 'sukses';
		if(!preg_match("/^[0-9\/-]+$/", $nomor_telepon)){
			$feedback['status'] = 'gagal';
			$feedback['issue'] = 'bukan_nomor_telepon';
		}

		return $feedback;
	}

	private function validasi_password($pass, $pass_confirm){
		$feedback = array();

		$feedback['status'] = 'sukses';
		if(!($pass === $pass_confirm)){
			$feedback['status'] = 'gagal';
			$feedback['issue'] = 'password tidak sama';
		}

		return $feedback;
	}
}