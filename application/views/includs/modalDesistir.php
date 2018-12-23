
<!-- MODAL DE DESISTENCIA DO USUÁRIO -->
<div id="desistir" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">

    <div class="modal-dialog" role="document">

       <div class="modal-content">

              <div class="modal-header" style="background-color: #d43f3a; color: white;">

                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                 <h4 class="modal-title" id="gridSystemModalLabel">Deseja realmente desistir?</h4>

             </div>

                 <div class="modal-body">
                    <p>Se desistir poderá refazer ou continuar esta atividade a qualquer momento que quiser!</p>
                    <p>Sua pontuação até agora é: <?php echo $_SESSION['pontuacaoObtidaAteMomento']; ?> Pontos</p>

                </div>

                <div class="modal-footer">
                    <button name="nao" type="button" data-dismiss="modal" class="btn btn-default"><span class="glyphicon glyphicon-remove"></span> Não</button>
                    <a name="sim" type="button" class="btn btn-danger" href="atividades.php"><span class="glyphicon glyphicon-ok"></span> Sim</a>
                </div>

         </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
