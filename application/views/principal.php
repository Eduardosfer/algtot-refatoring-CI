<?php

  require_once("../controle/Acesso.php");
  
      
    $modelo = new Modelo();
    $acesso = new Acesso();

    $acesso->acessar();

    $necessarioNivel1 = 1000;
    $necessarioNivel2 = 2000;
    $necessarioNivel3 = 3000;
    $necessarioNivel4 = 4000;   
  
    $select = "SELECT usuario.usuario,
    (SELECT COUNT(usuarioquestao.cdQuestao) 
    FROM usuarioquestao, questao, atividade 
    WHERE usuarioquestao.cdUsuario = ? AND 
    usuarioquestao.status = 'acertou' 
    AND usuarioquestao.cdQuestao = questao.cdQuestao 
    AND atividade.cdAtividade = questao.cdAtividade 
    AND atividade.nivel = 1) AS quantidadeAcertadaNivel1,

    (SELECT COUNT(usuarioquestao.cdQuestao) 
    FROM usuarioquestao, questao, atividade 
    WHERE usuarioquestao.cdUsuario = ? 
    AND usuarioquestao.status = 'acertou' 
    AND usuarioquestao.cdQuestao = questao.cdQuestao 
    AND atividade.cdAtividade = questao.cdAtividade 
    AND atividade.nivel = 2) AS quantidadeAcertadaNivel2,

    (SELECT COUNT(usuarioquestao.cdQuestao) 
    FROM usuarioquestao, questao, atividade 
    WHERE usuarioquestao.cdUsuario = ? 
    AND usuarioquestao.status = 'acertou' 
    AND usuarioquestao.cdQuestao = questao.cdQuestao 
    AND atividade.cdAtividade = questao.cdAtividade 
    AND atividade.nivel = 3) AS quantidadeAcertadaNivel3,

    (SELECT COUNT(usuarioquestao.cdQuestao) 
    FROM usuarioquestao, questao, atividade 
    WHERE usuarioquestao.cdUsuario = ? 
    AND usuarioquestao.status = 'acertou' 
    AND usuarioquestao.cdQuestao = questao.cdQuestao 
    AND atividade.cdAtividade = questao.cdAtividade 
    AND atividade.nivel = 4) AS quantidadeAcertadaNivel4,

    (SELECT COUNT(usuarioquestao.cdQuestao) 
    FROM usuarioquestao, questao, atividade 
    WHERE usuarioquestao.cdUsuario = ? 
    AND usuarioquestao.status = 'acertou' 
    AND usuarioquestao.cdQuestao = questao.cdQuestao 
    AND atividade.cdAtividade = questao.cdAtividade 
    AND atividade.nivel = 5) AS quantidadeAcertadaNivel5

    FROM usuario
    WHERE usuario.cdUsuario = ?";
  
    $select2 = "SELECT DISTINCT
    (SELECT COUNT(cdQuestao) 
    FROM questao, atividade 
    WHERE questao.cdAtividade = atividade.cdAtividade 
    AND questao.status = 'ativo' 
    AND atividade.status = 'ativo'
    AND atividade.nivel = ?) AS quantidadeNivel1,

    (SELECT COUNT(cdQuestao) 
    FROM questao, atividade 
    WHERE questao.cdAtividade = atividade.cdAtividade 
    AND questao.status = 'ativo' 
    AND atividade.status = 'ativo'
    AND atividade.nivel = ?) AS quantidadeNivel2,

    (SELECT COUNT(cdQuestao) 
    FROM questao, atividade 
    WHERE questao.cdAtividade = atividade.cdAtividade 
    AND questao.status = 'ativo' 
    AND atividade.status = 'ativo'
    AND atividade.nivel = ?) AS quantidadeNivel3,

    (SELECT COUNT(cdQuestao) 
    FROM questao, atividade 
    WHERE questao.cdAtividade = atividade.cdAtividade 
    AND questao.status = 'ativo' 
    AND atividade.status = 'ativo'
    AND atividade.nivel = ?) AS quantidadeNivel4,

    (SELECT COUNT(cdQuestao) 
    FROM questao, atividade 
    WHERE questao.cdAtividade = atividade.cdAtividade 
    AND questao.status = 'ativo' 
    AND atividade.status = 'ativo'
    AND atividade.nivel = ?) AS quantidadeNivel5

    FROM questao";
  
    $dados = array($_SESSION['cdUsuario'],$_SESSION['cdUsuario'],$_SESSION['cdUsuario'],$_SESSION['cdUsuario'],$_SESSION['cdUsuario'],$_SESSION['cdUsuario']);
    $totalRespondidas = $modelo->selecionar($select,$dados);        
    $totalNiveis = $modelo->selecionar($select2,array(1,2,3,4,5));    

    foreach ($totalRespondidas as $key => $total) {
        $respondido1 = $total['quantidadeAcertadaNivel1'];
        $respondido2 = $total['quantidadeAcertadaNivel2'];
        $respondido3 = $total['quantidadeAcertadaNivel3'];
        $respondido4 = $total['quantidadeAcertadaNivel4'];
        $respondido5 = $total['quantidadeAcertadaNivel5'];
    }
    
    foreach ($totalNiveis as $key => $total2) {
        $total1 = $total2['quantidadeNivel1'];
        $total2 = $total2['quantidadeNivel2'];
        $total3 = $total2['quantidadeNivel3'];
        $total4 = $total2['quantidadeNivel4'];
        $total5 = $total2['quantidadeNivel5'];
    }
    
    $porcentNecessa1 = 60;
    $porcentNecessa2 = 60;
    $porcentNecessa3 = 60;
    $porcentNecessa4 = 60;      
    $porcentNecessa5 = 60;
        
    function validarPorcentagem($quantiRespondida, $quantiTotal, $nivel) {    
        $porcentNecessa1 = 60;
        $porcentNecessa2 = 60;
        $porcentNecessa3 = 60;
        $porcentNecessa4 = 60;      
        $porcentNecessa5 = 60;      
        $retorno = false;
        $porcemRespon = 0;
        $porcemRespon = (($quantiRespondida * 100) / $quantiTotal);
        if ($nivel == 1) {
            if ($porcemRespon >= $porcentNecessa1) {
                $retorno = true;
            }
        }
        if ($nivel == 2) {
            if ($porcemRespon >= $porcentNecessa2) {
                $retorno = true;
            }
        }
        if ($nivel == 3) {
            if ($porcemRespon >= $porcentNecessa3) {
                $retorno = true;
            }
        }
        if ($nivel == 4) {
            if ($porcemRespon >= $porcentNecessa4) {
                $retorno = true;
            }
        }
        if ($nivel == 5) {
            if ($porcemRespon >= $porcentNecessa5) {
                $retorno = true;
            }
        }
        return $retorno;
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
	<link href="vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
	<script type="text/javascript" src="vendor/bootstrap/js/bootstrap.js"></script>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->

      <title>AlgtTot: Principal</title>

  </head>

  <!-- Bootstrap -->
  <body>

    <!-- MENU DO ALUNO -->
    <?php include_once("includs/menuAluno.php"); ?>

    <!--MODAL DE VISUALIZAÇÃO E EDIÇÃO DE DADOS-->
    <?php include_once("includs/modalVerEditarPerfil.php"); ?>

    <!--MODAL DE EXCLUIR PERFIL-->
    <?php include_once("includs/modalExcluirPerfil.php"); ?>

  	<section id="conteudo" class="container">

  		<br>
  		<br>
  		<br>

  		<div class="row">

  			<div id="niveis" class="col-sm-7">


  				<div class="panel panel-default">

  					<div class="panel-heading" title="Pontuando em cada nível você desbloqueiará os proximos" style="background-color: #4cae4c; color:white; text-align:center;">

  						<div >
  							<h3 class="blog-title">Escolha um dos níveis!</h3>
  						</div>

  					</div>

  					<div class="panel-body">

  						<br>

              <center>

          				<div id="centro" class="col">

          					<div class="btn-group-vertical" role="group">

          						<form name="niveis" action="atividades.php" method="post">

          							<button name="nivel" value="1" style="min-width: 120px; min-height: 100px;" type="submit" title="Clique para abrir o nível" class="btn btn-<?php echo ($_SESSION['nivel1'] < 0)?'danger':'success'; ?>" href="atividades.php">
                          Nível 1<br>
                          Pontuação<br>
                          <?php echo $_SESSION['nivel1']; ?> <span class='glyphicon glyphicon-star' aria-hidden='true'></span>
                        </button>
          							<br><br>

          							<button name="nivel" value="2" style="min-width: 120px; min-height: 100px;" type="submit" <?php if($_SESSION['nivel1']>=$necessarioNivel1 || validarPorcentagem($respondido1, $total1, 1)){ echo "title='Clique para abrir o nível'"; }else{ echo "title='Faça $necessarioNivel1 pontos no nível 1 ou acerte $porcentNecessa1% das questões'"." disabled "; } ?> class="btn btn-<?php echo ($_SESSION['nivel2'] < 0)?'danger':'success'; ?>">
                          Nível 2
                          <?php if($_SESSION['nivel1']>=$necessarioNivel1 || validarPorcentagem($respondido1, $total1, 1)){ echo "<br>Pontuação<br>".$_SESSION['nivel2']." <span class='glyphicon glyphicon-star' aria-hidden='true'></span>"; }else{ echo"<br>Necessário<br>$necessarioNivel1 <span class='glyphicon glyphicon-star' aria-hidden='true'></span><br>no nível 1"; } ?></button>
          							<br><br>

          							<button name="nivel" value="3" style="min-width: 120px; min-height: 100px;" type="submit" <?php if($_SESSION['nivel2']>=$necessarioNivel2 || validarPorcentagem($respondido2, $total2, 2)){ echo "title='Clique para abrir o nível'"; }else{ echo "title='Faça $necessarioNivel2 pontos no nível 2 ou acerte $porcentNecessa2% das questões'"." disabled "; } ?> class="btn btn-<?php echo ($_SESSION['nivel3'] < 0)?'danger':'success'; ?>">
                          Nível 3
                          <?php if($_SESSION['nivel2']>=$necessarioNivel2 || validarPorcentagem($respondido2, $total2, 2)){ echo "<br>Pontuação<br>".$_SESSION['nivel3']." <span class='glyphicon glyphicon-star' aria-hidden='true'></span>"; }else{ echo"<br>Necessário<br>$necessarioNivel2 <span class='glyphicon glyphicon-star' aria-hidden='true'></span><br>no nível 2"; } ?></button>
          							<br><br>

          							<button name="nivel" value="4" style="min-width: 120px; min-height: 100px;" type="submit" <?php if($_SESSION['nivel3']>=$necessarioNivel3 || validarPorcentagem($respondido3, $total3, 3)){ echo "title='Clique para abrir o nível'"; }else{ echo "title='Faça $necessarioNivel3 pontos no nível 3 ou acerte $porcentNecessa3% das questões'"." disabled "; } ?> class="btn btn-<?php echo ($_SESSION['nivel4'] < 0)?'danger':'success'; ?>">
                          Nível 4
                          <?php if($_SESSION['nivel3']>=$necessarioNivel3 || validarPorcentagem($respondido3, $total3, 3)){ echo "<br>Pontuação<br>".$_SESSION['nivel4']." <span class='glyphicon glyphicon-star' aria-hidden='true'></span>"; }else{ echo"<br>Necessário<br>$necessarioNivel3 <span class='glyphicon glyphicon-star' aria-hidden='true'></span><br>no nível 3"; } ?></button>
          							<br><br>

          							<button name="nivel" value="5" style="min-width: 120px; min-height: 100px;" type="submit" <?php if($_SESSION['nivel4']>=$necessarioNivel4 || validarPorcentagem($respondido4, $total4, 4)){ echo "title='Clique para abrir o nível'"; }else{ echo "title='Faça $necessarioNivel4 pontos no nível 4 ou acerte $porcentNecessa4% das questões'"." disabled "; } ?> class="btn btn-<?php echo ($_SESSION['nivel5'] < 0)?'danger':'success'; ?>">
                          Nível 5
                          <?php if($_SESSION['nivel4']>=$necessarioNivel4 || validarPorcentagem($respondido4, $total4, 4)){ echo "<br>Pontuação<br>".$_SESSION['nivel5']." <span class='glyphicon glyphicon-star' aria-hidden='true'></span>"; }else{ echo"<br>Necessário<br>$necessarioNivel4 <span class='glyphicon glyphicon-star' aria-hidden='true'></span><br>no nível 4"; } ?></button>
          							<br><br>

          						</form>

          					</div>

          				</div>

              </center>

  					</div>

  				</div><!--Fim do painel-->

  			</div>

  			<div id="ranking" class="col-sm-5 col-sm-offset-0">

          <div class="panel panel-default">

            <div class="panel-heading" style="background-color: #4cae4c; color:white; text-align:center;">
              <h3>Ranking</h3>
            </div>

            <div class="panel-body">

              <div id="usuarios">

                <ol class="list-unstyled">

                <?php

                   $select1 = "SELECT * FROM usuario WHERE status = ? AND cdGrupo = ? ORDER BY pontuacaoTotal DESC LIMIT 10";
                   $dados1 = array('ativo',3);

                   $select2 = "SELECT SUM(questao.pontuacao) AS pontosTotais FROM questao, atividade
                              WHERE atividade.cdAtividade = questao.cdAtividade AND questao.status = ? AND atividade.status = ?";
                   $dados2 = array('ativo','ativo');
                   $alunos = $modelo->selecionar($select1,$dados1);
                   $totalDePontos = $modelo->selecionar($select2,$dados2);

                   foreach ($totalDePontos as $key => $total) {
                     $pontosTotais = $total['pontosTotais'];
                   }

					if(($pontosTotais==null)||($pontosTotais==0)){
						$pontosTotais = 1;
					}

                   $contador = 1;

                   foreach ($alunos as $key => $usuario) {

                      $aluno = htmlspecialchars($usuario['usuario']);
                      $totalDePontosAluno = $usuario['pontuacaoTotal'];

                      $porcentagemAluno = ($totalDePontosAluno * 100) / $pontosTotais;

                      if ($porcentagemAluno>100) {
                          $porcentagemAluno = 100;
                      }

                      $porcentagemAluno = number_format($porcentagemAluno, 1, '.', '');

                ?>


                <p><?php echo $contador; ?>º <?php echo $aluno; ?>: <?php echo $totalDePontosAluno; ?> <span class="glyphicon glyphicon-star" aria-hidden="true"></span></p>
                  <li>
                    <div class="progress">
                      <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php echo $porcentagemAluno; ?>" aria-valuemin="0" aria-valuemax="100" style="min-width: 4%; width: <?php echo $porcentagemAluno; ?>%;"> <?php echo $porcentagemAluno; ?>%
                        <span class="sr-only"><?php echo $porcentagemAluno; ?>% Complete (warning)</span>
                      </div>
                    </div>
                  </li>

                  <?php

                      $contador++;

                  }

                  ?>


                  <?php if ($contador > 1) { ?>
                    <li><div class="alert alert-success" role="alert"><a href="ranking.php" class="alert-link">Ver Todos</a></div></li>
                 <?php } else { ?>
                    <li><div class="alert alert-warning" role="alert">Nenhum participante</div></li>
                 <?php } ?>

                </ol>

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
