<?php

    require_once('./verificarUsuario.php');// VERIFICAR SE USUARIO ESTA LOGADO

    // CONEXAO COM O BANCO
    require_once('../bd/conexao.php');
    $conexao = conexaoMySql();

    // EXCLUIR REGISTRO DE LOJA E SEU ENDEREÇO PELOS CÓDIGOS PASSADOS NA URL
    if(isset($_GET['modo'])){
        if($_GET['modo'] == 'excluir'){
            $codLoja = $_GET['codloja'];
            $codEndereco = $_GET['codendereco'];

            $sql = "DELETE FROM tbl_loja WHERE cod_loja = ".$codLoja;
            if(mysqli_query($conexao, $sql)){
                echo 'excluiu a loja<br>';
                $sql = "DELETE FROM tbl_endereco WHERE cod_endereco = ".$codEndereco;
                if(mysqli_query($conexao, $sql)){
                    header('location: mngLojas.php');
                }else{
                    echo 'não foi';
                }
            }
        }
    }elseif(isset($_GET['btn_atualizar_loja'])){
        // VERIFICANDO SE AS CAIXAS OBRIGATORIAS EXISTEM PARA ATUALIZAR O REGISTRO
        if(isset($_GET['txt_logradouro']) && isset($_GET['txt_numero']) && isset($_GET['txt_estado']) && isset($_GET['txt_cidade'])){
            // VERIFICANDO SE AS CAIXAS OBRIGATORIAS FORAM PREENCHIDAS PARA ATUALIZAR O REGISTRO
            if(!empty($_GET['txt_logradouro']) && !empty($_GET['txt_numero']) && !empty($_GET['txt_estado']) && !empty($_GET['txt_cidade'])){
                echo 'campos preenchidos ';
                $numero = $_GET['txt_numero'];
                $logradouro = $_GET['txt_logradouro'];
                $bairro = $_GET['txt_bairro'];
                $estado = $_GET['txt_estado'];
                $cidade = $_GET['txt_cidade'];
                $cep = $_GET['txt_cep'];
                echo $_SESSION['cod_endereco'];

                $sql = "UPDATE tbl_endereco SET logradouro = '".$logradouro."', numero = '".$numero."', bairro = '".$bairro."', cep = '".$cep."', cod_cidade = (SELECT c.cod_cidade FROM tbl_cidade AS c WHERE c.cidade = '".$cidade."') WHERE cod_endereco = ".$_SESSION['cod_endereco'];

                if(mysqli_query($conexao, $sql)){
                    header("location: mngLojas.php");
                }else{
                   echo "nao foi\n".$sql;
                }
                $_SESSION['cod_endereco'] = null;
            }
        }
    }elseif(isset($_GET['btn_enviar_loja'])){ //INSERIR NO BANCO DADOS TRAZIDOS DA REQUISIÇÃO FOR FORMULARIO
        
        if(isset($_GET['txt_logradouro']) && isset($_GET['txt_numero']) && isset($_GET['txt_estado']) && isset($_GET['txt_cidade'])){
            
            if(!empty($_GET['txt_logradouro']) && !empty($_GET['txt_numero']) && !empty($_GET['txt_estado']) && !empty($_GET['txt_cidade'])){
                
                $numero = $_GET['txt_numero'];
                $logradouro = $_GET['txt_logradouro'];
                $bairro = $_GET['txt_bairro'];
                $estado = $_GET['txt_estado'];
                $cidade = $_GET['txt_cidade'];
                $cep = $_GET['txt_cep'];

                $sql = "INSERT INTO tbl_endereco (logradouro, numero, bairro, cep, status, cod_cidade) VALUES ('".$logradouro."', '".$numero."', '".$bairro."', '".$cep."', 'desativado', (SELECT c.cod_cidade FROM tbl_cidade AS c WHERE c.cidade = '".$cidade."'));";
                if(mysqli_query($conexao, $sql)){
                    $sql = "INSERT INTO tbl_loja (status, cod_endereco) VALUES ('desativado', (SELECT cod_endereco FROM tbl_endereco WHERE cod_endereco = (SELECT MAX(cod_endereco) FROM tbl_endereco)))";
                    if(mysqli_query($conexao, $sql)){
                        header("location: mngLojas.php");
                    }else{
                        echo $sql.'<br>';
                    }
                }else{
                   echo $sql.'<br>';
                }
            }
        }
    }else{
        echo 'modo fail';
    }
?>