<?php

class Komunitas extends Eloquent{

	protected $table = 'komunitas';
	protected $guarded = array('id');
	
	public function komunitas_event(){
		return $this->hasMany('Event', 'id_komunitas', 'id');
	}

	public function komunitas_member(){
		return $this->belongsToMany('Users', 'komunitas_member', 'id_user', 'id_user');
	}

	public static function komunitas_count() {
		return DB::table('komunitas')
					->count();
    }

    public static function get_all_komunitas_data(){
		$data = DB::table('komunitas')
					->join('kategori','komunitas.id_kategori','=','kategori.id')
					->select('komunitas.*', 'kategori.nama_genre')
					->orderBy ('komunitas.id_kategori', 'ASC') 
					// ->take(5)
					->get();
					return $data;
	}

	public static function get_initial_recommendation(){
		$data = DB::table('komunitas')
					->join('kategori','komunitas.id_kategori','=','kategori.id')
					->select('komunitas.*', 'kategori.*')
					// ->orderBy rand()
					->take(5)
					->get();
					return $data;
	}

	public static function get_recommendation($id) {
		// $data = DB::table('komunitas_member')
		// 			->join('komunitas','komunitas_member.id_komunitas','=','komunitas.id', 'right')
		// 			->select('komunitas.*')
		// 			//->where('komunitas_member.id_user', '!=', $id)
		// 			->get();
		// 			return $data;

		$query = DB::table('komunitas_member')
					->select('komunitas_member.id_komunitas')
					->where('komunitas_member.id_user','=',$id)
					->get();
					return $query;
		foreach ($query as $row) {
			$id[] = $row->id_komunitas;
		}
		return $id;

		// if (count($query) > 0) 
		// {
		// 	foreach ($query as $row) {
		// 	$exception[] = $row->id_komunitas;
		// 	return DB::table('komunitas')
		// 			->select('komunitas.*')
		// 			->where('id', '!=', $exception)
		// 			->get();
		// 	}
			
			
		// 	//return $exception;
		// } else {
		// 	return DB::table('komunitas')
		// 			->select('komunitas.*')
		// 			->take(5)
		// 			->get();
		// }	
	}

    public static function count_komunitas_rate_by_id($id) {
		return DB::table('user_rating')
					->where('user_rating.id_komunitas', '=', $id)
					->count();
    }

    public static function count_totalrate_by_idkom($id){
		$query = DB::table('user_rating')
					->select('user_rating.rating')
					->where('id_komunitas', '=', $id)
					->get();
		$jumlah = 0;
		foreach ($query as $row) {
			$data[] = $row;
			$jumlah += $row->rating;
		}
		return $jumlah;
	}

 //    public static function get_all_komunitas_data(){
	// 	$data = DB::table('komunitas')
	// 				//->join('komunitas_event','komunitas.id','=','komunitas_event.id_komunitas')
	// 				//->select('komunitas.*', 'komunitas_event.judul_acara')
	// 				->get();
	// 				return $data;
	// }

	public static function get_komunitas_by_id($id){
		return DB::table('komunitas')
					->select('komunitas.*')
					->where('komunitas.id', '=', $id)
					->get();
	}

	public static function get_komunitas_by_slug($slug){
		return DB::table('komunitas')
					->select('komunitas.*')
					->where('komunitas.slug', '=', $slug)
					->get();
	}

	public static function get_acara_komunitas_by_id($id){
		return DB::table('komunitas_event')
					// ->join('komunitas','komunitas_event.id_komunitas','=','komunitas.id')
					->select('komunitas_event.*')
					->where('komunitas_event.id_komunitas','=',$id)
					->get();
	}

	public static function get_anggota_komunitas_by_id($id){
		return DB::table('users')
					->join('komunitas_member','users.id','=','komunitas_member.id_user')
					->select('users.foto', 'komunitas_member.id_user')
					->where('komunitas_member.id_komunitas','=',$id)
					->get();
	}

	public static function fetch_komunitas(){
		return DB::table('komunitas')
					->select('komunitas.*')
					->get();
	}

	public static function get_komunitas_avg_rate ($id){
		$query = DB::table('komunitas')
					->select('komunitas.avg_rate')
					->where('komunitas.id', '=', $id)
					->get();
		foreach ($query as $row) {
			$data[] = $row;
			$avg = $row->avg_rate;
		}
		return $avg;
	}

	public static function get_id_kategori ($id){
		$query = DB::table('komunitas')
					->select('komunitas.id_kategori')
					->where('komunitas.id', '=', $id)
					->get();
		foreach ($query as $row) {
			$data[] = $row;
			$id = $row->id_kategori;
		}
		return $id;
	}

	public static function get_komunitas_rated_except ($id){
		return DB::table('komunitas')
					->select('komunitas.id')
					->where('komunitas.avg_rate', '>', 0)
					->where('komunitas.id', '!=', $id)
					->get();
	}

	// public static function get_recommend (){
	// 	return DB::table('komunitas')
	// 				->join('komunitas_member','users.id','=','komunitas_member.id_user')
	// }

}
