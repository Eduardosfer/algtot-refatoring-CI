<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Acesso
 *
 * @author EduSfer
 */
require_once("../modelo/Modelo.php");

Class Acesso {

    private $modelo;

    public function __construct() {
        //       
    }

    public function acessar() {
        
        $this->modelo = new Modelo();

        session_start();

        if (!isset($_SESSION['usuario'])) {
            header("Location: ".BASE_URL_ALG."index.php");
        } else {

            $url = explode("/", $_SERVER['REQUEST_URI']);

            $aplicacao = $url[count($url)-1];
            $cdGrupo = $_SESSION['cdGrupo'];

            $select = "SELECT aplicacao FROM aplicacao, grupo WHERE grupo.cdGrupo = aplicacao.cdGrupo
                                    AND aplicacao = ?
                                    AND aplicacao.cdGrupo = ?
                                    ORDER BY cdAplicacao ASC";
            $dados = array($aplicacao, $cdGrupo);
            $dados = $this->modelo->selecionar($select, $dados);

            foreach ($dados as $key => $value) {
                $value['aplicacao'];
            }

            //QUANDO NÃƒO ESTIVER NESSAS APLICAÇÕES E ESTIVER EM ALGUMA QUE FOR VERIFICAVEL EU UNSETO A ATIVIDADE E O TIPO
            if (($aplicacao != 'questaoTipo1.php') && ($aplicacao != 'questaoTipo2.php') && ($aplicacao != 'questaoTipo3.php')) {
                unset($_SESSION['atividade']);
                unset($_SESSION['tipo']);
                echo "<script>localStorage.removeItem('porcentagemAtualCookie');</script>";
            }            

            if ($value['aplicacao'] != $aplicacao) {
                $this->mostrarPagina();
            }
        }
    }

    public function verificarApresentacao() {
        session_start();
        $url = explode("/", $_SERVER['REQUEST_URI']);
        $aplicacao = $url[count($url)-1];
        //QUANDO NÃO ESTIVER NESSAS APLICAÇÕES E ESTIVER EM ALGUMA QUE FOR VERIFICAVEL EU UNSETO A ATIVIDADE E O TIPO
        if (($aplicacao != 'questaoTipo1.php') && ($aplicacao != 'questaoTipo2.php') && ($aplicacao != 'questaoTipo3.php')) {
            unset($_SESSION['atividade']);
            unset($_SESSION['tipo']);
            echo "<script>localStorage.removeItem('porcentagemAtualCookie');</script>";
        }
    }

    public function mostrarPagina() {
        if ($_SESSION['cdGrupo'] == 1) {
            header("Location: ".BASE_URL_ALG."visao/principalADM.php");
        }

        if ($_SESSION['cdGrupo'] == 2) {
            header("Location: ".BASE_URL_ALG."visao/principalProfessor.php");
        }

        if ($_SESSION['cdGrupo'] == 3) {
            header("Location: ".BASE_URL_ALG."visao/principal.php");
        }
    }

}
