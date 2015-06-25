<?php

class UserEvent extends Eloquent{

	protected $table = 'user_event';
	protected $guarded = array('id');

	// public function user(){
	// 	return $this->belongsTo('Users', 'id_user', 'id');
	// }

	// public function acara(){
	// 	return $this->belongsTo('Acara', 'id_acara', 'id');
	// }
	
	public static function is_registered($userid, $id){
		$query = DB::table('user_event')
					->where('id_user', '=', $userid)
					->where('id_acara', '=', $id)
					->get();
		if (count($query) > 0) 
		{
			return TRUE;
		} else
		{
			return FALSE;
		}
	}
	
}
