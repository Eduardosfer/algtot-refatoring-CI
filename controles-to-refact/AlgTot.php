<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AlgTot
 *
 * @author EduSfer
 */
require_once("../modelo/Modelo.php");

new AlgTot();

Class AlgTot {

    private $modelo;

    public function __construct() {                        

        if (!isset($_POST['acao'])) {
            $_POST['acao'] = "";
        }

        switch ($_POST['acao']) {

            case 'CadastrarAtividade':
                $this->cadastrarAtividade();
                break;

            case 'EditarAtividade':
                $this->editarAtividade();
                break;
            
            case 'ativaOuInativarAtividade':
                $this->ativaOuInativarAtividade();
                break;

            case 'ExcluirAtividade':
                $this->excluirAtividade();
                break;

            case 'CadastrarQuestaoTipo1':
                $this->cadastrarQuestaoTipo1();
                break;

            case 'CadastrarQuestaoTipo2':
                $this->cadastrarQuestaoTipo2();
                break;

            case 'CadastrarQuestaoTipo3':
                $this->cadastrarQuestaoTipo3();
                break;

            case 'AlterarQuestao':
                $this->alterarQuestao();
                break;

            case 'ExcluirQuestao':
                $this->excluirQuestao();
                break;

            case 'ValidarQuestaoTipo1':
                $this->validarQuestaoTipo1();
                break;

            case 'ValidarQuestaoTipo2':
                $this->validarQuestaoTipo2();
                break;

            case 'ValidarQuestaoTipo3':
                $this->validarQuestaoTipo3();
                break;

            case 'PularQuestao':
                $this->pularQuestao();
                break;
        }
    }

    public function cadastrarAtividade() {
        
        $this->modelo = new Modelo();

        $titulo = $_POST['titulo'];
        $nivel = $_POST['nivel'];
        $status = $_POST['status'];
        //TA AUTOMATICO NO BANCO
//        $dataCadastramento = date('Y-m-d');        
        session_start();
        $mensagem = '';
        $meuModal = null;        

        if (($_SESSION['cdGrupo'] == 1) || ($_SESSION['cdGrupo'] == 2)) {

            if ((isset($titulo) && $titulo != '') && (isset($nivel) && $nivel != '') && (isset($status) && $status != '')) {

                $select = "SELECT count(cdAtividade) AS quantidade FROM atividade WHERE titulo = ? AND status != ?";
                $dados = array($titulo, 'deletado');

                if ($this->verificarDuplicidade($select, $dados) == true) {
                    $insert = "INSERT INTO atividade(titulo,nivel,status) VALUES(?,?,?)";
                    $dados = array($titulo, $nivel, $status);
                    $this->modelo->cadastrar($insert, $dados);
                    $meuModal = 'meuModalSucesso';
                    $mensagem = 'Atividade cadastrada com sucesso!';                                        
                } else {
                    $meuModal = 'meuModalErro';
                    $mensagem = 'Já existe uma atividade cadastrada com esse título. Atividade não cadastrada!';
                }
            } else {
                $meuModal = 'meuModalErro';
                $mensagem = 'Atividade não foi cadastrada!<br>Algum dado pode estar faltando.';
            }

            if ($_SESSION['cdGrupo'] == 1) {                
                $this->setModalRedirecionar('', $mensagem, '', $meuModal, '../visao/atividadesADM.php');
                return true;
            }

            if ($_SESSION['cdGrupo'] == 2) {                
                $this->setModalRedirecionar('', $mensagem, '', $meuModal, '../visao/atividadesProfessor.php');
                return true;
            }
        }
    }

    public function editarAtividade() {
        
        $this->modelo = new Modelo();

        session_start();

        if (($_SESSION['cdGrupo'] == 1) || ($_SESSION['cdGrupo'] == 2)) {

            $mensagem = "";
            $sucesso = 0;
            $erro = 0;                    
            $url = '';                    

            if (!isset($_POST['cdAtividade'])) {
                $cdAtividade = null;
            } else {
                $cdAtividade = $_POST['cdAtividade'];
            }

            if (!isset($_POST['titulo'])) {
                $titulo = null;
            } else {
                $titulo = $_POST['titulo'];
            }

            if (!isset($_POST['nivel'])) {
                $nivel = null;
            } else {
                $nivel = $_POST['nivel'];
            }

            if (!isset($_POST['status'])) {
                $status = null;
            } else {
                $status = $_POST['status'];
            }


            if ($titulo != null && $titulo != '') {
                $select = "SELECT count(cdAtividade) AS quantidade FROM atividade WHERE titulo = ? AND status != ? AND cdAtividade != ?";
                $dados = array($titulo, 'deletado', $cdAtividade);

                if ($this->verificarDuplicidade($select, $dados) == true) {
                    $update = "UPDATE atividade SET titulo = ? WHERE cdAtividade = ?";
                    $dados = array($titulo, $cdAtividade);
                    $this->modelo->alterar($update, $dados);
                    $mensagem = $mensagem . 'Titulo alterado com sucesso!<br>';
                    $sucesso++;
                } else {
                    $mensagem = $mensagem . 'Titulo não editado. Já existe uma atividade cadastrada com esse titulo.<br>';
                    $erro++;
                }
            }
            
            if ($nivel != null && $nivel != '') {
                $update = "UPDATE atividade SET nivel = ? WHERE cdAtividade = ?";
                $dados = array($nivel, $cdAtividade);
                $this->modelo->alterar($update, $dados);
                $mensagem = $mensagem . 'Nível alterado com sucesso!<br>';
                $sucesso++;
            }

            if ($status != null && $status != '') {
                $update = "UPDATE atividade SET status = ? WHERE cdAtividade = ?";
                $dados = array($status, $cdAtividade);
                $this->modelo->alterar($update, $dados);
                $mensagem = $mensagem . 'Status alterado com sucesso!<br>';
                $sucesso++;
            }

            if ($_SESSION['cdGrupo'] == 1) {                
                $url = '../visao/atividadesADM.php';                
            }

            if ($_SESSION['cdGrupo'] == 2) {                
                $url = '../visao/atividadesProfessor.php';  
            }
            
            if ($sucesso == 0 && $erro == 0) {
                $this->setModalRedirecionar('Nenhuma alteração', 'Nada alterado.', '', 'meuModalSucesso', $url);
                return true;
            } else {
                if ($sucesso > 0 && $erro > 0) {
                    $this->setModalRedirecionar('Nem todos os dados puderam ser alterados!', $mensagem, '', 'meuModalErro', $url);
                    return false;
                }                
                if ($sucesso > 0 && $erro == 0) {
                    $this->setModalRedirecionar('', $mensagem, '', 'meuModalSucesso', $url);
                    return true;
                }                
                if ($sucesso == 0 && $erro > 0) {
                    $this->setModalRedirecionar('', $mensagem, '', 'meuModalErro', $url);
                    return false;
                }                
            }  
        }
    }
    
    public function ativaOuInativarAtividade() {
        $cdAtividade = $_POST['cdAtividadeJqueryPost'];
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
        
        $update = "UPDATE atividade SET status = ? WHERE cdAtividade = ?";
        $dados = array($status, $cdAtividade);
        $this->modelo->alterar($update, $dados);
        
        echo $retorno;
    }

    public function excluirAtividade() {
        
        $this->modelo = new Modelo();

        session_start();

        if (($_SESSION['cdGrupo'] == 1) || ($_SESSION['cdGrupo'] == 2)) {

            $mensagem = "";

            if (!isset($_POST['cdAtividade'])) {
                $cdAtividade = null;
            } else {
                $cdAtividade = $_POST['cdAtividade'];
            }

            if (isset($cdAtividade)) {
                $update = "UPDATE atividade SET status = ? WHERE cdAtividade = ?";
                $dados = array('deletado', $cdAtividade);
                $this->modelo->excluir($update, $dados);
                $update2 = "UPDATE questao SET status = ? WHERE cdAtividade = ?";
                $dados2 = array('deletado', $cdAtividade);
                $this->modelo->excluir($update2, $dados2);
                $mensagem = $mensagem . 'Atividade deletada com sucesso!';
            }

            if ($_SESSION['cdGrupo'] == 1) {
                $this->setModalRedirecionar('', $mensagem, '', 'meuModalSucesso', '../visao/atividadesADM.php');                
            }

            if ($_SESSION['cdGrupo'] == 2) {                
                $this->setModalRedirecionar('', $mensagem, '', 'meuModalSucesso', '../visao/atividadesProfessor.php');
            }
        }
    }

    public function cadastrarQuestaoTipo1() {
        
        $this->modelo = new Modelo();        

        session_start();

        if (($_SESSION['cdGrupo'] == 1) || ($_SESSION['cdGrupo'] == 2)) {

            $mensagem = "";
            $meuModal = "";

            if (isset($_POST['dica'])) {
                $dica = $_POST['dica'];
            } else {
                $dica = " ";
            }

            if ((!isset($_POST['pergunta'])) || (!isset($_POST['alternativaCorreta'])) || (!isset($_POST['alternativaIncorreta1'])) || (!isset($_POST['alternativaIncorreta2'])) || (!isset($_POST['alternativaIncorreta3'])) || (!isset($_POST['alternativaIncorreta4'])) || (!isset($_POST['pontuacao'])) || (!isset($_POST['cdAtividade'])) || (!isset($_POST['tipo']))) {
                $mensagem = $mensagem . 'A questão não pode ser cadastrada, pois está faltando algum campo a ser preenchido!<br>';
            } else {
                $pergunta = $_POST['pergunta'];
                $alternativaCorreta = $_POST['alternativaCorreta'];
                $alternativaIncorreta1 = $_POST['alternativaIncorreta1'];
                $alternativaIncorreta2 = $_POST['alternativaIncorreta2'];
                $alternativaIncorreta3 = $_POST['alternativaIncorreta3'];
                $alternativaIncorreta4 = $_POST['alternativaIncorreta4'];
                $pontuacao = $_POST['pontuacao'];
                $tempoTotalQuestao = $_POST['tempoTotalQuestao'];
                $cdAtividade = $_POST['cdAtividade'];
                $tipo = $_POST['tipo'];
                //TA AUTOMATICO NO BANCO
//                $dataCadastramento = date('Y-m-d');

                $select = "SELECT count(cdQuestao) AS quantidade FROM questao WHERE pergunta = ? AND status != ?";
                $dados = array($pergunta, 'deletado');

                if ($this->verificarDuplicidade($select, $dados) == true) {

                    $insert = "INSERT INTO questao(cdAtividade,tipo,pergunta,alternativaCorreta,
                                alternativaIncorreta1,alternativaIncorreta2,alternativaIncorreta3,alternativaIncorreta4,
                                pontuacao,tempoTotalQuestao,dica,status) VALUES(?,?,?,?,?,?,?,?,?,?,?,?) ";

                    $dados = array($cdAtividade, $tipo, $pergunta,
                        $alternativaCorreta, $alternativaIncorreta1, $alternativaIncorreta2,
                        $alternativaIncorreta3, $alternativaIncorreta4, $pontuacao, $tempoTotalQuestao,
                        $dica, 'ativo');

                    $this->modelo->cadastrar($insert, $dados);
                    $mensagem = $mensagem . 'A questão foi cadastrada com sucesso!';
                    $meuModal = 'meuModalSucesso';
                } else {
                    $mensagem = $mensagem . 'A questão não foi cadastrada, pois já esxiste uma questão com esta pergunta!<br>Caso queira cadastrar mesmo assim, terá que mudar algo na pergunta!';
                    $meuModal = 'meuModalErro';
                }
            }

            if ($_SESSION['cdGrupo'] == 1) {                
                $this->setModalRedirecionar('', $mensagem, '', $meuModal, '../visao/questaoADM.php');
            }

            if ($_SESSION['cdGrupo'] == 2) {
                $this->setModalRedirecionar('', $mensagem, '', $meuModal, '../visao/questaoProfessor.php');                
            }
        }
    }

    public function cadastrarQuestaoTipo2() {
        
        $this->modelo = new Modelo();

        session_start();

        if (($_SESSION['cdGrupo'] == 1) || ($_SESSION['cdGrupo'] == 2)) {

            $mensagem = "";
            $meuModal = '';
            if (isset($_POST['dica'])) {

                $dica = $_POST['dica'];
            } else {

                $dica = " ";
            }

            if ((!isset($_POST['pergunta'])) || (!isset($_POST['alternativaCorreta'])) || (!isset($_POST['pontuacao'])) || (!isset($_POST['cdAtividade'])) || (!isset($_POST['tipo']))) {

                $mensagem = $mensagem . 'A questão não pode ser cadastrada, pois está faltando algum campo a ser preenchido!<br>';
            } else {
                $pergunta = $_POST['pergunta'];
                $alternativaCorreta = $_POST['alternativaCorreta'];
                $pontuacao = $_POST['pontuacao'];
                $tempoTotalQuestao = $_POST['tempoTotalQuestao'];
                $cdAtividade = $_POST['cdAtividade'];
                $tipo = $_POST['tipo'];
                //TA AUTOMATICO NO BANCO
//                $dataCadastramento = date('Y-m-d');
                $alternativaCorreta = trim($alternativaCorreta);

                $select = "SELECT count(cdQuestao) AS quantidade FROM questao WHERE pergunta = ? AND status != ?";
                $dados = array($pergunta, 'deletado');

                if ($this->verificarDuplicidade($select, $dados) == true) {
                    $insert = "INSERT INTO questao(cdAtividade,tipo,pergunta,alternativaCorreta,pontuacao,tempoTotalQuestao,dica,status)
                                                VALUES(?,?,?,?,?,?,?,?)";

                    $dados = array($cdAtividade, $tipo, $pergunta, $alternativaCorreta, $pontuacao, $tempoTotalQuestao, $dica, 'ativo');
                    $this->modelo->cadastrar($insert, $dados);
                    $mensagem = $mensagem . 'A questão foi cadastrada com sucesso!';
                    $meuModal = 'meuModalSucesso';
                } else {
                    $mensagem = $mensagem . 'A questão não foi cadastrada, pois já esxiste uma questão com esta pergunta/contexto!<br>Caso queira cadastrar mesmo assim, terá que mudar algo na pergunta/contexto!';
                    $meuModal = 'meuModalErro';
                }
            }

            if ($_SESSION['cdGrupo'] == 1) {                
                $this->setModalRedirecionar('', $mensagem, '', $meuModal, '../visao/questaoADM.php');
            }

            if ($_SESSION['cdGrupo'] == 2) {
                $this->setModalRedirecionar('', $mensagem, '', $meuModal, '../visao/questaoProfessor.php');              
            }
        }
    }

    public function cadastrarQuestaoTipo3() {
        //São os mesmos campos, por isso nÃ£o precisa de outro metodo, mas posteriormente posso fazer algo diferente, por isso criei este metodo
        $this->cadastrarQuestaoTipo1();
    }

    public function alterarQuestao() {
        
        $this->modelo = new Modelo();

        session_start();

        if (($_SESSION['cdGrupo'] == 1) || ($_SESSION['cdGrupo'] == 2)) {

            $mensagem = "";
            $url = "";
            $sucesso = 0;
            $erro = 0;

            if ((!isset($_POST['cdQuestao']))) {
                $mensagem = $mensagem . 'A questão não pode ser alterada, pois está faltando algum campo a ser preenchido!<br>';
                $erro++;
            } else {

                $cdQuestao = $_POST['cdQuestao'];

                if (!isset($_POST['pergunta'])) {
                    $pergunta = null;
                } else {
                    $pergunta = $_POST['pergunta'];
                }
                if (!isset($_POST['alternativaCorreta'])) {
                    $alternativaCorreta = null;
                } else {
                    $alternativaCorreta = trim($_POST['alternativaCorreta']);
                }
                if (!isset($_POST['alternativaIncorreta1'])) {
                    $alternativaIncorreta1 = null;
                } else {
                    $alternativaIncorreta1 = $_POST['alternativaIncorreta1'];
                }
                if (!isset($_POST['alternativaIncorreta2'])) {
                    $alternativaIncorreta2 = null;
                } else {
                    $alternativaIncorreta2 = $_POST['alternativaIncorreta2'];
                }
                if (!isset($_POST['alternativaIncorreta3'])) {
                    $alternativaIncorreta3 = null;
                } else {
                    $alternativaIncorreta3 = $_POST['alternativaIncorreta3'];
                }
                if (!isset($_POST['alternativaIncorreta4'])) {
                    $alternativaIncorreta4 = null;
                } else {
                    $alternativaIncorreta4 = $_POST['alternativaIncorreta4'];
                }
                if (!isset($_POST['pontuacao'])) {
                    $pontuacao = null;
                } else {
                    $pontuacao = $_POST['pontuacao'];
                }
                if (!isset($_POST['tempoTotalQuestao'])) {
                    $tempoTotalQuestao = null;
                } else {
                    $tempoTotalQuestao = $_POST['tempoTotalQuestao'];
                }
                if (!isset($_POST['dica'])) {
                    $dica = null;
                } else {
                    $dica = $_POST['dica'];
                }

                $select = "SELECT count(cdQuestao) AS quantidade FROM questao WHERE pergunta = ? AND status != ? AND cdQuestao != ?";
                $dados = array($pergunta, 'deletado', $cdQuestao);

                if ($this->verificarDuplicidade($select, $dados) == true) {

                    if (isset($pergunta)) {
                        $update = "UPDATE questao SET pergunta = ? WHERE cdQuestao = ?";
                        $dados = array($pergunta, $cdQuestao);
                        $this->modelo->alterar($update, $dados);
                        $mensagem = $mensagem . 'A pergunta foi alterada com sucesso!<br>';
                        $sucesso++;
                    }

                    if (isset($alternativaCorreta)) {
                        $update = "UPDATE questao SET alternativaCorreta = ? WHERE cdQuestao = ?";
                        $dados = array($alternativaCorreta, $cdQuestao);
                        $this->modelo->alterar($update, $dados);
                        $mensagem = $mensagem . 'A alternativa correta foi alterada com sucesso!<br>';
                        $sucesso++;
                    }

                    if (isset($alternativaIncorreta1)) {
                        $update = "UPDATE questao SET alternativaIncorreta1 = ? WHERE cdQuestao = ?";
                        $dados = array($alternativaIncorreta1, $cdQuestao);
                        $this->modelo->alterar($update, $dados);
                        $mensagem = $mensagem . 'A alternativa incorreta 1 foi alterada com sucesso!<br>';
                        $sucesso++;
                    }

                    if (isset($alternativaIncorreta2)) {
                        $update = "UPDATE questao SET alternativaIncorreta2 = ? WHERE cdQuestao = ?";
                        $dados = array($alternativaIncorreta2, $cdQuestao);
                        $this->modelo->alterar($update, $dados);
                        $mensagem = $mensagem . 'A alternativa incorreta 2 foi alterada com sucesso!<br>';
                        $sucesso++;
                    }

                    if (isset($alternativaIncorreta3)) {
                        $update = "UPDATE questao SET alternativaIncorreta3 = ? WHERE cdQuestao = ?";
                        $dados = array($alternativaIncorreta3, $cdQuestao);
                        $this->modelo->alterar($update, $dados);
                        $mensagem = $mensagem . 'A alternativa incorreta 3 foi alterada com sucesso!<>br';
                        $sucesso++;
                    }

                    if (isset($alternativaIncorreta4)) {
                        $update = "UPDATE questao SET alternativaIncorreta4 = ? WHERE cdQuestao = ?";
                        $dados = array($alternativaIncorreta4, $cdQuestao);
                        $this->modelo->alterar($update, $dados);
                        $mensagem = $mensagem . 'A alternativa incorreta 4 foi alterada com sucesso!<br>';
                        $sucesso++;
                    }

                    if (isset($pontuacao)) {
                        $update = "UPDATE questao SET pontuacao = ? WHERE cdQuestao = ?";
                        $dados = array($pontuacao, $cdQuestao);
                        $this->modelo->alterar($update, $dados);
                        $mensagem = $mensagem . 'A pontuacao foi alterada com sucesso!<br>';
                        $sucesso++;
                    }

                    if (isset($tempoTotalQuestao)) {
                        $update = "UPDATE questao SET tempoTotalQuestao = ? WHERE cdQuestao = ?";
                        $dados = array($tempoTotalQuestao, $cdQuestao);
                        $this->modelo->alterar($update, $dados);
                        $mensagem = $mensagem . 'O tempo de resposta da questão foi alterada com sucesso!<br>';
                        $sucesso++;
                    }

                    if (isset($dica)) {
                        $update = "UPDATE questao SET dica = ? WHERE cdQuestao = ?";
                        $dados = array($dica, $cdQuestao);
                        $this->modelo->alterar($update, $dados);
                        $mensagem = $mensagem . 'A dica foi alterada com sucesso!<br>';
                        $sucesso++;
                    }
                } else {
                    $mensagem = $mensagem . 'A questão não foi alterada, pois já esxiste uma questão com esta pergunta/contexto!<br>Caso queira alterar mesmo assim, terá que mudar algo na pergunta/contexto!';
                    $erro++;
                }
            }
                
            if ($_SESSION['cdGrupo'] == 1) {                
                $url = '../visao/questaoADM.php';                
            }

            if ($_SESSION['cdGrupo'] == 2) {                
                $url = '../visao/questaoProfessor.php';  
            }
            
            if ($sucesso == 0 && $erro == 0) {
                $this->setModalRedirecionar('Nenhuma alteração', 'Nada alterado.', '', 'meuModalSucesso', $url);
                return true;
            } else {
                if ($sucesso > 0 && $erro > 0) {
                    $this->setModalRedirecionar('Nem todos os dados puderam ser alterados!', $mensagem, '', 'meuModalErro', $url);
                    return false;
                }                
                if ($sucesso > 0 && $erro == 0) {
                    $this->setModalRedirecionar('', $mensagem, '', 'meuModalSucesso', $url);
                    return true;
                }                
                if ($sucesso == 0 && $erro > 0) {
                    $this->setModalRedirecionar('', $mensagem, '', 'meuModalErro', $url);
                    return false;
                }                
            }
        }
    }        

    public function excluirQuestao() {
        
        $this->modelo = new Modelo();

        session_start();

        if (($_SESSION['cdGrupo'] == 1) || ($_SESSION['cdGrupo'] == 2)) {

            $mensagem = "";

            if (!isset($_POST['cdQuestao'])) {
                $cdQuestao = null;
            } else {
                $cdQuestao = $_POST['cdQuestao'];
            }

            if (isset($cdQuestao)) {
                $update = "UPDATE questao SET status = ? WHERE cdQuestao = ?";
                $dados = array('deletado', $cdQuestao);
                $this->modelo->excluir($update, $dados);
                $mensagem = $mensagem . 'Questão excluida com sucesso!';
            }
            
            if ($_SESSION['cdGrupo'] == 1) {
                $this->setModalRedirecionar('', $mensagem, '', 'meuModalSucesso', '../visao/questaoADM.php');                
            }

            if ($_SESSION['cdGrupo'] == 2) {                
                $this->setModalRedirecionar('', $mensagem, '', 'meuModalSucesso', '../visao/questaoProfessor.php');
            }                       
        }
    }

    public function validarQuestaoTipo1() {
        
        $this->modelo = new Modelo();

        session_start();

        if (!isset($_POST['resposta'])) {
            $resposta = null;
        } else {
            $resposta = $_POST['resposta'];
        }

        if (isset($resposta)) {

            $_SESSION['pontuacaoObtidaQuestao'] = $_SESSION['pontuacao'];
            $cdUsuario = $_SESSION['cdUsuario'];
            $cdQuestao = $_SESSION['cdQuestao'];
            $cdAtividade = $_SESSION['atividade'];

//            OBTENDO SE HOUVE ACERTO OU ERRO
            $select = "SELECT usuarioquestao.status AS acertouOuErrou FROM usuarioquestao
                        WHERE usuarioquestao.cdUsuario = ? AND usuarioquestao.cdQuestao = ?
                        ORDER BY usuarioquestao.cdUsuarioQuestao DESC LIMIT 0,1";
            $dados = array($cdUsuario, $cdQuestao);
            $acertos = $this->modelo->selecionar($select, $dados);
            //USANDO FOREACH PARA SABER SE A ULTIMA VEZ QUE ELE RESPONDEU A QUESTÃO ELE ACERTOU OU ERROU
            foreach ($acertos as $key => $acerto) {
                $acertouOuErrou = $acerto['acertouOuErrou'];
            }                
            if (!isset($acertouOuErrou)) {
                $acertouAnteriormente = null;
                $errouAnteriormente = null;
            } else {
                if ($acertouOuErrou == 'acertou') {
                    $acertouAnteriormente = 'acertouAnteriormente';
                } else {
                    $acertouAnteriormente = null;
                }
                if ($acertouOuErrou == 'errou') {
                    $errouAnteriormente = 'errouAnteriormente';
                } else {
                    $errouAnteriormente = null;
                }
            }  
                        
            $_SESSION['acertouAnteriormente'] = $acertouAnteriormente;
            $_SESSION['errouAnteriormente'] = $errouAnteriormente;
//            FIM DO OBTENDO SE HOUVE ACERTO OU ERRO           

            if ($resposta == $_SESSION['alternativaCorreta']) {

                $pontuacaoQuestao = $_SESSION['pontuacao'];

                $select = "SELECT atividade.nivel AS nivel FROM atividade, questao
                            WHERE atividade.cdAtividade = questao.cdAtividade AND questao.cdQuestao = ?";
                $dados = array($cdQuestao);
                $niveis = $this->modelo->selecionar($select, $dados);

                foreach ($niveis as $key => $nivels) {
                    $nivel = $nivels['nivel'];
                }

                if (!isset($nivel)) {
                    $nivel = null;
                }

                if ($acertouAnteriormente == null) {

                    $_SESSION['pontuacaoTotal'] = $_SESSION['pontuacaoTotal'] + $pontuacaoQuestao;
                    $_SESSION['pontuacaoObtidaAteMomento'] = $_SESSION['pontuacaoObtidaAteMomento'] + $pontuacaoQuestao;
                    $pontuacaoTotal = $_SESSION['pontuacaoTotal'];

                    if ($nivel == 1) {
                        $_SESSION['nivel1'] = $_SESSION['nivel1'] + $pontuacaoQuestao;
                        $campo = 'nivel1';
                        $pontuacaoNivel = $_SESSION['nivel1'];
                    }

                    if ($nivel == 2) {
                        $_SESSION['nivel2'] = $_SESSION['nivel2'] + $pontuacaoQuestao;
                        $campo = 'nivel2';
                        $pontuacaoNivel = $_SESSION['nivel2'];
                    }

                    if ($nivel == 3) {
                        $_SESSION['nivel3'] = $_SESSION['nivel3'] + $pontuacaoQuestao;
                        $campo = 'nivel3';
                        $pontuacaoNivel = $_SESSION['nivel3'];
                    }

                    if ($nivel == 4) {
                        $_SESSION['nivel4'] = $_SESSION['nivel4'] + $pontuacaoQuestao;
                        $campo = 'nivel4';
                        $pontuacaoNivel = $_SESSION['nivel4'];
                    }

                    if ($nivel == 5) {
                        $_SESSION['nivel5'] = $_SESSION['nivel5'] + $pontuacaoQuestao;
                        $campo = 'nivel5';
                        $pontuacaoNivel = $_SESSION['nivel5'];
                    }

                    $insert = "INSERT INTO usuarioquestao(cdUsuario,cdQuestao,status) VALUES(?,?,?)";
                    $dados = array($cdUsuario, $cdQuestao, 'acertou');
                    $this->modelo->cadastrar($insert, $dados);

                    $update = "UPDATE usuario SET pontuacaoTotal = ?, $campo = ? WHERE cdUsuario = ?";
                    $dados = array($pontuacaoTotal, $pontuacaoNivel, $cdUsuario);
                    $this->modelo->alterar($update, $dados);
                } else {
                    $insert = "INSERT INTO usuarioquestao(cdUsuario,cdQuestao,status) VALUES(?,?,?)";
                    $dados = array($cdUsuario, $cdQuestao, 'acertou');
                    $this->modelo->cadastrar($insert, $dados);
                }

                $_SESSION['totalQuestoesAcertadas'] ++;
                $_SESSION['mostrarModalRegistro'] = 'acertou';
            } else {
                
                $pontuacaoQuestao = $_SESSION['pontuacao'];

                $select = "SELECT atividade.nivel AS nivel FROM atividade, questao
                            WHERE atividade.cdAtividade = questao.cdAtividade AND questao.cdQuestao = ?";
                $dados = array($cdQuestao);
                $niveis = $this->modelo->selecionar($select, $dados);

                foreach ($niveis as $key => $nivels) {
                    $nivel = $nivels['nivel'];
                }

                if (!isset($nivel)) {
                    $nivel = null;
                }

                if ($errouAnteriormente == null) {

                    $_SESSION['pontuacaoTotal'] = $_SESSION['pontuacaoTotal'] - $pontuacaoQuestao;
                    $_SESSION['pontuacaoObtidaAteMomento'] = $_SESSION['pontuacaoObtidaAteMomento'] - $pontuacaoQuestao;
                    $pontuacaoTotal = $_SESSION['pontuacaoTotal'];

                    if ($nivel == 1) {
                        $_SESSION['nivel1'] = $_SESSION['nivel1'] - $pontuacaoQuestao;
                        $campo = 'nivel1';
                        $pontuacaoNivel = $_SESSION['nivel1'];
                    }

                    if ($nivel == 2) {
                        $_SESSION['nivel2'] = $_SESSION['nivel2'] - $pontuacaoQuestao;
                        $campo = 'nivel2';
                        $pontuacaoNivel = $_SESSION['nivel2'];
                    }

                    if ($nivel == 3) {
                        $_SESSION['nivel3'] = $_SESSION['nivel3'] - $pontuacaoQuestao;
                        $campo = 'nivel3';
                        $pontuacaoNivel = $_SESSION['nivel3'];
                    }

                    if ($nivel == 4) {
                        $_SESSION['nivel4'] = $_SESSION['nivel4'] - $pontuacaoQuestao;
                        $campo = 'nivel4';
                        $pontuacaoNivel = $_SESSION['nivel4'];
                    }

                    if ($nivel == 5) {
                        $_SESSION['nivel5'] = $_SESSION['nivel5'] - $pontuacaoQuestao;
                        $campo = 'nivel5';
                        $pontuacaoNivel = $_SESSION['nivel5'];
                    }

                    $insert = "INSERT INTO usuarioquestao(cdUsuario,cdQuestao,status) VALUES(?,?,?)";
                    $dados = array($cdUsuario, $cdQuestao, 'errou');
                    $this->modelo->cadastrar($insert, $dados);

                    $update = "UPDATE usuario SET pontuacaoTotal = ?, $campo = ? WHERE cdUsuario = ?";
                    $dados = array($pontuacaoTotal, $pontuacaoNivel, $cdUsuario);
                    $this->modelo->alterar($update, $dados);
                } else {
                    $insert = "INSERT INTO usuarioquestao(cdUsuario,cdQuestao,status) VALUES(?,?,?)";
                    $dados = array($cdUsuario, $cdQuestao, 'errou');
                    $this->modelo->cadastrar($insert, $dados);
                }

                $_SESSION['totalQuestoesErradas'] ++;
                $_SESSION['mostrarModalRegistro'] = 'errou';
            }

            //TRANSFORMO EM UM ARRAY PARA PEGAR O AS QUESTÕES SEM REPETIR 
            $_SESSION['randQuestao'] = explode(",", $_SESSION['randQuestao']);

            $questaoRandomica = count($_SESSION['randQuestao']) - 1;
            //Setando o codigo da questao randomicamente -- Começo do 1 pois o primeiro valor é sempre uma virgula
            $_SESSION['numQuestao'] = $_SESSION['randQuestao'][rand(1, $questaoRandomica)];

            //retirando a questao que ja foi selecionada
            $teste = "/\b" . $_SESSION['numQuestao'] . "\b/";
            $_SESSION['randQuestao'] = preg_replace($teste, '', $_SESSION['randQuestao']);

            //TORNANDO O RAND QUESTÃO EM UMA STRING NOVAMENTE PARA PODER ELIMINAR O VAZIO QUE FOI DEIXADO PELO PREG_REPLACE    
            $_SESSION['randQuestao'] = implode(",", $_SESSION['randQuestao']);
            //RETIRANDO O EXCESSO DE VIRGULAS
            $_SESSION['randQuestao'] = preg_replace('/,,/', ',', $_SESSION['randQuestao']);
            //RETIRANDO O ULTIMO ELEMENTO CASO ELE SEJA UMA VIRGULA    
            if ($_SESSION['randQuestao'][strlen($_SESSION['randQuestao']) - 1] == ',') {
                $_SESSION['randQuestao'] = substr($_SESSION['randQuestao'], 0, -1);
            }

            $_SESSION['progressoAtividade']++;

            if ($_SESSION['progressoAtividade'] > $_SESSION['quantidadeTotalQuestao']) {
                unset($_SESSION['atividade']);
                $_SESSION['mostrarModalRegistroFinal'] = 'registroFinalAtividade';
                header("Location: ".BASE_URL_ALG."visao/atividades.php");
            } else {
                header("Location: ".BASE_URL_ALG."visao/questaoTipo1.php");
            }
        } else {
            header("Location: ".BASE_URL_ALG."visao/questaoTipo1.php");
        }
    }

    public function validarQuestaoTipo2() {
        
        $this->modelo = new Modelo();

        session_start();

        if (isset($_POST)) {

            $resposta = "";
            $respostas = $_POST;
            $alternativaCorreta = $_SESSION['alternativaCorreta'];
            $cdUsuario = $_SESSION['cdUsuario'];
            $cdQuestao = $_SESSION['cdQuestao'];
            $cdAtividade = $_SESSION['atividade'];
            $_SESSION['pontuacaoObtidaQuestao'] = $_SESSION['pontuacao'];

            //            OBTENDO SE HOUVE ACERTO OU ERRO
            $select = "SELECT usuarioquestao.status AS acertouOuErrou FROM usuarioquestao
                        WHERE usuarioquestao.cdUsuario = ? AND usuarioquestao.cdQuestao = ?
                        ORDER BY usuarioquestao.cdUsuarioQuestao DESC LIMIT 0,1";
            $dados = array($cdUsuario, $cdQuestao);
            $acertos = $this->modelo->selecionar($select, $dados);
            //USANDO FOREACH PARA SABER SE A ULTIMA VEZ QUE ELE RESPONDEU A QUESTÃO ELE ACERTOU OU ERROU
            foreach ($acertos as $key => $acerto) {
                $acertouOuErrou = $acerto['acertouOuErrou'];                
            }                
            if (!isset($acertouOuErrou)) {
                $acertouAnteriormente = null;
                $errouAnteriormente = null;
            } else {
                if ($acertouOuErrou == 'acertou') {
                    $acertouAnteriormente = 'acertouAnteriormente';
                } else {
                    $acertouAnteriormente = null;
                }
                if ($acertouOuErrou == 'errou') {
                    $errouAnteriormente = 'errouAnteriormente';
                } else {
                    $errouAnteriormente = null;
                }
            }               
            $_SESSION['acertouAnteriormente'] = $acertouAnteriormente;
            $_SESSION['errouAnteriormente'] = $errouAnteriormente;
//            FIM DO OBTENDO SE HOUVE ACERTO OU ERRO

            foreach ($respostas as $value) {
                if ($value != $respostas['acao']) {
                    $resposta = $resposta . $value . ";";
                }
            }

            if ($resposta == $alternativaCorreta) {

                $pontuacaoQuestao = $_SESSION['pontuacao'];

                $select = "SELECT atividade.nivel AS nivel FROM atividade, questao
                                            WHERE atividade.cdAtividade = questao.cdAtividade AND questao.cdQuestao = ?";
                $dados = array($cdQuestao);
                $niveis = $this->modelo->selecionar($select, $dados);

                foreach ($niveis as $key => $nivels) {
                    $nivel = $nivels['nivel'];
                }

                if (!isset($nivel)) {
                    $nivel = null;
                }

                if ($acertouAnteriormente == null) {

                    $_SESSION['pontuacaoTotal'] = $_SESSION['pontuacaoTotal'] + $pontuacaoQuestao;
                    $_SESSION['pontuacaoObtidaAteMomento'] = $_SESSION['pontuacaoObtidaAteMomento'] + $pontuacaoQuestao;
                    $pontuacaoTotal = $_SESSION['pontuacaoTotal'];

                    if ($nivel == 1) {
                        $_SESSION['nivel1'] = $_SESSION['nivel1'] + $pontuacaoQuestao;
                        $campo = 'nivel1';
                        $pontuacaoNivel = $_SESSION['nivel1'];
                    }

                    if ($nivel == 2) {
                        $_SESSION['nivel2'] = $_SESSION['nivel2'] + $pontuacaoQuestao;
                        $campo = 'nivel2';
                        $pontuacaoNivel = $_SESSION['nivel2'];
                    }

                    if ($nivel == 3) {
                        $_SESSION['nivel3'] = $_SESSION['nivel3'] + $pontuacaoQuestao;
                        $campo = 'nivel3';
                        $pontuacaoNivel = $_SESSION['nivel3'];
                    }

                    if ($nivel == 4) {
                        $_SESSION['nivel4'] = $_SESSION['nivel4'] + $pontuacaoQuestao;
                        $campo = 'nivel4';
                        $pontuacaoNivel = $_SESSION['nivel4'];
                    }

                    if ($nivel == 5) {
                        $_SESSION['nivel5'] = $_SESSION['nivel5'] + $pontuacaoQuestao;
                        $campo = 'nivel5';
                        $pontuacaoNivel = $_SESSION['nivel5'];
                    }

                    $insert = "INSERT INTO usuarioquestao(cdUsuario,cdQuestao,status) VALUES(?,?,?)";
                    $dados = array($cdUsuario, $cdQuestao, 'acertou');
                    $this->modelo->cadastrar($insert, $dados);

                    $update = "UPDATE usuario SET pontuacaoTotal = ?, $campo = ? WHERE cdUsuario = ?";
                    $dados = array($pontuacaoTotal, $pontuacaoNivel, $cdUsuario);
                    $this->modelo->alterar($update, $dados);
                } else {

                    $insert = "INSERT INTO usuarioquestao(cdUsuario,cdQuestao,status) VALUES(?,?,?)";
                    $dados = array($cdUsuario, $cdQuestao, 'acertou');
                    $this->modelo->cadastrar($insert, $dados);
                }

                $_SESSION['totalQuestoesAcertadas'] ++;
                $_SESSION['mostrarModalRegistro'] = 'acertou';
            } else {

                
                $pontuacaoQuestao = $_SESSION['pontuacao'];

                $select = "SELECT atividade.nivel AS nivel FROM atividade, questao
                            WHERE atividade.cdAtividade = questao.cdAtividade AND questao.cdQuestao = ?";
                $dados = array($cdQuestao);
                $niveis = $this->modelo->selecionar($select, $dados);

                foreach ($niveis as $key => $nivels) {
                    $nivel = $nivels['nivel'];
                }

                if (!isset($nivel)) {
                    $nivel = null;
                }

                if ($errouAnteriormente == null) {

                    $_SESSION['pontuacaoTotal'] = $_SESSION['pontuacaoTotal'] - $pontuacaoQuestao;
                    $_SESSION['pontuacaoObtidaAteMomento'] = $_SESSION['pontuacaoObtidaAteMomento'] - $pontuacaoQuestao;
                    $pontuacaoTotal = $_SESSION['pontuacaoTotal'];

                    if ($nivel == 1) {
                        $_SESSION['nivel1'] = $_SESSION['nivel1'] - $pontuacaoQuestao;
                        $campo = 'nivel1';
                        $pontuacaoNivel = $_SESSION['nivel1'];
                    }

                    if ($nivel == 2) {
                        $_SESSION['nivel2'] = $_SESSION['nivel2'] - $pontuacaoQuestao;
                        $campo = 'nivel2';
                        $pontuacaoNivel = $_SESSION['nivel2'];
                    }

                    if ($nivel == 3) {
                        $_SESSION['nivel3'] = $_SESSION['nivel3'] - $pontuacaoQuestao;
                        $campo = 'nivel3';
                        $pontuacaoNivel = $_SESSION['nivel3'];
                    }

                    if ($nivel == 4) {
                        $_SESSION['nivel4'] = $_SESSION['nivel4'] - $pontuacaoQuestao;
                        $campo = 'nivel4';
                        $pontuacaoNivel = $_SESSION['nivel4'];
                    }

                    if ($nivel == 5) {
                        $_SESSION['nivel5'] = $_SESSION['nivel5'] - $pontuacaoQuestao;
                        $campo = 'nivel5';
                        $pontuacaoNivel = $_SESSION['nivel5'];
                    }

                    $insert = "INSERT INTO usuarioquestao(cdUsuario,cdQuestao,status) VALUES(?,?,?)";
                    $dados = array($cdUsuario, $cdQuestao, 'errou');
                    $this->modelo->cadastrar($insert, $dados);

                    $update = "UPDATE usuario SET pontuacaoTotal = ?, $campo = ? WHERE cdUsuario = ?";
                    $dados = array($pontuacaoTotal, $pontuacaoNivel, $cdUsuario);
                    $this->modelo->alterar($update, $dados);
                } else {
                    $insert = "INSERT INTO usuarioquestao(cdUsuario,cdQuestao,status) VALUES(?,?,?)";
                    $dados = array($cdUsuario, $cdQuestao, 'errou');
                    $this->modelo->cadastrar($insert, $dados);
                }

                $_SESSION['totalQuestoesErradas'] ++;
                $_SESSION['mostrarModalRegistro'] = 'errou';
            }

            //TRANSFORMO EM UM ARRAY PARA PEGAR O AS QUESTÕES SEM REPETIR 
            $_SESSION['randQuestao'] = explode(",", $_SESSION['randQuestao']);

            $questaoRandomica = count($_SESSION['randQuestao']) - 1;
            //Setando o codigo da questao randomicamente -- Começo do 1 pois o primeiro valor é sempre uma virgula
            $_SESSION['numQuestao'] = $_SESSION['randQuestao'][rand(1, $questaoRandomica)];

            //retirando a questao que ja foi selecionada
            $teste = "/\b" . $_SESSION['numQuestao'] . "\b/";
            $_SESSION['randQuestao'] = preg_replace($teste, '', $_SESSION['randQuestao']);

            //TORNANDO O RAND QUESTÃO EM UMA STRING NOVAMENTE PARA PODER ELIMINAR O VAZIO QUE FOI DEIXADO PELO PREG_REPLACE    
            $_SESSION['randQuestao'] = implode(",", $_SESSION['randQuestao']);
            //RETIRANDO O EXCESSO DE VIRGULAS
            $_SESSION['randQuestao'] = preg_replace('/,,/', ',', $_SESSION['randQuestao']);
            //RETIRANDO O ULTIMO ELEMENTO CASO ELE SEJA UMA VIRGULA    
            if ($_SESSION['randQuestao'][strlen($_SESSION['randQuestao']) - 1] == ',') {
                $_SESSION['randQuestao'] = substr($_SESSION['randQuestao'], 0, -1);
            }

            $_SESSION['progressoAtividade'] ++;

            if ($_SESSION['progressoAtividade'] > $_SESSION['quantidadeTotalQuestao']) {
                unset($_SESSION['atividade']);
                $_SESSION['mostrarModalRegistroFinal'] = 'registroFinalAtividade';
                header("Location: ".BASE_URL_ALG."visao/atividades.php");
            } else {
                header("Location: ".BASE_URL_ALG."visao/questaoTipo1.php");
            }
        } else {

            header("Location: ".BASE_URL_ALG."visao/questaoTipo1.php");
        }
    }

    public function validarQuestaoTipo3() {
        //São os mesmos tratamentos para o tipo 1, mas criei este metodo para caso precise fazer algo diferente
        $this->validarQuestaoTipo1();
    }

    public function pularQuestao() {                

        session_start();

        //TRANSFORMO EM UM ARRAY PARA PEGAR O AS QUESTÕES SEM REPETIR 
        $_SESSION['randQuestao'] = explode(",", $_SESSION['randQuestao']);

        $questaoRandomica = count($_SESSION['randQuestao']) - 1;
        //Setando o codigo da questao randomicamente -- Começo do 1 pois o primeiro valor é sempre uma virgula
        $_SESSION['numQuestao'] = $_SESSION['randQuestao'][rand(1, $questaoRandomica)];

        //retirando a questao que ja foi selecionada
        $teste = "/\b" . $_SESSION['numQuestao'] . "\b/";
        $_SESSION['randQuestao'] = preg_replace($teste, '', $_SESSION['randQuestao']);

        //TORNANDO O RAND QUESTÃO EM UMA STRING NOVAMENTE PARA PODER ELIMINAR O VAZIO QUE FOI DEIXADO PELO PREG_REPLACE    
        $_SESSION['randQuestao'] = implode(",", $_SESSION['randQuestao']);
        //RETIRANDO O EXCESSO DE VIRGULAS
        $_SESSION['randQuestao'] = preg_replace('/,,/', ',', $_SESSION['randQuestao']);
        //RETIRANDO O ULTIMO ELEMENTO CASO ELE SEJA UMA VIRGULA    
        if ($_SESSION['randQuestao'][strlen($_SESSION['randQuestao']) - 1] == ',') {
            $_SESSION['randQuestao'] = substr($_SESSION['randQuestao'], 0, -1);
        }

        //pulando a questao
        $_SESSION['progressoAtividade'] ++;

        //Adicionando em questÃµes Puladas
        $_SESSION['totalQuestoesPuldas'] ++;

        //Setando o que o modal de acerto erro ou pular deve mostrar que neste caso a que ele pulou por falta de tempo
        $_SESSION['mostrarModalRegistro'] = 'pulou';

        //Redirecionando
        if ($_SESSION['progressoAtividade'] > $_SESSION['quantidadeTotalQuestao']) {
            unset($_SESSION['atividade']);
            $_SESSION['mostrarModalRegistroFinal'] = 'registroFinalAtividade';
            header("Location: ".BASE_URL_ALG."visao/atividades.php");
        } else {
            header("Location: ".BASE_URL_ALG."visao/questaoTipo1.php");
        }
    }

    public function setAtividade($cdAtividade, $titulo) {

        if (isset($cdAtividade)) {
            $_SESSION['cdAtividade'] = $cdAtividade;
            $_SESSION['titulo'] = $titulo;
        }

        if (!isset($_SESSION['cdAtividade'])) {

            if ($_SESSION['cdGrupo'] == 1) {
                header("Location: ".BASE_URL_ALG."visao/atividadesADM.php");
            }

            if ($_SESSION['cdGrupo'] == 2) {
                header("Location: ".BASE_URL_ALG."visao/atividadesProfessor.php");
            }
        }
    }

    public function setNivel($nivel) {

        if (isset($nivel)) {
            $_SESSION['nivel'] = $nivel;
        }

        if (!isset($_SESSION['nivel'])) {

            if ($_SESSION['cdGrupo'] == 1) {
                header("Location: ".BASE_URL_ALG."visao/atividadesADM.php");
            }

            if ($_SESSION['cdGrupo'] == 2) {
                header("Location: ".BASE_URL_ALG."visao/atividadesProfessor.php");
            }
        }
    }

    public function setQuestao($atividade) {

        $this->modelo = new Modelo();
        
        if ($atividade != null) {
            $_SESSION['atividade'] = $atividade;
            $_SESSION['numQuestao'] = 0;
            $_SESSION['pontuacaoObtidaAteMomento'] = 0;
            $_SESSION['totalQuestoesAcertadas'] = 0;
            $_SESSION['totalQuestoesPuldas'] = 0;
            $_SESSION['totalQuestoesErradas'] = 0;
            $_SESSION['progressoAtividade'] = 1;
            $cdAtividade = $_SESSION['atividade'];
            $cdUsuario = $_SESSION['cdUsuario'];

            //            PEGANDO A QUANTIDADE TOTAL DE QUESTÕES QUE O USUÁRIO AINDA NÃO ACERTOU
            $select = "SELECT COUNT(questao.cdQuestao) AS quantidadeTotalQuestao
                        FROM questao
                        WHERE questao.cdAtividade = ?
                        AND questao.status = ?
                        AND ((select count(usuarioquestao.cdUsuarioQuestao) 
                        FROM usuarioquestao where usuarioquestao.cdQuestao = questao.cdQuestao 
                        AND usuarioquestao.cdUsuario = ? 
                        AND usuarioquestao.status = ?
                        AND questao.status = ?) = 0)";
            $dados = array($cdAtividade, 'ativo', $cdUsuario, 'acertou', 'ativo');
            $quantias = $this->modelo->selecionar($select, $dados);

            foreach ($quantias as $key => $quantia) {
                $_SESSION['quantidadeTotalQuestao'] = $quantia['quantidadeTotalQuestao'];
            }
            //FIM DO PEGANDO QUANTIDADE TOTAL DE QUESTÕES              

            $_SESSION['randQuestao'] = null;

            for ($i = 0; $i < $_SESSION['quantidadeTotalQuestao']; $i++) {
                $_SESSION['randQuestao'] = $_SESSION['randQuestao'] . "," . $i;
            }

            //TRANSFORMO EM UM ARRAY PARA PEGAR O AS QUESTÕES SEM REPETIR 
            $_SESSION['randQuestao'] = explode(",", $_SESSION['randQuestao']);

            $questaoRandomica = count($_SESSION['randQuestao']) - 1;
            //Setando o codigo da questao randomicamente -- Começo do 1 pois o primeiro valor é sempre uma virgula
            $_SESSION['numQuestao'] = $_SESSION['randQuestao'][rand(1, $questaoRandomica)];

            //retirando a questao que ja foi selecionada
            $teste = "/\b" . $_SESSION['numQuestao'] . "\b/";
            $_SESSION['randQuestao'] = preg_replace($teste, '', $_SESSION['randQuestao']);

            //TORNANDO O RAND QUESTÃO EM UMA STRING NOVAMENTE PARA PODER ELIMINAR O VAZIO QUE FOI DEIXADO PELO PREG_REPLACE    
            $_SESSION['randQuestao'] = implode(",", $_SESSION['randQuestao']);
            //RETIRANDO O EXCESSO DE VIRGULAS
            $_SESSION['randQuestao'] = preg_replace('/,,/', ',', $_SESSION['randQuestao']);
            //RETIRANDO O ULTIMO ELEMENTO CASO ELE SEJA UMA VIRGULA    
            if ($_SESSION['randQuestao'][strlen($_SESSION['randQuestao']) - 1] == ',') {
                $_SESSION['randQuestao'] = substr($_SESSION['randQuestao'], 0, -1);
            }
        }

        if (isset($_SESSION['atividade'])) {

            $quantidadeTotalQuestao = $_SESSION['quantidadeTotalQuestao'];
            $numQuestao = $_SESSION['numQuestao'];
            $cdAtividade = $_SESSION['atividade'];
            $cdUsuario = $_SESSION['cdUsuario'];

//            SELECIONANDO TODAS AS QUESTÕES QUE O USUARIO AINDA NAO ACERTOU DA ATIVIDADE
            $select = "SELECT questao.*
                        FROM questao
                        WHERE questao.cdAtividade = ?
                        AND questao.status = ?
                        AND ((select count(usuarioquestao.cdUsuarioQuestao) 
                        FROM usuarioquestao where usuarioquestao.cdQuestao = questao.cdQuestao 
                        AND usuarioquestao.cdUsuario = ? 
                        AND usuarioquestao.status = ?
                        AND questao.status = ?) = 0)
                        LIMIT $numQuestao,1";
            $dados = array($cdAtividade, 'ativo', $cdUsuario, 'acertou', 'ativo');            
            $questoes = $this->modelo->selecionarFetchAll($select, $dados);
            
            if (isset($_SESSION['tipo'])) {
                unset($_SESSION['tipo']);
            }
                     
            if ($questoes == true) {                               
                $questao = $questoes[0];                            
                $_SESSION['cdQuestao'] = $questao['cdQuestao'];
                $_SESSION['tipo'] = $questao['tipo'];
                $_SESSION['pergunta'] = $questao['pergunta'];
                $_SESSION['alternativaCorreta'] = $questao['alternativaCorreta'];
                $_SESSION['alternativaIncorreta1'] = $questao['alternativaIncorreta1'];
                $_SESSION['alternativaIncorreta2'] = $questao['alternativaIncorreta2'];
                $_SESSION['alternativaIncorreta3'] = $questao['alternativaIncorreta3'];
                $_SESSION['alternativaIncorreta4'] = $questao['alternativaIncorreta4'];
                $_SESSION['dica'] = $questao['dica'];
                $_SESSION['pontuacao'] = $questao['pontuacao'];
                $_SESSION['tempoTotalQuestao'] = $questao['tempoTotalQuestao'];                                
            }
            
        } else {            
            header("Location: ".BASE_URL_ALG."visao/atividades.php");
        }
        
        if (!isset($_SESSION['tipo'])) {                
            header("Location: ".BASE_URL_ALG."visao/atividades.php");
        }
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

    public function setModalRedirecionar($header = null, $body = null, $footer = null, $meuModal = null, $url = "../index.php") {
        session_start();
        $_SESSION['modal'] = $meuModal;
        $_SESSION['header'] = $header;
        $_SESSION['body'] = $body;
        $_SESSION['footer'] = $footer;
        header("Location: $url");
    }

    public function setModelo($modelo) {
        $this->modelo = $modelo;
    }

    public function getModelo() {
        return $this->modelo;
    }

}
