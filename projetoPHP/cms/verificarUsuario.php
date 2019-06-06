<?php


    session_start();//INICIA A SESSÃO
    if(isset($_SESSION['cod_usuario'])){//VERIFICA SE O COD USUARIO EXISTE PARA SE MANTER LOGADO, OU VERIFICAR SE QUEM ACESSOU A PAGINA ESTA LOGADO, SE NAGATIVO, ENVIA UMA MENSAGEM DE ERRO E DETROI A SESSÃO
        if($_SESSION['status'] != "ativado"){//VERIFICA SE O USUARIO LOGADO ESTA ATIVO, SE NÃO, DESTROI A SESSÃO E ENVIA UMA MENSAGEM DE ERRO
            session_destroy();
            echo
            "<script>
                alert('O usuário foi desativado!');
                window.history.back();
            </script>";
            // header('location: ../index.php');
        }elseif(empty($_SESSION['cod_usuario'])){
            session_destroy();
            header('location: ../index.php');
        }
    }else{
        session_destroy();
        header('location: ../index.php');
    }
