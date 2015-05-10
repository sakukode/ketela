<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Card_model extends CI_Model {

	//declare variabel table name
	private $table = "card";

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

	public function addMember($data) {
		if($data != null) {
			$id = $this->db->insert('usercard', $data);
		}
	}

	public function addAttachment($data) {
		if($data != null) {
			$id = $this->db->insert('filecard', $data);
		}	
	}

	public function get($id) {
		$this->db->select('card.*, list.title listTitle');
		$this->db->from('card');
		$this->db->join('list','list.id=card.listId');
		$this->db->where('card.id',$id);
		$query = $this->db->get();

		if($query->num_rows() > 0) {
			return $query->row();
		} else {
			return null;
		}
	}

	public function getMember($cardId) {
		$this->db->select('usercard.*, user.name name, user.username username');
		$this->db->from('usercard');
		$this->db->join('user','user.id=usercard.userId');
		$this->db->where('usercard.cardId',$cardId);
		$query = $this->db->get();

		if($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}

	public function getAttachment($cardId) {
		
		$query = $this->db->get_where('filecard', array('cardId'=> $cardId));

		if($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}
}