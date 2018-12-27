<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of MY_controller
 *
 * @author Eduardo Sfer
 */
class MY_Controller extends CI_Controller {	

	protected $dados = array();
	protected $mainPage = 'mainPage';
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
				if ($this->checkPermissao($controller, $method) === false) {
					//VOLTAR A PÁGINA ANTERIOR E INFORMAR QUE AO USUÁRIO QUE NÃO TEM PERMISSÃO PARA ACESSAR $controller/$method
					$this->util->setModalRedirecionar('Aviso de permissão', 'Você não tem permissão para acessar '.$controller.'/'.$method, '', 'meuModalErro', $this->urlBack);
					//DESENVOLVER UMA FUNÇÃO QUE PEGA A PÁGINA ANTERIOR					
				} else {
					//TEM PERMISSÃO E POR ISSO PODE USAR O CONTROLE E METODO NORMALMENTE
					return true;
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
		if ($this->session->userdata('usuarioLogado') === true) {
			return true;
		} else {
			return false;
		}
	}

	public function checkPermissao($controller = null, $method = null) {
		$return = false;
		$permissoes = $this->session->userdata('permissoes');
		foreach ($permissoes as $permissao) {
			if (strtolower($permissao->classe) == $controller && strtolower($permissao->metodo) == $method) {
				$return = true;
				break;
			}			
		}		
		return $return;
	}
}
