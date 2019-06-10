<?php

    session_start(); // INICANDO A SESSÃO

    require_once('bd/conexao.php');//CONEXAO COM O BANCO
    $conexao = conexaoMySql();

    if(!isset($_POST['logout'])){//SE A VARIAVEL LOGOUT NÃO EXISTIR NA REQUISIÇÃO, EXECUTA O SCRIPT QUE VERIFICA O LOGIN
        if(!isset($_SESSION['cod_usuario'])){//FAZ O SCRIPT DO LOGIN SE NÃO HOUVER NENHUM USUARIO LOGADO NA SESSÃO
            $user = $_POST['txt_usuario'];
            $password = trim(hash('sha512', $_POST['txt_senha']));

            // SCRIPT SQL QUE VERIFICA SE O USUARIO E SENHA EXISTEM NO BANCO E TRAZ SEUS DADOS 
            $sql = "SELECT user.cod_usuario, user.nome_usuario, user.senha, user.nome, user.email, user.status,
                    nivel_user.adm_conteudo, nivel_user.adm_fale_conosco, nivel_user.status AS nivelStatus,
                    nivel_user.adm_produto, nivel_user.adm_usuario, nivel_user.cod_nivel_usuario
                    FROM tbl_usuario AS user
                    INNER JOIN tbl_nivel_usuario AS nivel_user
                    ON user.cod_nivel_usuario = nivel_user.cod_nivel_usuario
                    WHERE (user.nome_usuario = '".addslashes($user)."' OR user.email = '".addslashes($user)."') AND user.senha = '".addslashes($password)."'";

            if($select = mysqli_query($conexao, $sql)) {//SE O SELECT NO BANCO FUNCIONAR EXECUTA O SCRIPT DE VERIFICAÇÃO SOBRE O USUARIO

                if($rsUser = mysqli_fetch_array($select)) {
                    if($rsUser['cod_usuario'] == '') {//SE O CODIGO DO USUARIO BUSCADO FOR NULO, ENVIA UMA MENSAGEM DE ERRO
                        echo
                        "<script>
                            alert('Usuário não consta em nossos registros!');
                            window.history.back();
                        </script>";

                    }elseif($rsUser['status'] == 'desativado' || $rsUser['nivelStatus'] == 'desativado'){//SE O USUARIO OU SEU NIVEL ESTIVAR DESATIVADO, RETORNA UMA MENSAGEM DE ERRO
                        echo
                        "<script>
                            alert('Usuário ou nível de usuário inserido está desativado!');
                            window.history.back();
                        </script>";

                    }elseif($rsUser['cod_usuario'] != ''){//CASO O USUARIO EXISTA, E ESTEJA ATTIVADO, COLOCA SEUS DADOS EM VARIAVEIS DE SESSÃO E REDIRECIONA PARA A PAGINA DO CMS
                        $_SESSION['user'] = $rsUser['nome'];
                        $_SESSION['user_name'] = $rsUser['nome_usuario'];
                        $_SESSION['email'] = $rsUser['email'];
                        $_SESSION['cod_usuario'] = $rsUser['cod_usuario'];
                        $_SESSION['cod_nivel_usuario'] = $rsUser['cod_nivel_usuario'];
                        $_SESSION['adm_conteudo'] = $rsUser['adm_conteudo'];
                        $_SESSION['adm_fale_conosco'] = $rsUser['adm_fale_conosco'];
                        $_SESSION['adm_produto'] = $rsUser['adm_produto'];
                        $_SESSION['adm_usuario'] = $rsUser['adm_usuario'];
                        $_SESSION['status'] = $rsUser['status'];
                        $_SESSION['status_nivel'] = $rsUser['nivelStatus'];
                        header('location: ./cms/index.php');
                    }
                }else{//SE NÃO HOUVER SENHUM USUARIO CORRESPONDENTE, ENVIA UMA MENSAGEM DE ERRO
                    echo 
                    "<script>
                        alert('Usuário ou senha digitados esta incorreto! ');
                        window.history.back();
                    </script>";
                }
            }else{//
                echo $sql;
            }
        }else{
            $userName = "'".$_SESSION['user_name']."'";
            echo
            "<script>
                alert('O usuário '+$userName+' ja está logado no momento.');
                window.history.back();
            </script>";
        }
    }else{
        session_destroy();
        header('location: index.php');
    }
?>