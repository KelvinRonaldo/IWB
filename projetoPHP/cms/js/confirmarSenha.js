function confirmarSenha(){

    var txtSenha = document.getElementById("txt-senha-user");
    var txtConfirmSenha = document.getElementById("txt-confirmar-senha-user");

    let senha = txtSenha.value;
    let confirmarSenha = txtConfirmSenha.value;

    if(senha != confirmarSenha){
        alert("AS SENHAS NÃO COINCIDEM!");
        return false;
    }else{
        return true;
    }
}