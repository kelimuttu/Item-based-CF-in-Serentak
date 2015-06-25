<?php

class Fungsi extends Eloquent{

	public static function enkripsi_password($password){
		$pass = md5($password);
		$pass = strrev($pass);
		$pass = md5($pass);
		return $pass;
	}

	public static function ambil_bulan(){
		$bulan = array();
		$bulan[1] = 'January';
		$bulan[2] = 'Februari';
		$bulan[3] = 'Maret';
		$bulan[4] = 'April';
		$bulan[5] = 'Mei';
		$bulan[6] = 'Juni';
		$bulan[7] = 'Juli';
		$bulan[8] = 'Agustus';
		$bulan[9] = 'September';
		$bulan[10] = 'Oktober';
		$bulan[11] = 'November';
		$bulan[12] = 'Desember';

		return $bulan;
	}
}
