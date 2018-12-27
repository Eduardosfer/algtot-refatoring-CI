<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of MY_controller
 *
 * @author Eduardo Sfer
 */
class MY_Controller extends CI_Controller {	

	protected $dados = array();
	protected $mensagem = '';
	protected $urlBack = '';

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
			if ($controller != 'inicio' && $controller != null) {
				$method = strtolower($this->router->method);
				$cdGrupo = $this->session->userdata('cdGrupo');
				if ($this->checkPermission($controller, $method, $cdGrupo) === false) {
					var_dump($controller);
					var_dump($method);
					//VOLTAR A PÁGINA ANTERIOR E INFORMAR QUE AO USUÁRIO QUE NÃO TEM PERMISSÃO PARA ACESSAR $controller/$method
				}
			} else {				
				$this->mostrarTelaApresentacao();
			}
		} else {			
			$this->mostrarTelaApresentacao();			
		}
	}

	public function mostrarTelaApresentacao() {		
		$this->load->model('UsuarioModel');
		$fields = null;
		$where = array('usuario.status' => 'ativo', 'usuario.cdGrupo' => 3);
		$limit = 0;
		$amount = 10;
		$orderBy = 'usuario.pontuacaoTotal DESC';
		$groupBy = null;
		$this->dados['usuariosRanking'] = $this->UsuarioModel->getData($where, $fields, $limit, $amount, $orderBy, $groupBy);
		$this->load->view('algTotApresentacao', $this->dados);		
	}

	public function verificarLogado() {
		if ($this->session->userdata('logado') === true) {
			return true;
		} else {
			return false;
		}
	}

	public function checkPermission($controller = null, $method = null, $cdGrupo = null) {
		$return = false; 

		return $return;
	}
}
