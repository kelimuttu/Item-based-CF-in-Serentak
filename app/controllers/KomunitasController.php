<?php

class KomunitasController extends BaseController {

	public function __construct(){
		$this->komunitas = new Komunitas();
		$this->rating = new UserRating();
		$this->average = new UserAvgRate();
		$this->komsimilarity = new KomSimilarity();
		$this->member = new KomunitasMember();
		$this->predict = new KomRatePredict();
	}

	public function index(){
		$data['komunitas'] = $this->komunitas->get_all_komunitas_data();
		//$data['komunitas'] = Komunitas::get();
		return View::make('manage_komunitas', $data);
	}

	public function make_tambah_komunitas(){
		$data['kategori'] = Kategori::get();
		return View::make('tambah_komunitas', $data);
	}

	public function tambah_komunitas(){
		$data['nama_komunitas'] = Input::get('name');
		$data['id_kategori'] = Input::get('kategori');
		$data['slug'] = Str::slug(Input::get('name'), '-');
		$data['deskripsi'] = Input::get('description');
		$data['tanggal_jadi'] = Input::get('since');
		$data['basecamp'] = Input::get('basecamp');
		$data['telepon'] = Input::get('phone');
		$data['surel'] = Input::get('email');
		$data['situs'] = Input::get('site');
		$data['facebook'] = Input::get('facebook');
		$data['twitter'] = Input::get('twitter');
		$data['gplus'] = Input::get('gplus');

		$bahan_ringkasan = strip_tags(Input::get('description'));
		$data['ringkasan'] = implode(' ', array_slice(explode(' ', $bahan_ringkasan), 0, 20));
		$data['ringkasan'] = preg_replace('/\s+/', ' ',$data['ringkasan']);

		Komunitas::create($data);
		//$id = Komunitas::where('nama_komunitas', '=', $data['nama_komunitas'])->first()->id;
		$id = Komunitas::where('slug', '=', $data['slug'])->first()->slug;
		
		return Redirect::to('/komunitas/'.$id);
		//return Redirect::to('/beranda/komunitas');
	}

	public function profile($id){
		// $data['komunitas'] = Komunitas::where('slug', '=', $id)->first();
		//$data['komunitasEvent'] = Acara::where('id_komunitas', '=', $idkom)->get();
		$iduser = Users::where('id', '=', Session::get('user_id'))->first()->id;
		$idkom = Komunitas::where('slug', '=', $id)->first()->id;
		$data['komunitas'] = $this->komunitas->get_komunitas_by_slug($id);
		$data['rating'] = $this->rating->get_rating_by_userkom_id($iduser, $idkom);
		$data['acara'] = $this->komunitas->get_acara_komunitas_by_id($idkom);
		$data['anggota'] = $this->komunitas->get_anggota_komunitas_by_id($idkom);
		$data['cek'] = $this->rating->is_rated($iduser, $idkom);
		$data['ismember'] = $this->member->is_anggota($iduser, $idkom);

		// $allkom = $this->rating->get_rating_only($iduser, $idkom);
		// $ceksimilarity = $this->komsimilarity->get_similarity($idkom);
		//var_dump($ceksimilarity);
		
		return View::make('profile_komunitas', $data);
	}

	public function update_avatar($id)
	{
		$ava = Input::file('avatar');
		$filename = 'komunitas-'.$id.'.'.Input::file('avatar')->getClientOriginalExtension();
		$path = public_path('assets/img/komunitas/'.$filename);
		Image::make($ava->getRealPath())->resize(400, null, function($c){
			$c->aspectRatio();
			$c->upsize();
		})->save($path);
       	$data['foto'] = $filename;
       	Komunitas::where('slug', '=', $id)->update($data);

		return Redirect::to('/komunitas/'.$id);
	}

	public function edit_komunitas($id)
	{
		$data['komunitas'] = Komunitas::where('id', '=', $id)->first();
		$data['kategori'] = Kategori::get();
		return View::make('edit_komunitas', $data);
	}

	public function update_komunitas($id){
		$data['nama_komunitas'] = Input::get('name');
		$data['id_kategori'] = Input::get('kategori');
		$data['slug'] = Str::slug(Input::get('name'), '-');
		$data['deskripsi'] = Input::get('description');
		$data['tanggal_jadi'] = Input::get('since');
		$data['basecamp'] = Input::get('basecamp');
		$data['avg_rate'] = Input::get('rating');
		$data['telepon'] = Input::get('phone');
		$data['surel'] = Input::get('email');
		$data['situs'] = Input::get('site');
		$data['facebook'] = Input::get('facebook');
		$data['twitter'] = Input::get('twitter');
		$data['gplus'] = Input::get('gplus');

		$bahan_ringkasan = strip_tags(Input::get('description'));
		$data['ringkasan'] = implode(' ', array_slice(explode(' ', $bahan_ringkasan), 0, 20));
		$data['ringkasan'] = preg_replace('/\s+/', ' ',$data['ringkasan']);

		Komunitas::where('id', '=', $id)->update($data);
		return Redirect::to('/komunitas/'.$data['slug']);
		//return Redirect::to('/beranda/komunitas');
	}

	public function bergabung_komunitas($id){
		$data['id_user'] = Users::where('id', '=', Session::get('user_id'))->first()->id;
		$data['id_komunitas'] = $id;

		KomunitasMember::create($data);
		$slug = Komunitas::where('id', '=', $id)->first()->slug;
		return Redirect::to('/komunitas/'.$slug);
	}

	public function give_rate_by_id_kom($id){
		$data['id_user'] = Users::where('id', '=', Session::get('user_id'))->first()->id;
		$data['id_komunitas'] = $id;
		$data['rating'] = Input::get('rating');

		$jml  = $this->rating->count_rate_row_by_id($data['id_user']);
		$jmlplus = $jml + 1;
		$total = $this->rating->count_all_rating_by_id($data['id_user']);
		$totalplus = $total + $data['rating'];
		
		$avgrate['avg_rate'] = $totalplus / $jmlplus;

		$jml2  = $this->komunitas->count_komunitas_rate_by_id($id);
		$jml2plus = $jml2 + 1;
		$ratetotal  = $this->komunitas->count_totalrate_by_idkom($id);
		$totalrate = $ratetotal + $data['rating'];

		$ratekom['avg_rate'] = $totalrate / $jml2plus;

		UserRating::create($data);
		UserAvgRate::where('id_user', '=', Session::get('user_id'))->update($avgrate);
		Komunitas::where('id', '=', $id)->update($ratekom);

		$totrate  = $this->rating->count_rate_row_by_id($data['id_user']);
		if ($totrate > 1) {
			$ratesim = $this->rating->get_all_user_rate($data['id_user'], $id);
			//$ratesim = $this->komunitas->get_komunitas_rated_except($id);
			foreach ($ratesim as $rated) {
				$similar['id_kom1'] = $id;
				$similar['id_kom2'] = $rated->id_komunitas;
				//$similar['id_kom2'] = $rated->id;

				$user_avg = $this->average->get_average_rate($data['id_user']);
				$rate1 = $this->rating->get_rating_only($data['id_user'], $similar['id_kom1']);
				$rate2 = $this->rating->get_rating_only($data['id_user'], $similar['id_kom2']);

				$similar['similarity'] = ((($rate1 - $user_avg)*($rate2 - $user_avg))/((sqrt(pow(($rate1 - $user_avg),2)))*(sqrt(pow(($rate2 - $user_avg),2)))));

				$check = $this->komsimilarity->is_compared($similar['id_kom1'], $similar['id_kom2']);
				if ($check == TRUE) {
					KomSimilarity::where('id_kom1', '=', $id)->where('id_kom2', '=', $rated->id_komunitas)->update($similar);
				} else {
					KomSimilarity::create($similar);
				}
			}

			// $allkom = Komunitas::get();
			$allkom = $this->komunitas->get_komunitas_rated_except($id);
			foreach ($allkom as $kom) {
				$israted  = $this->rating->is_rated($data['id_user'], $kom->id);
				if ($israted == FALSE) {
					$ceksimilarity = $this->komsimilarity->get_similarity($kom->id);
					foreach ($ceksimilarity as $mirip) {
						// $ratekomp = $this->rating->get_rating_only($data['id_user'], $mirip->id_kom2);
						$ratekomp = $this->rating->get_rating($mirip->id_kom2);
						$simvalue = $this->komsimilarity->get_similarity_value($mirip->id_kom1, $mirip->id_kom2);
						$predict['id_user'] = $data['id_user'];
						$predict['id_komunitas'] = $mirip->id_kom2;
						$predict['rate_predict'] = (($ratekomp * $simvalue)/(ABS($simvalue)));

						$ceki = $this->predict->is_predicted($data['id_user'], $mirip->id_kom2);
						if ($ceki == TRUE) {
							KomRatePredict::where('id_user', '=', $data['id_user'])->where('id_komunitas', '=', $mirip->id_kom2)->update($predict);
						} else {
							KomRatePredict::create($predict);
						}
					}
				}
			}
		}
			// // $allkom = Komunitas::get();
			// $allkom = $this->komunitas->get_komunitas_rated_except($id);
			// foreach ($allkom as $kom) {
			// 	$israted  = $this->rating->is_rated($data['id_user'], $kom->id);
			// 	if ($israted == FALSE) {
			// 		$ceksimilarity = $this->komsimilarity->get_similarity($kom->id);
			// 		foreach ($ceksimilarity as $mirip) {
			// 			$cekrating  = $this->rating->is_rated($data['id_user'], $mirip->id_kom2);
			// 			if ($cekrating == FALSE) {
			// 				$ratekomp = $this->rating->get_rating_only($data['id_user'], $mirip->id_kom1);
			// 				$simvalue = $this->komsimilarity->get_similarity_value($mirip->id_kom1, $mirip->id_kom2);
			// 				$predict['id_user'] = $data['id_user'];
			// 				$predict['id_komunitas'] = $mirip->id_kom2;
			// 				$predict['rate_predict'] = (($ratekomp * $simvalue)/(ABS($simvalue)));

			// 				$ceki = $this->predict->is_predicted($data['id_user'], $mirip->id_kom2);
			// 				if ($ceki == TRUE) {
			// 					KomRatePredict::update($predict);
			// 				} else {
			// 					KomRatePredict::create($predict);
			// 				}
			// 			}
			// 		}
					
			// 	}
			// }
		$slug = Komunitas::where('id', '=', $id)->first()->slug;
		return Redirect::to('/komunitas/'.$slug);
	}

	public function hapus_komunitas($id){
		Komunitas::where('id', '=', $id)->delete();
		return Redirect::to('/beranda/komunitas');
	}

	public function batal_bergabung($id){
		$iduser = Users::where('id', '=', Session::get('user_id'))->first()->id;
		$slug = Komunitas::where('id', '=', $id)->first()->slug;
		KomunitasMember::where('id_user', '=', $iduser)->where('id_komunitas', '=', $id)->delete();
		return Redirect::to('/komunitas/'.$slug);
	}

	public function fetch_community_list (){
		$data['user'] = Users::find(Session::get('user_id'));
		$data['komunitas'] = Komunitas::orderBy('nama_komunitas', 'ASC')->paginate(10);	
		return View::make('list_komunitas', $data);
	}

}