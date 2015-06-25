<?php

class EventController extends BaseController {

	public function __construct(){
		$this->acara = new Acara();
		$this->komunitas = new Komunitas();
		$this->userevent = new UserEvent();
	}

	public function index(){
		$data['acara'] = $this->acara->get_all_acara_data();
		//$data['acara'] = Acara::get();
		return View::make('manage_event', $data);
	}

	public function tambah_acara(){
		$data['komunitas'] = Komunitas::get();
		return View::make('tambah_acara', $data);
	}

	public function simpan_acara(){
		$data = array(
			'judul_acara'=>Input::get('event_name'),
			'slug'=>Str::slug(Input::get('event_name'), '-'),
			'id_komunitas'=>Input::get('komunitas'),
			'deskripsi'=>Input::get('description'),
			'tempat'=>Input::get('place'),
			'tanggal'=>Input::get('date'),
			'pendaftaran'=>Input::get('register')
			);

		Acara::create($data);
		//$id = Acara::where('judul_acara', '=', $data['judul_acara'])->first()->id;
		$id = Acara::where('slug', '=', $data['slug'])->first()->slug;
		return Redirect::to('/acara/'.$id);
	}

	public function acara($id){
		$iduser = Users::where('id', '=', Session::get('user_id'))->first()->id;
		$idevent = Acara::where('slug', '=', $id)->first()->id;
		$idkom = Acara::where('slug', '=', $id)->first()->id_komunitas;
		$data['acara'] = $this->acara->get_acara_by_id($idevent);
		$data['user'] = $this->acara->get_member_acara_by_id($idevent);
		$data['komunitas'] = $this->komunitas->get_komunitas_by_id($idkom);
		$data['register'] = $this->userevent->is_registered($iduser, $idevent);
		//$data['komunitas'] = Komunitas::where('id', '=', $idkom)->first();
		// $data['event'] = Acara::where('slug', '=', $id)->first();
		// var_dump($data['register']);
							
		return View::make('profile_acara', $data);
	}

	public function update_poster($id)
	{
		$ava = Input::file('poster');
		$filename = 'Acara-'.$id.'.'.Input::file('poster')->getClientOriginalExtension();
		$path = public_path('assets/img/poster/'.$filename);
		Image::make($ava->getRealPath())->resize(600, null, function($c){
			$c->aspectRatio();
			$c->upsize();
		})->save($path);
       	$data['poster'] = $filename;

       	Acara::where('slug', '=', $id)->update($data);

		return Redirect::to('/acara/'.$id);
	}

	public function edit_acara($id)
	{
		$data['event'] = Acara::where('id', '=', $id)->first();
		$data['komunitas'] = Komunitas::get();
		return View::make('edit_acara', $data);
	}

	public function update_acara($id){
		$data = array(
			'judul_acara'=>Input::get('event_name'),
			'slug'=>Str::slug(Input::get('event_name'), '-'),
			'id_komunitas'=>Input::get('komunitas'),
			'deskripsi'=>Input::get('description'),
			'tempat'=>Input::get('place'),
			'tanggal'=>Input::get('date'),
			'pendaftaran'=>Input::get('register')
			);

		Acara::where('id', '=', $id)->update($data);
		return Redirect::to('/acara/'.$data['slug']);
	}

	public function bergabung_acara($id){
		$data['id_user'] = Users::where('id', '=', Session::get('user_id'))->first()->id;
		$data['id_acara'] = $id;

		UserEvent::create($data);
		$slug = Acara::where('id', '=', $id)->first()->slug;
		return Redirect::to('/acara/'.$slug);
	}

	public function hapus_acara($id){
		Acara::where('id', '=', $id)->delete();
		return Redirect::to('/beranda/acara');
	}

	public function batal_bergabung($id){
		$iduser = Users::where('id', '=', Session::get('user_id'))->first()->id;
		$slug = Acara::where('id', '=', $id)->first()->slug;
		UserEvent::where('id_user', '=', $iduser)->where('id_acara', '=', $id)->delete();
		return Redirect::to('/acara/'.$slug);
	}

	public function fetch_event_list(){
		$data['user'] = Users::find(Session::get('user_id'));
		$data['acara'] = Acara::where('tanggal', '>=', DB::raw('CURDATE()'))->paginate(10);
		return View::make('list_acara', $data);
	}
}