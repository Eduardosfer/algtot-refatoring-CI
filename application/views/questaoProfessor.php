<?php

  require_once("../controle/Acesso.php");
  require_once("../controle/AlgTot.php");
  

  $acesso = new Acesso();
  $algTot = new AlgTot();
  $modelo = new Modelo();

  $acesso->acessar();

  if (!isset($_POST['cdAtividade'])) {
      $cdAtividade = null;
  }else {
      $cdAtividade = $_POST['cdAtividade'];
  }

  if (!isset($_POST['titulo'])) {
      $titulo = null;
  }else {
      $titulo = $_POST['titulo'];
  }

  $algTot->setAtividade($cdAtividade,$titulo);

  $cdAtividade = $_SESSION['cdAtividade'];
  $titulo = $_SESSION['titulo'];


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

    <title>AlgtTot: Questões Professor</title>

    </head>

    <!-- Bootstrap -->
    <body>

      <!-- MENU DO PROFESSOR -->
      <?php include_once("includs/menuProfessor.php"); ?>

      <!--MODAL DE VISUALIZAÇÃO E EDIÇÃO DE DADOS-->
      <?php include_once("includs/modalVerEditarPerfil.php"); ?>

      <!--MODAL DE EXCLUIR PERFIL-->
      <?php include_once("includs/modalExcluirPerfil.php"); ?>


      <div id="cadastrarQuestao1" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">

         <div class="modal-dialog" role="document">

            <div class="modal-content">

               <div class="modal-header" style="background-color: #4cae4c; color: white;" >
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="gridSystemModalLabel">Cadastro de Questão tipo 1</h4>
              </div>

              <form name="cadastrarQuestao1" action="../controle/AlgTot.php" method="post">

                <div class="modal-body">

                  <input type="hidden" name="cdAtividade" value="<?php echo $cdAtividade; ?>">
                  <input type="hidden" name="tipo" value="1">

                   <div class="input-group">
                    <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-question-sign"></span></span>
                    <input type="text" name="pergunta" maxlength="2000" class="form-control" required placeholder="Insira uma pergunta" title="Insira uma pergunta: Maximo 2000 caracteres" aria-describedby="sizing-addon2">
                  </div>

                  <br>

                  <div class="input-group">
                    <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-ok"></span></span>
                    <input type="text" name="alternativaCorreta" maxlength="2000" class="form-control" required placeholder="Insira a alternativa correta" title="Insira a alternativa correta da questão: Maximo 2000 caracteres" aria-describedby="sizing-addon2">
                  </div>

                   <br>

                  <div class="input-group">
                    <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-remove"></span></span>
                    <input type="text" name="alternativaIncorreta1" maxlength="2000" class="form-control" required placeholder="Insira uma alternativa incorreta" title="Insira uma alternativa incorreta da questão: Maximo 2000 caracteres" aria-describedby="sizing-addon2">
                  </div>

                   <br>

                  <div class="input-group">
                    <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-remove"></span></span>
                    <input type="text" name="alternativaIncorreta2" maxlength="2000" class="form-control" required placeholder="Insira uma alternativa incorreta" title="Insira uma alternativa incorreta da questão: Maximo 2000 caracteres" aria-describedby="sizing-addon2">
                  </div>

                  <br>

                  <div class="input-group">
                    <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-remove"></span></span>
                    <input type="text" name="alternativaIncorreta3" maxlength="2000" class="form-control" required placeholder="Insira uma alternativa incorreta" title="Insira uma alternativa incorreta da questão: Maximo 2000 caracteres" aria-describedby="sizing-addon2">
                  </div>

                  <br>

                  <div class="input-group">
                    <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-remove"></span></span>
                    <input type="text" name="alternativaIncorreta4" maxlength="2000" class="form-control" required placeholder="Insira uma alternativa incorreta" title="Insira uma alternativa incorreta da questão: Maximo 2000 caracteres" aria-describedby="sizing-addon2">
                  </div>

                  <br>

                  <div class="input-group">
                    <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-star"></span></span>
                    <input type="number" min="0" step="1" name="pontuacao" class="form-control" required placeholder="Insira a pontuação para a questão" title="Insira uma pontuação para a questão: Somente números naturais" aria-describedby="sizing-addon2">
                  </div>

                  <br>

                  <div class="input-group">
                    <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-time"></span></span>
                    <input type="number" min="0" step="1" name="tempoTotalQuestao" class="form-control" required placeholder="Tempo de resposta da questão em minutos ex: 1 ou 60 ou 100 ou etc..." title="Insira um tempo de resposta para a questão em minutos: Somente números naturais" aria-describedby="sizing-addon2">
                  </div>

                  <br>

                  <div class="input-group">
                    <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-thumbs-up"></span></span>
                    <input type="text" name="dica" maxlength="2000" class="form-control" placeholder="Insira uma dica para a questão" title="Insira uma dica para a questão: não obrigatório: Maximo 2000 caracteres" aria-describedby="sizing-addon2">
                  </div>

              </div>

              <div class="modal-footer">
               <button name="acao" type="submit" value="CadastrarQuestaoTipo1" class="btn btn-success"><span class="glyphicon glyphicon-save"></span> Cadastrar</button>
             </div>

            </form>

          </div>

        </div><!-- /.modal-content -->

      </div><!-- /.modal-dialog -->

      <div id="cadastrarQuestao2" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">

         <div class="modal-dialog" role="document">

            <div class="modal-content">

               <div class="modal-header" style="background-color: #4cae4c; color: white;" >
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="gridSystemModalLabel">Cadastro de Questão tipo 2</h4>
                <p>Escreva um pseudocódigo utilizando apenas uma ação por linha, utilize um ponto e virgula ";" ao final de cada ação. Ex: inicio; ler dois numeros; somar; mostrar;</p>
              </div>

              <form name="cadastrarQuestao2" action="../controle/AlgTot.php" method="post">

                <div class="modal-body">

                  <input type="hidden" name="cdAtividade" value="<?php echo $cdAtividade; ?>">
                  <input type="hidden" name="tipo" value="2">

                  <div class="input-group">
                   <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-question-sign"></span></span>
                   <input type="text" name="pergunta" maxlength="2000" class="form-control" required placeholder="Insira uma pergunta: servirá para dar um contexto" title="Insira uma pergunta: Essa pergunta serve para dar um contexto para a sequencia, já que sem um contexto a mesma sequencia pode ter infinitas possibilidades: Maximo 2000 caracteres" aria-describedby="sizing-addon2">
                 </div>
                 <br>

                   <textarea name="alternativaCorreta" class="form-control" style="height: 20em; max-width:100%; max-height:20em;" required placeholder="Insira um pseudocódigo" title="Insira um pseudocódigo separando as ações por ';'"></textarea>
                   <br>

                  <div class="input-group">
                    <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-star"></span></span>
                    <input type="number" min="0" step="1" name="pontuacao" class="form-control" required placeholder="Insira a pontuação para a questão" title="Insira uma pontuação para a questão: Somente números naturais" aria-describedby="sizing-addon2">
                  </div>

                  <br>

                  <div class="input-group">
                    <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-time"></span></span>
                    <input type="number" min="0" step="1" name="tempoTotalQuestao" class="form-control" required placeholder="Tempo de resposta da questão em minutos ex: 1 ou 60 ou 100 ou etc..." title="Insira um tempo de resposta para a questão em minutos: Somente números naturais" aria-describedby="sizing-addon2">
                  </div>

                  <br>

                  <div class="input-group">
                    <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-thumbs-up"></span></span>
                    <input type="text" name="dica" maxlength="2000" class="form-control" placeholder="Insira uma dica para a questão" title="Insira uma dica para a questão: não obrigatório: Maximo 2000 caracteres" aria-describedby="sizing-addon2">
                  </div>

              </div>

              <div class="modal-footer">
                <button name="acao" type="submit" value="CadastrarQuestaoTipo2" class="btn btn-success"><span class="glyphicon glyphicon-save"></span> Cadastrar</button>
             </div>

            </form>

          </div>

        </div><!-- /.modal-content -->

      </div><!-- /.modal-dialog -->

      <div id="cadastrarQuestao3" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">

         <div class="modal-dialog" role="document">

            <div class="modal-content">

               <div class="modal-header" style="background-color: #4cae4c; color: white;" >
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="gridSystemModalLabel">Cadastro de Questão tipo 3</h4>
                <p>Essa questão será respondida utilizadno o pseudo tradutor de Portugol, dessa forma utilize questões que sejam possiveis de se resolver utilizando o Portugol.</p>
              </div>

              <form name="cadastrarQuestao3" action="../controle/AlgTot.php" method="post">

                <div class="modal-body">

                  <input type="hidden" name="cdAtividade" value="<?php echo $cdAtividade; ?>">
                  <input type="hidden" name="tipo" value="3">

                   <div class="input-group">
                    <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-question-sign"></span></span>
                    <input type="text" name="pergunta" maxlength="2000" class="form-control" required placeholder="Insira uma pergunta" title="Insira uma pergunta: Maximo 2000 caracteres" aria-describedby="sizing-addon2">
                  </div>

                  <br>

                  <div class="input-group">
                    <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-ok"></span></span>
                    <input type="text" name="alternativaCorreta" maxlength="2000" class="form-control" required placeholder="Insira a alternativa correta" title="Insira a alternativa correta da questão: Maximo 2000 caracteres" aria-describedby="sizing-addon2">
                  </div>

                   <br>

                  <div class="input-group">
                    <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-remove"></span></span>
                    <input type="text" name="alternativaIncorreta1" maxlength="2000" class="form-control" required placeholder="Insira uma alternativa incorreta" title="Insira uma alternativa incorreta da questão: Maximo 2000 caracteres" aria-describedby="sizing-addon2">
                  </div>

                   <br>

                  <div class="input-group">
                    <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-remove"></span></span>
                    <input type="text" name="alternativaIncorreta2" maxlength="2000" class="form-control" required placeholder="Insira uma alternativa incorreta" title="Insira uma alternativa incorreta da questão: Maximo 2000 caracteres" aria-describedby="sizing-addon2">
                  </div>

                  <br>

                  <div class="input-group">
                    <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-remove"></span></span>
                    <input type="text" name="alternativaIncorreta3" maxlength="2000" class="form-control" required placeholder="Insira uma alternativa incorreta" title="Insira uma alternativa incorreta da questão: Maximo 2000 caracteres" aria-describedby="sizing-addon2">
                  </div>

                  <br>

                  <div class="input-group">
                    <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-remove"></span></span>
                    <input type="text" name="alternativaIncorreta4" maxlength="2000" class="form-control" required placeholder="Insira uma alternativa incorreta" title="Insira uma alternativa incorreta da questão: Maximo 2000 caracteres" aria-describedby="sizing-addon2">
                  </div>

                  <br>

                  <div class="input-group">
                    <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-star"></span></span>
                    <input type="number" min="0" step="1" name="pontuacao" class="form-control" required placeholder="Insira a pontuação para a questão" title="Insira uma pontuação para a questão: Somente números naturais" aria-describedby="sizing-addon2">
                  </div>

                  <br>

                  <div class="input-group">
                    <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-time"></span></span>
                    <input type="number" min="0" step="1" name="tempoTotalQuestao" class="form-control" required placeholder="Tempo de resposta da questão em minutos ex: 1 ou 60 ou 100 ou etc..." title="Insira um tempo de resposta para a questão em minutos: Somente números naturais" aria-describedby="sizing-addon2">
                  </div>

                  <br>

                  <div class="input-group">
                    <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-thumbs-up"></span></span>
                    <input type="text" name="dica" maxlength="2000" class="form-control" placeholder="Insira uma dica para a questão" title="Insira uma dica para a questão: não obrigatório: Maximo 2000 caracteres" aria-describedby="sizing-addon2">
                  </div>

              </div>

              <div class="modal-footer">
               <button name="acao" type="submit" value="CadastrarQuestaoTipo3" class="btn btn-success"><span class="glyphicon glyphicon-save"></span> Cadastrar</button>
             </div>

            </form>

          </div>

        </div><!-- /.modal-content -->

      </div><!-- /.modal-dialog -->


      <section id="conteudo" class="container">

        <br>
        <br>
        <br>

        <div class="row">

          <div id="niveis" class="col-sm-8">

          	<div class="panel panel-default">

          		<div class="panel-heading" style="background-color: #4cae4c; color:white">

          			<div class="blog-header" style="text-align: center;">
          				<h3 class="blog-title">Clique em qual tipo de questão deseja adicionar a esta atividade</h3>
          			</div>

                <div class="blog-header" style="text-align: center;">
                  <h3 class="blog-title">Atividade: <?php echo $titulo; ?></h3>
                </div>

                <form class="form-inline" role="search" action="" method="post">

                  <div class="form-group">
                    <div class="col">
                      <a title="Clique para adicionar uma nova questão de tipo 1" data-toggle="modal" data-target="#cadastrarQuestao1" type="button" class="btn btn-default">Questão tipo 1</a>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col">
                      <a title="Clique para adicionar uma nova questão de tipo 2" data-toggle="modal" data-target="#cadastrarQuestao2" type="button" class="btn btn-default">Questão tipo 2</a>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col">
                      <a title="Clique para adicionar uma nova questão de tipo 3" data-toggle="modal" data-target="#cadastrarQuestao3" type="button" class="btn btn-default">Questão tipo 3</a>
                    </div>
                  </div>
                    
                    <div class="form-group">
                    <div class="col">
                        <a title="Total de questões dessa atividade" class="btn btn-default"><span class="glyphicon glyphicon-scale"></span> Total: <span id="total_questoes_atividade" ></span></a>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col">
                      <a name="atividadesProfessor" href="atividadesProfessor.php" class="btn btn-default"><span class="glyphicon glyphicon-arrow-left"></span> Voltar</a>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col">
                      <a name="voltarInicio" href="principalProfessor.php" class="btn btn-default"><span class="glyphicon glyphicon-home"></span> Início</a>
                    </div>
                  </div>

              </form>

          		</div>

          		<div class="panel-body">

          			<br>

            			<div id="centro" class="col">

                    <?php

                      $numero = 1;

                      $select = "SELECT * FROM questao WHERE cdAtividade = ? AND status = ? ORDER BY cdQuestao DESC";
                      $dados = array($cdAtividade,'ativo');
                      $dados = $modelo->selecionar($select,$dados);
                      $countAlert = 0;
                      foreach ($dados as $key => $dado) {
                        $countAlert++;
                        $cdQuestao = $dado['cdQuestao'];
                        $pergunta = htmlspecialchars($dado['pergunta']);
                        $alternativaCorreta =  htmlspecialchars($dado['alternativaCorreta']);
                        $alternativaIncorreta1 = htmlspecialchars($dado['alternativaIncorreta1']);
                        $alternativaIncorreta2 = htmlspecialchars($dado['alternativaIncorreta2']);
                        $alternativaIncorreta3 = htmlspecialchars($dado['alternativaIncorreta3']);
                        $alternativaIncorreta4 = htmlspecialchars($dado['alternativaIncorreta4']);
                        $pontuacao = $dado['pontuacao'];
                        $tipo = $dado['tipo'];
                        $dica = htmlspecialchars($dado['dica']);
                        $dataCadastramento = $dado['dataCadastramento'];
                        $dataCadastramento = date("d/m/Y H:i", strtotime($dataCadastramento));
                        $dataCadastramento = preg_replace('/ /', ' as ', $dataCadastramento);
                        $status = htmlspecialchars($dado['status']);
                        $tempoTotalQuestao = $dado['tempoTotalQuestao'];

                      ?>
                                    
                      <?php if($tipo==1){ ?>

                      <div name="tipo1" class="panel panel-default" style="<?php if($tipo==1){ echo 'display:block;'; }else{ echo 'display:none;'; }?>">

                        <div class="panel-heading" style="background-color: #4cae4c; color:white">
                          <h3 class="panel-title">Questão: <?php if ($tipo==1) { echo $numero; } ?> Tipo: <?php if ($tipo==1) { echo $tipo; } ?></h3>
                        </div>

                        <form name="alterarQuestao1" action="../controle/AlgTot.php" method="post">

                        <div class="panel-body">

                            <input type="hidden" name="cdAtividade" value="<?php echo $cdAtividade; ?>">
                            <input type="hidden" name="tipo" value="1">
                            <input type="hidden" name="cdQuestao" value="<?php if ($tipo==1) { echo $cdQuestao; } ?>">

                             <div class="input-group">
                              <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-question-sign"></span></span>
                              <input type="text" value="<?php if ($tipo==1) { echo $pergunta; } ?>" id="pergunta<?php if ($tipo==1) { echo $cdQuestao; } ?>" name="pergunta" maxlength="2000" class="form-control" disabled required placeholder="Insira uma pergunta" title="Insira uma pergunta: Maximo 2000 caracteres" aria-describedby="sizing-addon2">
                              <span class="input-group-btn">
                              <button id="editarPergunta<?php if ($tipo==1) { echo $cdQuestao; } ?>" class="btn btn-default" title="Clique para editar" onclick="editarInput(document.getElementById('editarPergunta<?php if ($tipo==1) { echo $cdQuestao; } ?>'), document.getElementById('pergunta<?php if ($tipo==1) { echo $cdQuestao; } ?>'))" type="button"><span class="glyphicon glyphicon-edit"></span> Editar</button>
                            </span>
                            </div>

                            <br>

                            <div class="input-group">
                              <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-ok"></span></span>
                              <input type="text" value="<?php if ($tipo==1) { echo $alternativaCorreta; } ?>" id="alternativaCorreta<?php if ($tipo==1) { echo $cdQuestao; } ?>" name="alternativaCorreta" maxlength="2000" class="form-control" disabled required placeholder="Insira a alternativa correta" title="Insira a alternativa correta da questão: Maximo 2000 caracteres" aria-describedby="sizing-addon2">
                              <span class="input-group-btn">
                              <button id="editarAlternativaCorreta<?php if ($tipo==1) { echo $cdQuestao; } ?>" class="btn btn-default" title="Clique para editar" onclick="editarInput(document.getElementById('editarAlternativaCorreta<?php if ($tipo==1) { echo $cdQuestao; } ?>'), document.getElementById('alternativaCorreta<?php if ($tipo==1) { echo $cdQuestao; } ?>'))" type="button"><span class="glyphicon glyphicon-edit"></span> Editar</button>
                              </span>
                            </div>

                             <br>

                            <div class="input-group">
                              <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-remove"></span></span>
                              <input type="text" value="<?php if ($tipo==1) { echo $alternativaIncorreta1; } ?>" id="alternativaIncorreta1<?php if ($tipo==1) { echo $cdQuestao; } ?>" name="alternativaIncorreta1" maxlength="2000" class="form-control" disabled required placeholder="Insira uma alternativa incorreta" title="Insira uma alternativa incorreta da questão: Maximo 2000 caracteres" aria-describedby="sizing-addon2">
                              <span class="input-group-btn">
                              <button id="editarAlternativaIncorreta1<?php if ($tipo==1) { echo $cdQuestao; } ?>" class="btn btn-default" title="Clique para editar" onclick="editarInput(document.getElementById('editarAlternativaIncorreta1<?php if ($tipo==1) { echo $cdQuestao; } ?>'), document.getElementById('alternativaIncorreta1<?php if ($tipo==1) { echo $cdQuestao; } ?>'))" type="button"><span class="glyphicon glyphicon-edit"></span> Editar</button>
                              </span>
                            </div>

                             <br>

                            <div class="input-group">
                              <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-remove"></span></span>
                              <input type="text" value="<?php if ($tipo==1) { echo $alternativaIncorreta2; } ?>" id="alternativaIncorreta2<?php if ($tipo==1) { echo $cdQuestao; } ?>" name="alternativaIncorreta2" maxlength="2000" class="form-control" disabled required placeholder="Insira uma alternativa incorreta" title="Insira uma alternativa incorreta da questão: Maximo 2000 caracteres" aria-describedby="sizing-addon2">
                              <span class="input-group-btn">
                              <button id="editarAlternativaIncorreta2<?php if ($tipo==1) { echo $cdQuestao; } ?>" class="btn btn-default" title="Clique para editar" onclick="editarInput(document.getElementById('editarAlternativaIncorreta2<?php if ($tipo==1) { echo $cdQuestao; } ?>'), document.getElementById('alternativaIncorreta2<?php if ($tipo==1) { echo $cdQuestao; } ?>'))" type="button"><span class="glyphicon glyphicon-edit"></span> Editar</button>
                              </span>
                            </div>

                            <br>

                            <div class="input-group">
                              <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-remove"></span></span>
                              <input type="text" value="<?php if ($tipo==1) { echo $alternativaIncorreta3; } ?>" id="alternativaIncorreta3<?php if ($tipo==1) { echo $cdQuestao; } ?>" name="alternativaIncorreta3" maxlength="2000" class="form-control" disabled required placeholder="Insira uma alternativa incorreta" title="Insira uma alternativa incorreta da questão: Maximo 2000 caracteres" aria-describedby="sizing-addon2">
                              <span class="input-group-btn">
                              <button id="editarAlternativaIncorreta3<?php if ($tipo==1) { echo $cdQuestao; } ?>" class="btn btn-default" title="Clique para editar" onclick="editarInput(document.getElementById('editarAlternativaIncorreta3<?php if ($tipo==1) { echo $cdQuestao; } ?>'), document.getElementById('alternativaIncorreta3<?php if ($tipo==1) { echo $cdQuestao; } ?>'))" type="button"><span class="glyphicon glyphicon-edit"></span> Editar</button>
                              </span>
                            </div>

                            <br>

                            <div class="input-group">
                              <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-remove"></span></span>
                              <input type="text" value="<?php if ($tipo==1) { echo $alternativaIncorreta4; } ?>" id="alternativaIncorreta4<?php if ($tipo==1) { echo $cdQuestao; } ?>" name="alternativaIncorreta4" maxlength="2000" class="form-control" disabled required placeholder="Insira uma alternativa incorreta" title="Insira uma alternativa incorreta da questão: Maximo 2000 caracteres" aria-describedby="sizing-addon2">
                              <span class="input-group-btn">
                              <button id="editarAlternativaIncorreta4<?php if ($tipo==1) { echo $cdQuestao; } ?>" class="btn btn-default" title="Clique para editar" onclick="editarInput(document.getElementById('editarAlternativaIncorreta4<?php if ($tipo==1) { echo $cdQuestao; } ?>'), document.getElementById('alternativaIncorreta4<?php if ($tipo==1) { echo $cdQuestao; } ?>'))" type="button"><span class="glyphicon glyphicon-edit"></span> Editar</button>
                              </span>
                            </div>

                            <br>

                            <div class="input-group">
                              <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-star"></span></span>
                              <input type="number" min="0" value="<?php if ($tipo==1) { echo $pontuacao; } ?>" id="pontuacao<?php if ($tipo==1) { echo $cdQuestao; } ?>" step="1" name="pontuacao" class="form-control" disabled required placeholder="Insira a pontuação para a questão" title="Insira uma pontuação para a questão: Somente números naturais" aria-describedby="sizing-addon2">
                              <span class="input-group-btn">
                              <button id="editarPontuacao<?php if ($tipo==1) { echo $cdQuestao; } ?>" class="btn btn-default" title="Clique para editar" onclick="editarInput(document.getElementById('editarPontuacao<?php if ($tipo==1) { echo $cdQuestao; } ?>'), document.getElementById('pontuacao<?php if ($tipo==1) { echo $cdQuestao; } ?>'))" type="button"><span class="glyphicon glyphicon-edit"></span> Editar</button>
                              </span>
                            </div>

                            <br>

                            <div class="input-group">
                              <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-time"></span></span>
                              <input id="tempoTotalQuestao<?php if ($tipo==1) { echo $cdQuestao; } ?>" type="number" min="0" value="<?php if ($tipo==1) { echo $tempoTotalQuestao; } ?>" step="1" name="tempoTotalQuestao" class="form-control" required disabled placeholder="Tempo de resposta da questão em minutos ex: 1 ou 60 ou 100 ou etc..." title="Insira um tempo de resposta para a questão em minutos: Somente números naturais" aria-describedby="sizing-addon2">
                              <span class="input-group-btn">
                              <button id="editarTempoTotalQuestao<?php if ($tipo==1) { echo $cdQuestao; } ?>" class="btn btn-default" title="Clique para editar" onclick="editarInput(document.getElementById('editarTempoTotalQuestao<?php if ($tipo==1) { echo $cdQuestao; } ?>'), document.getElementById('tempoTotalQuestao<?php if ($tipo==1) { echo $cdQuestao; } ?>'))" type="button"><span class="glyphicon glyphicon-edit"></span> Editar</button>
                              </span>
                            </div>

                            <br>

                            <div class="input-group">
                              <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-thumbs-up"></span></span>
                              <input type="text" value="<?php if ($tipo==1) { echo $dica; } ?>" id="dica<?php if ($tipo==1) { echo $cdQuestao; } ?>" name="dica" disabled maxlength="2000" class="form-control" placeholder="Insira uma dica para a questão" title="Insira uma dica para a questão: não obrigatório: Maximo 2000 caracteres" aria-describedby="sizing-addon2">
                              <span class="input-group-btn">
                              <button id="editarDica<?php if ($tipo==1) { echo $cdQuestao; } ?>" class="btn btn-default" title="Clique para editar" onclick="editarInput(document.getElementById('editarDica<?php if ($tipo==1) { echo $cdQuestao; } ?>'), document.getElementById('dica<?php if ($tipo==1) { echo $cdQuestao; } ?>'))" type="button"><span class="glyphicon glyphicon-edit"></span> Editar</button>
                              </span>
                            </div>

                            <br>

                            <div class="input-group">
                              <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-calendar"></span></span>
                              <input type="text" value="<?php if ($tipo==1) { echo $dataCadastramento; } ?>" disabled maxlength="2000" class="form-control" title="Essa é a data de cadastrametoda questão" aria-describedby="sizing-addon2">
                            </div>

                        </div>

                        <div class="panel-footer">
                          <button type="button" class="btn btn-danger" title="Excluir questão" data-toggle="modal" data-target="#excluir<?php if ($tipo==1) { echo $cdQuestao; } ?>"><span class="glyphicon glyphicon-trash"></span> Excluir</button>
                          <button name="acao" title="Clique para alterar a questão" type="submit" value="AlterarQuestao" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span> Salvar</button>
                        </div>

                        </form>

                      </div>

                      <?php } ?>

                      <?php if($tipo==2){ ?>
                                    
                      <div name="tipo2" class="panel panel-default" style="<?php if($tipo==2){ echo 'display:block;'; }else{ echo 'display:none;'; }?>">

                        <div class="panel-heading" style="background-color: #4cae4c; color:white">
                          <h3 class="panel-title">Questão: <?php if ($tipo==2) { echo $numero; } ?> Tipo: <?php if ($tipo==2) { echo $tipo; } ?></h3>
                        </div>

                        <form name="alterarQuestao2" action="../controle/AlgTot.php" method="post">

                        <div class="panel-body">

                            <input type="hidden" name="cdAtividade" value="<?php echo $cdAtividade; ?>">
                            <input type="hidden" name="tipo" value="1">
                            <input type="hidden" name="cdQuestao" value="<?php if ($tipo==2) { echo $cdQuestao; } ?>">

                            <div class="input-group">
                             <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-question-sign"></span></span>
                             <input type="text" name="pergunta" value="<?php if ($tipo==2) { echo $pergunta; } ?>"  id="pergunta<?php if ($tipo==2) { echo $cdQuestao; } ?>" maxlength="2000" class="form-control" disabled required placeholder="Insira uma pergunta: servirá para dar um contexto" title="Insira uma pergunta: Essa pergunta serve para dar um contexto para a sequencia, já que sem um contexto a mesma sequencia pode ter infinitas possibilidades: Maximo 2000 caracteres" aria-describedby="sizing-addon2">
                               <span class="input-group-btn">
                               <button id="editarPergunta<?php if ($tipo==2) { echo $cdQuestao; } ?>" class="btn btn-default" title="Clique para editar" onclick="editarInput(document.getElementById('editarPergunta<?php if ($tipo==2) { echo $cdQuestao; } ?>'), document.getElementById('pergunta<?php if ($tipo==2) { echo $cdQuestao; } ?>'))" type="button"><span class="glyphicon glyphicon-edit"></span> Editar</button>
                               </span>
                           </div>
                           <br>

                           <textarea name="alternativaCorreta" id="alternativaCorreta<?php if ($tipo==2) { echo $cdQuestao; } ?>" class="form-control" style="height: 20em; max-width:100%; max-height:20em;" disabled required placeholder="Insira um pseudocódigo" title="Insira um pseudocódigo separando as ações por ';'"><?php if ($tipo==2) { echo $alternativaCorreta; } ?></textarea>
                            <span class="input-group-btn">
                            <button id="editarAlternativaCorreta<?php if ($tipo==2) { echo $cdQuestao; } ?>" class="btn btn-default" title="Clique para editar" onclick="editarInput(document.getElementById('editarAlternativaCorreta<?php if ($tipo==2) { echo $cdQuestao; } ?>'), document.getElementById('alternativaCorreta<?php if ($tipo==2) { echo $cdQuestao; } ?>'))" type="button"><span class="glyphicon glyphicon-edit"></span> Editar</button>
                            </span>

                            <br>

                            <div class="input-group">
                              <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-star"></span></span>
                              <input type="number" min="0" value="<?php if ($tipo==2) { echo $pontuacao; } ?>" id="pontuacao<?php if ($tipo==2) { echo $cdQuestao; } ?>" step="1" name="pontuacao" class="form-control" disabled required placeholder="Insira a pontuação para a questão" title="Insira uma pontuação para a questão: Somente números naturais" aria-describedby="sizing-addon2">
                              <span class="input-group-btn">
                              <button id="editarPontuacao<?php if ($tipo==2) { echo $cdQuestao; } ?>" class="btn btn-default" title="Clique para editar" onclick="editarInput(document.getElementById('editarPontuacao<?php if ($tipo==2) { echo $cdQuestao; } ?>'), document.getElementById('pontuacao<?php if ($tipo==2) { echo $cdQuestao; } ?>'))" type="button"><span class="glyphicon glyphicon-edit"></span> Editar</button>
                              </span>
                            </div>

                            <br>

                            <div class="input-group">
                              <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-time"></span></span>
                              <input id="tempoTotalQuestao<?php if ($tipo==2) { echo $cdQuestao; } ?>" type="number" min="0" value="<?php if ($tipo==2) { echo $tempoTotalQuestao; } ?>" step="1" name="tempoTotalQuestao" class="form-control" required disabled placeholder="Tempo de resposta da questão em minutos ex: 1 ou 60 ou 100 ou etc..." title="Insira um tempo de resposta para a questão em minutos: Somente números naturais" aria-describedby="sizing-addon2">
                              <span class="input-group-btn">
                              <button id="editarTempoTotalQuestao<?php if ($tipo==2) { echo $cdQuestao; } ?>" class="btn btn-default" title="Clique para editar" onclick="editarInput(document.getElementById('editarTempoTotalQuestao<?php if ($tipo==2) { echo $cdQuestao; } ?>'), document.getElementById('tempoTotalQuestao<?php if ($tipo==2) { echo $cdQuestao; } ?>'))" type="button"><span class="glyphicon glyphicon-edit"></span> Editar</button>
                              </span>
                            </div>

                            <br>

                            <div class="input-group">
                              <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-thumbs-up"></span></span>
                              <input type="text" value="<?php if ($tipo==2) { echo $dica; } ?>" id="dica<?php if ($tipo==2) { echo $cdQuestao; } ?>" name="dica" disabled maxlength="2000" class="form-control" placeholder="Insira uma dica para a questão" title="Insira uma dica para a questão: não obrigatório: Maximo 2000 caracteres" aria-describedby="sizing-addon2">
                              <span class="input-group-btn">
                              <button id="editarDica<?php if ($tipo==2) { echo $cdQuestao; } ?>" class="btn btn-default" title="Clique para editar" onclick="editarInput(document.getElementById('editarDica<?php if ($tipo==2) { echo $cdQuestao; } ?>'), document.getElementById('dica<?php if ($tipo==2) { echo $cdQuestao; } ?>'))" type="button"><span class="glyphicon glyphicon-edit"></span> Editar</button>
                              </span>
                            </div>

                            <br>

                            <div class="input-group">
                              <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-calendar"></span></span>
                              <input type="text" value="<?php if ($tipo==2) { echo $dataCadastramento; } ?>" disabled class="form-control" title="Essa é a data de cadastrametoda questão" aria-describedby="sizing-addon2">
                            </div>

                        </div>

                        <div class="panel-footer">
                          <button type="button" class="btn btn-danger" title="Excluir questão" data-toggle="modal" data-target="#excluir<?php if ($tipo==2) { echo $cdQuestao; } ?>"><span class="glyphicon glyphicon-trash"></span> Excluir</button>
                          <button name="acao" title="Clique para alterar a questão" type="submit" value="AlterarQuestao" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span> Salvar</button>
                        </div>

                        </form>

                      </div>

                      <?php } ?>
                                    
                      <?php if($tipo==3){ ?>
                                    
                      <div name="tipo3" class="panel panel-default" style="<?php if($tipo==3){ echo 'display:block;'; }else{ echo 'display:none;'; }?>">

                        <div class="panel-heading" style="background-color: #4cae4c; color:white">
                          <h3 class="panel-title">Questão: <?php if ($tipo==3) { echo $numero; } ?> Tipo: <?php if ($tipo==3) { echo $tipo; } ?></h3>
                        </div>

                        <form name="alterarQuestao3" action="../controle/AlgTot.php" method="post">

                        <div class="panel-body">

                            <input type="hidden" name="cdAtividade" value="<?php echo $cdAtividade; ?>">
                            <input type="hidden" name="tipo" value="1">
                            <input type="hidden" name="cdQuestao" value="<?php if ($tipo==3) { echo $cdQuestao; } ?>">

                             <div class="input-group">
                              <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-question-sign"></span></span>
                              <input type="text" value="<?php if ($tipo==3) { echo $pergunta; } ?>" id="pergunta<?php if ($tipo==3) { echo $cdQuestao; } ?>" name="pergunta" maxlength="2000" class="form-control" disabled required placeholder="Insira uma pergunta" title="Insira uma pergunta: Maximo 2000 caracteres" aria-describedby="sizing-addon2">
                              <span class="input-group-btn">
                              <button id="editarPergunta<?php if ($tipo==3) { echo $cdQuestao; } ?>" class="btn btn-default" title="Clique para editar" onclick="editarInput(document.getElementById('editarPergunta<?php if ($tipo==3) { echo $cdQuestao; } ?>'), document.getElementById('pergunta<?php if ($tipo==3) { echo $cdQuestao; } ?>'))" type="button"><span class="glyphicon glyphicon-edit"></span> Editar</button>
                            </span>
                            </div>

                            <br>

                            <div class="input-group">
                              <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-ok"></span></span>
                              <input type="text" value="<?php if ($tipo==3) { echo $alternativaCorreta; } ?>" id="alternativaCorreta<?php if ($tipo==3) { echo $cdQuestao; } ?>" name="alternativaCorreta" maxlength="2000" class="form-control" disabled required placeholder="Insira a alternativa correta" title="Insira a alternativa correta da questão: Maximo 2000 caracteres" aria-describedby="sizing-addon2">
                              <span class="input-group-btn">
                              <button id="editarAlternativaCorreta<?php if ($tipo==3) { echo $cdQuestao; } ?>" class="btn btn-default" title="Clique para editar" onclick="editarInput(document.getElementById('editarAlternativaCorreta<?php if ($tipo==3) { echo $cdQuestao; } ?>'), document.getElementById('alternativaCorreta<?php if ($tipo==3) { echo $cdQuestao; } ?>'))" type="button"><span class="glyphicon glyphicon-edit"></span> Editar</button>
                              </span>
                            </div>

                             <br>

                            <div class="input-group">
                              <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-remove"></span></span>
                              <input type="text" value="<?php if ($tipo==3) { echo $alternativaIncorreta1; } ?>" id="alternativaIncorreta1<?php if ($tipo==3) { echo $cdQuestao; } ?>" name="alternativaIncorreta1" maxlength="2000" class="form-control" disabled required placeholder="Insira uma alternativa incorreta" title="Insira uma alternativa incorreta da questão: Maximo 2000 caracteres" aria-describedby="sizing-addon2">
                              <span class="input-group-btn">
                              <button id="editarAlternativaIncorreta1<?php if ($tipo==3) { echo $cdQuestao; } ?>" class="btn btn-default" title="Clique para editar" onclick="editarInput(document.getElementById('editarAlternativaIncorreta1<?php if ($tipo==3) { echo $cdQuestao; } ?>'), document.getElementById('alternativaIncorreta1<?php if ($tipo==3) { echo $cdQuestao; } ?>'))" type="button"><span class="glyphicon glyphicon-edit"></span> Editar</button>
                              </span>
                            </div>

                             <br>

                            <div class="input-group">
                              <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-remove"></span></span>
                              <input type="text" value="<?php if ($tipo==3) { echo $alternativaIncorreta2; } ?>" id="alternativaIncorreta2<?php if ($tipo==3) { echo $cdQuestao; } ?>" name="alternativaIncorreta2" maxlength="2000" class="form-control" disabled required placeholder="Insira uma alternativa incorreta" title="Insira uma alternativa incorreta da questão: Maximo 2000 caracteres" aria-describedby="sizing-addon2">
                              <span class="input-group-btn">
                              <button id="editarAlternativaIncorreta2<?php if ($tipo==3) { echo $cdQuestao; } ?>" class="btn btn-default" title="Clique para editar" onclick="editarInput(document.getElementById('editarAlternativaIncorreta2<?php if ($tipo==3) { echo $cdQuestao; } ?>'), document.getElementById('alternativaIncorreta2<?php if ($tipo==3) { echo $cdQuestao; } ?>'))" type="button"><span class="glyphicon glyphicon-edit"></span> Editar</button>
                              </span>
                            </div>

                            <br>

                            <div class="input-group">
                              <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-remove"></span></span>
                              <input type="text" value="<?php if ($tipo==3) { echo $alternativaIncorreta3; } ?>" id="alternativaIncorreta3<?php if ($tipo==3) { echo $cdQuestao; } ?>" name="alternativaIncorreta3" maxlength="2000" class="form-control" disabled required placeholder="Insira uma alternativa incorreta" title="Insira uma alternativa incorreta da questão: Maximo 2000 caracteres" aria-describedby="sizing-addon2">
                              <span class="input-group-btn">
                              <button id="editarAlternativaIncorreta3<?php if ($tipo==3) { echo $cdQuestao; } ?>" class="btn btn-default" title="Clique para editar" onclick="editarInput(document.getElementById('editarAlternativaIncorreta3<?php if ($tipo==3) { echo $cdQuestao; } ?>'), document.getElementById('alternativaIncorreta3<?php if ($tipo==3) { echo $cdQuestao; } ?>'))" type="button"><span class="glyphicon glyphicon-edit"></span> Editar</button>
                              </span>
                            </div>

                            <br>

                            <div class="input-group">
                              <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-remove"></span></span>
                              <input type="text" value="<?php if ($tipo==3) { echo $alternativaIncorreta4; } ?>" id="alternativaIncorreta4<?php if ($tipo==3) { echo $cdQuestao; } ?>" name="alternativaIncorreta4" maxlength="2000" class="form-control" disabled required placeholder="Insira uma alternativa incorreta" title="Insira uma alternativa incorreta da questão: Maximo 2000 caracteres" aria-describedby="sizing-addon2">
                              <span class="input-group-btn">
                              <button id="editarAlternativaIncorreta4<?php if ($tipo==3) { echo $cdQuestao; } ?>" class="btn btn-default" title="Clique para editar" onclick="editarInput(document.getElementById('editarAlternativaIncorreta4<?php if ($tipo==3) { echo $cdQuestao; } ?>'), document.getElementById('alternativaIncorreta4<?php if ($tipo==3) { echo $cdQuestao; } ?>'))" type="button"><span class="glyphicon glyphicon-edit"></span> Editar</button>
                              </span>
                            </div>

                            <br>

                            <div class="input-group">
                              <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-star"></span></span>
                              <input type="number" min="0" value="<?php if ($tipo==3) { echo $pontuacao; } ?>" id="pontuacao<?php if ($tipo==3) { echo $cdQuestao; } ?>" step="1" name="pontuacao" class="form-control" disabled required placeholder="Insira a pontuação para a questão" title="Insira uma pontuação para a questão: Somente números naturais" aria-describedby="sizing-addon2">
                              <span class="input-group-btn">
                              <button id="editarPontuacao<?php if ($tipo==3) { echo $cdQuestao; } ?>" class="btn btn-default" title="Clique para editar" onclick="editarInput(document.getElementById('editarPontuacao<?php if ($tipo==3) { echo $cdQuestao; } ?>'), document.getElementById('pontuacao<?php if ($tipo==3) { echo $cdQuestao; } ?>'))" type="button"><span class="glyphicon glyphicon-edit"></span> Editar</button>
                              </span>
                            </div>

                            <br>

                            <div class="input-group">
                              <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-time"></span></span>
                              <input id="tempoTotalQuestao<?php if ($tipo==3) { echo $cdQuestao; } ?>" type="number" min="0" value="<?php if ($tipo==3) { echo $tempoTotalQuestao; } ?>" step="1" name="tempoTotalQuestao" class="form-control" required disabled placeholder="Tempo de resposta da questão em minutos ex: 1 ou 60 ou 100 ou etc..." title="Insira um tempo de resposta para a questão em minutos: Somente números naturais" aria-describedby="sizing-addon2">
                              <span class="input-group-btn">
                              <button id="editarTempoTotalQuestao<?php if ($tipo==3) { echo $cdQuestao; } ?>" class="btn btn-default" title="Clique para editar" onclick="editarInput(document.getElementById('editarTempoTotalQuestao<?php if ($tipo==3) { echo $cdQuestao; } ?>'), document.getElementById('tempoTotalQuestao<?php if ($tipo==3) { echo $cdQuestao; } ?>'))" type="button"><span class="glyphicon glyphicon-edit"></span> Editar</button>
                              </span>
                            </div>

                            <br>

                            <div class="input-group">
                              <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-thumbs-up"></span></span>
                              <input type="text" value="<?php if ($tipo==3) { echo $dica; } ?>" id="dica<?php if ($tipo==3) { echo $cdQuestao; } ?>" name="dica" disabled maxlength="2000" class="form-control" placeholder="Insira uma dica para a questão" title="Insira uma dica para a questão: não obrigatório: Maximo 2000 caracteres" aria-describedby="sizing-addon2">
                              <span class="input-group-btn">
                              <button id="editarDica<?php if ($tipo==3) { echo $cdQuestao; } ?>" class="btn btn-default" title="Clique para editar" onclick="editarInput(document.getElementById('editarDica<?php if ($tipo==3) { echo $cdQuestao; } ?>'), document.getElementById('dica<?php if ($tipo==3) { echo $cdQuestao; } ?>'))" type="button"><span class="glyphicon glyphicon-edit"></span> Editar</button>
                              </span>
                            </div>

                            <br>

                            <div class="input-group">
                              <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-calendar"></span></span>
                              <input type="text" value="<?php if ($tipo==3) { echo $dataCadastramento; } ?>" disabled class="form-control" title="Essa é a data de cadastrametoda questão" aria-describedby="sizing-addon2">
                            </div>

                        </div>

                        <div class="panel-footer">
                          <button type="button" class="btn btn-danger" title="Excluir questão" data-toggle="modal" data-target="#excluir<?php if ($tipo==3) { echo $cdQuestao; } ?>"><span class="glyphicon glyphicon-trash"></span> Excluir</button>
                          <button name="acao" title="Clique para alterar a questão" type="submit" value="AlterarQuestao" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span> Salvar</button>
                        </div>

                        </form>

                      </div>

                      <?php } ?>

                      <!--MODAL EXCLUIR-->
                      <div id="excluir<?php  echo $cdQuestao; ?>" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="gridSystemModalLabel">
                      <div class="modal-dialog" role="document">
                        <form class="form-horizontal" action="../controle/AlgTot.php" method="post">
                            <div class="modal-content">

                              <div class="modal-header" style="background-color: #d43f3a; color: white">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Fexar"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="gridSystemModalLabel">Deseja realmente excuir esta Questão ?</h4>
                              </div>

                             <div class="modal-body">

                               <input type="hidden" name="cdQuestao" value="<?php echo $cdQuestao;?>">

                               <p>Se excluir esta questão, ela não estara mais disponievel para os alunos responderem.</p>

                              </div>

                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Não</button>
                                <button type="submit" value="ExcluirQuestao" name="acao" class="btn btn-danger"><span class="glyphicon glyphicon-ok"></span> Sim</button>
                              </div>

                            </div><!-- /.modal-content -->
                          </form>
                      </div><!-- /.modal-dialog -->
                    </div><!-- /.modal FIM DO MODAL EXCLUIR-->

              <?php $numero++; } ?>

                                <?php if ($countAlert == 0) { ?>
                                    <div class="alert alert-warning" role="alert">Nenhuma questão foi cadastrada para essa atividade</div>
                                <?php } ?>  
            			</div>

          		</div>

            </div>

          </div>

          <div id="informacoes" class="col-sm-4">

            <div id="informacoes1">

            	<div class="panel panel-default">

            		<div class="panel-heading" style="background-color: #4cae4c; color:white; text-align:center;">

            				<h4>Informações do nível 1</h4>

            		</div>

            		<div class="panel-body" style="text-align: justify;">
            				<p>
                      Não coloque pontuações muito altas nas questões, lembre-se de que para desbloquear o nível 2 basta 1000 pontos no nível 1.<br><br>O nível 1 deverá possuir atividades com conceitos básicos de lógica de programação e faz uma breve introdução a algoritmos. Neste nível podem ser cadastradas questões para o aprendizado na declaração de variáveis e para a utilização da função excreva do Portugol.
                    </p>
            		</div>

            	</div>

            </div>

            <div id="informacoes2">

              <div class="panel panel-default">

                <div class="panel-heading" style="background-color: #4cae4c; color:white; text-align:center;">

                    <h4>Informações do nível 2</h4>

                </div>

                <div class="panel-body" style="text-align: justify;">
                    <p>
                      Não coloque pontuações muito altas nas questões, lembre-se de que para desbloquear o nível 3 basta 2000 pontos no nível 2.<br><br>O nível 2 deverá possuir atividades de lógica para reforçar os conceitos aprendidos anteriormente, além de trabalhar com as funções de leitura e escrita do Portugol.
                    </p>
                </div>

              </div>

            </div>

            <div id="informacoes3">

              <div class="panel panel-default">

                <div class="panel-heading" style="background-color: #4cae4c; color:white; text-align:center;">

                    <h4>Informações do nível 3</h4>

                </div>

                <div class="panel-body" style="text-align: justify;">
                    <p>Não coloque pontuações muito altas nas questões, lembre-se de que para desbloquear o nível 4 basta 3000 pontos no nível 3.<br><br>O nível 3 deverá possuir atividades com a aplicação das operações matemáticas de soma, multiplicação, subtração e divisão.</p>
                </div>

              </div>

            </div>

            <div id="informacoes4">

              <div class="panel panel-default">

                <div class="panel-heading" style="background-color: #4cae4c; color:white; text-align:center;">

                    <h4>Informações do nível 4</h4>

                </div>

                <div class="panel-body" style="text-align: justify;">
                    <p>Não coloque pontuações muito altas nas questões, lembre-se de que para desbloquear o nível 5 basta 4000 pontos no nível 4.<br><br>O nível 4 deverá ter atividades utilizando as estruturas de controle como o “se” e o “senao” do Portugol.</p>
                </div>

              </div>

            </div>

            <div id="informacoes5">

              <div class="panel panel-default">

                <div class="panel-heading" style="background-color: #4cae4c; color:white; text-align:center;">

                    <h4>Informações do nível 5</h4>

                </div>

                <div class="panel-body" style="text-align: justify;">
                    <p>
                      O nível 5 deverá possuir atividades mais complexas de lógica e trabalhará com questões utilizando as estruturas de repetição como o “repita” e o “para” e revisará as estruturas de controle anteriormente estudadas.
                    </p>
                </div>

              </div>

            </div>

          </div>

        </div>

      </section>

      <!--Minhas verificações -->
      <script src="js/verificacoes.js"></script>
      
      <script>
          var totalQuestoes = '<?php echo $countAlert; ?>';
          $(document).ready( function () {
             $('#total_questoes_atividade').html(totalQuestoes); 
          });          
      </script>

    </body>
</html>
