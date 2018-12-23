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

        <title>AlgtTot: Usuários ADM</title>

    </head>

    <!-- Bootstrap -->
    <body>

        <!-- MENU DO ADM -->
<?php include_once ("includs/menuADM.php"); ?>
        
        <!--MODAL DE VISUALIZAÇÃO E EDIÇÃO DE DADOS-->
<?php include_once("includs/modalVerEditarPerfil.php"); ?>

        <!--MODAL DE EXCLUIR PERFIL-->
<?php include_once("includs/modalExcluirPerfil.php"); ?>

        <!--Modal de cadastrar usuário-->
        <div id="cadastrarUsuario" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">

            <div class="modal-dialog" role="document">

                <div class="modal-content">

                    <div class="modal-header" style="background-color: #4cae4c; color: white;">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="modal-title" id="gridSystemModalLabel">Cadastar Usuário</h4>
                    </div>

                    <form name="cadastrarUsuario" id="cadastrarUsuarioForm" action="../controle/Usuario.php" method="post">

                        <div class="modal-body">

                            <div class="input-group">
                                <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-info-sign"></span></span>
                                <input name="nomeCompleto" type="text" minlength="10" maxlength="200" class="form-control input_verific" required placeholder="Nome Completo" title="Seu nome completo: Apenas letras: Maximo 200 caracteres" aria-describedby="sizing-addon2">
                            </div>

                            <br>
                            
                            <div class="input-group">
                                <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-home"></span></span>
                                <input name="instituicao" type="text" minlength="3" maxlength="500" class="form-control input_verific" required placeholder="Instituição" title="Instituiçao onde estuda/trabalha" aria-describedby="sizing-addon2">
                            </div>

                            <br>
                            
                            <div class="input-group">
                                <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-education"></span></span>
                                <input name="curso" type="text" minlength="2" maxlength="200" class="form-control input_verific" required placeholder="Curso" title="Curso que esta ingressado ou leciona" aria-describedby="sizing-addon2">
                            </div>

                            <br>
                            
                            <div class="input-group">
                                <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-user"></span></span>
                                <input name="usuario" type="text" minlength="3" maxlength="20" class="form-control input_verific" required placeholder="Usuário" pattern="[a-zA-Z0-9]+" title="Insira um nome de usuário: Apenas letras e números: Maximo 20 caracteres" aria-describedby="sizing-addon2">
                            </div>

                            <br>

                            <div class="input-group">
                                <span class="input-group-addon" id="sizing-addon2">@</span>
                                <input name="email" type="email" class="form-control input_verific" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" placeholder="email" title="Insira o e-mail: este e-mail pode ser utilizado para recuperar a conta" aria-describedby="sizing-addon2">
                            </div>

                            <br>

                            <div class="input-group">
                                <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-flash"></span></span>
                                <select required name="cdGrupo" class="form-control">
                                    <option value="" selected>Selecione um grupo</option>

<?php
$select = "SELECT cdGrupo, grupo FROM grupo ORDER bY grupo ASC";
$dados = array('');

$grupos = $modelo->selecionar($select, $dados);

foreach ($grupos as $key => $grupo) {
    ?>

                                        <option value="<?php echo $grupo['cdGrupo']; ?>"><?php echo $grupo['grupo']; ?></option>

    <?php
}
?>

                                </select>
                            </div>
                            
                            <br>
                            
                            <div class="input-group">
                                <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-sort"></span></span>
                                <select title="Selecione o status" required name="status" class="form-control">                                    
                                    <option value="ativo">Ativo</option>
                                    <option value="inativo">Inativo</option>
                                </select>
                            </div>

                            <br>

                            <div class="input-group">
                                <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-lock"></span></span>
                                <input name="senha" id="senhaCadastro" type="password" pattern="\S+" oninput="validarSenha(document.getElementById('senhaCadastro'),document.getElementById('confirmarSenhaCadastro'),document.getElementById('acaoCadastro'))" minlength="3" maxlength="20" class="form-control input_verific" required placeholder="Senha" title="Digite uma senha: Maximo 20 caracteres, exceto espaços em branco" aria-describedby="sizing-addon2">
                            </div>

                            <br>

                            <div class="input-group">
                                <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-lock"></span></span>
                                <input name="confirmarSenha" id="confirmarSenhaCadastro" minlength="3" maxlength="20" type="password" pattern="\S+" oninput="validarSenha(document.getElementById('senhaCadastro'),document.getElementById('confirmarSenhaCadastro'),document.getElementById('acaoCadastro'))" class="form-control input_verific" required placeholder="Confirme a Senha" title="Confirme a senha digitada acima, exceto espaços em branco" aria-describedby="sizing-addon2">
                            </div>

                            <br>
                            <div id="alertaSenhaIncorretaUsuariosADM" class="alert alert-danger text-center" style="display:none;" title="Senhas não conferem!" role="alert">Senhas não conferem!</div>

                        </div>

                        <div class="modal-footer">
                            <button name="acao" id="acaoCadastro" type="button" value="Cadastrar" class="btn btn-success"><span class="glyphicon glyphicon-save"></span> Cadastrar</button>
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

                <div class="col-sm">

                    <div class="panel panel-default">

                        <div class="panel-heading" style="background-color: #4cae4c; color:white;">

                            <div style="text-align: center;">
                                <h3 class="blog-title">Usuários</h3>
                            </div>

                            <form class="form-inline" role="search" action="usuariosADM.php" method="post">

                                <div class="form-group">
                                    <div class="col">
                                        <a href="#" data-toggle="modal" data-target="#cadastrarUsuario" class="btn btn-default"><span class="glyphicon glyphicon-plus"></span> Cadastrar Usuário</a>
                                    </div>
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

                                    <div class="col">
                                        <select required id="buscarPor" title="Selecione pelo que gostaria de buscar" name="buscarPor" class="form-control buscar_por_select">

                                            <option value="" <?php if (($_POST['buscarPor'] == null) && (isset($_POST['buscarPor']))) {
                                    echo "selected";
                                } ?> >Buscar por</option>
                                            
                                            <option value="usuario.nomeCompleto" <?php if (($_POST['buscarPor'] == 'usuario.nomeCompleto') && (isset($_POST['buscarPor']))) {
                                    echo "selected";
                                } ?> >Nome</option>
                                            
                                            <option value="usuario.instituicao" <?php if (($_POST['buscarPor'] == 'usuario.instituicao') && (isset($_POST['buscarPor']))) {
                                    echo "selected";
                                } ?> >Instituicao</option>
                                            
                                            <option value="usuario.curso" <?php if (($_POST['buscarPor'] == 'usuario.curso') && (isset($_POST['buscarPor']))) {
                                    echo "selected";
                                } ?> >Curso</option>
                                            
                                            <option value="usuario.status" <?php if (($_POST['buscarPor'] == 'usuario.status') && (isset($_POST['buscarPor']))) {
                                    echo "selected";
                                } ?> >Status</option>
                                            
                                            <option value="usuario.usuario" <?php if (($_POST['buscarPor'] == 'usuario.usuario') && (isset($_POST['buscarPor']))) {
                                    echo "selected";
                                } ?> >Usuário</option>

                                            <option value="usuario.email" <?php if (($_POST['buscarPor'] == 'usuario.email') && (isset($_POST['buscarPor']))) {
                                    echo "selected";
                                } ?> >E-mail</option>

                                            <option value="grupo.grupo" <?php if (($_POST['buscarPor'] == 'grupo.grupo') && (isset($_POST['buscarPor']))) {
                                    echo "selected";
                                } ?> >Grupo</option>

                                            <option value="usuario.data" <?php if (($_POST['buscarPor'] == 'usuario.data') && (isset($_POST['buscarPor']))) {
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
                                        <button type="submit" name="buscar" value="Buscar" class="btn btn-default"><span class="glyphicon glyphicon-search"></span> Buscar</button>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col">
                                        <a name="usuariosADM" href="usuariosADM.php" class="btn btn-default"><span class="glyphicon glyphicon-refresh"></span> Usuários</a>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="col">
                                        <a name="usuariosInativosADM" href="usuariosInativosADM.php" class="btn btn-default"><span class="glyphicon glyphicon-refresh"></span> Usuários Inativos</a>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col">
                                        <a name="voltarInicio" href="principalADM.php" class="btn btn-default"><span class="glyphicon glyphicon-home"></span> Início</a>
                                    </div>
                                </div>

                            </form>

                        </div>

                        <div class="table-responsive panel-body">

                            <table class="table table-bordered">

                                <thead>
                                    <th><span class="glyphicon glyphicon-sort-by-attributes"></span></th>
                                    <th>Usuário</th>
                                    <th>Nome</th>
                                    <th>Instituição</th>
                                    <th>Curso</th>
                                    <!--<th>Senha</th>-->
                                    <th>Grupo</th>
                                    <!--<th>E-mail</th>-->
                                    <th>Data/hora cadastro</th>
                                    <th>Status</th>
                                    <th>Ações</th>
                                </thead>

                                <tbody>

                                    <?php
                                    //pegando numero de linhas
                                    if (($_POST['buscarPor'] != null) && ($_POST['parametro'] != null)) {

                                        $campo = $_POST['buscarPor'];
                                        $parametro = $_POST['parametro'];  
                                        
                                        if ($campo == 'usuario.data') {
                                            $novaData = explode('/', $parametro);                                                                                       
                                            $parametro = $novaData[2].'-'.$novaData[1].'-'.$novaData[0];                                                                                        
                                        }

                                        $select = "SELECT count(usuario.cdUsuario) AS numLinhas FROM usuario, grupo
                                      WHERE  usuario.cdGrupo = grupo.cdGrupo
                                      AND usuario.status != ? AND $campo LIKE ?";
                                        $dados = array('deletado', '%' . $parametro . '%');
                                    } else {

                                        $select = "SELECT count(cdUsuario) AS numLinhas FROM usuario WHERE status != ?";
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
                                        
                                        if ($campo == 'usuario.data') {
                                            $novaData = explode('/', $parametro);                                                                                       
                                            $parametro = $novaData[2].'-'.$novaData[1].'-'.$novaData[0];                                                                                        
                                        }

                                        $select = "SELECT usuario.*, grupo.grupo AS grupo FROM usuario, grupo
                                    WHERE usuario.cdGrupo = grupo.cdGrupo AND usuario.status != ?
                                    AND $campo LIKE ? ORDER BY $campo ASC LIMIT $offset,20";
                                        $dados = array('deletado', '%' . $parametro . '%');
                                    } else {

                                        $select = "SELECT usuario.*, grupo.grupo AS grupo FROM usuario, grupo
                                    WHERE usuario.cdGrupo = grupo.cdGrupo AND usuario.status != ?
                                    ORDER BY usuario.cdUsuario DESC LIMIT $offset,20";
                                        $dados = array('deletado');
                                    }

                                    $dados = $modelo->selecionar($select, $dados);
                                    $countAlert = 0;
                                    $countAlert = $offset;
                                    foreach ($dados as $key => $dado) {                                                                                
                                        $countAlert++;                                        
                                        $dado['usuario'] = htmlspecialchars($dado['usuario']);
                                        $dado['nomeCompleto'] = htmlspecialchars($dado['nomeCompleto']);
                                        $dado['instituicao'] = htmlspecialchars($dado['instituicao']);
                                        $dado['curso'] = htmlspecialchars($dado['curso']);                                        
                                        $dado['senha'] = htmlspecialchars($dado['senha']);
                                        $dado['grupo'] = htmlspecialchars($dado['grupo']);
                                        $dado['email'] = htmlspecialchars($dado['email']);
                                        $dado['data'] = htmlspecialchars($dado['data']);
                                        $dado['data'] = date("d/m/Y H:i", strtotime($dado['data']));
                                        $dado['data'] = preg_replace('/ /', ' as ', $dado['data']);                                        
                                        ?>

                                        <tr>                                                                                        
                                            <td><?php echo $countAlert; ?></td>
                                            <td><?php echo $dado['usuario']; ?></td>
                                            <td><?php echo $dado['nomeCompleto']; ?></td>
                                            <td><?php echo $dado['instituicao']; ?></td>
                                            <td><?php echo $dado['curso']; ?></td>
                                            <!--<td><?php // echo $dado['senha']; ?></td>-->
                                            <td><?php echo $dado['grupo']; ?></td>
                                            <!--<td><?php // echo $dado['email']; ?></td>-->
                                            <td><?php echo $dado['data']; ?></td>
                                            <td><div onclick="ativaOuInativarUsuarios(<?php echo $dado['cdUsuario']; ?>, this);" class="<?php echo ($dado['status'] == 'ativo')?'status_ativo':'status_inativo'; ?>" ><?php echo $dado['status']; ?></div></td>

                                            <td style="width: 105px;">
                                                <button type="button" class="btn btn-danger" title="Excluir conta" data-toggle="modal" data-target="#excluir<?php echo $dado['cdUsuario'] ?>"><span class="glyphicon glyphicon-trash"></span></button>

                                                <button type="button" class="btn btn-success" title="Ver e/ou editar os dados!" data-toggle="modal" data-target="#editarConta<?php echo $dado['cdUsuario'] ?>"><span class="glyphicon glyphicon-edit"></span></button>
                                                <!--MODAL DE EXCLUSÃO-->

                                                <div id="excluir<?php echo $dado['cdUsuario'] ?>" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="gridSystemModalLabel">
                                                    <div class="modal-dialog" role="document">
                                                        <form class="form-horizontal" action="../controle/Usuario.php" method="post">
                                                            <div class="modal-content">

                                                                <div class="modal-header" style="background-color: #d43f3a; color: white">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Fexar"><span aria-hidden="true">&times;</span></button>
                                                                    <h4 class="modal-title" id="gridSystemModalLabel">Deseja realmente excuir este Usuário ?</h4>
                                                                </div>

                                                                <div class="modal-body">

                                                                    <input type="hidden" name="cdGrupo" value="<?php echo $dado['cdGrupo']; ?>">
                                                                    <input type="hidden" name="cdUsuario" value="<?php echo $dado['cdUsuario']; ?>">

                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-info-sign"></span></span>
                                                                        <input disabled="true" type="text" minlength="10" maxlength="200" value="<?php echo $dado['nomeCompleto']; ?>" class="form-control" required placeholder="Nome Completo" title="Seu nome completo: Apenas letras: Maximo 200 caracteres" aria-describedby="sizing-addon2">
                                                                    </div>

                                                                    <br>

                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-home"></span></span>
                                                                        <input disabled="true" type="text" minlength="3" maxlength="500" value="<?php echo $dado['instituicao']; ?>" class="form-control" required placeholder="Instituição" title="Instituiçao onde estuda/trabalha" aria-describedby="sizing-addon2">
                                                                    </div>

                                                                    <br>

                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-education"></span></span>
                                                                        <input disabled="true" type="text" minlength="2" maxlength="200" value="<?php echo $dado['curso']; ?>" class="form-control" required placeholder="Curso" title="Curso que esta ingressado ou leciona" aria-describedby="sizing-addon2">
                                                                    </div>

                                                                    <br>
                                                                    
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" id="sizing-addon2">
                                                                            <span class="glyphicon glyphicon-user"></span>
                                                                        </span>
                                                                        <input minlength="3" maxlength="20" type="text" class="form-control" value="<?php echo $dado['usuario']; ?>" disabled required placeholder="Usuário" pattern="[a-zA-Z0-9]+" title="Nome de usuário da conta." aria-describedby="sizing-addon2">
                                                                    </div>

                                                                    <br>

                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" id="sizing-addon2">
                                                                            <span class="glyphicon glyphicon-lock"></span>
                                                                        </span>
                                                                        <input type="text" pattern="\S+" minlength="3" maxlength="20" class="form-control" value="<?php echo $dado['senha']; ?>" disabled required placeholder="Senha" title="Senha do usuário" aria-describedby="sizing-addon2">
                                                                    </div>

                                                                    <br>

                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" id="sizing-addon2">@</span>
                                                                        <input type="email" class="form-control" disabled pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" value="<?php echo $dado['email']; ?>" placeholder="email" title="Este e-mail pode ser utilizado para recuperar a senha da sua conta" aria-describedby="sizing-addon2">
                                                                    </div>

                                                                    <br>

                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-calendar"></span></span>
                                                                        <input type="text" class="form-control" disabled value="<?php echo $dado['data']; ?>" placeholder="data" title="Esta é a data e hora de cadastramento da conta." aria-describedby="sizing-addon2">
                                                                    </div>

                                                                    <br>

                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-flash"></span></span>
                                                                        <input type="text" class="form-control" disabled value="<?php echo $dado['grupo']; ?>" placeholder="Grupo" title="Este é a grupo deste usuário." aria-describedby="sizing-addon2">
                                                                    </div>
                                                                    
                                                                    <br>
                                                                    
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-sort"></span></span>
                                                                        <input type="text" class="form-control" disabled value="<?php echo $dado['status']; ?>" placeholder="Grupo" title="Este é a status deste usuário." aria-describedby="sizing-addon2">
                                                                    </div>

                                                                </div>

                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Não</button>
                                                                    <button type="submit" value="ExcluirUsuario" name="acao" class="btn btn-danger">Sim</button>
                                                                </div>

                                                            </div><!-- /.modal-content -->
                                                        </form>
                                                    </div><!-- /.modal-dialog -->
                                                </div><!-- /.modal -->

                                                <!--Modal de visualização e edição de dado-->
                                                <div id="editarConta<?php echo $dado['cdUsuario'] ?>" class="modal fade" data-keyboard="false" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="gridSystemModalLabel">

                                                    <div class="modal-dialog" role="document">

                                                        <div class="modal-content">

                                                            <div class="modal-header" style="background-color: #4cae4c; color: white;">
                                                                <a  class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></a>
                                                                <h4 class="modal-title" id="gridSystemModalLabel">Usuário: <?php echo $dado['usuario']; ?></h4>
                                                            </div>

                                                            <form name="alterarUsuarioF" class="editarUsuarioForm" action="../controle/Usuario.php" method="post">

                                                                <input type="hidden" name="cdGrupo" value="<?php echo $dado['cdGrupo']; ?>">
                                                                <input type="hidden" name="cdUsuario" value="<?php echo $dado['cdUsuario']; ?>">

                                                                <div class="modal-body">
                                                                    
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-info-sign"></span></span>
                                                                        <input id="nomeCompleto<?php echo $dado['cdUsuario'] ?>" name="nomeCompleto" disabled="true" type="text" minlength="10" maxlength="200" value="<?php echo $dado['nomeCompleto']; ?>" class="form-control input_verific_editar" required placeholder="Nome Completo" title="Seu nome completo: Apenas letras: Maximo 200 caracteres" aria-describedby="sizing-addon2">
                                                                        <span class="input-group-btn">
                                                                            <button id="editarNome<?php echo $dado['cdUsuario'] ?>" class="btn btn-default" title="Clique para editar o nome de usuário" onclick="editarInput(document.getElementById('editarNome<?php echo $dado['cdUsuario'] ?>'), document.getElementById('nomeCompleto<?php echo $dado['cdUsuario'] ?>'))" type="button">Editar</button>
                                                                        </span>
                                                                    </div>

                                                                    <br>

                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-home"></span></span>
                                                                        <input id="instituicao<?php echo $dado['cdUsuario'] ?>" name="instituicao" disabled="true" type="text" minlength="3" maxlength="500" value="<?php echo $dado['instituicao']; ?>" class="form-control input_verific_editar" required placeholder="Instituição" title="Instituiçao onde estuda/trabalha" aria-describedby="sizing-addon2">
                                                                        <span class="input-group-btn">
                                                                            <button id="editarInstituicao<?php echo $dado['cdUsuario'] ?>" class="btn btn-default" title="Clique para editar o nome de usuário" onclick="editarInput(document.getElementById('editarInstituicao<?php echo $dado['cdUsuario'] ?>'), document.getElementById('instituicao<?php echo $dado['cdUsuario'] ?>'))" type="button">Editar</button>
                                                                        </span>
                                                                    </div>

                                                                    <br>

                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-education"></span></span>
                                                                        <input id="curso<?php echo $dado['cdUsuario'] ?>" name="curso" disabled="true" type="text" minlength="2" maxlength="200" value="<?php echo $dado['curso']; ?>" class="form-control input_verific_editar" required placeholder="Curso" title="Curso que esta ingressado ou leciona" aria-describedby="sizing-addon2">
                                                                        <span class="input-group-btn">
                                                                            <button id="editarCurso<?php echo $dado['cdUsuario'] ?>" class="btn btn-default" title="Clique para editar o nome de usuário" onclick="editarInput(document.getElementById('editarCurso<?php echo $dado['cdUsuario'] ?>'), document.getElementById('curso<?php echo $dado['cdUsuario'] ?>'))" type="button">Editar</button>
                                                                        </span>
                                                                    </div>
                                                                    
                                                                    <br>

                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" id="sizing-addon2">
                                                                            <span class="glyphicon glyphicon-user"></span>
                                                                        </span>
                                                                        <input name="usuario" id="usuario<?php echo $dado['cdUsuario'] ?>" minlength="3" maxlength="20" type="text" class="form-control input_verific_editar" value="<?php echo $dado['usuario']; ?>" disabled required placeholder="Usuário" pattern="[a-zA-Z0-9]+" title="Insira um nome de usuário: Apenas letras e números: Maximo 20 caracteres" aria-describedby="sizing-addon2">
                                                                        <span class="input-group-btn">
                                                                            <button id="editarUsuario<?php echo $dado['cdUsuario'] ?>" class="btn btn-default" title="Clique para editar o nome de usuário" onclick="editarInput(document.getElementById('editarUsuario<?php echo $dado['cdUsuario'] ?>'), document.getElementById('usuario<?php echo $dado['cdUsuario'] ?>'))" type="button">Editar</button>
                                                                        </span>
                                                                    </div>

                                                                    <br>

                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" id="sizing-addon2">
                                                                            <span class="glyphicon glyphicon-lock"></span>
                                                                        </span>
                                                                        <input name="senha" id="senha<?php echo $dado['cdUsuario'] ?>" type="text" pattern="\S+" minlength="3" maxlength="20" class="form-control input_verific_editar" value="<?php echo $dado['senha']; ?>" disabled required placeholder="Senha atual" title="Digite a senha atual: Maximo 20 caracteres, exceto espaços em branco" aria-describedby="sizing-addon2">
                                                                        <span class="input-group-btn">
                                                                            <button id="editarSenha<?php echo $dado['cdUsuario'] ?>" class="btn btn-default" title="Clique para editar a senha" onclick="editarInput(document.getElementById('editarSenha<?php echo $dado['cdUsuario'] ?>'), document.getElementById('senha<?php echo $dado['cdUsuario'] ?>'))" type="button">Editar</button>
                                                                        </span>
                                                                    </div>

                                                                    <br>

                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" id="sizing-addon2">@</span>
                                                                        <input name="email" id="email<?php echo $dado['cdUsuario'] ?>" type="email" class="form-control input_verific_editar" disabled pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" value="<?php echo $dado['email']; ?>" placeholder="email" title="Este e-mail pode ser utilizado para recuperar a senha da sua conta" aria-describedby="sizing-addon2">
                                                                        <span class="input-group-btn">
                                                                            <button id="editarEmail<?php echo $dado['cdUsuario'] ?>" class="btn btn-default" title="Clique para editar o e-mail do usuário" onclick="editarInput(document.getElementById('editarEmail<?php echo $dado['cdUsuario'] ?>'), document.getElementById('email<?php echo $dado['cdUsuario'] ?>'))" type="button">Editar</button>
                                                                        </span>
                                                                    </div>

                                                                    <br>
                                                                    
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-sort"></span></span>
                                                                        <select disabled="true" id="status<?php echo $dado['cdUsuario'] ?>" title="Selecione o status" required name="status" class="form-control">                                    
                                                                            <option <?php echo ($dado['status'] == 'ativo')?'selected':''; ?> value="ativo">Ativo</option>
                                                                            <option <?php echo ($dado['status'] == 'inativo')?'selected':''; ?> value="inativo">Inativo</option>
                                                                        </select>
                                                                        <span class="input-group-btn">
                                                                            <button id="editarStatus<?php echo $dado['cdUsuario'] ?>" class="btn btn-default" title="Clique para editar o e-mail do usuário" onclick="editarInput(document.getElementById('editarStatus<?php echo $dado['cdUsuario'] ?>'), document.getElementById('status<?php echo $dado['cdUsuario'] ?>'))" type="button">Editar</button>
                                                                        </span>
                                                                    </div>
                                                                    
                                                                    <br>

                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-flash"></span></span>
                                                                        <input name="grupo" type="text" class="form-control" disabled value="<?php echo $dado['grupo']; ?>" placeholder="Grupo" title="Este é a grupo deste usuário." aria-describedby="sizing-addon2">
                                                                    </div>

                                                                    <br>

                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-calendar"></span></span>
                                                                        <input name="data" type="text" class="form-control" disabled value="<?php echo $dado['data']; ?>" placeholder="data" title="Esta é a data e hora de cadastramento da conta." aria-describedby="sizing-addon2">
                                                                    </div>


                                                                </div>

                                                                <div class="modal-footer">
                                                                    <div class="row">
                                                                        <div class="col-sm-4  col-sm-offset-8">
                                                                            <a data-dismiss="modal" class="btn btn-default">Cancelar</a>
                                                                            <button name="acao" type="submit" value="EditarUsuario" class="btn btn-success">Salvar</button>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </form>

                                                        </div>

                                                    </div><!-- /.modal-content -->

                                                </div><!--Fim modal-->

                                                <!--FIM DOS MODAIS-->

                                            </td>

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

                            <form name="paginacao" action="usuariosADM.php" method="post">

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

                    </div><!--Fim do painel-->

                </div>

            </div>

        </section>

        <!--Minhas verificações -->
        <script src="js/verificacoes.js"></script>
        <script src="js/jquery.maskedinput.js"></script>
        <script>
            var teste = 0;
            $(document).ready( function () {
                $('#cadastrarUsuarioForm').submit( function () {                   
                   $('.input_verific').each( function () {
                        if ($(this).val().length === 0 || !$(this).val().trim()) {
                            $(this).val('');                           
                            teste++;
                        } else {
                            $(this).val($(this).val().trim());
                        }
                    });
                    if (teste > 0) {
                        teste = 0;
                        return false;                        
                    }                    
                });
                
                $('.editarUsuarioForm').submit( function () {                   
                   $('.input_verific_editar').each( function () {
                        if ($(this).val().length === 0 || !$(this).val().trim()) {
                            $(this).val('');                           
                            teste++;
                        } else {
                            $(this).val($(this).val().trim());
                        }
                    });
                    if (teste > 0) {
                        teste = 0;
                        return false;                        
                    }                    
                });
                
                $('.buscar_por_select').change( function () {                    
                    if ($(this).val() == 'usuario.data') {                        
                        $('.parametro_da_busca').mask('99/99/9999');
                    }
                    $('.parametro_da_busca').focus();
                });
                
                <?php if ($_POST['buscarPor'] == 'usuario.data') { ?>
                        $('.parametro_da_busca').mask('99/99/9999');
                <?php } ?>
                
            });
            
            function ativaOuInativarUsuarios(cdUsuario, obj) {
                var status = $(obj).text();
                $.post( "../controle/Usuario.php", { statusJqueryPost: status, cdUsuarioJqueryPost: cdUsuario, acao: "ativaOuInativarUsuarios" })
                .done(function( resultado ) {
                    if (resultado == 'ativado') {
                        $(obj).removeClass('status_inativo');
                        $(obj).addClass('status_ativo');
                        $(obj).html('ativo');
                        $('#status'+cdUsuario+' option').each( function () {
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
                        $('#status'+cdUsuario+' option').each( function () {
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
