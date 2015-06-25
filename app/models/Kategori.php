<?php

class Kategori extends Eloquent{

	protected $table = 'kategori';
	protected $guarded = array('id');
	
	public function user_minat(){
		return $this->hasMany('UserMinat', 'id_genre', 'id');
	}
}
