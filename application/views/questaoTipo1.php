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

if ($_SESSION['tipo']==2) {
  header("Location: ".BASE_URL_ALG."visao/questaoTipo2.php");
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
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
    <script type="text/javascript" src="vendor/bootstrap/js/bootstrap.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

    <title>AlgtTot: Questão Tipo: 1</title>

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
      <?php include_once("includs/modalAcertoErroPulo.php"); if($_SESSION['tipo']==1){ unset($_SESSION['mostrarModalRegistro']); } ?>

        <br>
        <br>
        <br>

        <section id="conteudo">

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

        		<div>

        			<form name="validarQuestao1" onsubmit="localStorage.removeItem('porcentagemAtualCookie');" class="form-horizontal" action="../controle/AlgTot.php" method="post">

        				<div class="panel panel-default">

        					<div class="panel-heading" style="background-color: #4cae4c; color:white;"><h4><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span> <?php echo $_SESSION['pergunta']; ?></h4></div>

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

                    <?php

                      $numeros='12345';

                      $resposta[1] = $_SESSION['alternativaCorreta'];
                      $resposta[2] = $_SESSION['alternativaIncorreta1'];
                      $resposta[3] = $_SESSION['alternativaIncorreta2'];
                      $resposta[4] = $_SESSION['alternativaIncorreta3'];
                      $resposta[5] = $_SESSION['alternativaIncorreta4'];

                      for($i=1;$i<=5;$i++) {
                        $numRand = $numeros[rand(0,strlen($numeros)-1)];
                        $teste = "/".$numRand."/";
                        $numeros = preg_replace($teste, '', $numeros);
                        $resposta[$numRand] = htmlspecialchars($resposta[$numRand]);
                     ?>

        						<div class="form-group">
        							<div class="col-sm-offset-0 col-sm-12">
        								<div class="radio">
        									<label>
        										<input type="radio" class="radiosEnviar" name="resposta" required value="<?php echo $resposta[$numRand]; ?>" type="radio"><?php echo $resposta[$numRand]; ?>
        									</label>
        								</div>
        							</div>
        						</div>

                    <?php
                      }
                     ?>
        					</div>

                                        <div class="panel-footer" style="text-align: right;">            					
                                            <a name="desistir" type="button" class="btn btn-default" data-toggle="modal" data-target="#desistir"><span class="glyphicon glyphicon-remove"></span> Desistir</a>            						            					
                                            <button name="dica" type="button" class="btn btn-primary" data-toggle="modal" data-target="#verDica"><span class="glyphicon glyphicon-gift"></span> Ver Dica</button>
                                            <button name="acao" value="ValidarQuestaoTipo1" type="submit" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span> Enviar</button>            						            					
            				</div>

        				</div>

        			</form>

        		</div>

        	</div>

        </section>
        <!--Minhas verificações -->
        <script src="js/verificacoes.js"></script>
                
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
