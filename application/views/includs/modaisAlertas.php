
<!-- MODAIS DE ALERTAS DO SISTEMA -->
<div id="meuModalSucesso" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
    <div class="modal-dialog" role="document">     
        <div class="modal-content">
            
            <div class="modal-header" style="color: white!important; background-color: #4cae4c!important;">
                <button type="button" class="close" data-toggle="modal" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 id="headerMeuModalSucesso" class="modal-title">Sucesso!</h4>
            </div>

            <div class="modal-body">
                <p id="bodyMeuModalSucesso">
                    
                </p>
            </div>

            <div id="footerMeuModalSucesso" class="modal-footer">
                <button name="ok" type="button" data-dismiss="modal" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span> Ok</button>
            </div>

        </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
<div id="meuModalErro" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
    <div class="modal-dialog" role="document">     
        <div class="modal-content">
            
            <div class="modal-header" style="color: white!important; background-color: #d43f3a!important;">
                <button type="button" class="close" data-toggle="modal" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 id="headerMeuModalErro" class="modal-title">Erro!</h4>
            </div>

            <div class="modal-body">
               <p id="bodyMeuModalErro"></p>
            </div>

            <div id="footerMeuModalErro" class="modal-footer">
                <button name="ok" type="button" data-dismiss="modal" class="btn btn-danger"><span class="glyphicon glyphicon-ok"></span> Ok</button>
            </div>

        </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->

<script>            

    function chamarModal(header, body, footer, meuModal) {
        if (meuModal == 'meuModalSucesso' || meuModal == '.meuModalSucesso') {
            meuModal = '#meuModalSucesso';
        }
        if (meuModal == 'meuModalErro' || meuModal == '.meuModalErro') {
            meuModal = '#meuModalErro';
        }
        
        if (meuModal != '#meuModalSucesso' && meuModal != '#meuModalErro') {
            alert('Modal não encontrado: ' + meuModal);
            return false;
        }                
        
        if (meuModal == '#meuModalSucesso') {
            if (header != null && header != '') {
                $('#headerMeuModalSucesso').html(header);
            } else {
                $('#headerMeuModalSucesso').html('Sucesso!');
            }
            if (body != null && body != '') {
                $('#bodyMeuModalSucesso').html(body);
            } else {
                $('#bodyMeuModalSucesso').html('');
            }
            if (footer != null && footer != '') {
                $('#footerMeuModalSucesso').html(footer);
            } else {
                $('#footerMeuModalSucesso').html('<button name="ok" type="button" data-dismiss="modal" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span> Ok</button>');
            }
        }
        if (meuModal == '#meuModalErro') {
            if (header != null && header != '') {
                $('#headerMeuModalErro').html(header);
            } else {
                $('#headerMeuModalErro').html('Erro!');
            }
            if (body != null && body != '') {
                $('#bodyMeuModalErro').html(body);
            } else {
                $('#bodyMeuModalErro').html('');
            }
            if (footer != null && footer != '') {                
                $('#footerMeuModalErro').html(footer);
            } else {
                $('#footerMeuModalErro').html('<button name="ok" type="button" data-dismiss="modal" class="btn btn-danger"><span class="glyphicon glyphicon-ok"></span> Ok</button>');
            }                        
        }
                
        $(meuModal).modal('show');
        
        return true;
    }    

    <?php  
        $modal = $this->session->userdata('modal');
        if ($modal != null && $modal != '') {                                
            $header = $this->session->userdata('header');
            $body = $this->session->userdata('body');
            $footer = $this->session->userdata('footer');            
            $this->session->unset_userdata('modal');
            $this->session->unset_userdata('header');
            $this->session->unset_userdata('body');
            $this->session->unset_userdata('footer');
    ?>        
        chamarModal('<?php echo $header ?>', '<?php echo $body ?>', '<?php echo $footer ?>', '<?php echo $modal ?>');      
    <?php } ?>

</script>