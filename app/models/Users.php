<?php

class Users extends Eloquent{

	protected $table = 'users';
	protected $guarded = array('id');
	protected $hidden = array('password');
	
	public function user_minat(){
		return $this->hasMany('UserMinat', 'id_user', 'id');
	}

	public function user_komunitas(){
		return $this->belongsToMany('Komunitas', 'komunitas_member', 'id_user', 'id_user');
	}

	public function user_acara(){
		return $this->belongsToMany('Acara', 'user_event', 'id_user', 'id');
	}

	public static function get_komunitas_per_user_by_userid($id){
		return DB::table('komunitas')
					->join('komunitas_member','komunitas.id','=','komunitas_member.id_komunitas')
					->select('komunitas.*', 'komunitas_member.id_komunitas', 'komunitas_member.id_user')
					->where('komunitas_member.id_user','=',$id)
					->get();
	}

	public static function get_event_per_user_by_userid($id){
		return DB::table('komunitas_event')
					->join('user_event','komunitas_event.id','=','user_event.id_acara')
					->select('komunitas_event.*', 'user_event.id_acara')
					->where('user_event.id_user','=',$id)
					->get();
	}

	public static function cek_duplikasi_email($email){
		$query = DB::table('users')
					->where('surel', '=', $email)
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
