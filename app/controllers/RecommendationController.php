<?php

class RecommendationController extends BaseController {

	public function __construct(){
		$this->user = new Users();
		$this->acara = new Acara();
		$this->komunitas = new Komunitas();
		$this->rating = new UserRating();
		$this->predict = new KomRatePredict();
	}

	public function get_random_kom () {
		$data['komunitas'] = Komunitas::orderByRaw("RAND()")->take(5)->get();
		return View::make('selamat_bergabung', $data);
	}

	public function get_data_for_dashboard(){
		$userid = Users::where('id', '=', Session::get('user_id'))->first()->id;
		$data['user'] = Users::find(Session::get('user_id'));
		$data['komunitas'] = Komunitas::orderBy('avg_rate', 'DESC')->take(5)->get();
		$data['rekomen'] = $this->predict->recommendation($userid);
		$data['rating'] = $this->rating->count_rate_row_by_id($userid);
		$data['cek'] = $this->predict->has_recommendation($userid);
		$data['rand'] = Komunitas::orderByRaw("RAND()")->take(5)->get();
		// $data['test'] = $this->komunitas->get_recommendation($userid);
		// $data['komunitas'] = $this->komunitas->get_initial_recommendation();
		$data['acara'] = Acara::where('tanggal', '>=', DB::raw('CURDATE()'))->take(4)->orderBy('tanggal', 'ASC')->get();
		// $count = Komunitas::where('id_kategori', '=', 1)->count();
		$allkom = $this->predict->has_recommendation($userid);
		//var_dump($allkom);
		//var_dump($data['test']);
		return View::make('dashboard', $data);
	}

	public function get_search_result() {
		$data['cari'] = Input::get('key');
		$data['result'] = Komunitas::where('nama_komunitas','LIKE','%'.$data['cari'].'%')->get();
		//var_dump($data['result']);
		return View::make('hasil', $data);
	}

}