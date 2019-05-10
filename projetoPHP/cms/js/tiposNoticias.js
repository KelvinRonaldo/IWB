// VARIÁVEIS QUE RECEBEM AREAS DE NOTICIAS
const caixaPrincipais = document.getElementById("container-principais");
const caixaGerais = document.getElementById("container-gerais");

// VARIÁVEL QUE RECEBE AREA DOS BOTOTES DE ADICIONAR DE NOTICIAS
const caixaAddNoticias = document.getElementById("btns-add-noticias");

// VARIÁVEIS QUE RECEBEM BOTOES DE ADICIONAR NOTICIAS
const addPrincipais = document.getElementById("adicionar-principal");
const addGerais = document.getElementById("adicionar-geral");

// VARIÁVEIS QUE RECEBEM BOTOES DE SLECIONAR TIPOS DE NOTICIAS
const selecaoPrincipais = document.getElementById("tipo-principais");
const selecaoGerais = document.getElementById("tipo-gerais");

// FUNÇÃO QUE MOSTRA CONTAINER DE NOTICIAS PRINCIPAIS E ESCONDE O CONTAINER DE NOTICIAS GERAIS
const mostrarPrincipais = () =>{
    caixaPrincipais.style.display = "flex";
    caixaGerais.style.display = "none";
    addPrincipais.style.display = "inline";
    addGerais.style.display = "none";
    caixaAddNoticias.style.display = "flex";
    selecaoPrincipais.style.backgroundColor = "rgba(0, 0, 0, 0.768)";
    selecaoPrincipais.style.color = "#ffffff";
    selecaoGerais.style.backgroundColor = "rgba(0, 0, 0, 0.068)";
    selecaoGerais.style.color = "";
}
// FUNÇÃO QUE MOSTRA CONTAINER DE GERAIS PRINCIPAIS E ESCONDE O CONTAINER DE NOTICIAS PRINCIPAIS
const mostrarGerais = () =>{
    caixaPrincipais.style.display = "none";
    caixaGerais.style.display = "flex";
    addPrincipais.style.display = "none";
    addGerais.style.display = "inline";
    caixaAddNoticias.style.display = "flex";
    selecaoGerais.style.backgroundColor = "rgba(0, 0, 0, 0.768)";
    selecaoGerais.style.color = "#ffffff";
    selecaoPrincipais.style.backgroundColor = "rgba(0, 0, 0, 0.068)";
    selecaoPrincipais.style.color = "";
}