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

        <title>AlgtTot: Ranking ADM</title>

    </head>

    <!-- Bootstrap -->
    <body>

        <!-- MENU DO ADM -->
<?php include_once ("includs/menuADM.php"); ?>
        
        <!--MODAL DE VISUALIZAÇÃO E EDIÇÃO DE DADOS-->
<?php include_once("includs/modalVerEditarPerfil.php"); ?>

        <!--MODAL DE EXCLUIR PERFIL-->
<?php include_once("includs/modalExcluirPerfil.php"); ?>

        <section id="conteudo" class="container">

            <br>
            <br>
            <br>

            <div class="row">

                <div class="col-sm">

                    <div class="panel panel-default">

                        <div class="panel-heading" style="background-color: #4cae4c; color:white;">

                            <div style="text-align: center;">
                                <h3 class="blog-title">Ranking</h3>
                            </div>

                            <form class="form-inline" role="search" action="rankingADM.php" method="post">

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
                                        <select required id="buscarPor" title="Selecione pelo que gostaria de visualizar" name="buscarPor" class="form-control">

                                            <option value="" <?php if (($_POST['buscarPor'] == null) && (isset($_POST['buscarPor']))) {
                                    echo "selected";
                                } ?> >Organizar por</option>

                                            <option value="usuario.nivel1" <?php if (($_POST['buscarPor'] == 'usuario.nivel1') && (isset($_POST['buscarPor']))) {
                                    echo "selected";
                                } ?> >Nível 1</option>

                                            <option value="usuario.nivel2" <?php if (($_POST['buscarPor'] == 'usuario.nivel2') && (isset($_POST['buscarPor']))) {
                                    echo "selected";
                                } ?> >Nível 2</option>

                                            <option value="usuario.nivel3" <?php if (($_POST['buscarPor'] == 'usuario.nivel3') && (isset($_POST['buscarPor']))) {
                                    echo "selected";
                                } ?> >Nível 3</option>

                                            <option value="usuario.nivel4" <?php if (($_POST['buscarPor'] == 'usuario.nivel4') && (isset($_POST['buscarPor']))) {
                                    echo "selected";
                                } ?> >Nível 4</option>

                                            <option value="usuario.nivel5" <?php if (($_POST['buscarPor'] == 'usuario.nivel5') && (isset($_POST['buscarPor']))) {
                                    echo "selected";
                                } ?> >Nível 5</option>

                                            <option value="usuario.pontuacaoTotal" <?php if (($_POST['buscarPor'] == 'usuario.pontuacaoTotal') && (isset($_POST['buscarPor']))) {
                                    echo "selected";
                                } ?> >Pontuação Total</option>

                                        </select>
                                    </div>

                                </div>

                                <div class="form-group">
                                    <div class="col">
                                        <button type="submit" name="buscar" value="Buscar" class="btn btn-default"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Buscar</button>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col">
                                        <a name="rankingADM" href="rankingADM.php" class="btn btn-default"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> Ranking</a>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col">
                                        <a name="voltarInicio" href="principalADM.php" class="btn btn-default"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Início</a>
                                    </div>
                                </div>

                            </form>

                        </div>

                        <div class="table-responsive panel-body">

                            <table class="table table-striped">

                                <thead>
                                    <th><span class="glyphicon glyphicon-sort-by-attributes-alt"></span></th>
                                    <th><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Usuário</th>
                                    <th><span class="glyphicon glyphicon-star" aria-hidden="true"></span> Nível 1</th>
                                    <th><span class="glyphicon glyphicon-star" aria-hidden="true"></span> Nível 2</th>
                                    <th><span class="glyphicon glyphicon-star" aria-hidden="true"></span> Nível 3</th>
                                    <th><span class="glyphicon glyphicon-star" aria-hidden="true"></span> Nível 4</th>
                                    <th><span class="glyphicon glyphicon-star" aria-hidden="true"></span> Nível 5</th>
                                    <th><span class="glyphicon glyphicon-star" aria-hidden="true"></span> Pontuação Total</th>
                                </thead>

                                <tbody>

                                    <?php
                                    //pegando numero de linhas
                                    if (($_POST['buscarPor'] != null)) {

                                        $campo = $_POST['buscarPor'];

                                        $select = "SELECT count(cdUsuario) AS numLinhas FROM usuario WHERE status = ? AND cdGrupo = ?";
                                        $dados = array('ativo', 3);
                                    } else {

                                        $select = "SELECT count(cdUsuario) AS numLinhas FROM usuario WHERE status = ? AND cdGrupo = ?";
                                        $dados = array('ativo', 3);
                                    }

                                    $numLinhas = $modelo->selecionar($select, $dados);

                                    foreach ($numLinhas as $key => $value) {
                                        $totalLinhas = $value['numLinhas'];
                                    }

                                    $ultimaPagina = $totalLinhas / 10;

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
                                            $offset = $offset - 10;
                                        }

                                        if (($_POST['paginar'] == 'proxima') && ($pagina >= 1) && ($pagina < $ultimaPagina)) {

                                            $pagina = $pagina + 1;
                                            $offset = $offset + 10;
                                        }

                                        if ($_POST['paginar'] == 'primeira') {

                                            $pagina = 1;
                                            $offset = 0;
                                        }

                                        if ($_POST['paginar'] == 'ultima') {

                                            $pagina = $ultimaPagina;

                                            //É necessario subtrair -1 pois o offset inicia-se em 0 e a numeracao das paginas em 1
                                            $offset = ($ultimaPagina - 1) * 10;
                                        }
                                    }

                                    if (($_POST['buscarPor'] != null)) {

                                        $campo = $_POST['buscarPor'];

                                        $select = "SELECT usuario.*, grupo.grupo AS grupo FROM usuario, grupo
                                    WHERE usuario.cdGrupo = grupo.cdGrupo AND usuario.status = ?
                                    AND usuario.cdGrupo = ?
                                    ORDER BY $campo DESC LIMIT $offset,10";
                                        $dados = array('ativo', 3);
                                    } else {

                                        $select = "SELECT usuario.*, grupo.grupo AS grupo FROM usuario, grupo
                                    WHERE usuario.cdGrupo = grupo.cdGrupo AND usuario.status = ?
                                    AND usuario.cdGrupo = ?
                                    ORDER BY usuario.pontuacaoTotal DESC LIMIT $offset,10";
                                        $dados = array('ativo', 3);
                                    }

                                    $dados = $modelo->selecionar($select, $dados);
                                    $countAlert = 0;
                                    $countAlert = $offset;
                                    foreach ($dados as $key => $dado) {
                                        $countAlert++;
                                        $dado['usuario'] = htmlspecialchars($dado['usuario']);
                                        ?>

                                        <tr>
                                            <td><?php echo $countAlert.'ª'; ?></td>
                                            <td><?php echo $dado['usuario']; ?></td>
                                            <td><?php echo $dado['nivel1']; ?></td>
                                            <td><?php echo $dado['nivel2']; ?></td>
                                            <td><?php echo $dado['nivel3']; ?></td>
                                            <td><?php echo $dado['nivel4']; ?></td>
                                            <td><?php echo $dado['nivel5']; ?></td>
                                            <td><?php echo $dado['pontuacaoTotal']; ?></td>
                                        </tr>

                                        <?php
                                    }
                                    ?>

                                </tbody>

                            </table>
                            <?php if ($countAlert == 0 && isset($_POST['parametro'])) { ?>
                                <div class="alert alert-warning" role="alert">Nenhum usuário encontrado</div>
                            <?php } ?>
                            <?php if ($countAlert == 0 && !isset($_POST['parametro'])) { ?>
                                <div class="alert alert-success" role="alert">Nenhum usuário cadastrado</div>
                            <?php } ?>
                        </div>

                        <div class="panel-footer">

                            <form name="paginacao" action="rankingADM.php" method="post">

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

                    </div><!--Fim do painel-->

                </div>

            </div>

        </section>

        <!--Minhas verificações -->
        <script src="js/verificacoes.js"></script>

    </body>
</html>
