<?php

class KomRatePredict extends Eloquent{

	protected $table = 'komunitas_ratepredict';
	protected $guarded = array('id');

	public static function is_predicted($userid, $komid){
		$query = DB::table('komunitas_ratepredict')
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

	public static function has_recommendation($userid){
		$query = DB::table('komunitas_ratepredict')
					->where('id_user', '=', $userid)
					->where('rate_predict', '>', 0)
					->get();
		if (count($query) > 0) 
		{
			return TRUE;
		} else
		{
			return FALSE;
		}
	}

	public static function recommendation($userid){
		$query = DB::table('komunitas')
					->join('komunitas_ratepredict','komunitas.id','=','komunitas_ratepredict.id_komunitas')
					->where('komunitas_ratepredict.id_user', '=', $userid)
					->where('komunitas_ratepredict.rate_predict', '>', 0)
					->select('komunitas.*')
					->get();
		return $query;
	}

}
