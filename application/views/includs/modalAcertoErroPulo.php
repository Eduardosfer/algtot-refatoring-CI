
<!-- MODAL DE REGISTRO ACERTO OU ERRO OU PULO -->
<div id="acertoOuerro" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">

    <div class="modal-dialog" role="document">

      <script>
        <?php

          if (isset($_SESSION['mostrarModalRegistro'])) {
            echo "$(document).ready(function() {
                    $('#acertoOuerro').modal('show');
                  });";

            $modal = $_SESSION['mostrarModalRegistro'];            
          }

        ?>
      </script>

       <div class="modal-content">

              <div class="modal-header" style="background-color: <?php if (isset($modal)){ if ($modal=='acertou'){ echo '#4cae4c;'; } if ($modal=='errou'){ echo '#d43f3a;'; } if ($modal=='pulou'){ echo '#2e6da4;'; } } ?> color: white;">

                 <button type="button" class="close" data-toggle="modal" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                 <h4 class="modal-title" id="gridSystemModalLabel">

                    <?php

                      if (isset($modal)){

                        if ($modal=='acertou'){
                          echo 'Parabéns você acertou!';
                        }

                        if ($modal=='errou'){
                          echo 'Você errou! Não fique trieste... continue tentando!';
                        }

                        if ($modal=='pulou') {
                          echo "Infelizmente você não conseguiu responder a questão a tempo!";
                        }
                      }

                    ?>

                 </h4>

             </div>

                 <div class="modal-body">

                   <?php

                     if (isset($modal)){

                       if ($modal=='acertou'){

                         //SIGNIFICA QUE ELE AINDA NÃO TINHA ACERTDO ESSA QUESTÃO ANTERIORMENTE, E POIR ISSO ELE PODE RECEBER A PONTUAÇÃO DELA
                        if ($_SESSION['acertouAnteriormente'] == null) {
                          echo "<p>Você recebeu ".$_SESSION['pontuacaoObtidaQuestao']." <span class='glyphicon glyphicon-star' aria-hidden='true'></span></p>";
                        }else {
                          echo "<p>Você acertou mas nao ganhou nenhum ponto, pois já pontuou nestá questão!</P>";
                          echo "<p>Revisar é sempre importante para aprender mais!</P>";
                        }

                       }

                       if ($modal=='errou'){
                           
                           //SIGNIFICA QUE ELE AINDA NÃO TINHA ERRADO ESSA QUESTÃO ANTERIORMENTE, E POR ISSO ELE IRA PERDER A PONTUAÇÃO DELA
                            if ($_SESSION['errouAnteriormente'] == null) {
                                echo '<p>Não desista, a percistência é a chave para a vitória!</p>';
                                echo "<p>Você perdeu ".$_SESSION['pontuacaoObtidaQuestao']." <span class='glyphicon glyphicon-star' aria-hidden='true'></span></p>";
                            }else {
                              echo "<p>Você errou mas não perdeu nenhum ponto, pois já havia errado esta questão!</P>";
                              echo "<p>Revisar é sempre importante para aprender mais!</P>";
                            }
                                                    
                       }

                       if ($modal=='pulou') {
                         echo "<p>Seja mais rápido(a) da próxima vez!</p>";
                       }
                       echo "<p>Pontuação recebida até o momento: ".$_SESSION['pontuacaoObtidaAteMomento']." <span class='glyphicon glyphicon-star' aria-hidden='true'></span></p>";
                     }

                   ?>

                </div>

                <div class="modal-footer">
                    <button name="ok" type="button" data-dismiss="modal" class="btn btn-<?php if (isset($modal)){ if ($modal=='acertou'){ echo 'success'; } if ($modal=='errou'){ echo 'danger'; } if ($modal=='pulou'){ echo 'primary'; } } ?>"><span class="glyphicon glyphicon-ok"></span> Ok</button>
                </div>

         </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
