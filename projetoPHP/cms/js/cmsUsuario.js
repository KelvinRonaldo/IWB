const btnCancelNivel = document.getElementById('btn-cancelar-nivel');
const btnAddNivel = document.getElementById('btn-add-nivel');
const caixaAddNivel = document.getElementById('container-add-nivel');

const btnCancelUser = document.getElementById('btn-cancelar-user');
const btnAddUser = document.getElementById('btn-add-user');
const caixaAddUser = document.getElementById('container-add-user');

const selecionarNivel = document.getElementById("selecao-nivel");
const selecionarUsers = document.getElementById("selecao-usuario");

const containerNivel = document.getElementById("container-nivel-usuario");
const containerUser = document.getElementById("container-users");

function showAddNivel(){
    caixaAddNivel.style.display = "flex";
    btnAddNivel.style.display = "none";
}
function hiddenAddNivel(){
    caixaAddNivel.style.display = "none";
    btnAddNivel.style.display = "inline";
}

function showAddUser(){
    caixaAddUser.style.display = "flex";
    btnAddUser.style.display = "none";
}
function hiddenAddUser(){
    caixaAddUser.style.display = "none";
    btnAddUser.style.display = "inline";
}

function showContainerNivel(){
    containerNivel.style.display = "flex";
    containerUser.style.display = "none";
    selecionarNivel.style.backgroundColor = "rgba(0, 0, 0, 0.768)";
    selecionarNivel.style.color = "rgba(255, 255, 255)";

    selecionarUsers.style.backgroundColor = "rgba(0, 0, 0, 0.068)";
    selecionarUsers.style.color = "rgba(0, 0, 0)";
}
function showContainerUsuario(){
    containerUser.style.display = "flex";
    containerNivel.style.display = "none";
    selecionarUsers.style.backgroundColor = "rgba(0, 0, 0, 0.768)";
    selecionarUsers.style.color = "rgba(255, 255, 255)";
    selecionarNivel.style.backgroundColor = "rgba(0, 0, 0, 0.068)";
    selecionarNivel.style.color = "rgba(0, 0, 0)";
}

btnAddNivel.addEventListener('click', showAddNivel);
btnCancelNivel.addEventListener('click', hiddenAddNivel);
selecionarNivel.addEventListener('click', showContainerNivel);

btnAddUser.addEventListener('click', showAddUser);
btnCancelUser.addEventListener('click', hiddenAddUser);
selecionarUsers.addEventListener('click', showContainerUsuario);