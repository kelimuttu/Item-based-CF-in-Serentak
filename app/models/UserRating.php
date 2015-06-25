<?php

class UserRating extends Eloquent{

	protected $table = 'user_rating';
	protected $guarded = array('id');
	
	public function komunitas(){
		return $this->belongsTo('Komunitas', 'id_komunitas', 'id');
	}

	public function user(){
		return $this->belongsTo('Users', 'id_user', 'id');
	}

	public static function count_rate_row_by_id($id){
		return UserRating::where('id_user', '=', $id)->count();
	}

	public static function count_all_rating_by_id($id){
		$query = DB::table('user_rating')
					->select('user_rating.rating')
					->where('id_user', '=', $id)
					->get();
		$jumlah = 0;
		foreach ($query as $row) {
			$data[] = $row;
			$jumlah += $row->rating;
		}
		return $jumlah;
	}

	public static function count_similarity($iduser, $idkom){
		$query = DB::table('user_rating')
					->join('user_avgrate','user_rating.id_user','=','user_avgrate.id_user')
					->select('user_rating.rating', '*', 'user_avgrate.avg_rate')
					->where('user_rating.id_user', '=', $iduser)
					->get();
		$jumlah = 0;
		foreach ($query as $row) {
			$data[] = $row;
			$jumlah += $row->rating;
		}
		return $jumlah;
	}

	public static function get_all_user_rate ($userid, $idexcept){
		return DB::table('user_rating')
					->select('user_rating.rating', 'user_rating.id_komunitas')
					->where('user_rating.id_user', '=', $userid)
					->where('user_rating.id_komunitas', '!=', $idexcept)
					->get();
	}

	public static function is_rated($userid, $komid){
		$query = DB::table('user_rating')
					->where('id_user', '=', $userid)
					->where('id_komunitas', '=', $komid)
					->get();
		if (count($query) > 0) 
		{
			return TRUE;
		} else
		{
			return FALSE;
		}
	}

	public static function get_rating_by_userkom_id($userid, $komid){
		return DB::table('user_rating')
					->where('user_rating.id_user', '=', $userid)
					->where('user_rating.id_komunitas', '=', $komid)
					->get();
	}

	public static function get_rating_only($userid, $komid){
		$query = DB::table('user_rating')
					->select('user_rating.rating')
					->where('user_rating.id_user', '=', $userid)
					->where('user_rating.id_komunitas', '=', $komid)
					->get();
		foreach ($query as $row) {
			$data[] = $row;
			$rate = $row->rating;
		}
		return $rate;
	}

	public static function get_rating($komid){
		$query = DB::table('user_rating')
					->select('user_rating.rating')
					->where('user_rating.id_komunitas', '=', $komid)
					->get();
		foreach ($query as $row) {
			$data[] = $row;
			$rate = $row->rating;
		}
		return $rate;
	}

	// public static function get_user_rated_by_komid($iduser, $kom1, $kom2){
	// 	$query = DB::table('user_rating')
	// 				->join('user_avgrate','user_rating.id_user','=','user_avgrate.id_user')
	// 				->where('user_rating.id_user', '=', $iduser)
	// 				->select('user_rating.rating, user_avgrate.avg_rate as item1') 
	// 				->where('user_rating.id_komunitas', '=', $kom1)
	// 				->select('user_rating.rating, user_avgrate.avg_rate as item2')
	// 				->where('user_rating.id_komunitas', '=', $kom2)
	// 				->select('(sum((item1.rating-item1.avg_rate)*(item2.rating-item2.avg_rate))/((sqrt(sum(pow(item1.rating-item1.avg_rate))))*(sqrt(sum(pow(item2.rating-item2.avg_rate)))))) as similarity')
	// 				->get();
	// 	return $query;
	// }

	// public static function get_user_sim($kom1, $kom2){
	// 	$query = DB::table('users')
	// 				->join('user_rating','users.id','=','user_rating.id_user')
	// 				->select('user_rating.id_komunitas')
	// 				->where('user_rating.id_komunitas', '=', $kom1)
	// 				// ->where('user_rating.id_komunitas', '=', $kom2)
	// 				->whereNotNull('user_rating.rating')
	// }
}
