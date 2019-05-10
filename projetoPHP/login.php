<?php

    session_start();

    require_once('./bd/conexao.php');
    $conexao = conexaoMySql();

    if(!isset($_POST['logout'])){
        $user = $_POST['txt_usuario'];
        $pwd = hash('sha512', $_POST['txt_senha']);

        $sql = "SELECT u.cod_usuario, u.nome_usuario, u.senha, u.nome, u.email,
        nu.adm_conteudo, nu.adm_fale_conosco,
        nu.adm_produto, nu.adm_usuario
        FROM tbl_usuario AS u
        INNER JOIN tbl_nivel_usuario AS nu
        ON u.cod_nivel_usuario = nu.cod_nivel_usuario
        WHERE u.nome_usuario = '".$user."' AND u.senha = '".$pwd."'";

        if($select = mysqli_query($conexao, $sql)) {

            if($rsUser = mysqli_fetch_array($select)) {
                if($rsUser['cod_usuario'] == '') {
                    echo('nao há');
                }else{
                    $_SESSION['user'] = $rsUser['nome'];
                    $_SESSION['user_name'] = $rsUser['nome_usuario'];
                    $_SESSION['email'] = $rsUser['email'];
                    $_SESSION['cod_usuario'] = $rsUser['cod_usuario'];
                    $_SESSION['allow_conteudo'] = $rsUser['adm_conteudo'];
                    $_SESSION['allow_fale_conosco'] = $rsUser['adm_fale_conosco'];
                    $_SESSION['allow_produto'] = $rsUser['adm_produto'];
                    $_SESSION['allow_usuario'] = $rsUser['adm_usuario'];
                    header('location: ./cms/cmsConteudo.php');
                }
            }else{
                echo
                "<script>
                    alert('Usuário ou senha digitados esta incorreto!');
                    window.history.back();
                </script>";
            }
        }
    }else{
        session_destroy();
        header('location: index.php');
    }
?>