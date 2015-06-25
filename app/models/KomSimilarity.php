<?php

class KomSimilarity extends Eloquent{

	protected $table = 'komunitas_similarity';
	protected $guarded = array('id');

	public static function is_compared ($kom1, $kom2){
		$query = DB::table('komunitas_similarity')
					->where('id_kom1', '=', $kom1)
					->where('id_kom2', '=', $kom2)
					->get();
		if (count($query) > 0) 
		{
			return TRUE;
		} else
		{
			return FALSE;
		}
	}

	public static function get_similarity_value($kom1, $kom2){
		$query = DB::table('komunitas_similarity')
					->select('komunitas_similarity.similarity')
					->where('komunitas_similarity.id_kom1', '=', $kom1, 'and') 
					->where('komunitas_similarity.id_kom2', '=', $kom2)
					->orWhere('komunitas_similarity.id_kom1', '=', $kom2, 'and') 
					->where('komunitas_similarity.id_kom2', '=', $kom1)
					->get();
		foreach ($query as $row) {
			$data[] = $row;
			$similar = $row->similarity;
		}
		return $similar;
	}

	public static function get_similarity($idkom){
		$query = DB::table('komunitas_similarity')
					->select('komunitas_similarity.similarity', 'komunitas_similarity.id_kom1', 'komunitas_similarity.id_kom2')
					->where('komunitas_similarity.id_kom1', '=', $idkom) 
					//->orWhere('komunitas_similarity.id_kom2', '=', $idkom)
					->get();
		// foreach ($query as $row) {
		// 	$data[] = $row;
		// 	$similar = $row->similarity;
		// }
		return $query;
	}

	// public static function similarity()
}
