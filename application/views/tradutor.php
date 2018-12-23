<?php
  
  require_once("../controle/Acesso.php");  
  require_once("../controle/Tradutor.php");
  
  $acesso = new Acesso();
  $tradutor = new Tradutor();

  $acesso->acessar();
 

if (!isset($_POST['codigo'])) {
    $codigo = null;
} else {
    $codigo = $_POST['codigo'];
}

$tradutor->executar($codigo);

$codigoPortugol = $tradutor->getCodigoPortugol();
$codigoTraduzido = $tradutor->getCodigoTraduzido();
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

        <title>AlgtTot: Treinar Portugol</title>

    </head>

    <!-- Bootstrap -->
    <body>
        
                
        <?php 
            
            if($_SESSION['cdGrupo']==1){
                //MENU DE ADM
                include_once ("includs/menuADM.php"); 
            }
            
            if($_SESSION['cdGrupo']==2){
                //MENU DE Professor
                include_once ("includs/menuProfessor.php"); 
            }
            
            if($_SESSION['cdGrupo']==3){
                //MENU DE ALUNO
                include_once("includs/menuAluno.php"); 
            }
        ?>

        <!--MODAL DE VISUALIZAÇÃO E EDIÇÃO DE DADOS-->
        <?php include_once("includs/modalVerEditarPerfil.php"); ?>

        <!--MODAL DE EXCLUIR PERFIL-->
        <?php include_once("includs/modalExcluirPerfil.php"); ?>

        <br>
        <br>
        <br>

        <section id="conteudo">

            <div id="titulo" class="container">

                <div class="row">

                    <div id="titulo" class="container">

                        <div class="row">

                            <div class="col-lg-12 text-center" style="color:white;">
                                <h3 class="section-heading"></span> Aqui você pode treinar com essa versão da sintaxe do portugol</h3>
                                <hr class="primary">
                            </div>

                        </div>

                    </div>

                    <div class="container">                           		

                        <div class="panel panel-default">

                            <div class="panel-heading" style="background-color: #4cae4c; color:white;"><h4> Utilize o campo abaixo para escrever seu algoritmo </h4><a class="btn btn-default" name="acaoInicio" href="principal.php" ><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Início</a></div>

                            <div class="panel-body">



                                <div class="col-sm-6">

                                    <div class="panel panel-info">

                                        <div class="panel-heading">

                                            <form name="traducaoCodigo" action="tradutor.php" method="post">

                                                <h4 style="text-align: center;">Digite seu código no campo abaixo.</h4>
                                                <button name="acao" value="Executar" type="submit" class="btn btn-success"><span class="glyphicon glyphicon-play"></span> Rodar</button>
                                                <button name="acaoSintaxe" value="sintaxe" type="button" data-toggle="modal" data-target="#sintaxe" href="#" class="btn btn-primary"><span class="glyphicon glyphicon-book"></span> Sintaxe</button>

                                        </div>

                                        <div class="panel-body">

                                            <textarea style="max-width:100%; height: 40em; max-height:40em;" required placeholder="Digite aqui seu código, você pode verificar a sintaxe clicando no botão sintaxe" id="codigo" name="codigo" class="form-control"><?php
                                                if (isset($codigoPortugol)) {
                                                    echo $codigoPortugol;
                                                } else {
                                                    echo "";
                                                }
                                                ?></textarea>

                                            </form>

                                        </div>

                                    </div><!--Fim do painel-->

                                </div>

                                <div id="codigoExecucao" class="col-sm-6 col-sm-offset-0">

                                    <div class="panel panel-info" title="Se nada aparecer aqui, verifique a sintaxe">

                                        <div class="panel-heading" style="text-align: center; height:6.7em;">
                                            <h4>Código em execução</h4>
                                        </div>

                                        <div id="codigoExecucao" style="min-height:42em;" class="panel-body" title="Se nada aparecer aqui, verifique a sintaxe">

                                            <script type="text/javascript" defer="defer"><?php
                                                if (isset($codigoTraduzido)) {

                                                    echo $codigoTraduzido;
                                                } else {

                                                    echo "";
                                                }
                                                ?></script>

                                        </div>

                                    </div>

                                </div>



                            </div>

                        </div>

                    </div>

                </div>

        </section>
        <!--Minhas verificações -->
        <script src="js/verificacoes.js"></script>
    </body>
</html>
