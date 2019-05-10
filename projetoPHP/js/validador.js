// VALIDACAO DAS INFORMAÇÕES DO FORMULARIO DA PAGINA contato.php


// ATRIBUINDO ÀS VARIÁVEIS OS ELEMENTOS DA PAGINA HTML PELO id
const btnEnviar = document.getElementById('btn-enviar');    //BOTAO DE SUBMISSAO

let txtNome = document.getElementById("txt-nome-contato");  //INPUT TEXT(CAIXA DE TEXTO) DO NOME DO USUARIO
let txtCelular = document.getElementById("txt-celular-contato");    //INPUT TEXT(CAIXA DE TEXTO) DO CELULAR DO USUARIO
let txtTelefone = document.getElementById("txt-telefone-contato");  //INPUT TEXT(CAIXA DE TEXTO) DO TELEFONE DO USUARIO
let txtEmail = document.getElementById("txt-email-contato");    //INPUT TEXT(CAIXA DE TEXTO) DO EMAIL DO USUARIO
let txtProfissao = document.getElementById("txt-profissao-contato");    //INPUT TEXT(CAIXA DE TEXTO) DO PROFISSAO DO USUARIO
let slcAssunto = document.getElementById("slc-assunto-contato");    //SELECT(CAIXA DE SELEÇÃO) DO ASSUNTO DA MENSAGEM DO USUARIO
let txtMensagem = document.getElementById("txt-msg-contato");   //TEXTAREA(CAIXA DE TEXTO DIMENSIONAVEL) A MENSAGEM DO USUARIO
let txtHomePage = document.getElementById("txt-home-page-contato");
let txtFacebook = document.getElementById("txt-facebook-contato")

const validacao = () =>{ // FUNÇÃO QUE VALIDA TODOS OS CAMPOS FOR FORMULARIO

    const validarNome = () =>{ //VALIDACAO DO NOME DO USUARIO
        er = /[^(a-zA-Zà-úÀ-Ú )]+/;
        return er.test(txtNome.value);
    }
    const validarCelular = () =>{ //VALIDACAO DO CELULAR DO USUARIO
        er = /\([0-9]{2}\) ?9[0-9]{4}-?[0-9]{4}/;
        return er.test(txtCelular.value);
    }
    const validarTelefone = () =>{ //VALIDACAO DO TELEFONE DO USUARIO
        er = /\([0-9]{2}\) ?[0-9]{4}-?[0-9]{4}/;
        return er.test(txtTelefone.value);
    }
    const validarEmail = () =>{ //VALIDACAO DO EMAIL DO USUARIO
        er = /^[0-9a-zA-Z_\-.]+@[a-z]{2,}(\.[a-z]+)+/;
        return er.test(txtEmail.value);
    }
    const validarProfissao = () =>{ //VALIDACAO DO PROFISSAO DO USUARIO
        er = /[^(a-zA-Zà-úÀ-Ú )]+/;
        return er.test(txtProfissao.value);
    }



    if(validarNome()|| txtNome.value == ""){ // **1 --> SE INVALIDO OU VAZIO, ATRIBUI UMA ESTILIZAÇÃO DIFERENTE NO CSS AO ELEMENTO
        txtNome.className = "erro"; // **2 --> ATRIBUIÇÃO DE CLASSE PARA ESTILIZAÇÃO CSS
        txtNome.placeholder = "Nome inválido."; // **3 --> MENSAGEM DE ALERTA PARA USUARIO
        txtNome.value = ""; // **4 --> APAGA O QUE O USUARIO HAVIA DIGITADO
    }else{
        txtNome.className = ""; // **5 SENÃO, NÃO FAZ NADA OU RETIRA A CLASSE ATRIBUIDA EM CASO DE CONSERTO DO ERRO
    }
    
    if(!validarCelular() || txtCelular.value == ""){ // **1 -->
        txtCelular.className = "erro"; // **2
        txtCelular.placeholder = "(XX) 00000-0000"; // **3 -->
        txtCelular.value = ""; // **4 -->
    }else{
        txtCelular.className = ""; // **5 -->
    }

    if(!validarTelefone()){ // **1 -->
        txtTelefone.className = "erro"; // **2 -->
        txtTelefone.placeholder = "(XX) 0000-0000"; // **3 -->
        txtTelefone.value = ""; // **4 -->
    }else{
        txtTelefone.className = ""; // **5 -->
    }

    if(!validarEmail() || txtEmail.value ==  ""){ // **1 -->
        txtEmail.className = "erro"; // **2 -->
        txtEmail.placeholder = "E-mail inválido."; // **3 -->
        txtEmail.value = ""; // **4 -->
    }else{
        txtEmail.className = ""; // **5 -->
    }

    if(validarProfissao() || txtProfissao.value == ""){ // **1 -->
        txtProfissao.className = "erro"; // **2 -->
        txtProfissao.placeholder = "Digite apenas letras."; // **3 -->
        txtProfissao.value = ""; // **4 -->
    }else{
        txtProfissao.className = ""; // **5 -->
    }



    if(txtMensagem.value == ""){
        txtMensagem.className = "erro"; // **2 -->
        txtMensagem.placeholder = "Mensagem inválida."; // **3 -->
        txtMensagem.value = ""; // **4 -->
    }else{
        txtMensagem.className = ""; // **5 -->
    }

    if(slcAssunto.value == ""){
        slcAssunto.className = "erro"; // **2 -->
    }else{
        slcAssunto.className = ""; // **5 -->
    }
}

// MASCARA PARA DIGITAÇÃO DO CAMPO DO NOME
const mascaraNome = (code) =>{
    if(code.keyCode != 8 && code.keyCode != 46){ //PERMITE A "DIGITAÇÃO" DOS CARACTERES "backspace" e "delete"
        let texto = txtNome.value; // ATRIBUI O QUE O USUARIO DIGITOU A UMA VARIAVEL
    
        texto = texto.replace(/[^a-zA-Zà-úÀ-Ú ]/g, ""); // NÃO PERMITE A DIGITAÇÃO DE CARACTERES QUE NÃO SEJAM DE LETRAS E ESPAÇO

        txtNome.value = texto;
    }
}

// MASCARA PARA DIGITAÇÃO DO CAMPO DA PROFISSÃO
const mascaraProfissao = (code) =>{
    if(code.keyCode != 8 && code.keyCode != 46){ //PERMITE A "DIGITAÇÃO" DOS CARACTERES "backspace" e "delete"
        let texto = txtProfissao.value; // ATRIBUI O QUE O USUARIO DIGITOU A UMA VARIAVEL
    
        texto = texto.replace(/[^a-zA-Zà-úÀ-Ú ]/g, ""); // NÃO PERMITE A DIGITAÇÃO DE CARACTERES QUE NÃO SEJAM DE LETRAS E ESPAÇO

        txtProfissao.value = texto;
    }
}
// MASCARA PARA DIGITAÇÃO DO CAMPO DO CELULAR
const mascaraCelular = (code) =>{
    if(code.keyCode != 8 && code.keyCode != 46){ //PERMITE A "DIGITAÇÃO" DOS CARACTERES "backspace" e "delete"
        let texto = txtCelular.value; // ATRIBUI O QUE O USUARIO DIGITOU A UMA VARIAVEL
    
        texto = texto.replace(/[^0-9]/g, ""); // NÃO PERMITE A DIGITAÇÃO DE  CARACTERES QUE NÃO SEJAM DE O A 9 NA SEQUENCIA DA TABELA ASCII
    
        texto = texto.replace(/(^.)/, "($1"); // INCLUI '(' NO INICIO DO CAMPO
        texto = texto.replace(/^(...)/,  "$1) "); //INCLUI ') ' APOS AS DIGITAÇÃO DE 3 CARACTERES
        texto = texto.replace(/^(.{10})/, "$1-") // INCLUI '-' APOS A DIGITAÇÃO DE 10 CARACTERES
    
        txtCelular.value = texto;
    }
}

// MASCARA PARA DIGITAÇÃO DO CAMPO DO TELEFONE
const mascaraTelefone = (code) =>{
    if(code.keyCode != 8 && code.keyCode != 46){ //PERMITE A "DIGITAÇÃO" DOS CARACTERES "backspace" e "delete"
        let texto = txtTelefone.value; // ATRIBUI O QUE O USUARIO DIGITOU A UMA VARIAVEL
    
        texto = texto.replace(/[^0-9]/g, ""); // NÃO PERMITE A DIGITAÇÃO DE  CARACTERES QUE NÃO SEJAM DE O A 9 NA SEQUENCIA DA TABELA ASCII
    
        texto = texto.replace(/(^.)/, "($1"); // INCLUI '(' NO INICIO DO CAMPO
        texto = texto.replace(/^(...)/,  "$1) "); //INCLUI ') ' APOS AS DIGITAÇÃO DE 3 CARACTERES
        texto = texto.replace(/^(.{9})/, "$1-") // INCLUI '-' APOS A DIGITAÇÃO DE 9 CARACTERES
    
        txtTelefone.value = texto;
    }
}

btnEnviar.addEventListener('click', validacao); //NO APERTAR DO BOTÃO, CHAMA A FUNÇÃO DE VALIDACAO DOS CAMPOS
txtCelular.addEventListener('keyup', (code) => mascaraCelular(code)); // ##1 --> ENVIA O CODIGO DA TECLA DIGITADA A FUNÇÃO DE MASCARA AO USUARIO SOLTAR A TECLA
txtTelefone.addEventListener('keyup', (code) => mascaraTelefone(code)); // ##1
txtNome.addEventListener('keyup', (code) => mascaraNome(code)); // ##1
txtProfissao.addEventListener('keyup', (code) => mascaraProfissao(code)); // ##1