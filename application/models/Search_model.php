<?php 

class Search_model extends CI_Model {

	public function search($q, $row_count, $offset) {
		$array_search = array(
			'name' => $q, 
			'descriptions' => $q,
		);

		$query = $this->db
			->or_like($array_search) 
			->order_by('add_date', 'desc')
			->get('movie', $row_count, $offset);

		return $query->result_array();
	}
}