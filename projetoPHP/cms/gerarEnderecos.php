<?php

    require_once ('./verificarUsuario.php');

    // CONEXAO COM O BANCO
    require_once('../bd/conexao.php');
    $conexao = conexaoMySql();

//    VARIAVEL QUE RECEBE O ENDERECO VINDO DA API COM UM SCRIPT JS
    $enderecoApi = $_GET['endereco'];

    $modo = $_GET['modo'];
    if($modo == 'select'){
        if(!empty($enderecoApi)){
        
            //ARRAY QUE RECEBE O ENDERECO VINDO DO BANCO COM O VINDO DA API FUTURAMENTE
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
                    // RECUPERA DADOS PEGOS DO BANCO
                    $codEstado = $rsEndereco['cod_estado'];
                    $estado = $rsEndereco['estado'];
                    $codCidade = $rsEndereco['cod_cidade'];
                    $cidade = $rsEndereco['cidade'];

//                    INSERE OS DADOS EM UM ARRAY
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
//                RETORN O ARRAY CONVERTIDO EM JSON PARA O SCRIPT JS
                print_r(json_encode($arrayEndereco));
            }else{
                echo 'BUSCA FALHOU';
            }
        }else{
            echo 'ENDERECO NULO';
        }
    }
?>