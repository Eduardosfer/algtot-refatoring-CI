<!-- MODAL DE VISUALIZAÇÃO DE SINTAXE -->
<div id="sintaxe" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">

    <div class="modal-dialog modal-lg" role="document">

       <div class="modal-content">

              <div class="modal-header" style="background-color: #2e6da4; color: white;">

                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                 <h4 class="modal-title" id="gridSystemModalLabel" style="text-align:center;">Clique nos botões abaixo para aprender sobre a sintaxe!</h4>

             </div>

                 <div class="modal-body">

                   <center>
                     <button type="radio" onclick="clicarBotao(this)" title="Aprenda sobre a estrutura principal do portugol" style="margin:2px; min-width:24%;" class="btn btn-default" data-parent="#collapse_radio" data-toggle="collapse" data-target="#collapse_estruturaPrincipal" name="sintaxes" id="estruturaPrincipal">1 Estrutura Principal</button>
                     <button type="radio" onclick="clicarBotao(this)" title="Aprenda sobre a declaração de variaveis" style="margin:2px; min-width:24%;" class="btn btn-default" data-parent="#collapse_radio" data-toggle="collapse" data-target="#collapse_declaracaoVariaveis" name="sintaxes" id="declaracaoVariaveis">2 Declaração de Variáveis</button>
                     <button type="radio" onclick="clicarBotao(this)" title="Aprenda sobre as funções de leitura leia() e escrita escreva()" style="margin:2px; min-width:24%;" class="btn btn-default" data-parent="#collapse_radio" data-toggle="collapse" data-target="#collapse_leituraEscrita" name="sintaxes" id="leituraEscrita">3 Função de Leitura e Escrita</button>
                     <button type="radio" onclick="clicarBotao(this)" title="Aprenda sobre as estruturas de controle (se, senao etc...)" style="margin:2px; min-width:24%;" class="btn btn-default" data-parent="#collapse_radio" data-toggle="collapse" data-target="#collapse_estruturaControle" name="sintaxes" id="estruturaControle">4 Estruturas de Controle</button>
                     <button type="radio" onclick="clicarBotao(this)" title="Aprenda sobre as estruturas de repetição (para, enquanto...)" style="margin:2px; min-width:24%;" class="btn btn-default" data-parent="#collapse_radio" data-toggle="collapse" data-target="#collapse_estruturaRepeticao" name="sintaxes" id="estruturaRepeticao">5 Estruturas de Repetição</button>
                     <button type="radio" onclick="clicarBotao(this)" title="Aprenda sobre os operadores matematicos (+,-,*...)" style="margin:2px; min-width:24%;" class="btn btn-default" data-parent="#collapse_radio" data-toggle="collapse" data-target="#collapse_operadoresMatematicos" name="sintaxes" id="operadoresMatematicos">6 Operadores Matematicos</button>
                     <button type="radio" onclick="clicarBotao(this)" title="Aprenda sobre os operadores lógicos (e e ou)" style="margin:2px; min-width:24%;" class="btn btn-default" data-parent="#collapse_radio" data-toggle="collapse" data-target="#collapse_operadoresLogicos" name="sintaxes" id="operadoresLogicos">7 Operadores Lógicos</button>
                     <button type="radio" onclick="clicarBotao(this)" title="informações adicionais" style="margin:2px; min-width:24%;" class="btn btn-default" data-parent="#collapse_radio" data-toggle="collapse" data-target="#collapse_informacoesAdicionais" name="sintaxes" id="informacoesAdicionais">8 Informações Adicionais</button>
                   </center>

                   <div class="no-style-collapse" id="collapse_radio">

                      <div class="panel panel-default" style="border:none">

                        <div id="collapse_estruturaPrincipal" class="panel-collapse collapse" style="margin-top:20px;">
                          <div class="well arrow-up">
                            <table class="table">
                              <h3>1 Estrutura Principal.</h3>
                              <tr>
                                  <td style="width:50%;">
                                    <h4>Explicação.</h4>
                                    <p>
                                        O portugol é uma linguagem que possui diversas sintaxes diferentes, (caso não saiba a sintaxe é, explicando de uma forma simplificada a forma em que você escreve o código ou seja os termos e padrões utilizados na linguagem), dessa forma aqui você pode consultar toda a sintaxe possível para a codificação dos códigos nessa versão do portugol.
                                    </p>
                                    <p>
                                      Ao lado você pode observar um exemplo onde é demonstrado um código escrito em portugol. Caso queira mais detalhes pode verificar mais afundo navegando pelos outros itens da sintaxe.
                                    </p>

                                    <p>
                                      Não é necessário colocar nada para delimitar o início e o fim do seu algoritmo, mas fique ciente que a melhor forma de começar um algoritmo é declarando as variáveis que você ira utilizar.
                                    </p>
                                    <h4>Observações.</h4>
                                    <p>
                                      *Saiba que o intuito principal dessa ferramenta é ajuda-lo a despertar ou ampliar o seu raciocínio lógico, por isso não fique tão apegado em decorar a sintaxe do portugol.
                                    </p>
                                    <p>
                                      *Use sempre letras minúsculas quando estiver usando palavras reservadas da sintaxe do portugol. Ex: escreva,leia,inteiro,real. Você pode apenas utiliza-las com as letras maiúsculas quando estiver fazendo um comentário ou colocando algum texto para aparecer na tela com a função escreva. Ex: escreva(”Leia um número Inteiro ou LEIA um número INTEIRO”);//Isso não ira interferir no código. Ex 2: //Leia um número ou LEIA um NUMERO.
                                    </p>
                                  </td>

                                  <td style="width:50%;">
                                    <h4>Exemplo(s).</h4>
                                    <p>
                                        &nbsp       //Isso é um comentario <br>
                                        &nbsp       //Logo abaixo temo as declaração das variaveis <br>
                                        &nbsp        variavel caractere ola="Ola Mundo";<br>
                                        &nbsp        variavel inteiro numero;<br><br>

                                        &nbsp         /*<br>
                                        &nbsp&nbsp&nbsp  Isso é um comentario  em varias linhas, os<br>
                                        &nbsp&nbsp&nbsp  comentario não interferem do funcionamento<br>
                                        &nbsp&nbsp&nbsp  do algoritmo.<br>
                                        &nbsp          */<br><br>

                                        &nbsp          //Essa é a função de leitura, serve para ler algo<br> //que o usuário insira<br>
                                        &nbsp          leia(numero);<br><br>

                                        &nbsp          se ola == "Ola Mundo" entao<br><br>

                                        &nbsp&nbsp&nbsp   //Essa é a função de escrita, serve para mostrar<br> // algo na tela<br>
                                        &nbsp&nbsp&nbsp   escreval(ola);<br>
                                        &nbsp&nbsp&nbsp    /*Quando se coloca um "l" no final significa<br>
                                        &nbsp&nbsp&nbsp      que é para pular uma<br>
                                        &nbsp&nbsp&nbsp      linha apos mostrar o conteudo do<br>
                                        &nbsp&nbsp&nbsp      escreva ou nesse caso escreval, caso não coloqueo éle (l)<br>
                                        &nbsp&nbsp&nbsp      o conteudo do proximo escreva ficara logo na frente do<br>
                                        &nbsp&nbsp&nbsp      anterior, esta confuso??<br>
                                        &nbsp&nbsp&nbsp      teste o exemplo para ver o que acontece<br>
                                        &nbsp&nbsp&nbsp    */<br><br>
                                        &nbsp&nbsp&nbsp   escreva(numero);<br><br>

                                        &nbsp          senao<br><br>

                                        &nbsp&nbsp&nbsp     escreva("Vish, não vai ter ola mundo!");<br><br>

                                        &nbsp          fimse<br>
                                    </p>
                                  </td>
                              </tr>
                           </table>
                          </div>
                        </div>
                      </div>


                      <div class="panel panel-default" style="border:none">
                        <div id="collapse_declaracaoVariaveis" class="panel-collapse collapse">
                          <div class="well arrow-up">
                            <table class="table">
                              <h3>2 Declaração de Variáveis.</h3>
                              <tr>
                                  <td style="width:50%;">
                                    <h4>Explicação.</h4>
                                    <p>
                                        Para se declarar uma variável é muito simples, basta escrever a palavra variável, seguida pelo tipo da variável e por último o nome da variável, você também pode colocar uma virgula no final no nome da variável e colocar outra variável, e assim sucessivamente.
                                    </p>
                                    <p>
                                      Os tipo das variáveis são:
                                    </p>

                                    <p>
                                      Inteiro (São os números inteiros);<br>
                                      real (São os números reais) ;<br>
                                      caractere (São os caracteres exemplo: abd12/?$#[])}...).<br>
                                    </p>
                                    <br>
                                    <h4>Observações.</h4>
                                    <p>
                                      *Nunca declare uma variável com o nome "var" ou "variavel", pois estas são palavras reservadas e ira acarretar no não funcionamento do seu algoritmo.
                                    </p>
                                    <p>
                                      *Nunca declare uma variável com o mesmo nome que outra, pois isto ira acarretar no não funcionamento do seu algoritmo.
                                    </p>
                                    <p>
                                      *Para atribuir os valores para uma variável do tipo caractere você deve utilizar as aspas simples(') ou aspas duplas(") ex: variável caractere testo="ola";
                                    </p>
                                    <p>
                                      *Lembre-se de utilizar um ponto e vírgula (;) no final de cada linha de declaração de variáveis, como no exemplo ao lado.
                                    </p>
                                    <p>
                                      *O nome das variáveis deve ser costituido apenas por letras e números.
                                    </p>
                                  </td>

                                  <td style="width:50%;">
                                    <h4>Exemplo(s).</h4>
                                    <p>
                                        &nbsp       //Declarando uma variavel <br>
                                        &nbsp        variavel inteiro numero;<br><br>
                                        &nbsp       //Declarando varias váriaveis do mesmo tipo na mesma linha <br>
                                        &nbsp        variavel caractere ola,teste,vari;<br><br>
                                        &nbsp       //Declarando e atribuindo valor para uma variavel<br>
                                        &nbsp        variavel real ola=1.2;<br><br>
                                        &nbsp       //Declarando multiplas variaveis e atribuindo valor<br>// para cada uma delas<br>
                                        &nbsp        variavel real ola=1.2, teste=2.1, numero2=6;<br><br>
                                        &nbsp       //Declarando variaveis caractere e atribuindo valor<br>
                                        &nbsp        variavel caractere t="ola", texto='ola mundo' ;<br>
                                    </p>
                                  </td>
                              </tr>
                           </table>
                          </div>
                        </div>
                      </div>


                      <div class="panel panel-default" style="border:none">
                        <div id="collapse_leituraEscrita" class="panel-collapse collapse">
                          <div class="well arrow-up">
                            <table class="table">
                              <h3>3 Função de Leitura e Escrita.</h3>
                              <tr>
                                  <td style="width:50%;">
                                    <h4>Explicação.</h4>
                                    <p>
                                        A função de leitura serve para que você possa ler um valor direto pelo teclado e atribui-lo assim a uma variável ex: leia(a);
                                    </p>
                                    <p>
                                      A função de escrita é utilizada para mostrar algo na tela ex: escreva(“Ola mundo”);
                                    </p>
                                    <p>
                                      Você pode também utilizar a função de escrita chamada “escreval”, essa função também serve para mostrar algo na tela, mas a diferença é que ela dá uma quebra de linha após o que foi mostrado.
                                    </p>
                                    <p>
                                      Com ambas as funções (escreva(), escreval()) você pode mostrar uma mensagem concatenando dois ou mais conteúdos, para fazer isso basta utilizar o sinal de “+” entre um conteúdo e outro ex: escreva(“ola”+texto);
                                    </p>
                                    <br>
                                    <h4>Observações.</h4>
                                    <p>
                                      *Você também pode utilizar aspas simples para mostrar mensagens na tela utilizando o escreva('ola');, ou o escreval('ola');
                                    </p>
                                    <p>
                                      *Lembre-se de sempre utilizar um ponto e virgula (;) após a utilização de cada uma dessas funções leia(); escreve(); escreval();
                                    </p>
                                    <p>
                                      *Não precisa se preocupar tanto com este termo "função", apenas entenda que ele significa uma ação que elas podem fazer, como ler algo ou mostrar algo.
                                    </p>
                                    <p>
                                      *Este sinal de "+" também é utilizado para a soma, mas somente quando ele está entre duas variaveis do tipo inteiro ou real ou entre dois numeros;
                                    </p>
                                  </td>

                                  <td style="width:50%;">
                                    <h4>Exemplo(s).</h4>
                                    <p>
                                        &nbsp       //Declarando uma variavel <br>
                                        &nbsp        variavel inteiro numero;<br><br>
                                        &nbsp        //lendo a variavel numero<br>
                                        &nbsp        leia(numero);<br><br>
                                        &nbsp        //Mostrando uma mensagem na tela<br>
                                        &nbsp        escreva("Ola");<br><br>
                                        &nbsp        //Mostrando uma mensagem na tela e quebrando a linha<br>
                                        &nbsp        escreval("Ola");<br><br>
                                        &nbsp        /*Concatenando a palavra ola com a variavel numero<br>
                                        &nbsp        tambem pode ser feito com o escreval<br>
                                        &nbsp        e também pode utilizar as aspas simples (') no lugar<br>
                                        &nbsp        das duplas (")<br>
                                        &nbsp        */<br>
                                        &nbsp        escreva("ola"+numero+"tudo bom?");<br><br>
                                    </p>
                                  </td>
                              </tr>
                           </table>
                          </div>
                        </div>
                      </div>


                      <div class="panel panel-default" style="border:none">
                        <div id="collapse_estruturaControle" class="panel-collapse collapse">
                          <div class="well arrow-up">
                            <table class="table">
                              <h3>4 Estruturas de controle.</h3>
                              <tr>
                                  <td style="width:50%;">
                                    <h4>Explicação.</h4>
                                    <p>
                                        As estruturas de controle são comumente utilizadas para o desenvolvimento de algoritmos é com elas que dizemos o que o computador deve fazer em determinadas situações.
                                    </p>
                                    <p>
                                      No portugol temos o “se”, “senao” e o “escolha caso”, para utilizá-las basta fazer o seguinte:
                                    </p>
                                    <p>
                                      se {condição} entao<br>
                                      &nbsp&nbsp&nbsp      //instruções <br>
                                      fimse
                                    </p>
                                    <p>
                                      O “senao” serve para negar o “se” ou seja se a condição colocada no “se” não for atendida as instruções do “senao” serão executadas.
                                    </p>
                                    <p>
                                      Se {condição} então<br>
                                      &nbsp&nbsp&nbsp//instruções<br>
                                      senao<br>
                                      &nbsp&nbsp&nbsp//instruções<br>
                                      fimse
                                    </p>
                                    <p>
                                      O “escolha caso” é utilizado da seguinte forma:
                                    </p>
                                    <p>
                                      escolha {variavel}<br>
                                      &nbsp&nbsp&nbsp     caso {valor}<br>
                                      &nbsp&nbsp&nbsp     //instruções<br>
                                      &nbsp&nbsp&nbsp     caso {valor}<br>
                                      &nbsp&nbsp&nbsp     //instruções<br>
                                      &nbsp&nbsp&nbsp     caso {valor}<br>
                                      &nbsp&nbsp&nbsp     //instruções<br>
                                     fimescolha
                                    </p>
                                    <p>
                                      Podem existir tantos casos quanto necessário.
                                    </p>
                                    <br>
                                    <h4>Observações.</h4>
                                    <p>
                                      *Você pode utilizar quantas condições forem necessárias, mas para fazer isso tem que isolá-las utilizando parenteses ().Ex:se (a>b) e (a==2) ...
                                    </p>
                                    <p>
                                      *Você pode utilizar um "se" dentro de outro "se" e assim sucessivamente dependendo da sua nescessidade.
                                    </p>
                                    <p>
                                      *Não declare variaveis com esses nomes "se", "senao", "fimse", "escolha", "caso" isso pode gerar problemas no seu código já que estas são palavras reservadas da sintaxe do portugol.
                                    </p>
                                  </td>

                                  <td style="width:50%;">
                                    <h4>Exemplo(s).</h4>
                                    <p>
                                        &nbsp       //Declarando uma variavel e atribuindo valor a ela<br>
                                        &nbsp        variavel inteiro a=2;<br><br>
                                        &nbsp        //Declarando variavel e atribuindo valor a ela;<br>
                                        &nbsp        variavel caractere oi='ola';<br><br>
                                        &nbsp        //Fazendo a verificação com o "se"<br>
                                        &nbsp        se (a == 2) e (a > 1) entao<br>
                                        &nbsp&nbsp&nbsp        a = a + 10;<br>
                                        &nbsp&nbsp&nbsp        escreva(a);<br>
                                        &nbsp        fimse<br><br>
                                        &nbsp        //Fazendo verificação com "se" e "senao"<br>
                                        &nbsp        /*lembre-se que pode utilizar <br>
                                        &nbsp         tanto aspas simples (') como aspas duplas(")*/<br>
                                        &nbsp        se (a == 12) ou (oi == "ola") entao<br>
                                        &nbsp&nbsp&nbsp        a = a + 10;<br>
                                        &nbsp&nbsp&nbsp        escreva(a);<br>
                                        &nbsp        senao<br>
                                        &nbsp&nbsp&nbsp        a = a + 20;<br>
                                        &nbsp&nbsp&nbsp        escreva(a);<br>
                                        &nbsp        fimse<br><br>
                                        &nbsp        //Fazendo teste com o "escolha caso"<br>
                                        &nbsp        escolha a<br>
                                        &nbsp&nbsp&nbsp caso 1<br>
                                        &nbsp&nbsp&nbsp&nbsp escreval("Olha o valor de a: "+a);<br>
                                        &nbsp&nbsp&nbsp&nbsp a = a*22;<br>
                                        &nbsp&nbsp&nbsp caso 22<br>
                                        &nbsp&nbsp&nbsp&nbsp escreval("Olha o valor de a: "+a);<br>
                                        &nbsp&nbsp&nbsp caso 4<br>
                                        &nbsp&nbsp&nbsp&nbsp escreval("Olha o valor de a: "+a);<br>
                                        &nbsp        fimescolha<br>
                                    </p>
                                  </td>
                              </tr>
                           </table>
                          </div>
                        </div>
                      </div>

                      <div class="panel panel-default" style="border:none">
                        <div id="collapse_estruturaRepeticao" class="panel-collapse collapse">
                          <div class="well arrow-up">
                            <table class="table">
                              <h3>5 Estruturas de Repetição.</h3>
                              <tr>
                                  <td style="width:50%;">
                                    <h4>Explicação.</h4>
                                    <p>
                                        As estruturas de repetição, assim como as de controle são também utilizadas com muita frequência no desenvolvimento de algoritmos, estas servem para fazer loopings, e possuem diversas aplicações.
                                    </p>
                                    <p>
                                      As estruturas de repetição utilizadas nesta versão do portugol são o “repita ate”, “para” e o “enquanto”, segue abaixo a forma de utiliza-los.
                                    </p>
                                    <p>
                                      A estrutura “repita ate” ira executar as instruções primeiramente e após isso, fara a verificação da condição e caso a condição seja atendida o laço se repete, caso não o laço termina.
                                    </p>
                                    <p>
                                      repita<br>
                                      &nbsp&nbsp&nbsp//instruções<br>
                                      ate {condição}
                                    </p>
                                    <p>
                                      A estrutura “enquanto” fara a verificação da condição primeiramente e caso esta seja atendida o laço se inicia e as instruções são executadas.  Caso não o laço termina.
                                    </p>
                                    <p>
                                      enquanto {condição} faca<br>
                                      &nbsp&nbsp&nbsp//instruções<br>
                                      fimenquanto
                                    </p>
                                    <p>
                                      A estrutura “para” será executada atribuindo um valor para uma variável, e então o laço será executado, executando assim as instruções até que a variável atinja o valor que esta após o “ate”.
                                    </p>
                                    <p>
                                      para {variável} de {valor} ate {valor} faca<br>
                                      &nbsp&nbsp&nbsp//instruções<br>
                                      fimpara
                                    </p>
                                    <br>
                                    <h4>Observações.</h4>
                                    <p>
                                      *Lembre-se de sempre utilizar letras minúsculas para escrever estas estruturas.
                                    </p>
                                    <p>
                                      *Quando estiver utilizando alguma estrutura de repetição, tome muito cuidado com a “condição” que você coloca para que a estrutura funcione, pois você pode gerar o que é chamado de looping infinito que ocorre quando é dada uma condição que sempre sera atendida para a estrutura de repetição, fazendo assim com que o laço se repita infinitamente.
                                    </p>
                                    <p>
                                      *Não declare variaveis com esses nomes "para", "repita", "ate", "enquanto", "faca" isso pode gerar problemas no seu código já que estas são palavras reservadas da sintaxe do portugol.
                                    </p>
                                    <p>
                                      *Exemplo de condição infinita é: enquanto 1 == 1 faca..., repita ate “a”==”a”....
                                    </p>
                                    <p>
                                      *Caso faça a execução de um looping infinito, terá de esperar até o navegador parar a execução pois ele ficara sem resposta por um tempo. Você pode também reiniciar a aba para solucionar esse problema.
                                    </p>
                                    <p>
                                      *Lembre-se de que você pode utilizar mais de uma condição no "repita ate" e no "enquanto" Ex:<br> repita ... ate (vari>2) e (vari==10).<br> enquanto (vari<=0) e (vari!=-2) faca ...
                                    </p>
                                  </td>

                                  <td style="width:50%;">
                                    <h4>Exemplo(s).</h4>
                                    <p>
                                      &nbsp        //declarando variaveis<br>
                                      &nbsp        variavel inteiro a, contador=1, teste;<br><br>

                                      &nbsp        //Utilização do repita<br>
                                      &nbsp        repita<br>
                                      &nbsp&nbsp&nbsp          leia(a);<br>
                                      &nbsp&nbsp&nbsp          escreval(a);<br>
                                      &nbsp        ate a == 0<br><br>

                                      &nbsp        //Utilização do enquanto<br>
                                      &nbsp        enquanto contador < 10 faca<br>
                                      &nbsp&nbsp&nbsp          leia(teste);<br>
                                      &nbsp&nbsp&nbsp          escreval(teste);<br>
                                      &nbsp&nbsp&nbsp          //Somando a variavel contador de maneira simplificada<br>
                                      &nbsp&nbsp&nbsp          //Também pode ser utilizado contador = contador+1;<br>
                                      &nbsp&nbsp&nbsp          contador++;<br>
                                      &nbsp        fimenquanto<br><br>

                                      &nbsp        //Utilização do para, lembre-se de que pode<br>
                                      &nbsp        //utilizar uma estrutura dentro de outra<br>
                                      &nbsp        para a de 1 ate 5 faca<br>
                                      &nbsp&nbsp&nbsp          se (a > 2) e (a==4) entao<br>
                                      &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp          escreval("a é igual 4");<br>
                                      &nbsp&nbsp&nbsp          senao<br>
                                      &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp          escreval("a é menor que 4");<br>
                                      &nbsp&nbsp&nbsp          fimse<br>
                                      &nbsp        fimenquanto<br><br>
                                    </p>
                                  </td>
                              </tr>
                           </table>
                          </div>
                        </div>
                      </div>

                      <div class="panel panel-default" style="border:none">
                        <div id="collapse_operadoresMatematicos" class="panel-collapse collapse">
                          <div class="well arrow-up">
                            <table class="table">
                              <h3>6 Operadores Matemáticos.</h3>
                              <tr>
                                  <td style="width:50%;">
                                    <h4>Explicação.</h4>
                                    <p>
                                        Os operadores matemáticos do portugol são utilizados para efetuar as operações matemáticas como soma, adição, multiplicação e etc, e também são utilizados para comparar valores.
                                    </p>
                                    <p>
                                      Recebe “= “ este é o operador chamado recebe ele é utilizado para atribuir um valor a uma determinada variável ex: a=1;
                                    </p>
                                    <p>
                                      Igual “==” pode parecer confuso, mas o sinal de igual do portugol assim como em linguagens de programação muito utilizadas como c, java, php e etc são dois sinais de receba juntos, eles são utilizados para fazer comparações ex: a==1 (afirmando que a é igual a 1), 1==1 verdadeiro, 1==2 falso.
                                    </p>
                                    <p>
                                      Diferente “!=” Utilizado para verificar se dois valores são diferentes é o oposto do igual.
                                    </p>
                                    <p>
                                      Maior “>” Utilizado para comparar se um valor é maior que outro.
                                    </p>
                                    <p>
                                      Menor “<” Utilizado para comparar se um valor é menor que outro.
                                    </p>
                                    <p>
                                      Maior ou igual “>=” Utilizado para comparar se um valor é maior ou igual a outro.
                                    </p>
                                    <p>
                                      Menor ou igual “<=” Utilizado para comparar se um valor é menor ou igual a outro.
                                    </p>
                                    <p>
                                      Mais “+” é utilizado para efetuar somas, mas caso ele esteja entre uma variável que não seja do tipo inteiro ou real ele ira concatenar as variáveis (concatenar significa que ele ira juntar o valor das duas variáveis, mas não necessariamente ira soma-las). Ex efetuando uma soma: a = 2+1; Ex efetuando concatenação a = “ola”+”a” (sendo que a variável a deve ser do tipo caractere);
                                    </p>
                                    <p>
                                      Menos “-“ utilizado para fazer subtração.
                                    </p>
                                    <p>
                                      Divisão “/” Utilizado para fazer a divisão.
                                    </p>
                                    <p>
                                      Multiplicação “*” Utilizado para efetuar uma multiplicação.
                                    </p>
                                    <p>
                                      Modulo “%” Utilizado para pegar o resto de uma divisão inteira.
                                    </p>
                                    <br>
                                    <h4>Observações.</h4>
                                    <p>
                                      *Lembre-se de que as operações matemáticas como, soma, multiplicação, divisão, subtração e retirar o modulo da divisão só serão possíveis em variáveis do tipo real ou inteiro.
                                    </p>
                                    <p>
                                      *Para fazer operações matemáticas mais complexas utilize os parênteses para isolar as operações que você deseja executar primeiramente Ex: a = 2 + ((4*2)/5);
                                    </p>
                                    <p>
                                      *Nunca esqueça de usar o ponto e vírgula (;) ao final de cada instrução ele serve para informar que é naquele lugar que acaba a sua linha de comando.
                                    </p>
                                  </td>

                                  <td style="width:50%;">
                                    <h4>Exemplo(s).</h4>
                                    <p>

                                      &nbsp        //declarando variaveis<br>
                                      &nbsp        variavel inteiro a=1, b=2, c=3, d=4;<br>
                                      &nbsp        variavel real n1=32,n2=42;<br>
                                      &nbsp        variavel caractere texto="Mundo";<br><br>

                                      &nbsp        //Comparando para testar se a é igual a 1<br>
                                      &nbsp        se a == 1 entao<br>
                                      &nbsp&nbsp&nbsp          //utilizando "=" para atribuir valores para a<br>
                                      &nbsp&nbsp&nbsp          //utilizando "+" para somar 1 mais 1<br>
                                      &nbsp&nbsp&nbsp          a = 1+1;<br>
                                      &nbsp&nbsp&nbsp          escreval(a);<br>
                                      &nbsp        fimse<br><br>

                                      &nbsp        //Comparando para testar se a é diferente de 2<br>
                                      &nbsp        se a != 2 entao<br>
                                      &nbsp&nbsp&nbsp          a = 1+2;<br>
                                      &nbsp&nbsp&nbsp          escreval(a);<br>
                                      &nbsp&nbsp&nbsp          /*utilizando "+" para concatenar o conteudo<br> do escreval com a variavel texto*/<br>
                                      &nbsp&nbsp&nbsp          escreval("Ola"+texto);<br>
                                      &nbsp        fimse<br><br>

                                      &nbsp        //Comparando para testar se b é maior que 2<br>
                                      &nbsp        se b > 2 entao<br>
                                      &nbsp&nbsp&nbsp          b = 2+2;<br>
                                      &nbsp&nbsp&nbsp          escreval(b);<br>
                                      &nbsp        fimse<br><br>

                                      &nbsp        //Comparando para testar se b é menor que 2<br>
                                      &nbsp        se b < 2 entao<br>
                                      &nbsp&nbsp&nbsp          b = 0;<br>
                                      &nbsp&nbsp&nbsp          escreval(b);<br>
                                      &nbsp        fimse<br><br>

                                      &nbsp        //Comparando para testar se c é maior ou igual a d<br>
                                      &nbsp        se c >= d entao<br>
                                      &nbsp&nbsp&nbsp          c = d;<br>
                                      &nbsp&nbsp&nbsp          escreval(c);<br>
                                      &nbsp        fimse<br><br>

                                      &nbsp        //Comparando para testar se c é menor ou igual a d<br>
                                      &nbsp        se c <= d entao<br>
                                      &nbsp&nbsp&nbsp          d = c;<br>
                                      &nbsp&nbsp&nbsp          escreval(d);<br>
                                      &nbsp&nbsp&nbsp          //utilizando "-" para subtrair 2 de 4<br>
                                      &nbsp&nbsp&nbsp          a = 4-2;<br>
                                      &nbsp&nbsp&nbsp          escreval(a);<br>
                                      &nbsp&nbsp&nbsp          //utilizando "/" para dividir n2 por n1<br>
                                      &nbsp&nbsp&nbsp          n1 = n2/n1;<br>
                                      &nbsp&nbsp&nbsp          escreval(n1);<br>
                                      &nbsp&nbsp&nbsp          //utilizando "*" para multiplicar a e b<br>
                                      &nbsp&nbsp&nbsp          c = a*b;<br>
                                      &nbsp&nbsp&nbsp          escreval(c);<br>
                                      &nbsp&nbsp&nbsp          //utilizando "%" para pegar o resto da divisao de a por 2<br>
                                      &nbsp&nbsp&nbsp          d = a%2;<br>
                                      &nbsp&nbsp&nbsp          escreval(d);<br>
                                      &nbsp        fimse<br><br>
                                    </p>
                                  </td>
                              </tr>
                           </table>
                          </div>
                        </div>
                      </div>

                      <div class="panel panel-default" style="border:none">
                        <div id="collapse_operadoresLogicos" class="panel-collapse collapse">
                          <div class="well arrow-up">
                            <table class="table">
                              <h3>7 Operadores Lógicos.</h3>
                              <tr>
                                  <td style="width:50%;">
                                    <h4>Explicação.</h4>
                                    <p>
                                      Os operadores lógicos simplificadamente, sevem para auxiliar na validação de condições, quando se quer utilizar mais de uma condição. Ex: condição única se 1==2 entao... Ex: mais de uma condição se (3==3) e (3>2) então...
                                    </p>
                                    <p>
                                      Nesta versão do portugol você pode utilizar dois operadores lógicos que são eles o “e” e o “ou”.
                                    </p>
                                    <p>
                                      O “e” tem a função de agregar, isso significa que quando ele é utilizado entre as condições, todas elas devem ser verdadeiras para que por exemplo as instruções dentro do “se” sejam executadas.
                                    </p>
                                    <p>
                                      O “ou” tem a função de desagregar, ou seja, quando ele é utilizado entre as condições, isso significa que pelo menos uma delas deve ser verdadeira para que por exemplo as instruções do “se” sejam executadas.
                                    </p>
                                    <br>
                                    <h4>Observações.</h4>
                                    <p>
                                      *Você pode utilizar quantos “e”s desejar para fazer sua condição, assim como também tantos “ou”s.
                                    </p>
                                    <p>
                                      *Você pode utilizar o “e” e o “ou” em uma mesma sentença para formar sua condição.
                                    </p>
                                    <p>
                                      *Lembre-se de que estas condições podem ser utilizadas nas estruturas de controle e no “enquanto” e “repita ate”.
                                    </p>
                                    <p>
                                      *Não se esqueça de usar os parentesis "()" para isolar as suas condições quando utilizar mais de uma ex:<br>(3==3)ou(3>=2)
                                    </p>
                                  </td>

                                  <td style="width:50%;">
                                    <h4>Exemplo(s).</h4>
                                    <p>
                                      &nbsp        //declarando variaveis<br>
                                      &nbsp        variavel real n1=32,n2=42;<br>
                                      &nbsp        variavel caractere texto="Mundo";<br><br>

                                      &nbsp        //Condição com o "e"<br>
                                      &nbsp        se (n1==32) e (n2==42) entao<br>
                                      &nbsp&nbsp&nbsp          //quando as duas condições forem verdadeiras<br>
                                      &nbsp&nbsp&nbsp          escreval("Condições verdadeiras");<br>
                                      &nbsp        fimse<br><br>

                                      &nbsp        //Condição com o "ou"<br>
                                      &nbsp        se (n1==23) ou (n2==42) entao<br>
                                      &nbsp&nbsp&nbsp          //quando pelo menos uma condição for verdadeira<br>
                                      &nbsp&nbsp&nbsp          escreval("Pelo menos uma ai é verdadeira");<br>
                                      &nbsp        fimse<br><br>

                                      &nbsp        //Condição com o multiplos "e"<br>
                                      &nbsp        se (n1==32) e (n2==42) e (1==1) e (2==2) entao<br>
                                      &nbsp&nbsp&nbsp          //quando todas condições forem verdadeiras<br>
                                      &nbsp&nbsp&nbsp          escreval("Condições verdadeiras");<br>
                                      &nbsp        fimse<br><br>

                                      &nbsp        //Condição com o multiplos "ou"<br>
                                      &nbsp        se (n1==322) ou (n2==42) ou (1==3) ou (2==1) entao<br>
                                      &nbsp&nbsp&nbsp          //quando pelo menos uma condição for verdadeira<br>
                                      &nbsp&nbsp&nbsp          escreval("Pelo menos uma ai é verdadeira");<br>
                                      &nbsp        fimse<br><br>

                                      &nbsp        //Condição com o "ou" e "e"<br>
                                      &nbsp        se (((n1==322) e (n2==42) e (1==3)) ou (2==1)) entao<br>
                                      &nbsp&nbsp&nbsp          /*preste muita atenção na organização dos <br>parenteses pois eles que isolam as expreções*/<br>
                                      &nbsp&nbsp&nbsp          escreval("Pelo menos uma ai é verdadeiro ou não néh");<br>
                                      &nbsp        fimse<br><br>

                                      &nbsp        //Condição com o multiplos "e" no "enquanto"<br>
                                      &nbsp        enquanto (n1==32) e (n2==42) e (1==1) e (2==2) faca<br>
                                      &nbsp&nbsp&nbsp          //quando todas condições forem verdadeiras<br>
                                      &nbsp&nbsp&nbsp          escreval("Olha ai");<br>
                                      &nbsp&nbsp&nbsp          n1++;<br>
                                      &nbsp        fimenquanto<br><br>

                                      &nbsp        //Condição com o multiplos "e" no "repita ate"<br>
                                      &nbsp        repita<br>
                                      &nbsp&nbsp&nbsp          //quando todas condições forem verdadeiras<br>
                                      &nbsp&nbsp&nbsp          escreval("Olha ai");<br>
                                      &nbsp&nbsp&nbsp          n1++;<br>
                                      &nbsp        ate (n1==32) e (n2==42) e (1==1) e (2==2)<br><br>
                                    </p>
                                  </td>
                              </tr>
                           </table>
                          </div>
                        </div>
                      </div>

                      <div class="panel panel-default" style="border:none">
                        <div id="collapse_informacoesAdicionais" class="panel-collapse collapse">
                          <div class="well arrow-up">
                            <table class="table">
                              <h3>8 Informações adicionais.</h3>
                              <tr>

                                  <td style="width:50%;">
                                    <h4>Explicação.</h4>
                                    <p>
                                      Caso queira incrementar o valor de uma variável do tipo inteiro ou real em +1, basta colocar o nome da variável e então “++”. Ex: vari++;
                                    </p>
                                    <p>
                                      Caso queira decrementar basta utilizar “--“. Ex: vari--;
                                    </p>
                                    <p>
                                      Você também pode utilizar a forma convencional. Ex: vari = vari+1;. Pode trocar o “1” por outro valor caso queira incrementar outros valores.
                                    </p>
                                    <br>

                                    <h4>Observações.</h4>
                                    <p>
                                      *O AlgTot é algo novo e ainda estamos em aprendizado, caso ainda tenha mais duvidas, sugestões ou reclamações com relação a sintaxe pode nos mandar um e-mail.
                                    </p>

                                  </td>

                                  <td style="width:50%;">
                                    <h4>E-mail para sugestões, duvidas ou reclamações.</h4>
                                      <p>
                                        <a href="mailto:algtot@outlook.com.br">
                                          algtot@outlook.com.br
                                        </a>
                                      </p>
                                  </td>
                              </tr>
                           </table>
                          </div>
                        </div>
                      </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button name="ok" type="button" data-dismiss="modal" class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span> Ok</button>
                </div>

         </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
