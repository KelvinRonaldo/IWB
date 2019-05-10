<?php

    require_once ('./verificarUsuario.php');
    
    require_once('../bd/conexao.php');
    $conexao = conexaoMySql();

    if(isset($_GET['pagina'])){
        $pagina = $_GET['pagina'];
        $status = $_GET['status'];
        // VERIFICA QUAL A PAGINA QUE FEZ A REQUISIÇÃO
        if($pagina == 'noticias' && $_GET['noticia'] == 'geral'){
            $tabela = 'tbl_noticia';
            $codigo = $_GET['codigo'];
            $codTabela = 'cod_noticia';
        }elseif($pagina == 'noticias' && $_GET['noticia'] == 'principal' && $status == 'ativado'){
            $tabela = 'tbl_noticia_principal';                
            $codigo = $_GET['codigo'];
            $codTabela = 'cod_noticia';
            $status = 'desativado';
        }elseif($pagina == 'noticias' && $_GET['noticia'] == 'principal' && $status == 'desativado'){
            $tabela = 'tbl_noticia_principal';                
            $codigo = $_GET['codigo'];
            $codTabela = 'cod_noticia';
            $status = 'ativado';
            $nivelDestaque = $_GET['nvl_destaque'];

//            if(){
//
//            }
            $sql = "UPDATE ".$tabela." SET status = 'desativado' WHERE ".$codTabela." > 0 AND cod_destaque = '".$nivelDestaque."'";
            
            if(mysqli_query($conexao, $sql)){
                echo("DEMAIS DO MESMO NIVEL DESATIVADOS\n");
            }
        }elseif($pagina == 'lojas' && $status == 'ativado'){
            $tabela = 'tbl_loja';
            $codigo = $_GET['codigo'];
            $codTabela = 'cod_loja';
            $status = 'desativado';
            $codEndereco = $_GET['codEndereco'];

            $sql = "UPDATE tbl_endereco SET status = '".$status."' WHERE cod_endereco = ".$codEndereco;

            if(mysqli_query($conexao, $sql)){
                echo("ENDERECO MODIFICADO\n");
            }

        }elseif($pagina == 'lojas' && $status == 'desativado'){
            $tabela = 'tbl_loja';
            $codigo = $_GET['codigo'];
            $codTabela = 'cod_loja';
            $status = 'ativado';
            $codEndereco = $_GET['codEndereco'];

            $sql = "UPDATE tbl_endereco SET status = '".$status."' WHERE cod_endereco = ".$codEndereco;

            if(mysqli_query($conexao, $sql)){
                echo("ENDERECO MODIFICADO\n");
            }

        }elseif($pagina == 'sobre' && $status == 'ativado'){
            $tabela = 'tbl_sobre';
            $codigo = $_GET['codigo'];
            $codTabela = 'cod_sobre';
            $status = 'desativado';
        }elseif($pagina == 'sobre' && $status == 'desativado'){
            $tabela = 'tbl_sobre';
            $codigo = $_GET['codigo'];
            $codTabela = 'cod_sobre';
            $status = 'ativado';

            $sql = "UPDATE ".$tabela." SET status = 'desativado' WHERE ".$codTabela." > 0";

            if(mysqli_query($conexao, $sql)){
                echo("DEMAIS DO MESMO NIVEL DESATIVADOS\n");
            }
        }elseif($pagina == 'eventos' && $status == 'ativado'){
            $tabela = 'tbl_evento';
            $codigo = $_GET['codigo'];
            $codTabela = 'cod_evento';
            $status = 'desativado';
            $codEndereco = $_GET['codEndereco'];

            $sql = "UPDATE tbl_endereco SET status = '".$status."' WHERE cod_endereco = ".$codEndereco;

            if(mysqli_query($conexao, $sql)){
                echo("ENDERECO MODIFICADO\n");
            }

        }elseif($pagina == 'eventos' && $status == 'desativado'){
            $tabela = 'tbl_evento';
            $codigo = $_GET['codigo'];
            $codTabela = 'cod_evento';
            $status = 'ativado';
            $codEndereco = $_GET['codEndereco'];

            $sql = "UPDATE tbl_endereco SET status = '".$status."' WHERE cod_endereco = ".$codEndereco;

            if(mysqli_query($conexao, $sql)){
                echo("ENDERECO MODIFICADO\n");
            }

        }elseif($pagina == 'promocao' && $status == 'ativado'){
            $tabela = 'tbl_promocao';
            $codigo = $_GET['codigo'];
            $codTabela = 'cod_promocao';
            $status = 'desativado';
        }elseif($pagina == 'promocao' && $status == 'desativado'){
            $tabela = 'tbl_promocao';
            $codigo = $_GET['codigo'];
            $codTabela = 'cod_promocao';
            $status = 'ativado';
            $codProduto = $_GET['cod_produto'];

            $sql = "UPDATE tbl_promocao SET status = 'desativado' WHERE cod_produto = ".$codProduto;

            if(mysqli_query($conexao, $sql)){
                $sql = "UPDATE tbl_produto SET status = 'ativado' WHERE cod_produto = ".$codProduto;

                if(mysqli_query($conexao, $sql)){
                    echo("PROMOCAO MODIFICADO\n");
                }
            }
        }elseif($pagina == 'nivel_usuario'){
            $tabela = 'tbl_nivel_usuario';
            $codigo = $_GET['codigo'];
            $codTabela = 'cod_nivel_usuario';

            if($status == 'desativado'){
                $sql = "UPDATE tbl_usuario SET status = 'desativado' WHERE cod_usuario > 0 ";

                if(mysqli_query($conexao, $sql)){
                    echo("USUARIOS DESATIVADOS\n");
                }else{
                    echo $sql;
                }
            }
        }
        
        $sql = "UPDATE ".$tabela." SET status = '".$status."' WHERE $codTabela = ".$codigo;
    
        if(mysqli_query($conexao, $sql)){
            echo("REGISTRO MODIFICADO");
        }else{
            echo $sql;
        }
    }