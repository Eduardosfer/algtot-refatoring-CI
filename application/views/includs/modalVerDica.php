
<!-- MODAL DE VISUALIZAÇÃO DA DICA -->
<div id="verDica" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">

    <div class="modal-dialog" role="document">

       <div class="modal-content">

              <div class="modal-header" style="background-color: #286090; color: white;">

                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                 <h4 class="modal-title" id="gridSystemModalLabel">Dica da questão</h4>

             </div>

                 <div class="modal-body">
                    <p><?php if (($_SESSION['dica']=='')||($_SESSION['dica']==null)) { echo "Não existe dica para esta questão!"; }else { echo $_SESSION['dica']; } ?></p>
                </div>

                <div class="modal-footer">
                    <button name="ok" type="button" class="btn btn-primary" data-dismiss="modal"><span class="glyphicon glyphicon-ok"></span> Ok</button>
                </div>

         </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
