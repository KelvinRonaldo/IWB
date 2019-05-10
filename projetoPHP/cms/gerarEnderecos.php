<?php

    require_once ('./verificarUsuario.php');

    // CONEXAO COM O BANCO
    require_once('../bd/conexao.php');
    $conexao = conexaoMySql();
    $enderecoApi = $_GET['endereco'];

    $modo = $_GET['modo'];
    if($modo == 'select'){
        // echo 'modo slct ';
        if(!empty($enderecoApi)){
            // echo 'cep ok --> '.$_GET['cep'].' ';
        
            $arrayEndereco = (array) null;

            $uf = $enderecoApi['uf']; // pegando uf do endereço do JSON
            $nomeCidade = $enderecoApi['localidade']; // pegando cidade do endereço do JSON
            $bairro = $enderecoApi['bairro']; // pegando bairro do endereço do JSON
            $logradouro = $enderecoApi['logradouro']; // pegando logradouro do endereço do JSON
            $cep = $enderecoApi['cep']; // pegando cep do endereço do JSON
        
            $us = strtoupper($uf);  // tornando text do 'uf' maiusculo
        
            // SCRIPT SQL QUE TRAZ DO BANCO A CIDADE E O ESTADO DO CEP DIGITADO PELO USUARIO
            $sql = "SELECT e.cod_estado, e.estado,
            c.cod_cidade, c.cidade
            FROM tbl_estado AS e
            INNER JOIN tbl_cidade AS c
            ON c.cod_estado = e.cod_estado
            WHERE e.uf = '".$uf."' AND c.cidade = '".$nomeCidade."'";

            if($select = mysqli_query($conexao, $sql)){        
                if($rsEndereco = mysqli_fetch_array($select)){
                    $codEstado = $rsEndereco['cod_estado'];
                    $estado = $rsEndereco['estado'];
                    $codCidade = $rsEndereco['cod_cidade'];
                    $cidade = $rsEndereco['cidade'];

                    $arrayEndereco = array(
                        'nome_estado' => $estado,
                        'cod_estado' => $codEstado,
                        'nome_cidade' => $cidade,
                        'cod_cidade' => $codCidade, 
                        'bairro' => $bairro,
                        'logradouro' => $logradouro,
                        'cep' => $cep
                    );
                }
                print_r(json_encode($arrayEndereco));
            }else{
                echo 'nao deu';
            }
        }else{
            echo 'cep nulo';
        }
    }
?>