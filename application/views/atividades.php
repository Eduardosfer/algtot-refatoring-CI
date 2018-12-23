<?php
require_once("../controle/Acesso.php");
require_once("../controle/AlgTot.php");


    $algTot = new AlgTot();
    $acesso = new Acesso();
    $modelo = new Modelo();

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

if (!isset($_POST['nivel'])) {
    $nivel = null;
} else {
    $nivel = $_POST['nivel'];
    $porcentagemAtualNivel = 0;
    if ($nivel == 1) {
        $porcentagemAtualNivel = (($respondido1 * 100) / $total1);        
    }
    if ($nivel == 2) {
        $porcentagemAtualNivel = (($respondido2 * 100) / $total2);        
    }
    if ($nivel == 3) {
        $porcentagemAtualNivel = (($respondido3 * 100) / $total3);        
    }
    if ($nivel == 4) {
        $porcentagemAtualNivel = (($respondido4 * 100) / $total4);        
    }
    if ($nivel == 5) {
        $porcentagemAtualNivel = (($respondido5 * 100) / $total5);        
    }
    
    $porcentagemAtualNivel = number_format($porcentagemAtualNivel, 1, '.', '');    
}

$algTot->setNivel($nivel);

if (($_SESSION['nivel'] == 1) || ((($_SESSION['nivel'] == 2) && ($_SESSION['nivel1'] >= $necessarioNivel1)) || validarPorcentagem($respondido1, $total1, 1)) || ((($_SESSION['nivel'] == 3) && ($_SESSION['nivel2'] >= $necessarioNivel2)) || validarPorcentagem($respondido2, $total2, 2)) || ((($_SESSION['nivel'] == 4) && ($_SESSION['nivel3'] >= $necessarioNivel3)) || validarPorcentagem($respondido3, $total3, 3)) || ((($_SESSION['nivel'] == 5) && ($_SESSION['nivel4'] >= $necessarioNivel4)) || validarPorcentagem($respondido4, $total4, 4))) {
    //
} else {

    header("Location: ".BASE_URL_ALG."visao/principal.php");
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

        <title>AlgtTot: Atividades</title>

    </head>

    <!-- Bootstrap -->
    <body>

        <!-- MENU DO ALUNO -->
        <?php include_once("includs/menuAluno.php"); ?>

        <!--MODAL DE VISUALIZAÇÃO E EDIÇÃO DE DADOS-->
        <?php include_once("includs/modalVerEditarPerfil.php"); ?>
        
        <!--MODAL DE EXCLUIR PERFIL-->
        <?php include_once("includs/modalExcluirPerfil.php"); ?>

        <!-- MODAL DE VISUALIZAÇÃO DE SINTAXE DO PORTUGOL-->
        <?php include_once("includs/modalSintaxePortugol.php"); ?>

        <!-- MODAL DE REGISTRO  FINAL DA ATIVIDADE -->
        <?php include_once("includs/modalRegistroFinalAtividade.php"); ?>

        <!-- MODAL DE REGISTRO ACERTO OU ERRO OU PULO -->
        <?php include_once("includs/modalAcertoErroPulo.php");
        unset($_SESSION['mostrarModalRegistro']);
        unset($_SESSION['mostrarModalRegistroFinal']); ?>            

        <section id="conteudo" class="container">

            <br>
            <br>
            <br>

            <div class="row">

                <div id="atividadess" class="col-sm-8">

                    <div class="panel panel-default">

                        <div class="panel-heading" style="background-color: #4cae4c; color:white; text-align:center;">

                            <div class="blog-header">
                                <h3 class="blog-title">Selecione uma das atividades</h3>
                            </div>

                            <form class="form-inline" role="search" action="atividades.php" method="post">

                                <?php
                                if (!isset($_POST['parametro'])) {

                                    $_POST['parametro'] = null;
                                }

                                if (!isset($_POST['buscarPor'])) {

                                    $_POST['buscarPor'] = null;
                                }
                                ?>

                                <div class="form-group">

                                    <div class="col">
                                        <select required id="buscarPor" title="Selecione pelo que gostaria de buscar" name="buscarPor" class="form-control buscar_por_select">

                                            <option value="" <?php if (($_POST['buscarPor'] == null) && (isset($_POST['buscarPor']))) {
                                    echo "selected";
                                } ?> >Buscar por</option>

                                            <option value="atividade.titulo" <?php if (($_POST['buscarPor'] == 'atividade.titulo') && (isset($_POST['buscarPor']))) {
                                    echo "selected";
                                } ?> >Título</option>

                                            <option value="atividade.dataCadastramento" <?php if (($_POST['buscarPor'] == 'atividade.dataCadastramento') && (isset($_POST['buscarPor']))) {
                                    echo "selected";
                                } ?> >Data cadastramento</option>

                                        </select>
                                    </div>

                                </div>

                                <div class="form-group">
                                    <div class="col">

                                        <input required type="text" class="form-control parametro_da_busca" <?php if (isset($_POST['parametro'])) {
                                    echo "value=" . "'" . $_POST['parametro'] . "'";
                                } ?> placeholder="Busca" name="parametro" title="Digite aqui sua busca">

                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col">
                                        <button type="submit" name="buscar" value="Buscar" class="btn btn-default"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Buscar</button>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col">
                                        <a name="atividadess" href="atividades.php" class="btn btn-default"><span class="glyphicon glyphicon-refresh"></span> Atividades</a>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col">
                                        <a name="voltarInicio" href="principal.php" class="btn btn-default"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Início</a>
                                    </div>
                                </div>

                            </form>
                            
                            <p>Progresso atual do nível <?php echo $nivel; ?></p>
                            <div class="progress" title="Progresso atual do nível <?php echo $nivel; ?>">
        			<div class="progress-bar progress-bar-default" role="progressbar" aria-valuenow="<?php echo $porcentagemAtualNivel; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $porcentagemAtualNivel; ?>%"><?php echo $porcentagemAtualNivel; ?>%
        			<span class="sr-only"><?php echo $porcentagemAtualNivel; ?>% Complete (warning)</span>
        			</div>
                            </div>
                            
                        </div>

                        <div class="panel-body">

                            <br>

                            <div id="centro" class="col">

                                <div class="btn-group" role="group" arial-label="...">

                                    <form name="atividades" action="questaoTipo1.php" method="post">

                                        <?php
                                        $nivel = $_SESSION['nivel'];

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
                                                        WHERE atividade.status = ?
                                                        AND atividade.nivel = ?
                                                        AND ? LIKE ?";
                                            $dados = array('ativo', 'ativo', $nivel, $campo, '%' . $parametro . '%');
                                        } else {

                                            $select = "SELECT count(atividade.cdAtividade) AS numLinhas FROM atividade WHERE status = ? AND atividade.nivel = ?";
                                            $dados = array('ativo', $nivel);
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

                                        $cdUsuario = $_SESSION['cdUsuario'];

                                        if (($_POST['buscarPor'] != null) && ($_POST['parametro'] != null)) {

                                            $campo = $_POST['buscarPor'];
                                            $parametro = $_POST['parametro'];
                                            
                                            if ($campo == 'atividade.dataCadastramento') {
                                                $novaData = explode('/', $parametro);                                                                                       
                                                $parametro = $novaData[2].'-'.$novaData[1].'-'.$novaData[0];                                                                                        
                                            }

                                            $select = "SELECT atividade.cdAtividade AS codAtividade, atividade.* ,
                                                        (SELECT COUNT(questao.cdQuestao)
                                                        FROM questao, atividade
                                                        WHERE atividade.cdAtividade = questao.cdAtividade
                                                        AND atividade.cdAtividade = codAtividade) AS quantQuestaoAtividade,
                                                        (SELECT COUNT(questao.cdQuestao)
                                                        FROM questao
                                                        WHERE questao.cdAtividade = codAtividade
                                                        AND questao.status = ?
                                                        AND (select count(usuarioquestao.cdUsuarioQuestao) 
                                                              FROM usuarioquestao where usuarioquestao.cdQuestao = questao.cdQuestao 
                                                              AND usuarioquestao.cdUsuario = ? 
                                                              AND usuarioquestao.status = ?
                                                              AND questao.status = ?) = 0) AS aResponder,
                                                        (SELECT SUM( DISTINCT questao.pontuacao ) AS pontuacaoTotalUsuarioAtividade FROM atividade
                                                        LEFT JOIN questao ON questao.cdAtividade = atividade.cdAtividade
                                                        LEFT JOIN usuarioquestao ON questao.cdQuestao = usuarioquestao.cdQuestao
                                                        LEFT JOIN usuario ON usuario.cdUsuario = usuarioquestao.cdUsuario
                                                        WHERE usuario.cdUsuario = ? AND atividade.cdAtividade = codAtividade
                                                        AND (usuarioquestao.status = ? OR usuarioquestao.status is null)) AS pontuacaoTotalAluno,
                                                        atividade.dataCadastramento AS dataCadastramentoAtividade, COUNT(questao.cdQuestao) AS quantidadeQuestao,
                                                        SUM(questao.pontuacao) AS pontuacaoTotal FROM atividade
                                                        LEFT JOIN questao ON questao.cdAtividade = atividade.cdAtividade AND (questao.status = ? OR questao.status is null)
                                                        WHERE atividade.status = ? AND atividade.nivel = ?
                                                        AND $campo LIKE ? GROUP BY atividade.cdAtividade
                                                        ORDER BY $campo ASC LIMIT $offset,20";

                                            $dados = array('ativo', $cdUsuario, 'acertou', 'ativo', $cdUsuario, 'acertou', 'ativo', 'ativo', $nivel, '%' . $parametro . '%');
                                        } else {

                                            $select = "SELECT atividade.cdAtividade AS codAtividade, atividade.* ,
                                                        (SELECT COUNT(questao.cdQuestao)
                                                        FROM questao, atividade
                                                        WHERE atividade.cdAtividade = questao.cdAtividade
                                                        AND atividade.cdAtividade = codAtividade) AS quantQuestaoAtividade,
                                                        (SELECT COUNT(questao.cdQuestao)
                                                        FROM questao
                                                        WHERE questao.cdAtividade = codAtividade
                                                        AND questao.status = ?
                                                        AND (select count(usuarioquestao.cdUsuarioQuestao) 
                                                              FROM usuarioquestao where usuarioquestao.cdQuestao = questao.cdQuestao 
                                                              AND usuarioquestao.cdUsuario = ? 
                                                              AND usuarioquestao.status = ?
                                                              AND questao.status = ?) = 0) AS aResponder,
                                                        (SELECT SUM( DISTINCT questao.pontuacao ) AS pontuacaoTotalUsuarioAtividade FROM atividade
                                                        LEFT JOIN questao ON questao.cdAtividade = atividade.cdAtividade
                                                        LEFT JOIN usuarioquestao ON questao.cdQuestao = usuarioquestao.cdQuestao
                                                        LEFT JOIN usuario ON usuario.cdUsuario = usuarioquestao.cdUsuario
                                                        WHERE usuario.cdUsuario = ? AND atividade.cdAtividade = codAtividade
                                                        AND (usuarioquestao.status = ? OR usuarioquestao.status is null)) AS pontuacaoTotalAluno,
                                                        atividade.dataCadastramento AS dataCadastramentoAtividade, COUNT(questao.cdQuestao) AS quantidadeQuestao,
                                                        SUM(questao.pontuacao) AS pontuacaoTotal FROM atividade
                                                        LEFT JOIN questao ON questao.cdAtividade = atividade.cdAtividade AND (questao.status = ? OR questao.status is null)
                                                        WHERE atividade.status = ? AND atividade.nivel = ?
                                                        GROUP BY atividade.cdAtividade
                                                        ORDER BY codAtividade DESC LIMIT $offset,20";
                                            $dados = array('ativo', $cdUsuario, 'acertou', 'ativo', $cdUsuario, 'acertou', 'ativo', 'ativo', $nivel);
                                        }

                                        $atividades = $modelo->selecionar($select, $dados);
                                        $countAlert = 0;
                                        foreach ($atividades as $key => $atividade) {
                                            $countAlert++;
                                            $codAtividade = htmlspecialchars($atividade['codAtividade']);
                                            $titulo = htmlspecialchars($atividade['titulo']);
                                            $pontuacaoTotal = $atividade['pontuacaoTotal'];
                                            $dataCadastramento = htmlspecialchars($atividade['dataCadastramento']);
                                            $pontuacaoTotalAluno = $atividade['pontuacaoTotalAluno'];
                                            $quantQuestaoAtividade = $atividade['quantQuestaoAtividade'];
                                            $aResponder = $atividade['aResponder'];

                                            $tituloCortado = substr($titulo, 0, 21);

                                            if (!isset($pontuacaoTotalAluno)) {
                                                $pontuacaoTotalAluno = 0;
                                            }

                                            if ($titulo == $tituloCortado) {
                                                //
                                            } else {
                                                $tituloCortado = $tituloCortado . "...";
                                            }

                                            if (!isset($pontuacaoTotal)) {
                                                $pontuacaoTotal = 0;
                                            }
                                            
                                            $dataCadastramento = date("d/m/Y H:i", strtotime($dataCadastramento));
                                            $dataCadastramento = preg_replace('/ /', ' as ', $dataCadastramento); 
                                            ?>

                                        <button <?php if ($quantQuestaoAtividade > 0) { if ($aResponder > 0) { ?> name="atividade" type="submit" <?php } else { echo "type='button' onclick='cModal(1);'"; } } else { echo "type='button' onclick='cModal(2);'"; } ?> value="<?php echo $codAtividade; ?>" style="margin: .5em; width: 160px; height: 100px;" title="<?php echo $titulo; ?>" class="btn btn-<?php if ($pontuacaoTotalAluno >= $pontuacaoTotal) {
                                            echo 'success';
                                        } else {
                                            echo 'primary';
                                        } ?>"><?php echo $tituloCortado; ?><br><?php echo $dataCadastramento; ?><br><?php echo $pontuacaoTotalAluno; ?>/<?php echo $pontuacaoTotal; ?><br>Pontos</button>


    <?php
}
?>

                                    </form>
                                    
                                </div>
                                
                                <?php if ($countAlert == 0 && isset($_POST['parametro'])) { ?>
                                    <div class="alert alert-warning" role="alert">Nenhuma atividade encontrada</div>
                                <?php } ?>
                                <?php if ($countAlert == 0 && !isset($_POST['parametro'])) { ?>
                                    <div class="alert alert-success" role="alert">Nenhuma atividade cadastrada</div>
                                <?php } ?>
                            </div>
                            
                        </div>

                        <div class="panel-footer">

                            <form name="paginacao" action="atividades.php" method="post">

                                <div style="text-align: center">

                                    <input type="hidden" name="pagina" <?php if (isset($_POST['pagina'])) {
                                            echo "value='" . $pagina . "'";
                                        } ?> >
                                    <input type="hidden" name="offset" <?php if (isset($_POST['offset'])) {
                                            echo "value='" . $offset . "'";
                                        } ?> >

                                    <input type="hidden" name="buscarPor" <?php if (isset($_POST['buscarPor'])) {
                                            echo "value='" . $_POST['buscarPor'] . "'";
                                        } ?> >
                                    <input type="hidden" name="parametro" <?php if (isset($_POST['parametro'])) {
                                            echo "value='" . $_POST['parametro'] . "'";
                                        } ?> >

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

                <div id="informacoes" class="col-sm-4 col-sm-offset-0">

                    <div id="informacoes1" style="<?php if ($_SESSION['nivel'] == 1) {
    echo 'display: block;';
} else {
    echo 'display: none;';
} ?>" >

                        <div class="panel panel-default" >

                            <div class="panel-heading" style="background-color: #4cae4c; color:white; text-align:center;">

                                <h4>Informações do nível 1</h4>

                            </div>

                            <div class="panel-body" style="text-align: justify;">
                                <p>O nível 1 possui atividades com conceitos básicos de lógica de programação e faz uma breve introdução a algoritmos.</p>
                            </div>

                        </div>

                    </div>

                    <div id="informacoes2" style="<?php if ($_SESSION['nivel'] == 2) {
    echo 'display: block;';
} else {
    echo 'display: none;';
} ?>" >

                        <div class="panel panel-default">

                            <div class="panel-heading" style="background-color: #4cae4c; color:white; text-align:center;">

                                <h4>Informações do nível 2</h4>

                            </div>

                            <div class="panel-body" style="text-align: justify;">
                                <p>
                                    O nível 2 possuirá atividades de lógica para reforçar os conceitos aprendidos anteriormente, além de trabalhar com as funções de leitura e escrita do Portugol.
                                </p>
                            </div>

                        </div>

                    </div>

                    <div id="informacoes3" style="<?php if ($_SESSION['nivel'] == 3) {
    echo 'display: block;';
} else {
    echo 'display: none;';
} ?>" >

                        <div class="panel panel-default">

                            <div class="panel-heading" style="background-color: #4cae4c; color:white; text-align:center;">

                                <h4>Informações do nível 3</h4>

                            </div>

                            <div class="panel-body" style="text-align: justify;">
                                <p>O nível 3 possuirá atividades com a aplicação das operações matemáticas de soma, multiplicação, subtração e divisão.</p>
                            </div>

                        </div>

                    </div>

                    <div id="informacoes4" style="<?php if ($_SESSION['nivel'] == 4) {
    echo 'display: block;';
} else {
    echo 'display: none;';
} ?>" >

                        <div class="panel panel-default">

                            <div class="panel-heading" style="background-color: #4cae4c; color:white; text-align:center;">

                                <h4>Informações do nível 4</h4>

                            </div>

                            <div class="panel-body" style="text-align: justify;">
                                <p>O nível 4 terá atividades utilizando as estruturas de controle como o “se” e o “senao” do Portugol.</p>
                            </div>

                        </div>

                    </div>

                    <div id="informacoes5" style="<?php if ($_SESSION['nivel'] == 5) {
    echo 'display: block;';
} else {
    echo 'display: none;';
} ?>" >

                        <div class="panel panel-default">

                            <div class="panel-heading" style="background-color: #4cae4c; color:white; text-align:center;">

                                <h4>Informações do nível 5</h4>

                            </div>

                            <div class="panel-body" style="text-align: justify;">
                                <p>
                                    O nível 5 possuirá atividades mais complexas de lógica e trabalhará com questões utilizando as estruturas de repetição como o “repita” e o “para” e revisará as estruturas de controle anteriormente estudadas.
                                </p>
                            </div>

                        </div>

                    </div>

                    <div id="sintaxe">

                        <div class="panel panel-primary">

                            <div class="panel-heading" style="background-color:#2e6da4;text-align:center;">

                                <h4>Estude a sintaxe do portugol</h4>

                            </div>

                            <div class="panel-body" style="text-align: justify;">
                                <p>
                                    Antes de iniciar a responder as atividades de uma olhada na sintaxe desta versão do portugol. A sintaxe também estará disponível nas questões que forem necessárias.
                                </p>
                                <button name="acaoSintaxe" value="sintaxe" type="button" data-toggle="modal" data-target="#sintaxe" href="#" class="btn btn-primary"><span class="glyphicon glyphicon-book"></span> Sintaxe</button>
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
            function cModal(tipoModal) {
                if (tipoModal == 1) {
                    chamarModal('Parabéns você já completou essa atividade.', 'Parabéns você ja respondeu corretamente todas as questões dessa atividade, continue pontuado em outras atividades.', '', 'meuModalSucesso');
                }
                
                if (tipoModal == 2) {
                    chamarModal('Aviso!', 'Essa atividade ainda não possui nenhuma questão.', '', 'meuModalErro');
                }
            }
            
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
        </script>
    </body>
</html>
