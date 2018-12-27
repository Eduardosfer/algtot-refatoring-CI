<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {	

	private $dados = array();

	public function __construct() {
		parent::__construct();
		$this->autenticar();
	}

	public function index() {				
		// 
	}

	public function autenticar() {
		if ($this->verificarLogado() === true) {
			$controller = strtolower($this->router->class);
			if ($controller != 'auth' && $controller != null) {
				//
			} else {				
				$this->mostrarTelaApresentacao();
			}
		} else {
			$this->mostrarTelaApresentacao();
		}
	}

	public function mostrarTelaApresentacao() {		
		$this->load->model('UsuariosModel');
		$fields = null;
		$where = array('usuario.status' => 'ativo', 'usuario.cdGrupo' => 3);
		$limit = 0;
		$amount = 10;
		$orderBy = 'usuario.pontuacaoTotal DESC';
		$groupBy = null;
		$this->dados['usuariosRanking'] = $this->UsuariosModel->getData($where, $fields, $limit, $amount, $orderBy, $groupBy);
		$this->load->view('algTotApresentacao', $this->dados);
	}

	public function verificarLogado() {
		if ($this->session->userdata('logado') === true) {
			return true;
		} else {
			return false;
		}
	}
}
