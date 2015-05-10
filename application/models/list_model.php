<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class List_model extends CI_Model {

	//declare variabel table name
	private $table = "list";

	public function get_all() {
		$query = $this->db->get($this->table);
		
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