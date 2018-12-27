<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of MY_Model
 *
 * @author Eduardo Sfer
 */
class MY_Model extends CI_Model {	
	
	protected $table = '';
	protected $primaryKey = '';

	public function __construct() {
		parent::__construct();
	}

	public function insertData($data = null) {
		$this->db->insert($this->table, $data);
		$inserted_id = $this->db->insert_id();
		return $inserted_id;
	}

	public function getData($where = null, $fields = null, $limit = null, $amount = null, $orderBy = null, $groupBy = null) {		
		if ($fields != null && $fields != '') {
			$this->db->select($fields);
		}		
		if ($where != null && $where != '') {
			$this->db->where($where);
		}
		if ($groupBy != null && $groupBy != '') {
			$this->db->group_by($groupBy);
		}
		if ($orderBy != null && $orderBy != '') {
			$this->db->order_by($orderBy);
		}		
		$object = $this->db->get($this->table, $limit, $amount);
		return $object->result();
	}

	public function updateData($data = null, $where = null) {
		//
	}

	public function deleteData($where = null) {
		//
	}

	public function isDuplicated($where = null, $id = null) {
		$return = false;
		$this->db->select("COUNT({$this->primaryKey}) AS quantidade");
		if ($id != null && $id != '') {
			$this->db->where("{$this->primaryKey} != ", $id);
		}
		if ($where != null && $where != '') {			
			$this->db->where($where);
		}		
		$object = $this->db->get($this->table)->row();		
		if ($object->quantidade > 0) {
			$return = true;
		} else {
			$return = false;
		}
		return $return;
	}
}
