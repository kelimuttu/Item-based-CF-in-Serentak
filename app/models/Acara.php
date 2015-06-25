<?php

class Acara extends Eloquent{

	protected $table = 'komunitas_event';
	protected $guarded = array('id');

	public function komunitas(){
		return $this->belongsTo('Komunitas', 'id_komunitas', 'id');
	}

	public function users(){
		return $this->belongsToMany('Users', 'user_event', 'id_user', 'id');
	}

	public static function get_all_acara_data(){
		$data = DB::table('komunitas_event')
					->join('komunitas','komunitas_event.id_komunitas','=','komunitas.id')
					->select('komunitas_event.*', 'komunitas.nama_komunitas')
					->get();
					return $data;
	}

	public static function get_acara_by_id($id){
		$data = DB::table('komunitas_event')
					->select('komunitas_event.*')
					->where('komunitas_event.id', '=', $id)
					->get();
					return $data;
	}

	public static function get_acara_by_slug($slug){
		$data = DB::table('komunitas_event')
					->select('komunitas_event.*')
					->where('komunitas_event.slug', '=', $slug)
					->get();
					return $data;
	}

	public static function get_penyelenggara_by_id_kom($id){
		$data = DB::table('komunitas')
					->join('komunitas_event','komunitas.id','=','komunitas_event.id_komunitas')
					->select('komunitas.*', 'komunitas_event.id_komunitas', 'komunitas_event.slug')
					->where('komunitas.id','=',$id)
					->get();
					return $data;
	}

	public static function get_member_acara_by_id($id) {
		$data = DB::table('users')
					->join('user_event','users.id','=','user_event.id_user')
					->select('users.foto', 'user_event.id_user')
					->where('user_event.id_acara','=',$id)
					->get();
					return $data;
	}

	public static function fetch_acara(){
		return DB::table('komunitas_event')
					->select('komunitas_event.*')
					//->where('komunitas_event.tanggal','>=',CURDATE())
					->LIMIT ('5')
					->get();
	}
	
}
