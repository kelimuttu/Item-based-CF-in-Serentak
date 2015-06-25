<?php

class UserAvgRate extends Eloquent{

	protected $table = 'user_avgrate';
	protected $guarded = array('id');
	
	public static function get_average_rate ($userid){
		$query = DB::table('user_avgrate')
					->select('user_avgrate.avg_rate')
					->where('user_avgrate.id_user', '=', $userid)
					->get();
		foreach ($query as $row) {
			$data[] = $row;
			$avg = $row->avg_rate;
		}
		return $avg;
	}
}
