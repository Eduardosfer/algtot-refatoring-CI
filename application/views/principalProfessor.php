<?php

  require_once("../controle/Acesso.php");
  

  $modelo = new Modelo();
  $acesso = new Acesso();

  $acesso->acessar();

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

      <title>AlgtTot: Principal Professor</title>

  </head>

  <!-- Bootstrap -->
  <body>

    <!-- MENU DO PROFESSOR -->
    <?php include_once("includs/menuProfessor.php"); ?>

    <!--MODAL DE VISUALIZAÇÃO E EDIÇÃO DE DADOS-->
    <?php include_once("includs/modalVerEditarPerfil.php"); ?>

    <!--MODAL DE EXCLUIR PERFIL-->
    <?php include_once("includs/modalExcluirPerfil.php"); ?>

    <section id="conteudo" class="container">

      <br>
      <br>
      <br>

      <div class="row">

        <div id="gestao" class="col-sm-7">


          <div class="panel panel-default">

            <div class="panel-heading" style="background-color:#4cae4c;color:white;">

              <div style="text-align: center;">
                <h3 class="blog-title">Início</h3>
              </div>

            </div>

            <div class="panel-body">

              <br>

              <div id="centro" class="col">

				<center>

					<div class="btn-group-vertical" role="group">

						<a title="Clique para gerenciar as atividades" class="btn btn-success" href="atividadesProfessor.php">Gerenciar Atividades</a>

					</div>

				</center>

			</div>

            </div>

          </div><!--Fim do painel-->

        </div>

        <div id="ranking" class="col-sm-5 col-sm-offset-0">

          <div class="panel panel-default">

            <div class="panel-heading" style="background-color:#4cae4c;color:white;text-align:center;">
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
                  <li><div class="alert alert-success" role="alert"><a href="rankingProfessor.php" class="alert-link">Ver Todos</a></div></li>
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
