<div id="registroFinalAtividade" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">

  <script>

    <?php

      if (isset($_SESSION['mostrarModalRegistroFinal'])) {

          echo "$(document).ready(function() {
                  $('#registroFinalAtividade').modal('show');
                });";

        $mostrarModalRegistroFinal = $_SESSION['mostrarModalRegistroFinal'];        
      }

    ?>
  </script>

    <div class="modal-dialog" role="document">

       <div class="modal-content">

              <div class="modal-header" style="background-color: <?php if (isset($_SESSION['totalQuestoesAcertadas'])){ if ($_SESSION['totalQuestoesAcertadas']>$_SESSION['totalQuestoesErradas']){ echo '#4cae4c;'; } else { echo '#d43f3a;'; } } ?> color: white;">

                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                 <h4 class="modal-title" id="gridSystemModalLabel">

                    <?php

                      if (isset($mostrarModalRegistroFinal)){
                          echo "Parabéns você terminou de responder a atividade!";
                      }

                    ?>

                 </h4>

             </div>

                 <div class="modal-body">

                   <?php

                   if (isset($mostrarModalRegistroFinal)){

                     $totalQuestoes = $_SESSION['totalQuestoesAcertadas']+$_SESSION['totalQuestoesErradas'];

                       echo "<p>Total Respondido: ".$totalQuestoes."</P>";
                       echo "<p>Total de não respondidas: ".$_SESSION['totalQuestoesPuldas']."</P>";
                       echo "<p>Total de acertos: ".$_SESSION['totalQuestoesAcertadas']."</P>";
                       echo "<p>Total de erros: ".$_SESSION['totalQuestoesErradas']."</P>";
                       echo "<p>Pontuação total obtida: ".$_SESSION['pontuacaoObtidaAteMomento']." <span class='glyphicon glyphicon-star' aria-hidden='true'></span></p>";

                       if (($_SESSION['totalQuestoesAcertadas']<$totalQuestoes)||($totalQuestoes==0)) {
                        echo "<p>Você pode continuar a responder as questões desta atividade sempre que quiser, para obter a pontuação maxima, caso ainda não tenha obtido!</P>";
                      }else {
                        echo "<p>Parabéns você respondeu corretamente todas as questões da atividade, mesmo assim pode voltar a responder esta atividade sempre que quiser!</P>";
                      }

                   }

                   ?>

                </div>

                <div class="modal-footer">
                    <button name="ok" type="button" data-dismiss="modal" class="btn btn-<?php if (isset($_SESSION['totalQuestoesAcertadas'])){ if ($_SESSION['totalQuestoesAcertadas']>$_SESSION['totalQuestoesErradas']){ echo 'success'; } else { echo 'danger'; } } ?>"><span class="glyphicon glyphicon-ok"></span> Ok</button>
                </div>

         </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
