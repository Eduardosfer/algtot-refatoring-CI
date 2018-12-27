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

	public function logar() {
		$post = $this->input->post();
		$this->load->model('UsuarioModel');
		$where = array('usuario' => $post['usuario'], 'senha' => md5($post['senha']), 'status !=' => 'deletado');
		$usuario = $this->UsuarioModel->getOneData($where);
		if (!isset($usuario->status)) {
			$this->util->setModalRedirecionar('', 'Usuário ou senha invalidos.', '', 'meuModalErro', $this->urlBack);
		} else {			
			if ($usuario->status == 'inativo' || $usuario->status == null) {
				$this->util->setModalRedirecionar('Usuário ainda não liberado', 'Você ainda não tem acesso ao Algtot, aguarde a liberação de acesso do seu usuário.', '', 'meuModalErro', $this->urlBack);
			}
			if ($usuario->status == 'ativo') {
				if ($usuario->primeiroLogin == 'sim' && $usuario->cdGrupo == 3) {
					$this->UsuarioModel->updateData(array('primeiroLogin' => 'nao'), array('cdUsuario' => $usuario->cdUsuario));                    										
					$usuario->primeiroLogin = 'nao';
					$this->criarSessaoUsuario($usuario);					
					$this->util->setModalRedirecionar('Bem vindo ao Algtot '.$usuario->usuario.'!','Muito obrigado por participar do Algtot, aqui você poderá competir com outras pessoas no mundo da lógica e programação.<br>Você receberá <b>100</b> pontos de bonificação para começar.<br>Boa sorte e bom jogo.','','meuModalSucesso', $this->urlBack);
				} else {
					$this->criarSessaoUsuario($usuario);
					redirect('AlgTot');
				}
			}
		}
	}

	public function criarSessaoUsuario($usuario = null) {
		$this->session->set_userdata('usuarioLogado', true);
		$this->session->set_userdata('cdUsuario', $usuario->cdUsuario);
		$this->session->set_userdata('usuario', $usuario->usuario);
		$this->session->set_userdata('senha', $usuario->senha);
		$this->session->set_userdata('cdGrupo', $usuario->cdGrupo);		
		$this->session->set_userdata('email', $usuario->email);
		$this->session->set_userdata('status', $usuario->status);
		$this->session->set_userdata('data', $usuario->data);
		$this->session->set_userdata('nivel1', $usuario->nivel1);
		$this->session->set_userdata('nivel2', $usuario->nivel2);
		$this->session->set_userdata('nivel3', $usuario->nivel3);
		$this->session->set_userdata('nivel4', $usuario->nivel4);
		$this->session->set_userdata('pontuacaoTotal', $usuario->pontuacaoTotal);
		$this->session->set_userdata('nomeCompleto', $usuario->nomeCompleto);
		$this->session->set_userdata('instituicao', $usuario->instituicao);
		$this->session->set_userdata('curso', $usuario->curso);
		$this->session->set_userdata('primeiroLogin', $usuario->primeiroLogin);
		$this->session->set_userdata('permissoes', $this->obterPermissoes($usuario->cdGrupo));
	}

	public function obterPermissoes($cdGrupo = null) {
		$this->load->model('PermissaoModel');
		$permissoes = $this->PermissaoModel->getData(array('cdGrupo' => $cdGrupo));
		return (!isset($permissoes[0]->cdPermissao))?false:$permissoes;
	}
}
