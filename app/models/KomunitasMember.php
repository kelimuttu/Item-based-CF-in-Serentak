<?php

class KomunitasMember extends Eloquent{

	protected $table = 'komunitas_member';
	protected $guarded = array('id');
	
	public function komunitas(){
		return $this->belongsToMany('Komunitas');
	}

	public function user(){
		return $this->belongsToMany('Users');
	}

	public static function is_anggota($userid, $komid){
		$query = DB::table('komunitas_member')
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
}
