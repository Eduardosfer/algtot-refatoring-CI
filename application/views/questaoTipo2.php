<?php

require_once("../controle/Acesso.php");
require_once("../controle/AlgTot.php");


$algTot = new AlgTot();
$acesso = new Acesso();
$modelo = new Modelo();

$acesso->acessar();

if(!isset($_POST['atividade'])){
  $atividade = null;
}else{
  $atividade = $_POST['atividade'];
}

$algTot->setQuestao($atividade);

if ($_SESSION['tipo']==1) {
  header("Location: ".BASE_URL_ALG."visao/questaoTipo1.php");
}

if ($_SESSION['tipo']==3) {
  header("Location: ".BASE_URL_ALG."visao/questaoTipo3.php");
}

?>

<!DOCTYPE html>

<html lang="pt-br">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Eduardo Soares Ferreira">

    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <script type="text/javascript" src="vendor/jquery/jquery.min.js"></script>
    <script src="http://code.jquery.com/ui/1.8.21/jquery-ui.min.js"></script>
    <!--PARA FUNCIONAR O TOUCH -->
    <script src="js/jquery.ui.touch-punch.min.js"></script>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">    
    <link href="vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
    <script type="text/javascript" src="vendor/bootstrap/js/bootstrap.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <style>

        [draggable] {
          -moz-user-select: none;
          -khtml-user-select: none;
          -webkit-user-select: none;
          user-select: none;

          -khtml-user-drag: element;
          -webkit-user-drag: element;
        }

        #columns-full .column {
          -webkit-transition: -webkit-transform 0.2s ease-out;
          -moz-transition: -moz-transform 0.2s ease-out;
          -o-transition: -o-transform 0.2s ease-out;
          -ms-transition: -ms-transform 0.2s ease-out;
        }
          #columns-full .column.over,
          #columns-dragOver .column.over,
          #columns-dragEnd .column.over,
          #columns-almostFinal .column.over {
        }

        #columns-full .column.moving {
          opacity: 0.9;
          -webkit-transform: scale(0.8);
          -moz-transform: scale(0.8);
          -ms-transform: scale(0.8);
          -o-transform: scale(0.8);
        }

        #columns-full .column .count {
          padding-top: 15px;
          font-weight: bold;
          text-shadow: #fff 0 1px;
        }

      </style>

    <title>AlgtTot: Questão Tipo: 2</title>

    </head>

    <!-- Bootstrap -->
    <body>

      <!--MENU DE ALUNO-->
      <?php include_once ("includs/menuAluno.php"); ?>
      
      <!--MODAL DE VISUALIZAÇÃO E EDIÇÃO DE DADOS-->
      <?php include_once("includs/modalVerEditarPerfil.php"); ?>

      <!--MODAL DE EXCLUIR PERFIL-->
      <?php include_once("includs/modalExcluirPerfil.php"); ?>

      <!-- MODAL DE VISUALIZAÇÃO DA DICA -->
      <?php include_once("includs/modalVerDica.php"); ?>

      <!-- MODAL DE DESISTENCIA DO USUÁRIO -->
      <?php include_once("includs/modalDesistir.php"); ?>

      <!-- MODAL DE REGISTRO ACERTO OU ERRO OU PULO -->
      <?php include_once("includs/modalAcertoErroPulo.php"); if($_SESSION['tipo']==2){ unset($_SESSION['mostrarModalRegistro']); } ?>


        <br>
        <br>
        <br>

        <section id="conteudo">

        	<div id="titulo" class="container">

        		<div class="row">

              <div id="titulo" class="container">

            		<div class="row">

            			<div class="col-lg-12 text-center" style="color:white;">
            				<h3 class="section-heading"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span> Questão: <?php echo $_SESSION['progressoAtividade']; ?>  Valor: <?php echo $_SESSION['pontuacao']; ?> <span class="glyphicon glyphicon-star" aria-hidden="true"></span></h3>
            				<hr class="primary">
            			</div>

            		</div>

            	</div>

        			<div class="container">

                <?php

                  $porcentagemAtual = (($_SESSION['progressoAtividade']) * 100) / $_SESSION['quantidadeTotalQuestao'];

                  if ($porcentagemAtual>100) {
                      $porcentagemAtual = 100;
                  }

                  $porcentagemAtual = number_format($porcentagemAtual, 0, '', '');

                 ?>

            		<div class="progress" title="Progresso atual da atividade">
            			<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php echo $porcentagemAtual; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $porcentagemAtual; ?>%"><?php echo $porcentagemAtual; ?>%
            			<span class="sr-only"><?php echo $porcentagemAtual; ?>% Complete (warning)</span>
            			</div>
            		</div>

          			<div class="panel panel-default">

                  <div class="panel-heading" style="background-color: #4cae4c; color:white;">
                    <h4><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span> <?php echo $_SESSION['pergunta']; ?></h4>
                    <h5>*Clique e arraste as ações abaixo para ordena-las sequencialmente!</h5>
                  </div>

                  <form name="validarQuestao2" action="../controle/AlgTot.php" onsubmit="localStorage.removeItem('porcentagemAtualCookie');" method="post">

                    <div class="panel-body">

                      <?php

                        $tempoTotalQuestao = $_SESSION['tempoTotalQuestao'];

                      ?>

                      <script type="text/javascript">
                      $(document).ready(function() {
                      
                        $('input').keypress(function (e) {
                             var code = null;
                             code = (e.keyCode ? e.keyCode : e.which);                
                             return (code == 13) ? false : true;
                        });
                        
                        marcarTempo(<?php echo $tempoTotalQuestao; ?>);
                      });
                                            
                    </script>


                      <button id="pularQuestao" style="display:none" class="btn btn-success" type="submit" name="acao" value="PularQuestao"></button>

                      <div id="tempoRestante" class="progress" title="Tempo restante para responder a questão!">
                        <div id="barraTempo" class="progress-bar progress-bar-primary progress-bar" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 100%">Tempo restante !
                        </div>
                      </div>

            					<div id="sequenciaDesordenada" class="col">

                          <center>

                            <div id="columns-full">

                              <?php

                                    $acoes = explode(";", $_SESSION['alternativaCorreta']);

                                    //SUBTRAIO 2 PARA NÃO CONTAR O VAZIO QUE FICA NO FINAL POR CAUSA DAS ASPAS DUPLAS E PARA QUE EU PEGUE O VALOR DO LTIMO INDICE E NÃO DE FATO O TAMANHO
                                    $totalAcoes = count($acoes)-2;

                                    /** * Função para gerar números aleatórios 
                                    * * @author Paulo Freitas <paulofreitas dot web at gmail dot com> 
                                    * @copyright Copyright © 2006, Paulo Freitas 
                                    * @license http://creativecommo...by-nc-sa/2.0/br Commons Creative 
                                    * @version 20060312 
                                    * @param int $qnt quantidade de números que deseja gerar 
                                    * @param int $min número mínimo que deseja gerar 
                                    * @param int $max número máximo que deseja gerar 
                                    * @param bool $repeat false se os números gerados podem repetir 
                                    * @param bool $sort true se os números gerados devem ser ordenados 
                                    * @param integer $sort_order critério de ordenação, sendo 0 para ordenação ascendente e 1 para ordenação descendente 
                                    * @return array|string números gerados ou mensagem de erro caso ocorra */
                                
                                    function getRandomNumbers($qnt, $min, $max, $repeat = false, $sort = true, $sort_order = 0) {
                                      if ((($max - $min) + 1) >= $qnt) {
                                          $numbers = array();

                                          while (count($numbers) < $qnt) {
                                              $number = mt_rand($min, $max);
                                              if ($repeat) {
                                                  $numbers[] = $number;
                                              } elseif (!in_array($number, $numbers)) {
                                                  $numbers[] = $number;
                                              }
                                          }
                                          if ($sort) {
                                              switch ($sort_order) {
                                                  case 0:
                                                      sort($numbers);
                                                      break;
                                                  case 1:
                                                      rsort($numbers);
                                                      break;
                                              }
                                          }
                                          return $numbers;
                                      } else {
                                          return 'A faixa de valores entre $min e $max deve ser igual ou superior à ' .
                                                  'quantidade de números requisitados';
                                      }
                                  }// Após declará-la:

                                                            
                                foreach (getRandomNumbers($totalAcoes+1, 0, $totalAcoes, false, false) as $numRand) { 
                                
                                ?>

                                <div class="column" draggable="true" style="background-color:#4cae4c; display: table">
                                  <button name="btn<?php echo $numRand; ?>" value="<?php echo $acoes[$numRand]; ?>" type="button" class="btn btn-success">
                                    <h4>
                                      <?php echo $acoes[$numRand]; ?>
                                      <input name="<?php echo $numRand; ?>" value="<?php echo $acoes[$numRand]; ?>" type="hidden">
                                    </h4>
                                  </button>
                                </div>
                                <br>

                              <?php
                                }
                               ?>

                            </div>

                        </center>

            					</div>

            				</div>

                                        <div class="panel-footer" style="text-align: right;">            					
                                            <a name="desistir" type="button" class="btn btn-default" data-toggle="modal" data-target="#desistir"><span class="glyphicon glyphicon-remove"></span> Desistir</a>            						            					
                                            <button name="dica" type="button" class="btn btn-primary" data-toggle="modal" data-target="#verDica"><span class="glyphicon glyphicon-gift"></span> Ver Dica</button>
                                            <button name="acao" value="ValidarQuestaoTipo2" type="submit" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span> Enviar</button>            						            					
            				</div>

                  </form>

          			</div>

              </div>

        		</div>

        	</div>


        </section>

        <!--Minhas verificações -->
        <script src="js/verificacoes.js"></script>

        <!--Organizador Lógico -->
        <script src="js/organizadorLogico.js"></script>  
        
        
        <script>            
            function disableF5(e) { 
                if ((e.which || e.keyCode) == 116) {
                    e.preventDefault();
                }
            };
            $(document).ready(function(){
                 $(document).on("keydown", disableF5);
            });             
        </script>
        
    </body>
</html>
