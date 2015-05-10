<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class List_model extends CI_Model {

	//declare variabel table name
	private $table = "list";

	public function get_all() {
		$userId = $this->session->userdata('userId');
		$query = $this->db->get_where($this->table, array('userId'=> $userId));
		
		if($query->num_rows > 0) {
			return $query->result();
		} else {
			return null;
		}
	}
	/**
	 * process add or insert new record to list table
	 * @param [type] $data [description]
	 */
	public function add($data) {
		if($data != null) {

			$id = $this->db->insert($this->table, $data);

			if($id) {

				return $id;
			}
		}
	}
}