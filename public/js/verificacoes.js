
function validarSenha(senha, confirmarSenha, botao) {

    if ((senha.value != '') && (confirmarSenha.value != '')) {

        if (senha.value != confirmarSenha.value) {
            confirmarSenha.style.borderColor = '#d43f3a';
            confirmarSenha.title = 'Senhas não conferem';
            botao.type = 'button';
            botao.name = 'botao';

            document.getElementById('alertaSenhaIncorreta').style = 'display:block;';

            if (document.getElementById('alertaSenhaIncorretaUsuariosADM') != null) {
                document.getElementById('alertaSenhaIncorretaUsuariosADM').style = 'display:block;';
            }

        } else {
            confirmarSenha.style.borderColor = "#4cae4c";
            confirmarSenha.title = "Senhas corretas";
            botao.type = "submit";
            botao.name = 'acao';

            document.getElementById('alertaSenhaIncorreta').style = 'display:none;';

            if (document.getElementById('alertaSenhaIncorretaUsuariosADM') != null) {
                document.getElementById('alertaSenhaIncorretaUsuariosADM').style = 'display:none;';
            }

        }

    }

}


function editarInput(botao, input) {

    if (input.disabled == 1) {
        input.disabled = 0;
        document.getElementById('acaoEditar').type = 'submit';
    }

    if (botao.value == 'editarSenha') {
        document.getElementById('altSenha').style.display = 'block';
        document.getElementById('novaSenha').disabled = 0;
        document.getElementById('confirmarSenha').disabled = 0;
        document.getElementById('acaoEditar').type = 'submit';
    }

}

function clicarBotao(botao) {
    document.getElementById("estruturaPrincipal").style = "margin:2px; min-width:24%;";
    document.getElementById("declaracaoVariaveis").style = "margin:2px; min-width:24%;";
    document.getElementById("leituraEscrita").style = "margin:2px; min-width:24%;";
    document.getElementById("estruturaControle").style = "margin:2px; min-width:24%;";
    document.getElementById("estruturaRepeticao").style = "margin:2px; min-width:24%;";
    document.getElementById("operadoresMatematicos").style = "margin:2px; min-width:24%;";
    document.getElementById("operadoresLogicos").style = "margin:2px; min-width:24%;";
    document.getElementById("informacoesAdicionais").style = "margin:2px; min-width:24%;";
    botao.style = "background-color: #2e6da4; color:white; border-color: #2e6da4;margin:2px; min-width:24%;";
}


function marcarTempo(tempoTotalQuestao) {

    //Existem nos formularios de envio para validação da questão (questãoTipo1,questãoTipo2,questãoTipo3) uma propriedade onsubmit que quando ativada também unseta o cookie to timer
    //Convertendo o tempo total que vem em minutos, para milisegundos
    tempoTotalQuestao = tempoTotalQuestao * 60 * 1000;

    //Pegando o tempo que ira equivaler a 1% do total
    milesegundosAvancar = (tempoTotalQuestao * 1) / 100;

    //Setando a baarra de tempo a cada -1% do tempo total que ele possui para responder
    //dividi por 10 para a barra ir diminuindo mais detalhadamnete
    milesegundosAvancar = milesegundosAvancar / 10;
    tempo = window.setInterval(setarBarraTempo, milesegundosAvancar);

}

function setarBarraTempo() {

    porcentagemAtual = localStorage.getItem('porcentagemAtualCookie');

    if (porcentagemAtual == null) {
        porcentagemAtual = '100%';
    }

    barraTempo = document.getElementById('barraTempo');
    porcentagemAtual = parseFloat(porcentagemAtual);

    if (porcentagemAtual > -1) {

        porcentagemAtual = porcentagemAtual - 0.1;
        localStorage.setItem('porcentagemAtualCookie', porcentagemAtual);

    } else {

        //Pegando o botão que contem a ação de pular a questão
        pulo = document.getElementById('pularQuestao');

        //Pegando os inputs radios e retirando o required deles para poder conseguir envias os dados para a classe AlgTot
        var radios = document.querySelectorAll("input.radiosEnviar");
        for (var i = 0; i < radios.length; i++) {
            radios[i].required = false;
        }
        //Parando a execução do setInterval
        window.clearInterval(tempo);
        //Removendo dos cookies a variavel que auxilia na marcação do tempo
        localStorage.removeItem('porcentagemAtualCookie');
        //Chamando a função que ira fazer ir para outra questão
        pulo.click();

    }

    porcentagemAtual = porcentagemAtual + '%';
    barraTempo.style.width = porcentagemAtual;
}
