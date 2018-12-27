<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Inicio
 *
 * @author Eduardo Sfer
 */
class Inicio extends MY_Controller {		

	public function __construct() {
		parent::__construct();				
	}

	public function index() {
		//
	}

	public function autoCadastrar() {
		$post = $this->input->post();
		if (isset($post['acao'])) {
			unset($post['acao']);
		}
		if (isset($post['confirmarSenha'])) {
			unset($post['confirmarSenha']);
		}
		$this->load->model('UsuarioModel');		
		$existeUsuario = false;
		$existeEmail = false;
		$existeUsuario = $this->UsuarioModel->isDuplicated(array('usuario' => $post['usuario'], 'status !=' => 'deletado'), null);					
		$existeEmail = $this->UsuarioModel->isDuplicated(array('email' => $post['email'], 'status !=' => 'deletado'), null);

		if ($existeUsuario === true) {
			$this->mensagem = $this->mensagem . 'Este usuário já foi cadastrado. Tente outro nome de usuário!<br>';
		}
		if ($existeEmail === true) {
			$this->mensagem = $this->mensagem . 'Este e-mail já foi cadastrado. Tente utilizar outro e-mail!<br>';
		}
		if ($existeUsuario === false && $existeEmail === false) {
			$post['cdGrupo'] = 3; //3 = Grupo aluno, pois só é permitido o auto cadastro de alunos
			$post['senha'] = md5($post['senha']);
			$post['status'] = 'inativo'; //inativo, pois é preciso que o cadastro seja aceito por um gestor
			$this->UsuarioModel->insertData($post);
			$this->util->setModalRedirecionar('', 'Cadastrado efetuado com sucesso!', '', 'meuModalSucesso', $this->urlBack);
		} else {			
			$this->util->setModalRedirecionar('', $this->mensagem, '', 'meuModalErro', $this->urlBack);
		}
	}	
}
