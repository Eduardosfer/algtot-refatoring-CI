<?php
require_once("../controle/Acesso.php");


$acesso = new Acesso();
$modelo = new Modelo();

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

        <title>AlgtTot: Atividades ADM</title>

    </head>

    <!-- Bootstrap -->
    <body>

        <!-- MENU DO ADM -->
        <?php include_once ("includs/menuADM.php"); ?>

        <!--MODAL DE VISUALIZAÇÃO E EDIÇÃO DE DADOS-->
        <?php include_once("includs/modalVerEditarPerfil.php"); ?>

        <!--MODAL DE EXCLUIR PERFIL-->
        <?php include_once("includs/modalExcluirPerfil.php"); ?>

        <!--Modal de cadastrar atividade-->
        <div id="cadastrarAtividade" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">

            <div class="modal-dialog" role="document">

                <div class="modal-content">

                    <div class="modal-header" style="background-color: #4cae4c; color: white;">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="modal-title" id="gridSystemModalLabel">Cadastrar Atividade</h4>
                    </div>

                    <form name="cadastrarAtividade" action="../controle/AlgTot.php" method="post">

                        <div class="modal-body">

                            <div class="input-group">
                                <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-text-width"></span></span>
                                <input name="titulo" type="text" minlength="3" maxlength="200" class="form-control" required placeholder="Titulo da Atividade"  title="Insira o titulo da atividade: Maximo 200 caracteres" aria-describedby="sizing-addon2">
                            </div>

                            <br>

                            <div class="input-group">

                                <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-signal"></span></span>
                                <select required name="nivel" class="form-control" title="Selecione um nivel para a atividade">

                                    <option value="" selected>Selecione um nível</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>

                                </select>

                            </div>
                            
                            <br>
                            
                            <div class="input-group">
                                <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-sort"></span></span>
                                <select required name="status" class="form-control" title="Selecione o status da atividade: Ativo, aparece para os alunos. Inativo, não aparece.">                                    
                                    <option value="inativo">Inativo</option>
                                    <option value="ativo">Ativo</option>
                                </select>                               
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button name="acao" id="acaoCadastro" type="submit" value="CadastrarAtividade" class="btn btn-success"><span class="glyphicon glyphicon-save" aria-hidden="true"></span> Cadastrar</button>
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

                <div id="atividades" class="col-sm-8">

                    <div class="panel panel-default">

                        <div class="panel-heading" style="background-color: #4cae4c; color:white">

                            <div style="text-align: center;">
                                <h3 class="blog-title">Atividades</h3>
                            </div>

                            <form class="form-inline" role="search" action="atividadesADM.php" method="post">
                                
                                <div class="form-group">
                                    <a href="#" data-toggle="modal" data-target="#cadastrarAtividade" class="btn btn-default"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Cadastrar Atividade</a>                  
                                </div>
                                <?php
                                if (!isset($_POST['parametro'])) {

                                    $_POST['parametro'] = null;
                                }

                                if (!isset($_POST['buscarPor'])) {

                                    $_POST['buscarPor'] = null;
                                }
                                ?>

                                <div class="form-group">
                                    <select required id="buscarPor" title="Selecione pelo que gostaria de buscar" name="buscarPor" class="form-control buscar_por_select">

                                        <option value="" <?php
                                        if (($_POST['buscarPor'] == null) && (isset($_POST['buscarPor']))) {
                                            echo "selected";
                                        }
                                        ?> >Buscar por</option>
                                        <option value="atividade.titulo" <?php
                                        if (($_POST['buscarPor'] == 'atividade.titulo') && (isset($_POST['buscarPor']))) {
                                            echo "selected";
                                        }
                                        ?> >Título</option>

                                        <option value="atividade.nivel" <?php
                                        if (($_POST['buscarPor'] == 'atividade.nivel') && (isset($_POST['buscarPor']))) {
                                            echo "selected";
                                        }
                                        ?> >Nível</option>

                                        <option value="atividade.status" <?php
                                        if (($_POST['buscarPor'] == 'atividade.status') && (isset($_POST['buscarPor']))) {
                                            echo "selected";
                                        }
                                        ?> >Status</option>

                                        <option value="atividade.dataCadastramento" <?php
                                        if (($_POST['buscarPor'] == 'atividade.dataCadastramento') && (isset($_POST['buscarPor']))) {
                                            echo "selected";
                                        }
                                        ?> >Data</option>

                                    </select>
                                </div>

                                <div class="form-group">
                                    <input required type="text" class="form-control parametro_da_busca" <?php
                                    if (isset($_POST['parametro'])) {
                                        echo "value=" . "'" . $_POST['parametro'] . "'";
                                    }
                                    ?> placeholder="Busca" style="width:180px;" name="parametro" title="Digite aqui sua busca">                  
                                </div>
                                
                                <div class="form-group">
                                    <button type="submit" name="buscar" value="Buscar" class="btn btn-default"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Buscar</button>                                                      
                                </div>

                                <div class="form-group">
                                    <a name="voltarInicio" style="width:100px;" href="principalADM.php" class="btn btn-default"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Início</a>                                                      
                                </div>
                                
                                <div class="form-group">                                    
                                    <a name="atividadesADM" href="atividadesADM.php" class="btn btn-default"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> Atividades</a>                                                      
                                </div>
                            
                            </form>

                        </div>
                        
                        <div class="panel-body table-responsive">

                            <table class="table table-bordered">

                                <thead>
                                    <th><span class="glyphicon glyphicon-sort-by-attributes"></span></th>
                                    <th>Titulo</th>
                                    <th>Nível</th>
                                    <th>Data/Hora cadastro</th>
                                    <th>Status</th>
                                    <th>Ações</th>
                                </thead>

                                <tbody>

                                    <?php
                                    //pegando numero de linhas
                                    if (($_POST['buscarPor'] != null) && ($_POST['parametro'] != null)) {

                                        $campo = $_POST['buscarPor'];
                                        $parametro = $_POST['parametro'];
                                        
                                        if ($campo == 'atividade.dataCadastramento') {                                            
                                            $novaData = explode('/', $parametro);                                                                                       
                                            $parametro = $novaData[2].'-'.$novaData[1].'-'.$novaData[0];                                                                                         
                                        }

                                        $select = "SELECT count(atividade.cdAtividade) AS numLinhas FROM atividade
                                      LEFT JOIN questao ON questao.cdAtividade = atividade.cdAtividade AND (questao.status = ? OR questao.status is null)
                                      WHERE atividade.status != ?
                                      AND $campo LIKE ?";
                                        $dados = array('ativo', 'deletado', '%' . $parametro . '%');
                                    } else {

                                        $select = "SELECT count(atividade.cdAtividade) AS numLinhas FROM atividade WHERE status != ?";
                                        $dados = array('deletado');
                                    }

                                    $numLinhas = $modelo->selecionar($select, $dados);

                                    foreach ($numLinhas as $key => $value) {
                                        $totalLinhas = $value['numLinhas'];
                                    }

                                    $ultimaPagina = $totalLinhas / 20;

                                    //Arredondado o valor de ultima pagina para o proximo numero intero
                                    $ultimaPagina = ceil($ultimaPagina);

                                    //Não pode existir pagina 0 mas quando não existem resoltados na busca essa se torna 0, isso ocasiona erro na consulta, por isso deve ser substituido po 1 que é o minimo permitido.
                                    if ($ultimaPagina == 0) {

                                        $ultimaPagina = 1;
                                    }

                                    if (!isset($_POST['paginar'])) {

                                        //configuração padrão
                                        $_POST['pagina'] = 1;
                                        $_POST['offset'] = 0;
                                        $pagina = $_POST['pagina'];
                                        $offset = $_POST['offset'];
                                    } else {

                                        //configuração padrão pegando a pagina atual
                                        $pagina = $_POST['pagina'];
                                        $offset = $_POST['offset'];

                                        if (($_POST['paginar'] == 'anterior') && ($pagina >= 2)) {

                                            $pagina = $pagina - 1;
                                            $offset = $offset - 20;
                                        }

                                        if (($_POST['paginar'] == 'proxima') && ($pagina >= 1) && ($pagina < $ultimaPagina)) {

                                            $pagina = $pagina + 1;
                                            $offset = $offset + 20;
                                        }

                                        if ($_POST['paginar'] == 'primeira') {

                                            $pagina = 1;
                                            $offset = 0;
                                        }

                                        if ($_POST['paginar'] == 'ultima') {

                                            $pagina = $ultimaPagina;

                                            //É necessario subtrair -1 pois o offset inicia-se em 0 e a numeracao das paginas em 1
                                            $offset = ($ultimaPagina - 1) * 20;
                                        }
                                    }

                                    if (($_POST['buscarPor'] != null) && ($_POST['parametro'] != null)) {

                                        $campo = $_POST['buscarPor'];
                                        $parametro = $_POST['parametro'];
                                        
                                        if ($campo == 'atividade.dataCadastramento') {                                            
                                            $novaData = explode('/', $parametro);                                                                                       
                                            $parametro = $novaData[2].'-'.$novaData[1].'-'.$novaData[0];                                                                                         
                                        }

                                        $select = "SELECT atividade.* , COUNT(questao.cdQuestao) AS quantidadeQuestao,
                                                    SUM(questao.pontuacao) AS pontuacaoTotal FROM atividade
                                                    LEFT JOIN questao ON questao.cdAtividade = atividade.cdAtividade AND (questao.status = ? OR questao.status is null)
                                                    WHERE atividade.status != ?
                                                    AND $campo LIKE ?
                                                    GROUP BY atividade.cdAtividade
                                                    ORDER BY $campo ASC LIMIT $offset,20";
                                        $dados = array('ativo', 'deletado', '%' . $parametro . '%');
                                    } else {

                                        $select = "SELECT atividade.* , COUNT(questao.cdQuestao) AS quantidadeQuestao,
                                    SUM(questao.pontuacao) AS pontuacaoTotal FROM atividade
                                    LEFT JOIN questao ON questao.cdAtividade = atividade.cdAtividade AND (questao.status = ? OR questao.status is null)
                                    WHERE atividade.status != ?
                                    GROUP BY atividade.cdAtividade
                                    ORDER BY atividade.cdAtividade DESC LIMIT $offset,20";
                                        $dados = array('ativo', 'deletado');
                                    }

                                    $dados = $modelo->selecionar($select, $dados);
                                    $countAlert = 0;
                                    $countAlert = $offset;
                                    foreach ($dados as $key => $dado) {
                                        $countAlert++;
                                        $dado['titulo'] = htmlspecialchars($dado['titulo']);
                                        $dado['nivel'] = $dado['nivel'];
                                        $dado['status'] = htmlspecialchars($dado['status']);
                                        $dado['dataCadastramento'] = $dado['dataCadastramento'];
                                        $dado['dataCadastramento'] = date("d/m/Y H:i", strtotime($dado['dataCadastramento']));
                                        $dado['dataCadastramento'] = preg_replace('/ /', ' as ', $dado['dataCadastramento']);                                      
                                        ?>

                                        <tr>
                                            <td><?php echo $countAlert; ?></td>
                                            <td><?php echo $dado['titulo']; ?></td>
                                            <td><?php echo $dado['nivel']; ?></td>
                                            <td><?php echo $dado['dataCadastramento']; ?></td>
                                            <td><div onclick="ativaOuInativarAtividade(<?php echo $dado['cdAtividade']; ?>, this);" class="<?php echo ($dado['status'] == 'ativo')?'status_ativo':'status_inativo'; ?>" ><?php echo $dado['status']; ?></div></td>

                                            <td style="width: 150px;">

                                                <form name="questao" action="questaoADM.php" method="post">
                                                    <input type="hidden" name="titulo" value="<?php echo $dado['titulo']; ?>">
                                                    <button type="button" class="btn btn-success" data-toggle="modal" title="Ver e/ou editar os dados!" data-target="#editarAtividade<?php echo $dado['cdAtividade'] ?>"><span class="glyphicon glyphicon-edit"></span></button>
                                                    <button name="cdAtividade" type="submit" class="btn btn-primary" value="<?php echo $dado['cdAtividade']; ?>" title="Ver e/ou editar os dados das questões!"><span class="glyphicon glyphicon-eye-open"></span></button>
                                                    <button type="button" class="btn btn-danger" title="Excluir atividade" data-toggle="modal" data-target="#excluirAtividade<?php echo $dado['cdAtividade'] ?>"><span class="glyphicon glyphicon-trash"></span></button>
                                                </form>

                                                <!--Modal de visualização e edição de dado-->
                                                <div id="editarAtividade<?php echo $dado['cdAtividade'] ?>" class="modal fade" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="gridSystemModalLabel">

                                                    <div class="modal-dialog" role="document">

                                                        <div class="modal-content">

                                                            <div class="modal-header" style="background-color: #4cae4c; color: white;">
                                                                <a  class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></a>
                                                                <h4 class="modal-title" id="gridSystemModalLabel"><?php echo $dado['titulo']; ?></h4>
                                                            </div>

                                                            <form name="alterarAtividade" action="../controle/AlgTot.php" method="post">

                                                                <div class="modal-body">

                                                                    <input type="hidden" name="cdAtividade" value="<?php echo $dado['cdAtividade']; ?>">

                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" id="sizing-addon2">
                                                                            <span class="glyphicon glyphicon-text-width"></span>
                                                                        </span>
                                                                        <input name="titulo" id="titulo<?php echo $dado['cdAtividade'] ?>" minlength="3" maxlength="200" type="text" class="form-control" value="<?php echo $dado['titulo']; ?>" disabled required placeholder="Título da Atividade" title="Insira o titulo da atividade: Maximo 200 caracteres" aria-describedby="sizing-addon2">
                                                                        <span class="input-group-btn">
                                                                            <button id="editarAtividade<?php echo $dado['cdAtividade'] ?>" class="btn btn-default" title="Clique para editar o título da atividade" onclick="editarInput(document.getElementById('editarAtividade<?php echo $dado['cdAtividade'] ?>'), document.getElementById('titulo<?php echo $dado['cdAtividade'] ?>'))" type="button"><span class="glyphicon glyphicon-edit"></span> Editar</button>
                                                                        </span>
                                                                    </div>

                                                                    <br>

                                                                    <div class="input-group">

                                                                        <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-signal"></span></span>
                                                                        <select required disabled name="nivel" id="nivel<?php echo $dado['cdAtividade'] ?>" class="form-control" title="Selecione um nivel para a atividade">

                                                                            <option <?php
                                                                            if ($dado['nivel'] == 1) {
                                                                                echo "selected";
                                                                            }
                                                                            ?> value="1">1</option>
                                                                            <option <?php
                                                                            if ($dado['nivel'] == 2) {
                                                                                echo "selected";
                                                                            }
                                                                            ?> value="2">2</option>
                                                                            <option <?php
                                                                            if ($dado['nivel'] == 3) {
                                                                                echo "selected";
                                                                            }
                                                                            ?> value="3">3</option>
                                                                            <option <?php
                                                                            if ($dado['nivel'] == 4) {
                                                                                echo "selected";
                                                                            }
                                                                            ?> value="4">4</option>
                                                                            <option <?php
                                                                            if ($dado['nivel'] == 5) {
                                                                                echo "selected";
                                                                            }
                                                                            ?> value="5">5</option>

                                                                        </select>
                                                                        <span class="input-group-btn">
                                                                            <button id="editarNivel<?php echo $dado['cdAtividade'] ?>" class="btn btn-default" title="Clique para editar o Nível" onclick="editarInput(document.getElementById('editarNivel<?php echo $dado['cdAtividade'] ?>'), document.getElementById('nivel<?php echo $dado['cdAtividade'] ?>'))" type="button"><span class="glyphicon glyphicon-edit"></span> Editar</button>
                                                                        </span>

                                                                    </div>

                                                                    <br>

                                                                    <div class="input-group">

                                                                        <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-sort"></span></span>
                                                                        <select required disabled name="status" id="status<?php echo $dado['cdAtividade'] ?>" class="form-control" title="Selecione o status da atividade: Ativo, aparece para os alunos. Inativo, não aparece.">

                                                                            <option <?php
                                                                            if ($dado['status'] == 'ativo') {
                                                                                echo "selected";
                                                                            }
                                                                            ?> value="ativo">Ativo</option>
                                                                            <option <?php
                                                                            if ($dado['status'] == 'inativo') {
                                                                                echo "selected";
                                                                            }
                                                                            ?> value="inativo">Inativo</option>
                                                                        </select>
                                                                        <span class="input-group-btn">
                                                                            <button id="editarStatus<?php echo $dado['cdAtividade'] ?>" class="btn btn-default" title="Clique para editar o Status" onclick="editarInput(document.getElementById('editarStatus<?php echo $dado['cdAtividade'] ?>'), document.getElementById('status<?php echo $dado['cdAtividade'] ?>'))" type="button"><span class="glyphicon glyphicon-edit"></span> Editar</button>
                                                                        </span>

                                                                    </div>

                                                                    <br>

                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-question-sign"></span></span>
                                                                        <input name="quantidadeQuestao" type="text" class="form-control" disabled value="<?php echo $dado['quantidadeQuestao']; ?>" placeholder="Quantidade de Questão" title="Esta é a quantidade de questão que esta atividade possui no momento." aria-describedby="sizing-addon2">
                                                                    </div>

                                                                    <br>

                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-star"></span></span>
                                                                        <input name="pontuacaoTotal" type="text" class="form-control" disabled value="<?php
                                                                        if ($dado['pontuacaoTotal'] == null) {
                                                                            echo 0;
                                                                        } else {
                                                                            echo $dado['pontuacaoTotal'];
                                                                        }
                                                                        ?>" placeholder="Pontuação Total" title="Esta é a pontuação total que esta atividade possui no momento." aria-describedby="sizing-addon2">
                                                                    </div>

                                                                    <br>

                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-calendar"></span></span>
                                                                        <input type="text" class="form-control" disabled value="<?php echo $dado['dataCadastramento']; ?>" placeholder="data" title="Esta é a data de cadastramento da conta." aria-describedby="sizing-addon2">
                                                                    </div>


                                                                </div>

                                                                <div class="modal-footer">
                                                                    <div class="row">
                                                                        <div class="col-sm-5  col-sm-offset-7">
                                                                            <a data-dismiss="modal" class="btn btn-default"><span class="glyphicon glyphicon-remove"></span> Cancelar</a>
                                                                            <button name="acao"  type="submit" value="EditarAtividade" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span> Salvar</button>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </form>

                                                        </div>

                                                    </div><!-- /.modal-content -->

                                                </div><!--Fim modal-->

                                                <!--MODAL DE EXCLUSÃO-->

                                                <div id="excluirAtividade<?php echo $dado['cdAtividade'] ?>" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="gridSystemModalLabel">
                                                    <div class="modal-dialog" role="document">
                                                        <form class="form-horizontal" action="../controle/AlgTot.php" method="post">
                                                            <div class="modal-content">

                                                                <div class="modal-header" style="background-color: #d43f3a; color: white">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Fexar"><span aria-hidden="true">&times;</span></button>
                                                                    <h4 class="modal-title" id="gridSystemModalLabel">Deseja realmente excuir esta Atividade ?</h4>
                                                                </div>

                                                                <div class="modal-body">

                                                                    <input type="hidden" name="cdAtividade" value="<?php echo $dado['cdAtividade']; ?>">

                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" id="sizing-addon2">
                                                                            <span class="glyphicon glyphicon-text-width"></span>
                                                                        </span>
                                                                        <input minlength="3" maxlength="200" type="text" class="form-control" value="<?php echo $dado['titulo']; ?>" disabled required placeholder="Título da Atividade" title="Insira o titulo da atividade: Maximo 200 caracteres" aria-describedby="sizing-addon2">
                                                                    </div>

                                                                    <br>

                                                                    <div class="input-group">

                                                                        <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-signal"></span></span>
                                                                        <select required disabled class="form-control" title="Selecione um nivel para a atividade">

                                                                            <option <?php
                                                                            if ($dado['nivel'] == 1) {
                                                                                echo "selected";
                                                                            }
                                                                            ?> value="1">1</option>
                                                                            <option <?php
                                                                            if ($dado['nivel'] == 2) {
                                                                                echo "selected";
                                                                            }
                                                                            ?> value="2">2</option>
                                                                            <option <?php
                                                                            if ($dado['nivel'] == 3) {
                                                                                echo "selected";
                                                                            }
                                                                            ?> value="3">3</option>
                                                                            <option <?php
                                                                            if ($dado['nivel'] == 4) {
                                                                                echo "selected";
                                                                            }
                                                                            ?> value="4">4</option>
                                                                            <option <?php
                                                                            if ($dado['nivel'] == 5) {
                                                                                echo "selected";
                                                                            }
                                                                            ?> value="5">5</option>

                                                                        </select>

                                                                    </div>

                                                                    <br>

                                                                    <div class="input-group">

                                                                        <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-sort"></span></span>
                                                                        <select required disabled class="form-control" title="Status da atividade: Ativo, aparece para os alunos. Inativo, não aparece.">
                                                                            <option <?php
                                                                            if ($dado['status'] == 'ativo') {
                                                                                echo "selected";
                                                                            }
                                                                            ?> value="ativo">Ativo</option>
                                                                            <option <?php
                                                                            if ($dado['status'] == 'inativo') {
                                                                                echo "selected";
                                                                            }
                                                                            ?> value="inativo">Inativo</option>
                                                                        </select>

                                                                    </div>

                                                                    <br>

                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-question-sign"></span></span>
                                                                        <input type="text" class="form-control" disabled value="<?php echo $dado['quantidadeQuestao']; ?>" placeholder="Quantidade de Questão" title="Esta é a quantidade de questão que esta atividade possui no momento." aria-describedby="sizing-addon2">
                                                                    </div>

                                                                    <br>

                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-star"></span></span>
                                                                        <input name="pontuacaoTotal" type="text" class="form-control" disabled value="<?php
                                                                        if ($dado['pontuacaoTotal'] == null) {
                                                                            echo 0;
                                                                        } else {
                                                                            echo $dado['pontuacaoTotal'];
                                                                        }
                                                                        ?>" placeholder="Pontuação Total" title="Esta é a pontuação total que esta atividade possui no momento." aria-describedby="sizing-addon2">
                                                                    </div>

                                                                    <br>

                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-calendar"></span></span>
                                                                        <input type="text" class="form-control" disabled value="<?php echo $dado['dataCadastramento']; ?>" placeholder="data" title="Esta é a data de cadastramento da conta." aria-describedby="sizing-addon2">
                                                                    </div>


                                                                </div>

                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Não</button>
                                                                    <button type="submit" value="ExcluirAtividade" name="acao" class="btn btn-danger">Sim</button>
                                                                </div>

                                                            </div><!-- /.modal-content -->
                                                        </form>
                                                    </div><!-- /.modal-dialog -->
                                                </div><!-- /.modal -->

                                                <!--FIM DOS MODAIS-->

                                            </td>

                                        </tr>

                                        <?php
                                    }
                                    ?>

                                </tbody>

                            </table>
                            
                            <?php if ($countAlert == 0 && isset($_POST['parametro'])) { ?>
                                <div class="alert alert-warning" role="alert">Nenhuma atividade encontrada</div>
                            <?php } ?>
                            <?php if ($countAlert == 0 && !isset($_POST['parametro'])) { ?>
                                <div class="alert alert-success" role="alert">Nenhuma atividade cadastrada</div>
                            <?php } ?>

                        </div>

                        <div class="panel-footer">

                            <form name="paginacao" action="atividadesADM.php" method="post">

                                <div style="text-align: center">

                                    <input type="hidden" name="pagina" <?php
                                    if (isset($_POST['pagina'])) {
                                        echo "value='" . $pagina . "'";
                                    }
                                    ?> >
                                    <input type="hidden" name="offset" <?php
                                    if (isset($_POST['offset'])) {
                                        echo "value='" . $offset . "'";
                                    }
                                    ?> >

                                    <input type="hidden" name="buscarPor" <?php
                                    if (isset($_POST['buscarPor'])) {
                                        echo "value='" . $_POST['buscarPor'] . "'";
                                    }
                                    ?> >
                                    <input type="hidden" name="parametro" <?php
                                    if (isset($_POST['parametro'])) {
                                        echo "value='" . $_POST['parametro'] . "'";
                                    }
                                    ?> >

                                    <button name="paginar" title="Página <?php echo $pagina; ?> de <?php echo $ultimaPagina; ?>" type="button" class="btn btn-success">
                                        <?php echo $pagina; ?> de <?php echo $ultimaPagina; ?>
                                    </button>
                                    <button style="padding: 9px;" name="paginar" title="Ir para primeira página" value="primeira" type="submit" class="btn btn-default"><span class="glyphicon glyphicon-menu-left" ></span><span class="glyphicon glyphicon-menu-left" ></span></button>
                                    <button style="padding: 9px;" name="paginar" title="Ir para página anterior" value="anterior" type="submit" class="btn btn-default"><span class="glyphicon glyphicon-menu-left" ></span></button>
                                    <button name="paginar" title="Página atual" value="atual" type="button" class="btn btn-success">
                                        <?php echo $pagina; ?>
                                    </button>
                                    <button style="padding: 9px;" name="paginar" title="Ir para próxima página" value="proxima" type="submit" class="btn btn-default"><span class="glyphicon glyphicon-menu-right" ></span></button>
                                    <button style="padding: 9px;" name="paginar" title="Ir para ultima página" value="ultima" type="submit" class="btn btn-default"><span class="glyphicon glyphicon-menu-right" ></span><span class="glyphicon glyphicon-menu-right" ></span></button>

                                </div>

                            </form>

                        </div>

                    </div>

                </div>

                <div id="informacoes" class="col-sm-4">

                    <div id="informacoes1">

                        <div class="panel panel-default">

                            <div class="panel-heading" style="background-color: #4cae4c; color:white; text-align:center">

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

                            <div class="panel-heading" style="background-color: #4cae4c; color:white;text-align: center;">

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

                            <div class="panel-heading" style="background-color: #4cae4c; color:white;text-align: center;">

                                <h4>Informações do nível 3</h4>

                            </div>

                            <div class="panel-body" style="text-align: justify;">
                                <p>Não coloque pontuações muito altas nas questões, lembre-se de que para desbloquear o nível 4 basta 3000 pontos no nível 3.<br><br>O nível 3 deverá possuir atividades com a aplicação das operações matemáticas de soma, multiplicação, subtração e divisão.</p>
                            </div>

                        </div>

                    </div>

                    <div id="informacoes4">

                        <div class="panel panel-default">

                            <div class="panel-heading" style="background-color: #4cae4c; color:white;text-align: center;">

                                <h4>Informações do nível 4</h4>

                            </div>

                            <div class="panel-body" style="text-align: justify;">
                                <p>Não coloque pontuações muito altas nas questões, lembre-se de que para desbloquear o nível 5 basta 4000 pontos no nível 4.<br><br>O nível 4 deverá ter atividades utilizando as estruturas de controle como o “se” e o “senao” do Portugol.</p>
                            </div>

                        </div>

                    </div>

                    <div id="informacoes5">

                        <div class="panel panel-default">

                            <div class="panel-heading" style="background-color: #4cae4c; color:white;text-align: center;">

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
        <script src="js/jquery.maskedinput.js"></script>
        
        <script>
            $(document).ready( function () {
                $('.buscar_por_select').change( function () {                    
                    if ($(this).val() == 'atividade.dataCadastramento') {                        
                        $('.parametro_da_busca').mask('99/99/9999');
                    }
                    $('.parametro_da_busca').focus();
                });
                
                <?php if ($_POST['buscarPor'] == 'atividade.dataCadastramento') { ?>
                        $('.parametro_da_busca').mask('99/99/9999');
                <?php } ?>
            });
            
            function ativaOuInativarAtividade(cdAtividade, obj) {
                var status = $(obj).text();
                $.post( "../controle/AlgTot.php", { statusJqueryPost: status, cdAtividadeJqueryPost: cdAtividade, acao: "ativaOuInativarAtividade" })
                .done(function( resultado ) {
                    if (resultado == 'ativado') {
                        $(obj).removeClass('status_inativo');
                        $(obj).addClass('status_ativo');
                        $(obj).html('ativo');
                        $('#status'+cdAtividade+' option').each( function () {
                            $(this).removeAttr('selected');
                            if ($(this).val() == 'ativo') {
                                $(this).attr('selected', true);
                            } 
                        }); 
                    }
                    if (resultado == 'inativado') {
                        $(obj).removeClass('status_ativo');
                        $(obj).addClass('status_inativo');
                        $(obj).html('inativo');
                        $('#status'+cdAtividade+' option').each( function () {
                            $(this).removeAttr('selected');
                            if ($(this).val() == 'inativo') {
                                $(this).attr('selected', true);
                            } 
                        }); 
                    }
                 });
            }
        </script>
        

    </body>
</html>
