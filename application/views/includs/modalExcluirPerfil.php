
<!--Modal excluir perfil-->
<div id="excluirConta" class="modal fade" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="gridSystemModalLabel">

   <div class="modal-dialog" role="document">

      <div class="modal-content">

         <div class="modal-header" style="background-color: #d43f3a; color: white;">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
           <h4 class="modal-title" id="gridSystemModalLabel">Deseja realmente abandonar o AlgTot ?</h4>
         </div>

         <form name="excluirConta" action="../controle/Usuario.php" method="post">

         <div class="modal-body">

            <p>Todos os seus dados seram perdidos!</p>
            <p>Caso queira, digite sua senha e clieque em "Sim".</p>

            <br>

            <div class="input-group">
                <span class="input-group-addon" id="sizing-addon2">
                  <span class="glyphicon glyphicon-lock"></span>
                </span>
                <input name="senhaExcluir" id="senhaExcluir" pattern="\S+" type="password" minlength="3" maxlength="20" class="form-control" required placeholder="Digite a sua senha" title="Digite a sua senha: Maximo 20 caracteres, exceto espaços em branco" aria-describedby="sizing-addon2">
              </div>

          </div>

          <div class="modal-footer">
            <button name="acao" type="button" data-dismiss="modal" class="btn btn-default"><span class="glyphicon glyphicon-remove"></span> Não</button>
            <button name="acao" value="ExcluirConta" type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-ok"></span> Sim</button>
          </div>

          </form>

      </div><!-- /.modal-content -->
    </div>
  </div><!-- /.modal-dialog -->
