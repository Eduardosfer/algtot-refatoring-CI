<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Tradutor
 *
 * @author EduSfer
 */
require_once("../modelo/Modelo.php");

Class Tradutor {

    private $codigoTraduzido;
    private $codigoPortugol;
    private $escrevas;

    public function __construct() {        
        if (!isset($_POST['acao'])) {
            $_POST['acao'] = "";
        }
    }

    public function executar($codigo) {

        //PARA FUNCIONAR MELHOR Ã‰ PRECISO RETIRAR AS COISAS QUE ESTÃƒO ENTRE ASPAS DUPLAS E SIMPLES, E RECOLOCAR NO FINAL

        $this->setCodigoTraduzido($codigo);
        $this->setCodigoPortugol($codigo);

        //Tirando espaÃ§os em branco do inicio e fim do codigo
        $this->codigoTraduzido = trim($this->codigoTraduzido);
        $this->codigoPortugol = trim($this->codigoPortugol);

        //Retirando as crases soltas
        $this->codigoTraduzido = preg_replace('/`/', '', $this->codigoTraduzido);

        if ((isset($this->codigoPortugol) && ($this->codigoPortugol != ''))) {
            $this->traduzir();
        }
    }

    public function traduzir() {

        //APRIMORAR A TRADUÃ‡ÃƒO UTILIZANDO A SENTENÃ‡A COMPLETA POR EXEMPLO preg_replace('/\se(o que vier aqui)entao(conteudo)fimse\b/', 'if(${1}){${2}}', $this->codigoTraduzido);
        //REVISAR ESSAS FUNÃ‡OES DE TRADUÃ‡ÃƒO POR QUE AGORA EU MELHOREI EM EXPRESSAO REGULAR
        $this->retirarEscrevas();
        $this->traduzirOperadoresMatematicos();
        $this->traduzirEstruturaControle();
        $this->traduzirOperadoresLogicos();
        $this->traduzirEstruturaRepeticao();
        $this->traduzirEstruturaLeitura();
        $this->restituirEscrevas();
        $this->traduzirEstruturaEscrita();
    }

    public function retirarEscrevas() {

        //Demarcando onde estÃ£o os escrevas
        $codigoEscrevas = preg_replace('/(\bescreval\b\s*\(.*\)\s*;)/', '{[([[${1}]])]}', $this->codigoTraduzido);
        $codigoEscrevas = preg_replace('/(\bescreva\b\s*.*\s*;)/', '{[([[${1}]])]}', $codigoEscrevas);

        //Setando no atributo da classe para posteriormente restituir os escrevas
        $this->escrevas = $this->getEscrevas($codigoEscrevas);
    }

    public function restituirEscrevas() {

        //Demarcar conteudo dos escrevas que foram modificados pelas outras funÃ§Ãµes de traduÃ§ao
        $codigoEscrevasModificados = preg_replace('/(\bescreval\b\s*\(.*\)\s*;)/', '{[([[${1}]])]}', $this->codigoTraduzido);
        $codigoEscrevasModificados = preg_replace('/(\bescreva\b\s*.*\s*;)/', '{[([[${1}]])]}', $codigoEscrevasModificados);

        //Pegando os escrevas modificados
        $escrevasModificados = $this->getEscrevas($codigoEscrevasModificados);

        //Substituir os caracters especias que estÃ£o dentro dos escrevas modificados
        $charEspeciais = array('/\$/', '/\^/', '/\*/', '/\(/', '/\)/', '/\+/', '/\{/', '/\}/', '/\[/', '/\]/', '/\\\/', '/\|/', '/\?/', '/\-/', '/\./');
        $replace = array('\$', '\^', '\*', '\(', '\)', '\+', '\{', '\}', '\[', '\]', '\\\\', '\|', '\?', '\-', '\.');

        $escrevasModificados = preg_replace($charEspeciais, $replace, $escrevasModificados);

        //Transformando em varios vetores para poder utilizar no foreach
        $escrevasModificados = explode("`", $escrevasModificados);
        $this->escrevas = explode("`", $this->escrevas);

        $i = 0;

        while ($this->escrevas[$i] != null) {

            $escrevaModificado = $escrevasModificados[$i];
            $escreva = $this->escrevas[$i];

            //Agora Ã© sÃ³ substituir os escrevas modificados pelos que estÃ£o livres de traduÃ§Ãµes erradas
            $this->codigoTraduzido = preg_replace("/" . $escrevaModificado . "/", $escreva, $this->codigoTraduzido);

            $i++;
        }
    }

    public function getEscrevas($codigoEscrevas) {

        //Transformando a string do cÃ³digo em um vetor
        $testeEscrevas = str_split($codigoEscrevas);

        //Varrendo o vetor para encontrar o padÃ£o anteriormente setado onde estÃ£o os escrevas que foram anteriormente setados
        $i = 0;
        $i2 = 0;
        $escrevas = "";
        foreach ($testeEscrevas as $teste) {

            if (!isset($testeEscrevas[$i + 5])) {
                break;
            }

            if (($testeEscrevas[$i] == '{') && ($testeEscrevas[$i + 1] == '[') && ($testeEscrevas[$i + 2] == '(') && ($testeEscrevas[$i + 3] == '[') && ($testeEscrevas[$i + 4] == '[')) {
                $i2 = $i + 5;

                //Setando os escrevas
                while (($testeEscrevas[$i2] != ']') && ($testeEscrevas[$i2] != null)) {
                    $escrevas = $escrevas . $testeEscrevas[$i2];
                    $i2++;
                }

                $i = $i2;

                $escrevas = $escrevas . "`";
            }

            $i++;
        }

        //Retornando o vetor contendo os escrevas
        return $escrevas;
    }

    public function traduzirEstruturaEscrita() {

        $this->codigoTraduzido = preg_replace('/\bescreval\b\s*\((.*)\)\s*;/', 'document.write(${1}' . '+"<br>"' . ");", $this->codigoTraduzido);
        $this->codigoTraduzido = preg_replace('/\bescreva\b\s*(.*)\s*;/', 'document.write${1};', $this->codigoTraduzido);
    }

    public function traduzirEstruturaLeitura() {

        //SÃ³ posso ler se a a variavel for declarada por isso apensa chamo o metodo de traduzir vairiaveis, ja que este faz a traduÃ§Ã£o da leitura somente quando as variaveis foram declaradas
        $this->traduzirVariaveis();
    }

    public function traduzirVariaveis() {

        //sintaxe: variavel inteiro var1,var2,var3; (palavra variavel) (tido da variavel) (nome da variavel),(pode existir outras variaveis separadas por virgula);
        //tipos: inteiro, real, caractere: mas sÃ³ preciso converter os tipos inteiro e real;
        $this->traduzirVariaveisInteiras();
        $this->traduzirVariaveisReais();
        $this->traduzirVariaveisCaracteres();
    }

    public function traduzirVariaveisInteiras() {

        //variavel inteiro    num1 = 10,    num2, n='ola',  t="teste";
        //Demarcando onde estÃ£o as variaveis inteiras
        $codigoInteiras = preg_replace('/variavel\s+inteiro\s+(.+)\s*;/', '{[([[${1}]])]}', $this->codigoTraduzido);

        //Retirando espaÃ§os em branco
        $codigoInteiras = preg_replace('/\s/', '', $codigoInteiras);

        //Retirando aspas simples inicializados com as variaveis
        $codigoInteiras = preg_replace("/'/", "", $codigoInteiras);

        //Retirando aspas duplas inicializados com as variaveis
        $codigoInteiras = preg_replace('/"/', '', $codigoInteiras);

        //Retirando numeros ou outras variaveis que a variavel possa estar recebendo
        $codigoInteiras = preg_replace('/=\s*\w+/', '', $codigoInteiras);

        //pegando as variaveis declaradas do tipo inteiro
        $variaveisInteiras = explode(",", $this->getVariaveis($codigoInteiras));

        //Substituindo as declaraÃ§Ãµes de variaveis inteiras do codigo
        $this->codigoTraduzido = preg_replace('/variavel\s+inteiro\s+(\w+)/', 'var ${1}', $this->codigoTraduzido);

        foreach ($variaveisInteiras as $variavelInteira) {

            if ($variavelInteira != null) {
                //Agora Ã© sÃ³ substituir as variaveis pelos parseInt delas mesmas
                $this->codigoTraduzido = preg_replace('/(leia)\s*\(\s*(' . $variavelInteira . ')\s*\)\s*;/', '${2}=prompt("Entre com o valor de: ${2}");${2}=parseInt(${2});', $this->codigoTraduzido);
            }
        }
    }

    public function traduzirVariaveisReais() {

        //Demarcando onde estÃ£o as variaveis reais
        $codigoReais = preg_replace('/variavel\s+real\s+(.+)\s*;/', '{[([[${1}]])]}', $this->codigoTraduzido);

        //Retirando espaÃ§os em branco
        $codigoReais = preg_replace('/\s/', '', $codigoReais);

        //Retirando numeros ou outras variaveis que a variavel possa estar recebendo
        $codigoReais = preg_replace('/=\s*\w+/', '', $codigoReais);

        //pegando as variaveis declaradas do tipo real
        $variaveisReais = explode(",", $this->getVariaveis($codigoReais));

        //Substituindo as declaraÃ§Ãµes de variaveis reais do codigo
        $this->codigoTraduzido = preg_replace('/variavel\s+real\s+(\w+)/', 'var ${1}', $this->codigoTraduzido);

        foreach ($variaveisReais as $variavelReal) {

            if ($variavelReal != null) {
                //Agora Ã© sÃ³ substituir as variaveis pelos parseFloat delas mesmas
                $this->codigoTraduzido = preg_replace('/(leia)\s*\(\s*(' . $variavelReal . ')\s*\)\s*;/', '${2}=prompt("Entre com o valor de: ${2}");${2}=parseFloat(${2});', $this->codigoTraduzido);
            }
        }
    }

    public function traduzirVariaveisCaracteres() {

        //Demarcando onde estÃ£o as variaveis caracteres
        $codigoCaracteres = preg_replace('/variavel\s+caractere\s+(.+)\s*;/', '{[([[${1}]])]}', $this->codigoTraduzido);

        //Retirando espaÃ§os em branco
        $codigoCaracteres = preg_replace('/\s/', '', $codigoCaracteres);

        //Retirando aspas simples inicializados com as variaveis
        $codigoCaracteres = preg_replace("/'/", "", $codigoCaracteres);

        //Retirando aspas duplas inicializados com as variaveis
        $codigoCaracteres = preg_replace('/"/', '', $codigoCaracteres);

        //Retirando numeros ou outras variaveis que a variavel possa estar recebendo
        $codigoCaracteres = preg_replace('/=\s*\w+/', '', $codigoCaracteres);

        //pegando as variaveis declaradas do tipo caractere
        $variaveisCaractetes = explode(",", $this->getVariaveis($codigoCaracteres));

        //Substituindo as declaraÃ§Ãµes de variaveis caractere do codigo
        $this->codigoTraduzido = preg_replace('/variavel\s+caractere\s+(\w+)/', 'var ${1}', $this->codigoTraduzido);

        foreach ($variaveisCaractetes as $variavelCaractere) {

            if ($variavelCaractere != null) {
                //Agora Ã© sÃ³ substituir a estrutura de leitura
                $this->codigoTraduzido = preg_replace('/(leia)\s*\(\s*(' . $variavelCaractere . ')\s*\)\s*;/', '${2}=prompt("Entre com o valor de: ${2}");', $this->codigoTraduzido);
            }
        }
    }

    public function getVariaveis($codigoVariaveis) {

        //Transformando a string do cÃ³digo em um vetor
        $testeVariaveis = str_split($codigoVariaveis);

        //Varrendo o vetor para encontrar o padÃ£o anteriormente setado onde estÃ£o as as variaveis dos tipos que foram anteriormente setados
        $i = 0;
        $i2 = 0;
        $variaveis = "";
        foreach ($testeVariaveis as $teste) {

            if (!isset($testeVariaveis[$i + 5])) {
                break;
            }

            if (($testeVariaveis[$i] == '{') && ($testeVariaveis[$i + 1] == '[') && ($testeVariaveis[$i + 2] == '(') && ($testeVariaveis[$i + 3] == '[') && ($testeVariaveis[$i + 4] == '[')) {
                $i2 = $i + 5;

                //Setando as variaveis que sÃ£o dos tipos anteriormente marcados no metodo que chama este no vetor variaveis caracteres
                while (($testeVariaveis[$i2] != ']') && ($testeVariaveis[$i2] != null)) {
                    $variaveis = $variaveis . $testeVariaveis[$i2];
                    $i2++;
                }

                $i = $i2;

                $variaveis = $variaveis . ",";
            }

            $i++;
        }

        //retornando um vetor contendo as variaveis declaradas separadas por virgula
        return $variaveis;
    }

    public function traduzirOperadoresMatematicos() {

        //Ã‰ preciso encontrar uma forma mais inteligente de se fazer isso, pois sÃ³ posso pegar as coisas que estÃ£o fora das aspas siples
        //$this->codigoTraduzido = preg_replace('/===/', '====', $this->codigoTraduzido);
        //Traduzir o diferente //ja Ã© igual no js, mas estes "<==" e ">==" nao existe no portugol
        //$this->codigoTraduzido = preg_replace('/<==/', '====', $this->codigoTraduzido);
        //$this->codigoTraduzido = preg_replace('/>==/', '====', $this->codigoTraduzido);
        //Traduzir o diferente //ja Ã© igual no js, mas este !== nao existe no portugol
        //$this->codigoTraduzido = preg_replace('/\b!==\b/', '====', $this->codigoTraduzido);
    }

    public function traduzirEstruturaControle() {

        //se e senao - if else
        $this->codigoTraduzido = preg_replace('/\bse\b/', 'if(', $this->codigoTraduzido);
        $this->codigoTraduzido = preg_replace('/\bentao\b/', '){', $this->codigoTraduzido);
        $this->codigoTraduzido = preg_replace('/\bsenao\b/', '}else{', $this->codigoTraduzido);
        $this->codigoTraduzido = preg_replace('/\bfimse\b/', '}', $this->codigoTraduzido);

        //escolha caso - switch case
        $this->codigoTraduzido = preg_replace('/\bescolha\s*(\w*)\b/', 'switch (${1}){', $this->codigoTraduzido);
        $this->codigoTraduzido = preg_replace('/\bfimescolha\b/', '}', $this->codigoTraduzido);
        $this->codigoTraduzido = preg_replace('/caso\s*([\'\"]?\w*[\'\"]?)((\s*.*\s*;)*)/', 'case ${1}: ${2} break;', $this->codigoTraduzido);
    }

    public function traduzirEstruturaRepeticao() {

        //enquanto - while
        $this->codigoTraduzido = preg_replace('/\benquanto(.*)faca\b/', 'while(${1}){', $this->codigoTraduzido);
        $this->codigoTraduzido = preg_replace('/\bfimenquanto\b/', '}', $this->codigoTraduzido);

        //para - for
        $this->codigoTraduzido = preg_replace('/\bpara\s+(\w+)\s+de\s+(\w+)\s+ate\s+(\w+)\s+faca\b/', 'for(${1}=${2};${1}<=${3};${1}++){', $this->codigoTraduzido);
        $this->codigoTraduzido = preg_replace('/\bfimpara\b/', '}', $this->codigoTraduzido);

        //repita ate - do while
        $this->codigoTraduzido = preg_replace('/\brepita\b/', 'do{', $this->codigoTraduzido);
        $this->codigoTraduzido = preg_replace('/\bate\s+(.*)/', '} while (${1});', $this->codigoTraduzido);
    }

    public function traduzirOperadoresLogicos() {

        //e - &&
        $this->codigoTraduzido = preg_replace('/\)\s*e\s*\(/', ')&&(', $this->codigoTraduzido);

        //ou - ||
        $this->codigoTraduzido = preg_replace('/\)\s*ou\s*\(/', ')||(', $this->codigoTraduzido);
    }

    public function setCodigoTraduzido($codigoTraduzido) {
        $this->codigoTraduzido = $codigoTraduzido;
    }

    public function setCodigoPortugol($codigoPortugol) {
        $this->codigoPortugol = $codigoPortugol;
    }

    public function getCodigoTraduzido() {
        return $this->codigoTraduzido;
    }

    public function getCodigoPortugol() {
        return $this->codigoPortugol;
    }

}
