<?php

    require_once('verificarUsuario.php');// VERIFICAR SE USUARIO ESTA LOGADO

    // CONEXAO COM O BANCO
    require_once('../bd/conexao.php');
    $conexao = conexaoMySql();

    // EXCLUIR REGISTRO DE LOJA E SEU ENDEREÇO PELOS CÓDIGOS PASSADOS NA URL
    if(isset($_GET['modo'])){//SE A VARIAVEL MODO EXISTIR, ENTRA NO SCRIPT DE EXCLUSAO DA LOJA
        if($_GET['modo'] == 'excluir'){//SE O MODO FOR EXCLUIR, ENTRA NO SCRIPT DE EXCLUSAO DA LOJA
            $codLoja = $_GET['codloja'];
            $codEndereco = $_GET['codendereco'];

//                SCRIPT SQL QUE DELETE DADOS DO BANCO
            $sql = "DELETE FROM tbl_loja WHERE cod_loja = ".$codLoja;
            if(mysqli_query($conexao, $sql)){
                echo 'excluiu a loja<br>';
                $sql = "DELETE FROM tbl_endereco WHERE cod_endereco = ".$codEndereco;
                if(mysqli_query($conexao, $sql)){
                    header('location: mngLojas.php');
                }else{
                    echo 'EXCLUSÃO FALHOU';
                }
            }
        }
    }elseif(isset($_GET['btn_atualizar_loja'])){//SE O BOTAO DE ATUALIZAR A LOJA FOR PRESSIONADO, ENTRA NO SCRIPT DE ATUALIZAÇÃO DA LOJA
        if(isset($_GET['txt_logradouro']) && isset($_GET['txt_numero']) && isset($_GET['txt_estado']) && isset($_GET['txt_cidade'])){// VERIFICANDO SE AS CAIXAS OBRIGATORIAS EXISTEM PARA ATUALIZAR O REGISTRO
            if(!empty($_GET['txt_logradouro']) && !empty($_GET['txt_numero']) && !empty($_GET['txt_estado']) && !empty($_GET['txt_cidade'])){// VERIFICANDO SE AS CAIXAS OBRIGATORIAS FORAM PREENCHIDAS PARA ATUALIZAR O REGISTRO

                $numero = $_GET['txt_numero'];
                $logradouro = $_GET['txt_logradouro'];
                $bairro = $_GET['txt_bairro'];
                $estado = $_GET['txt_estado'];
                $cidade = $_GET['txt_cidade'];
                $cep = $_GET['txt_cep'];

//                SCRIPT SCQL QUE ATUALIZA DADOS NO BANCO
                $sql = "UPDATE tbl_endereco SET logradouro = '".$logradouro."', numero = '".$numero."', bairro = '".$bairro."', cep = '".$cep."', cod_cidade = (SELECT c.cod_cidade FROM tbl_cidade AS c WHERE c.cidade = '".$cidade."') WHERE cod_endereco = ".$_SESSION['cod_endereco'];

                if(mysqli_query($conexao, $sql)){
                    header("location: mngLojas.php");
                }else{
                   echo "INSERÇÃO FALHOU<br>".$sql;
                }
//                ZERA VARIÁVEL SE SESSÃO TEMPORARIA
                $_SESSION['cod_endereco'] = null;
            }
        }
    }elseif(isset($_GET['btn_enviar_loja'])){ //INSERIR NO BANCO DADOS TRAZIDOS DA REQUISIÇÃO FOR FORMULARIO
        if(isset($_GET['txt_logradouro']) && isset($_GET['txt_numero']) && isset($_GET['txt_estado']) && isset($_GET['txt_cidade'])){//VERIFICA SE OS CAMPOS EXISTEM PARA A INSERÇÃO DA LOJA
            if(!empty($_GET['txt_logradouro']) && !empty($_GET['txt_numero']) && !empty($_GET['txt_estado']) && !empty($_GET['txt_cidade'])){//VERIFICA SE OS CAMPOS QUE SERÃO INSERIDOS NÃO ESTÃO NULOS
                
                $numero = $_GET['txt_numero'];
                $logradouro = $_GET['txt_logradouro'];
                $bairro = $_GET['txt_bairro'];
                $estado = $_GET['txt_estado'];
                $cidade = $_GET['txt_cidade'];
                $cep = $_GET['txt_cep'];

				echo $estado;
//                SCRIPT SCQL QUE INSERE DADOS NO BANCO
     
				$sql = "INSERT INTO tbl_endereco (logradouro, numero, bairro, cep, cod_cidade) 
                            VALUES ('" . addslashes($logradouro) . "', '" . addslashes($numero) . "', '" . addslashes($bairro) . "', '" . addslashes($cep) . "', (SELECT c.cod_cidade FROM tbl_cidade AS c INNER JOIN tbl_estado AS e ON c.cod_estado = e.cod_estado WHERE c.cidade = '".addslashes($cidade)."' AND e.estado = '".addslashes($estado)."'));";
                    
                if(mysqli_query($conexao, $sql)){

//                    PEGA O CODIGO DA ULTIMA CONEXAO COM O BANCO PARA SE USADO COMO CAHVE ENTRAGEIRA DO PROXIMO INSERT
                    $codEndereco = mysqli_insert_id($conexao);

                    // SCRIPT SQL DE INSERÇÃO DE LOJA NO BANCO
                    $sql = "INSERT INTO tbl_loja (status, cod_endereco) VALUES ('desativado', ".$codEndereco.")";
                    if(mysqli_query($conexao, $sql)){
                        header("location: mngLojas.php");
                    }else{
                        echo "INSERÇÃO DE LOJA FALHOU<br>".$sql;
                    }
                }else{
                   echo "INSERÇÃO DE ENDEREÇO FALHOU<br>".$sql;
                }
            }
        }
    }else{
        echo 'modo fail';
    }
?>