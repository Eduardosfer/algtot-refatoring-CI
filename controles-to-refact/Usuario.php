<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Usuario
 *
 * @author EduSfer
 */
require_once("AlgTot.php");

new Usuario();

Class Usuario {

    private $modelo;
    private $AlgTot;
    private $cdUsuario;    
    private $nomeCompleto;
    private $instituicao;
    private $curso;
    private $primeiroLogin;        
    private $usuario;
    private $senha;
    private $cdGrupo;
    private $email;
    private $data;
    private $nivel1;
    private $nivel2;
    private $nivel3;
    private $nivel4;
    private $nivel5;
    private $pontuacaoTotal;   

    public function __construct() {                

        if (!isset($_POST['acao'])) {
            $_POST['acao'] = "";
        }

        switch ($_POST['acao']) {

            case 'Logar':
                $this->logar();
                break;

            case 'Cadastrar':
                $this->cadastrar();
                break;

            case 'Deslogar':
                $this->deslogar();
                break;

            case 'AlterarUsuario':
                $this->alterarUsuario();
                break;
            
            case 'ativaOuInativarUsuarios':
                $this->ativaOuInativarUsuarios();
                break;

            case 'ExcluirConta':
                $this->excluirConta();
                break;

            case 'RecuperarSenha':
                $this->recuperarSenha();
                break;

            case 'ExcluirUsuario':
                $this->excluirUsuario();
                break;

            case 'EditarUsuario':
                $this->editarUsuario();
                break;
        }
    }

    public function deslogar() {
        session_start();
        session_destroy();
        header("Location: ".BASE_URL_ALG."index.php");
    }

    public function logar() {
        
        $this->modelo = new Modelo();
        $this->AlgTot = new AlgTot();

        $this->setUsuario($_POST['usuario']);
        $this->setSenha($_POST['senha']);

        if (($this->usuario != null) && ($this->senha != null)) {

            if ($this->verificarLogin() == true) {

                if ($this->status == 'ativo') {
                    session_start();

                    $_SESSION['nomeCompleto'] = $this->nomeCompleto;
                    $_SESSION['instituicao'] = $this->instituicao;
                    $_SESSION['curso'] = $this->curso;
                    $_SESSION['primeiroLogin'] = $this->primeiroLogin;
                    $_SESSION['usuario'] = $this->usuario;
                    $_SESSION['senha'] = $this->senha;
                    $_SESSION['cdGrupo'] = $this->cdGrupo;
                    $_SESSION['email'] = $this->email;
                    $_SESSION['cdUsuario'] = $this->cdUsuario;
                    $_SESSION['data'] = $this->data;
                    $_SESSION['nivel1'] = $this->nivel1;
                    $_SESSION['nivel2'] = $this->nivel2;
                    $_SESSION['nivel3'] = $this->nivel3;
                    $_SESSION['nivel4'] = $this->nivel4;
                    $_SESSION['nivel5'] = $this->nivel5;
                    $_SESSION['pontuacaoTotal'] = $this->pontuacaoTotal;
                                        
                    //Verificando qual o grupo do usuario em questão e redirecionando para a pagina inicial e que ele pode ter acesso.
                    if ($_SESSION['cdGrupo'] == 1) {
                        $urlBack = "".BASE_URL_ALG."visao/principalADM.php";
                    }

                    if ($_SESSION['cdGrupo'] == 2) {                        
                        $urlBack = "".BASE_URL_ALG."visao/principalProfessor.php";
                    }

                    if ($_SESSION['cdGrupo'] == 3) {                        
                        $urlBack = "".BASE_URL_ALG."visao/principal.php";
                    }
                    
                    if ($_SESSION['primeiroLogin'] == 'sim' && $_SESSION['cdGrupo'] == 3) {
                        $_SESSION['primeiroLogin'] = 'nao';                       
                        $update = "UPDATE usuario SET primeiroLogin = ? WHERE cdUsuario = ?";
                        $dados = array('nao', $_SESSION['cdUsuario']);
                        $this->modelo->alterar($update, $dados);
                        $this->AlgTot->setModalRedirecionar('Bem vindo ao Algtot '.$_SESSION['usuario'].'!','Muito obrigado por participar do Algtot, aqui você poderá competir com outras pessoas no mundo da lógica e programação.<br>Você receberá <b>100</b> pontos de bonificação para começar.<br>Boa sorte e bom jogo.','','meuModalSucesso', $urlBack);
                    } else {
                        $this->AlgTot->setModalRedirecionar('','','','', $urlBack);
                    }
                    
                } else {
                    $this->AlgTot->setModalRedirecionar('Usuário ainda não liberado', 'Você ainda não tem acesso ao Algtot, aguarde a liberação de acesso do seu usuário.<br>Isso pode levar algum tempo...', '', 'meuModalErro', '../index.php');
                }
                                
                
            } else {
                $this->AlgTot->setModalRedirecionar('', 'Usuário ou senha incorretos.', '', 'meuModalErro', '../index.php');
            }
        }
    }

    public function verificarLogin() {

        $resultado = false;
        $value = null;

        $select = "SELECT * FROM usuario WHERE usuario = ? AND senha = ? AND status != ?";
        $dados = array($this->usuario, $this->senha, 'deletado');
        $dados = $this->modelo->selecionar($select, $dados);

        foreach ($dados as $key => $value) {
            $value['cdUsuario'];
            $value['nomeCompleto'];
            $value['instituicao'];
            $value['curso'];
            $value['primeiroLogin'];
            $value['usuario'];
            $value['senha'];
            $value['cdGrupo'];
            $value['email'];
            $value['data'];
            $value['nivel1'];
            $value['nivel2'];
            $value['nivel3'];
            $value['nivel4'];
            $value['nivel5'];
            $value['pontuacaoTotal'];
            $value['status'];
        }

        if (($value['usuario'] == $this->usuario) && ($value['senha'] == $this->senha)) {

            $this->cdUsuario = $value['cdUsuario'];            
            $this->nomeCompleto = htmlspecialchars($value['nomeCompleto']);
            $this->instituicao = htmlspecialchars($value['instituicao']);
            $this->curso = htmlspecialchars($value['curso']);
            $this->primeiroLogin = $value['primeiroLogin'];            
            $this->usuario = htmlspecialchars($value['usuario']);
            $this->senha = htmlspecialchars($value['senha']);
            $this->cdGrupo = $value['cdGrupo'];
            $this->email = $value['email'];            
            $value['data'] = date("d/m/Y H:i", strtotime($value['data']));
            $value['data'] = preg_replace('/ /', ' as ', $value['data']);            
            $this->data = $value['data'];
            $this->nivel1 = $value['nivel1'];
            $this->nivel2 = $value['nivel2'];
            $this->nivel3 = $value['nivel3'];
            $this->nivel4 = $value['nivel4'];
            $this->nivel5 = $value['nivel5'];
            $this->pontuacaoTotal = $value['pontuacaoTotal'];
            $this->status = $value['status'];

            $resultado = true;
        }

        return $resultado;
    }

    public function cadastrar() {
        
        $this->modelo = new Modelo();
        $this->AlgTot = new AlgTot();

        session_start();

        if (!isset($_SESSION['cdGrupo'])) {
            $_SESSION['cdGrupo'] = null;
        }

        if ($_SESSION['cdGrupo'] == 1) {

            $this->setUsuario($_POST['usuario']);                                                          
            $this->setSenha($_POST['senha']);
            $this->setEmail($_POST['email']);
            $this->setNomeCompleto($_POST['nomeCompleto']);
            $this->setInstituicao($_POST['instituicao']);
            $this->setCurso($_POST['curso']);
            $this->setStatus($_POST['status']);  
            $this->setCdGrupo($_POST['cdGrupo']); 
            //TA AUTOMATICO NO BANCO
//            $this->setData(date('Y-m-d'));
            $mensagem = "";
            
            if (isset($_POST['page_usuarios_inativos'])) {
                $urlBack = '../visao/usuariosInativosADM.php';
            } else {
                $urlBack = '../visao/usuariosADM.php';
            }
                
            if (($this->usuario != null) && ($this->senha != null) && ($this->email != null) && ($this->cdGrupo != null) && ($this->nomeCompleto != null) && ($this->instituicao != null) && ($this->curso != null) && ($this->status != null)) {

                $select = "SELECT count(usuario) AS quantidade FROM usuario WHERE usuario = ? AND status != ?";
                $dados = array($this->usuario, 'deletado');

                if ($this->verificarDuplicidade($select, $dados) == true) {

                    $select = "SELECT count(email) AS quantidade FROM usuario WHERE email = ? AND status != ?";
                    $dados = array($this->email, 'deletado');

                    if ($this->verificarDuplicidade($select, $dados) == true) {

                        $insert = "INSERT INTO usuario(usuario, senha, email, cdGrupo, status,
                                    nivel1, nivel2, nivel3, nivel4, nivel5, pontuacaoTotal, nomeCompleto, instituicao, curso, primeiroLogin)
                                    VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                        $dados = array($this->usuario, $this->senha, $this->email, $this->cdGrupo, $this->status, 100, 0, 0, 0, 0, 100, $this->nomeCompleto, $this->instituicao, $this->curso, 'sim');
                        $this->modelo->cadastrar($insert, $dados);

                        $this->AlgTot->setModalRedirecionar('', 'Usuário cadastrado com sucesso.', '', 'meuModalSucesso', $urlBack);
                        return true;
                    } else {
                        $mensagem = $mensagem . 'Este e-mail já foi cadastrado para um usuário, tente utiliza outro e-mail!\n';
                    }
                } else {
                    $mensagem = $mensagem . 'Este usuário já foi cadastrado, tente outro nome de usuário!\n';
                }
                                
                $this->AlgTot->setModalRedirecionar('', $mensagem, '', 'meuModalErro', $urlBack);                               
            } else {                               
                $this->AlgTot->setModalRedirecionar('', 'Erro ao cadastrar', '', 'meuModalErro', $urlBack);               
            }
        }

        if (!isset($_SESSION['cdGrupo'])) {

            $this->setUsuario($_POST['usuario']);
            $this->setSenha($_POST['senha']);
            $this->setEmail($_POST['email']);
            $this->setNomeCompleto($_POST['nomeCompleto']);
            $this->setInstituicao($_POST['instituicao']);
            $this->setCurso($_POST['curso']);
            $this->setCdGrupo(3);
//            $this->setData(date('Y-m-d'));
            $mensagem = "";

            if (($this->usuario != null) && ($this->senha != null) && ($this->email != null) && ($this->cdGrupo != null) && ($this->nomeCompleto != null) && ($this->instituicao != null) && ($this->curso != null)) {

                $select = "SELECT count(usuario) AS quantidade FROM usuario WHERE usuario = ? AND status != ?";
                $dados = array($this->usuario, 'deletado');

                if ($this->verificarDuplicidade($select, $dados) == true) {

                    $select = "SELECT count(email) AS quantidade FROM usuario WHERE email = ? AND status != ?";
                    $dados = array($this->email, 'deletado');

                    if ($this->verificarDuplicidade($select, $dados) == true) {

                        $insert = "INSERT INTO usuario(usuario, senha, email, cdGrupo, status,
                                    nivel1, nivel2, nivel3, nivel4, nivel5, pontuacaoTotal, nomeCompleto, instituicao, curso, primeiroLogin)
                                    VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                        $dados = array($this->usuario, $this->senha, $this->email, $this->cdGrupo, 'inativo', 100, 0, 0, 0, 0, 100, $this->nomeCompleto, $this->instituicao, $this->curso, 'sim');
                        $this->modelo->cadastrar($insert, $dados);

                        $mensagem = $mensagem . 'Usuário cadastrado com sucesso!<br>Em breve estaremos liberando o seu acesso ao Algtot.';
                        $this->AlgTot->setModalRedirecionar('', $mensagem, '', 'meuModalSucesso', '../index.php');
                        return true;
                    } else {

                        $mensagem = $mensagem . 'Este e-mail já foi cadastrado para um usuário, tente utiliza outro e-mail!<br>';
                    }
                } else {
                    $mensagem = $mensagem . 'Este usuário já foi cadastrado, tente outro nome de usuário!<br>';
                }

                $this->AlgTot->setModalRedirecionar('', $mensagem, '', 'meuModalErro', '../index.php');
            } else {
                $this->AlgTot->setModalRedirecionar('', 'Erro ao cadastrar a sua conta.', '', 'meuModalErro', '../index.php');
            }
        }
    }

    public function alterarUsuario() {
        
        $this->modelo = new Modelo();
        $this->AlgTot = new AlgTot();

        session_start();

//        REMOVI A EDIÇÃO DE NOME DE USUÁRIO
//        if (!isset($_POST['usuario'])) {
//            $this->setUsuario(null);
//        } else {
//            $this->setUsuario($_POST['usuario']);
//        }
        if (!isset($_POST['senha'])) {
            $this->setSenha(null);
        } else {
            $this->setSenha($_POST['senha']);
        }
        if (!isset($_SESSION['cdUsuario'])) {
            $this->cdUsuario = null;
        } else {
            $this->cdUsuario = $_SESSION['cdUsuario'];
        }
        if (!isset($_SESSION['cdGrupo'])) {
            $this->cdGrupo = null;
        } else {
            $this->cdGrupo = $_SESSION['cdGrupo'];
        }
        if (!isset($_SESSION['email'])) {
            $this->email = null;
        } else {
            $this->email = $_SESSION['email'];
        }
        if (!isset($_POST['email'])) {
            $novoEmail = null;
        } else {
            $novoEmail = $_POST['email'];
        }
        if (!isset($_POST['cdGrupo'])) {
            $novoGrupo = null;
        } else {
            $novoGrupo = $_POST['cdGrupo'];
        }
        if (!isset($_POST['novaSenha'])) {
            $novaSenha = null;
        } else {
            $novaSenha = $_POST['novaSenha'];
        }
        if (!isset($_SESSION['usuario'])) {
            $antigoUsuario = null;
        } else {
            $antigoUsuario = $_SESSION['usuario'];
        }
        if (!isset($_SESSION['senha'])) {
            $antigaSenha = null;
        } else {
            $antigaSenha = $_SESSION['senha'];
        }

        $mensagem = "";
        $sucesso = 0;
        $erro = 0;

        if (isset($antigoUsuario)) {

            if ((isset($novoEmail)) && ($this->email != $novoEmail)) {

                $select = "SELECT count(email) AS quantidade FROM usuario WHERE email = ? AND cdUsuario != ? AND status = ?";
                $dados = array($novoEmail, $this->cdUsuario, 'ativo');

                if ($this->verificarDuplicidade($select, $dados) == true) {

                    $update = "UPDATE usuario SET email = ? WHERE cdUsuario = ?";
                    $dados = array($novoEmail, $this->cdUsuario);
                    $this->modelo->alterar($update, $dados);
                    $_SESSION['email'] = $novoEmail;
                    $mensagem = $mensagem . 'E-mail alterado com sucesso!<br>';
                    $sucesso++;
                } else {
                    $mensagem = $mensagem . 'E-mail não alterado. Já existe um usuário utilizando este e-mail!<br>';
                    $erro++;
                }
            }
            
//            REMOVI A EDIÇÃO DE NOME DE USUÁRIO
//            if ((isset($this->usuario)) && ($this->usuario != $antigoUsuario)) {
//                $select = "SELECT count(usuario) AS quantidade FROM usuario WHERE usuario = ? AND cdUsuario != ? AND status != ?";
//                $dados = array($this->usuario, $this->cdUsuario, 'deletado');
//
//                if ($this->verificarDuplicidade($select, $dados) == true) {
//                    $update = "UPDATE usuario SET usuario = ? WHERE cdUsuario = ?";
//                    $dados = array($this->usuario, $this->cdUsuario);
//                    $this->modelo->alterar($update, $dados);
//                    $_SESSION['usuario'] = $this->usuario;
//                    $mensagem = $mensagem . 'Nome de usuário alterado com sucesso!<br>';
//                    $sucesso++;
//                } else {
//                    $mensagem = $mensagem . 'Nome de usuário não alterado. Já existe um usuário com este nome!<br>';
//                    $erro++;
//                }
//            }

            if (isset($this->senha)) {
                if ($this->senha == $antigaSenha) {
                    if ($this->senha != $novaSenha) {
                        $update = "UPDATE usuario SET senha = ? WHERE cdUsuario = ?";
                        $dados = array($novaSenha, $this->cdUsuario);
                        $this->modelo->alterar($update, $dados);
                        $_SESSION['senha'] = $novaSenha;
                        $mensagem = $mensagem . 'Senha alterada com sucesso!<br>';
                        $sucesso++;
                    } else {
                        $mensagem = $mensagem . 'Nenhuma alteração feita na senha!<br>';
                        $erro++;
                    }
                } else {
                    $mensagem = $mensagem . 'A senha atual não esta correta, senha nao alterada!<br>';
                    $erro++;
                }
            }

            //REDIRECIONANDO PARA A PÁGINA QUE O USUÁRIO ESTAVA ANTERIORMENTE
            if (isset($_SERVER['HTTP_REFERER'])) {
                $paginaAnterior = explode("/", $_SERVER['HTTP_REFERER']);
                $paginaAnterior = '../'.$paginaAnterior[count($paginaAnterior)-2].'/'.$paginaAnterior[count($paginaAnterior)-1];
            } else {
               $paginaAnterior = '../index.php';
            }            
            
            if ($sucesso == 0 && $erro == 0) {
                $this->AlgTot->setModalRedirecionar('Nenhuma alteração', 'Nada alterado.', '', 'meuModalSucesso', $paginaAnterior);
                return true;
            } else {
                if ($sucesso > 0 && $erro > 0) {
                    $this->AlgTot->setModalRedirecionar('Nem todos os dados puderam ser alterados!', $mensagem, '', 'meuModalErro', $paginaAnterior);
                    return false;
                }                
                if ($sucesso > 0 && $erro == 0) {
                    $this->AlgTot->setModalRedirecionar('', $mensagem, '', 'meuModalSucesso', $paginaAnterior);
                    return true;
                }                
                if ($sucesso == 0 && $erro > 0) {
                    $this->AlgTot->setModalRedirecionar('', $mensagem, '', 'meuModalErro', $paginaAnterior);
                    return false;
                }                
            }
        }
    }

    public function editarUsuario() {
        
        $this->modelo = new Modelo();
        $this->AlgTot = new AlgTot();

        session_start();

        $this->cdUsuario = $_POST['cdUsuario'];
        $mensagem = "";
        $sucesso = 0;
        $erro = 0;
        $this->cdGrupo = $_SESSION['cdGrupo'];

        if ((isset($this->cdGrupo)) && ($this->cdGrupo == 1)) {

            if (!isset($_POST['nomeCompleto'])) {
                $this->nomeCompleto = null;
            } else {
                $this->nomeCompleto = $_POST['nomeCompleto'];
                $update = "UPDATE usuario SET nomeCompleto = ? WHERE cdUsuario = ?";
                $dados = array($this->nomeCompleto, $this->cdUsuario);
                $this->modelo->alterar($update, $dados);
                $mensagem = $mensagem . 'Nome alterado com sucesso!<br>';
                $sucesso++;
            }
            
            if (!isset($_POST['instituicao'])) {
                $this->instituicao = null;
            } else {
                $this->instituicao = $_POST['instituicao'];
                $update = "UPDATE usuario SET instituicao = ? WHERE cdUsuario = ?";
                $dados = array($this->instituicao, $this->cdUsuario);
                $this->modelo->alterar($update, $dados);
                $mensagem = $mensagem . 'Instituição alterada com sucesso!<br>';
                $sucesso++;
            }

            if (!isset($_POST['curso'])) {
                $this->curso = null;
            } else {
                $this->curso = $_POST['curso'];
                $update = "UPDATE usuario SET curso = ? WHERE cdUsuario = ?";
                $dados = array($this->curso, $this->cdUsuario);
                $this->modelo->alterar($update, $dados);
                $mensagem = $mensagem . 'Curso alterado com sucesso!<br>';
                $sucesso++;
            }
            
            if (!isset($_POST['status'])) {
                $this->status = null;
            } else {
                $this->status = $_POST['status'];
                $update = "UPDATE usuario SET status = ? WHERE cdUsuario = ?";
                $dados = array($this->status, $this->cdUsuario);
                $this->modelo->alterar($update, $dados);
                $mensagem = $mensagem . 'Status alterado com sucesso!<br>';
                $sucesso++;
            }
            
            if (!isset($_POST['usuario'])) {
                $this->usuario = null;
            } else {

                $this->usuario = $_POST['usuario'];

                $select = "SELECT count(usuario) AS quantidade FROM usuario WHERE usuario = ? AND cdUsuario != ? AND status != ?";
                $dados = array($this->usuario, $this->cdUsuario, 'deletado');

                if ($this->verificarDuplicidade($select, $dados) == true) {
                    $update = "UPDATE usuario SET usuario = ? WHERE cdUsuario = ?";
                    $dados = array($this->usuario, $this->cdUsuario);
                    $this->modelo->alterar($update, $dados);
                    $mensagem = $mensagem . 'Nome de usuário alterado com sucesso!<br>';
                    $sucesso++;
                } else {
                    $mensagem = $mensagem . 'Usuário não alterado. Já existe um usuário com este nome!<br>';
                    $erro++;
                }
            }

            if (!isset($_POST['senha'])) {
                $this->senha = null;
            } else {
                $this->senha = $_POST['senha'];
                $update = "UPDATE usuario SET senha = ? WHERE cdUsuario = ?";
                $dados = array($this->senha, $this->cdUsuario);
                $this->modelo->alterar($update, $dados);
                $mensagem = $mensagem . 'Senha alterada com sucesso!<br>';
                $sucesso++;
            }

            if (!isset($_POST['email'])) {
                $this->email = null;
            } else {
                $this->email = $_POST['email'];
                $select = "SELECT count(email) AS quantidade FROM usuario WHERE email = ? AND cdUsuario != ? AND status != ?";
                $dados = array($this->email, $this->cdUsuario, 'deletado');

                if ($this->verificarDuplicidade($select, $dados) == true) {
                    $update = "UPDATE usuario SET email = ? WHERE cdUsuario = ?";
                    $dados = array($this->email, $this->cdUsuario);
                    $this->modelo->alterar($update, $dados);
                    $mensagem = $mensagem . 'E-mail alterado com sucesso!<br>';
                    $sucesso++;
                } else {
                    $mensagem = $mensagem . 'E-mail não alterado. Já existe um usuário utilizando este e-mail!<br>';
                    $erro++;
                }
            }                        
                
            if (isset($_POST['page_usuarios_inativos'])) {
                $urlBack = '../visao/usuariosInativosADM.php';
            } else {
                $urlBack = '../visao/usuariosADM.php';               
            }
            
            if ($sucesso == 0 && $erro == 0) {                
                $this->AlgTot->setModalRedirecionar('Nenhuma alteração', 'Nada alterado.', '', 'meuModalSucesso', $urlBack);
                return true;
            } else {
                if ($sucesso > 0 && $erro > 0) {
                    $this->AlgTot->setModalRedirecionar('Nem todos os dados puderam ser alterados!', $mensagem, '', 'meuModalErro', $urlBack);
                    return false;
                }                
                if ($sucesso > 0 && $erro == 0) {
                    $this->AlgTot->setModalRedirecionar('', $mensagem, '', 'meuModalSucesso', $urlBack);
                    return true;
                }                
                if ($sucesso == 0 && $erro > 0) {
                    $this->AlgTot->setModalRedirecionar('', $mensagem, '', 'meuModalErro', $urlBack);
                    return false;
                }                
            }            
        }
    }
    
    public function ativaOuInativarUsuarios() {
        $cdUsuario = $_POST['cdUsuarioJqueryPost'];
        $status = $_POST['statusJqueryPost'];
        $retorno = '';
        $this->modelo = new Modelo();
        
        if ($status == 'ativo') {
            $status = 'inativo';
            $retorno = 'inativado';
        } else {
            $status = 'ativo';
            $retorno = 'ativado';
        }
        
        $update = "UPDATE usuario SET status = ? WHERE cdUsuario = ?";
        $dados = array($status, $cdUsuario);
        $this->modelo->alterar($update, $dados);
        
        echo $retorno;
    }

    public function verificarDuplicidade($select, $dados) {              

        $resultado = false;

        $dados = $this->modelo->selecionar($select, $dados);

        foreach ($dados as $key => $value) {
            $value['quantidade'];
        }

        if ($value['quantidade'] == 0) {

            $resultado = true;
        }

        return $resultado;
    }

    public function excluirConta() {
        
        $this->modelo = new Modelo();
        $this->AlgTot = new AlgTot();

        session_start();

        $mensagem = null;
        $this->setCdUsuario($_SESSION['cdUsuario']);
        $this->setSenha($_SESSION['senha']);
        $this->setCdGrupo($_SESSION['cdGrupo']);
        if (!isset($_POST['senhaExcluir'])) {
            $senhaExcluir = null;
        } else {
            $senhaExcluir = $_POST['senhaExcluir'];
        }

        if (isset($_SESSION['usuario'])) {

            if ($this->senha == $senhaExcluir) {

                $update = "UPDATE usuario SET status = ? WHERE cdUsuario = ?";
                $dados = array('deletado', $this->cdUsuario);
                $this->modelo->excluir($update, $dados);
                session_destroy();
                $this->AlgTot->setModalRedirecionar('Conta excluida.', 'Sua conta foi excluída!', '', 'meuModalErro', '../index.php');
            } else {
                $mensagem = "Senha incorreta!";
                //REDIRECIONANDO PARA A PÁGINA QUE O USUÁRIO ESTAVA ANTERIORMENTE
                if (isset($_SERVER['HTTP_REFERER'])) {
                    $paginaAnterior = explode("/", $_SERVER['HTTP_REFERER']);
                    $paginaAnterior = '../'.$paginaAnterior[count($paginaAnterior)-2].'/'.$paginaAnterior[count($paginaAnterior)-1];
                } else {
                   $paginaAnterior = '../index.php';
                }
                $this->AlgTot->setModalRedirecionar('', $mensagem, '', 'meuModalErro', $paginaAnterior);
            }
        } else {
            $this->AlgTot->setModalRedirecionar('', '', '', '', '../index.php');
        }
    }

    public function excluirUsuario() {
        
        $this->modelo = new Modelo();
        $this->AlgTot = new AlgTot();

        session_start();
        $this->setCdGrupo($_SESSION['cdGrupo']);
        $grupoExcluir = $_POST['cdGrupo'];
        $usuarioExcluir = $_POST['cdUsuario'];
        
        if (isset($_POST['page_usuarios_inativos'])) {            
            $urlBack = '../visao/usuariosInativosADM.php';
        } else {
            $urlBack = '../visao/usuariosADM.php';               
        }

        if ((isset($_SESSION['usuario'])) && ($this->cdGrupo == 1)) {
            $update = "UPDATE usuario SET status = ? WHERE cdUsuario = ?";
            $dados = array('deletado', $usuarioExcluir);
            $this->modelo->excluir($update, $dados);
            $this->AlgTot->setModalRedirecionar('', 'Conta foi excluída com êxito!', '', 'meuModalSucesso', $urlBack);
        } else {
            $this->AlgTot->setModalRedirecionar('', 'Ocorreu algun erro ao tentar excluir esse usuário.', '', 'meuModalErro', $urlBack);
        }
    }

    public function recuperarSenha() {
        
        $this->modelo = new Modelo();
        $this->AlgTot = new AlgTot();

        $this->setUsuario($_POST['usuario']);

        if (isset($this->usuario)) {

            $select = "SELECT email, senha FROM usuario WHERE usuario = ? AND status = ?";
            $dados = array($this->usuario, 'ativo');
            $dados = $this->modelo->selecionar($select, $dados);

            foreach ($dados as $key => $value) {
                $value['email'];
                $value['senha'];
            }

            if (!isset($value['email'])) {
                $value['email'] = null;
            }
            if (!isset($value['senha'])) {
                $value['senha'] = null;
            }

            $this->setSenha($value['senha']);
            $this->setEmail($value['email']);

            if (isset($this->email)) {

                /*
                  $para = $this->email;
                  $assunto = 'Recuperação de senha, AlgTot';
                  $mensagem = 'Sua senha: ' . $this->senha;
                  $headers = "MIME-Version: 1.1/r/n";
                  $headers .= "Content-type: text/plain; charset=iso-8859-1/r/n";
                  $headers .= "From: AlgTot - AlgTot <algtot@outlook.com.br>/r/n";
                  $headers .= "Return-Path: AlgTot - AlgTot <algtot@outlook.com.br>";

                  if (mail($para, $assunto, $mensagem, $headers) == true) {

                 * $this->AlgTot->setModalRedirecionar('Email enviado', 'Uma mensagem foi enviada para sua caixa de e-mail.', '', 'meuModalSucesso', '../index.php');
                  } else {

                 * $this->AlgTot->setModalRedirecionar('Email não enviado', 'Não foi possivel enviar o e-mail, tente novamente!', '', 'meuModalErro', '../index.php');
                  } */

                $this->AlgTot->setModalRedirecionar('Ainda não disponível!', 'Este serviço ainda não está funcionando!<br>Envie um e-mail para algtot@outlook.com.br solicitando a sua senha<br>Você deve utilizar o e-mail que está vinculado com o seu usuário do AlgTot!', '', 'meuModalErro', '../index.php');
            } else {
                $this->AlgTot->setModalRedirecionar('', 'Usuário inválido!<br>O usuário <b>' . $this->usuario . '</b> não foi encontrado.', '', 'meuModalErro', '../index.php');
            }
        }
    }

    public function setCdUsuario($cdUsuario) {
        $this->cdUsuario = $cdUsuario;
    }

    public function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }

    public function setCdGrupo($cdGrupo) {
        $this->cdGrupo = $cdGrupo;
    }

    public function setEmail($email) {
        $this->email = $email;
    }
    
    public function setNomeCompleto($nomeCompleto) {
        $this->nomeCompleto = $nomeCompleto;
    }
    
    public function setInstituicao($instituicao) {
        $this->instituicao = $instituicao;
    }
    
    public function setCurso($curso) {
        $this->curso = $curso;
    }

    public function setData($data) {
        $this->data = $data;
    }
    
    public function setPrimeiroLogin($primeiroLogin) {
        $this->primeiroLogin = $primeiroLogin;
    }
    
    public function setStatus($status) {
        $this->status = $status;
    }
    
    public function getStatus($staus) {
        $this->staus = $staus;
    }

    public function getCdUsuario() {
        return $this->cdUsuario;
    }

    public function getUsuario() {
        return $this->usuario;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function getCdGrupo() {
        return $this->cdGrupo;
    }
    public function getPrimeiroLogin($primeiroLogin) {
        $this->primeiroLogin = $primeiroLogin;
    }
    

    public function getEmail() {
        return $this->email;
    }
    
    public function getNomeCompleto($nomeCompleto) {
        $this->nomeCompleto = $nomeCompleto;
    }
    
    public function getInstituicao($instituicao) {
        $this->instituicao = $instituicao;
    }
    
    public function getCurso($curso) {
        $this->curso = $curso;
    }

    public function getData() {
        return $this->data;
    }

}
