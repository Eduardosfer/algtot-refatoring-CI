<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UsuariosModel extends MainModel {	
	
	protected $table = 'usuario';	

	public function __construct() {
		parent::__construct();
	}

	public function getData($where = null, $fields = null, $limit = null, $amount = null, $orderBy = null, $groupBy = null) {			
		if ($fields != null && $fields != '') {
			$this->db->select($fields);
		}
		$this->db->join('grupo', "grupo.cdGrupo = $this->table.cdGrupo", 'LEFT');
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
}
