<!-- MODAL DE VISUALIZAÇÃO DE SINTAXE DO PORTUGOL-->
<?php include_once("includs/modalSintaxePortugol.php"); ?>

<!-- MODAIS DE ALERTAS -->
<?php include_once("includs/modaisAlertas.php"); ?>

<nav id="mainNav" class="navbar navbar-default navbar-fixed-top">

    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">

            <button id="botaoFecharMenuHam" type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Alterar Navegação</span><span class="glyphicon glyphicon-menu-hamburger"></span><i class="fa fa-bars"></i>
            </button>

            <a class="navbar-brand page-scroll" href="principal.php">AlgTot</a>

        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

            <ul class="nav navbar-nav navbar-right">

                <li>
                    <a class="page-scroll" href="#"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <?php echo $_SESSION['usuario']; ?></a>
                </li>
                <li>
                    <a class="page-scroll" href="#"><span class="glyphicon glyphicon-star" aria-hidden="true"></span> Pontuação Total: <?php echo $_SESSION['pontuacaoTotal']; ?></a>
                </li>
                <li>
                    <a class="page-scroll" data-toggle="modal" data-target="#verDados" href="#"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Perfil</a>
                </li>
                <li>
                    <a name="acaoSintaxe" value="sintaxe" data-toggle="modal" data-target="#sintaxe" href="#" class="page-scroll"><span class="glyphicon glyphicon-book"></span> Sintaxe Portugol</a> 
                </li>
                <li>
                    <a   href="tradutor.php" class="page-scroll"><span class="glyphicon glyphicon-rub"></span> Treinar Portugol</a> 
                </li>
                <li>
                    <form name="sair" action="../controle/Usuario.php" method="post">            
                        <button name="acao" value="Deslogar" type="submit" class="page-scroll-button"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Sair</button>
                    </form>
                </li>

            </ul>

        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>

<script>            
    $(document).mouseup(function(e) {
        var container = $('#bs-example-navbar-collapse-1');           
        if (!container.is(e.target) && container.has(e.target).length === 0) {
            if (container.is(':visible') == true && screen.width < 768) {
                $('#botaoFecharMenuHam').click();            
            }
        }
    });
    $(document).scroll( function () {
        if ($('#bs-example-navbar-collapse-1').is(':visible') == true && screen.width < 768) {
            $('#botaoFecharMenuHam').click();            
        }
    });
//    BLOQUEANDO A TECLA F12 E O CRL+U
    function disableF12eCtrlU(e) { 
        if ((e.which || e.keyCode) == 123) {
            e.preventDefault();
        }
        if (e.ctrlKey && (e.keyCode === 85)) {
            e.preventDefault();
        }
    };
//    BLOQUEANDO O CLIQUE DIREITO DO MOUSE
    $(document).ready( function () {
        $(document).bind("contextmenu",function(e){
            return false;
        });        
        $(document).on("keydown", disableF12eCtrlU);            
    });  
</script>