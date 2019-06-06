<?php

    require_once ('./verificarUsuario.php');
    
    require_once('../bd/conexao.php');
    $conexao = conexaoMySql();

    if(isset($_GET['pagina'])){
        $pagina = $_GET['pagina'];
        $status = $_GET['status'];
//        $nivelUsuario = $_GET['nivel'];
        /* VERIFICA QUAL A PAGINA QUE FEZ A REQUISIÇÃO, E QUAL SEU STATU
        SE O STATUS FOR ATIVADO, ELE DESATIVA O REGISTRO
        SE O STATUS FOR DESATIVADO, ELE ATIVA O REGISTRO
        */

        
        if($pagina == 'noticias' && $_GET['noticia'] == 'geral'){/// ATIVA E DESATIVA NOTICIAS GERAIS
            $tabela = 'tbl_noticia';
            $codigo = $_GET['codigo'];
            $codTabela = 'cod_noticia';
        }elseif($pagina == 'noticias' && $_GET['noticia'] == 'principal' && $status == 'ativado'){//DESATIVA NOTICIAS PRINCIPAIS
            $tabela = 'tbl_noticia_principal';                
            $codigo = $_GET['codigo'];
            $codTabela = 'cod_noticia';
            $status = 'desativado';
        }elseif($pagina == 'noticias' && $_GET['noticia'] == 'principal' && $status == 'desativado'){//ATIVA NOTICIAS PRINCIPAIS
            $tabela = 'tbl_noticia_principal';                
            $codigo = $_GET['codigo'];
            $codTabela = 'cod_noticia';
            $status = 'ativado';
            $nivelDestaque = $_GET['nvl_destaque'];

            //DESATIVA TODAS A NOTICIAS PRINCIPAIS PARA QUE FIQUE SÓ UMA ATIVA
            $sql = "UPDATE tbl_noticia_principal SET status = 'desativado' WHERE cod_noticia > 0 AND cod_destaque = ".$nivelDestaque;
            echo $sql;
            if(mysqli_query($conexao, $sql)){
                echo("DEMAIS DO MESMO NIVEL DESATIVADOS\n");
            }else{
                echo("Não Foi");
            }
        }elseif($pagina == 'lojas' && $status == 'ativado'){//DESATIVA LOJA
            $tabela = 'tbl_loja';
            $codigo = $_GET['codigo'];
            $codTabela = 'cod_loja';
            $status = 'desativado';
            $codEndereco = $_GET['codEndereco'];

            // DESATIVA ENDERECO DA LOJA
            $sql = "UPDATE tbl_endereco SET status = '".$status."' WHERE cod_endereco = ".$codEndereco;

            if(mysqli_query($conexao, $sql)){
                echo("ENDERECO MODIFICADO\n");
            }

        }elseif($pagina == 'lojas' && $status == 'desativado'){//ATIVA LOJA
            $tabela = 'tbl_loja';
            $codigo = $_GET['codigo'];
            $codTabela = 'cod_loja';
            $status = 'ativado';
            $codEndereco = $_GET['codEndereco'];
            
            // ATIVA ENDERECO DA LOJA
            $sql = "UPDATE tbl_endereco SET status = '".$status."' WHERE cod_endereco = ".$codEndereco;

            if(mysqli_query($conexao, $sql)){
                echo("ENDERECO MODIFICADO\n");
            }

        }elseif($pagina == 'sobre' && $status == 'ativado'){//DESATIVA SOBRE
            $tabela = 'tbl_sobre';
            $codigo = $_GET['codigo'];
            $codTabela = 'cod_sobre';
            $status = 'desativado';
        }elseif($pagina == 'sobre' && $status == 'desativado'){//ATIVA SOBRE
            $tabela = 'tbl_sobre';
            $codigo = $_GET['codigo'];
            $codTabela = 'cod_sobre';
            $status = 'ativado';

            //DESATIVA TODOS SOBRE PARA QUE FIQUE SÓ UM ATIVO
            $sql = "UPDATE ".$tabela." SET status = 'desativado' WHERE ".$codTabela." > 0";

            if(mysqli_query($conexao, $sql)){
                echo("DEMAIS DO MESMO NIVEL DESATIVADOS\n");
            }
        }elseif($pagina == 'eventos' && $status == 'ativado'){//DESATIVA EVENTOS
            $tabela = 'tbl_evento';
            $codigo = $_GET['codigo'];
            $codTabela = 'cod_evento';
            $status = 'desativado';
            $codEndereco = $_GET['codEndereco'];

            // DESATIVA ENDERECO DO EVENTO
            $sql = "UPDATE tbl_endereco SET status = '".$status."' WHERE cod_endereco = ".$codEndereco;

            if(mysqli_query($conexao, $sql)){
                echo("ENDERECO MODIFICADO\n");
            }

        }elseif($pagina == 'eventos' && $status == 'desativado'){//ATIVA EVENTOS
            $tabela = 'tbl_evento';
            $codigo = $_GET['codigo'];
            $codTabela = 'cod_evento';
            $status = 'ativado';
            $codEndereco = $_GET['codEndereco'];

            // DESATIVA ENDERECO DO EVENTO
            $sql = "UPDATE tbl_endereco SET status = '".$status."' WHERE cod_endereco = ".$codEndereco;

            if(mysqli_query($conexao, $sql)){
                echo("ENDERECO MODIFICADO\n");
            }

        }elseif($pagina == 'promocao' && $status == 'ativado'){//DESATIVA PROMOCAO
            $tabela = 'tbl_promocao';
            $codigo = $_GET['codigo'];
            $codTabela = 'cod_promocao';
            $status = 'desativado';
        }elseif($pagina == 'promocao' && $status == 'desativado'){//ATIVA PROMOCAO
            $tabela = 'tbl_promocao';
            $codigo = $_GET['codigo'];
            $codTabela = 'cod_promocao';
            $status = 'ativado';
            $codProduto = $_GET['cod_produto'];

            //DESATIVA TODAS AS PROMOÇÕES DE UMA MESMO PRODUTO PARA QUE FIQUE SÓ UM ATIVO
            $sql = "UPDATE tbl_promocao SET status = 'desativado' WHERE cod_produto = ".$codProduto;

            // if(mysqli_query($conexao, $sql)){
            //     $sql = "UPDATE tbl_produto SET status = 'ativado' WHERE cod_produto = ".$codProduto;

            //     if(mysqli_query($conexao, $sql)){
            //         echo("PROMOCAO MODIFICADO\n");
            //     }
            // }
        }elseif($pagina == 'nivel_usuario') {//ATIVA E DESATIVA NIVEL DE USUARIO
            if ($_GET['codigo'] != $_SESSION['cod_nivel_usuario'] && $_GET['codigo'] != 1) {
                $tabela = 'tbl_nivel_usuario';
                $codigo = $_GET['codigo'];
                $codTabela = 'cod_nivel_usuario';

                // DESATIVA TODOS OPS USUARIO COM O NIVEL CASA ESSE NIVEL SEJA DESATIVADO
                if ($status == 'desativado') {
                    $sql = "UPDATE tbl_usuario SET status = 'desativado' WHERE cod_usuario > 0 AND cod_nivel_usuario = ".$codigo;

                    if (mysqli_query($conexao, $sql)) {
                        echo("USUARIOS DESATIVADOS\n");
                    } else {
                        echo $sql;
                    }
                }
            }elseif ($_GET['codigo'] == 1){// NÃO DEIXA DESATIVA NIVEL DE USUARIO MASTER
                echo("NÍVEL DE USUÁRIO ADMINISTRADOR NÃO PODE SER DESATIVADO.");
                exit(0);
            }else{//NAO DEIXA DESATIVAR NIVEL DE USUARIO LOGADO
                echo("USUÁRIO ATUALMENTE LOGADO POSSUI ESSE NÍVEL, PORTANTO NÃO PODE SER DESATIVADO.");
                exit(0);
            }

        }elseif($pagina == 'usuario'){//ATIVA E DESATIVA USUARIO
            if($_GET['codigo'] != $_SESSION['cod_usuario'] && $_GET['codigo'] != 1){
                $tabela = 'tbl_usuario';
                $codigo = $_GET['codigo'];
                $codTabela = 'cod_usuario';

            }elseif($_GET['codigo'] == 1){// NÃO DEIXA DESATIVA NIVEL DE USUARIO MASTER
                echo("USUÁRIO ADMINISTRADOR NÃO PODE SER DESATIVADO.");
                exit(0);
            }else{//NAO DEIXA DESATIVAR NIVEL DE USUARIO LOGADO
                echo("USUÁRIO ATUALMENTO LOGADO, PORTANTO NÃO PODE SER DESATIVADO.");
                echo("\n".$_GET['codigo']."\n".$_SESSION['cod_usuario']);
                exit(0);
            }
        }elseif($pagina == 'categoria'){/// ATIVA E DESATIVA NOTICIAS GERAIS
            $tabela = 'tbl_categoria';
            $codigo = $_GET['codigo'];
            $codTabela = 'cod_categoria';
        }elseif($pagina == 'subcategoria'){/// ATIVA E DESATIVA NOTICIAS GERAIS
            $tabela = 'tbl_subcategoria';
            $codigo = $_GET['codigo'];
            $codTabela = 'cod_subcategoria';
        }elseif($pagina == 'produto'){/// ATIVA E DESATIVA NOTICIAS GERAIS
            $tabela = 'tbl_produto';
            $codigo = $_GET['codigo'];
            $codTabela = 'cod_produto';
        }
        // FAZ UPDATE NO BANCO DO REGISTRO USANDO AS VARIAVEIR SETADOS NA CONDIÇÕES ACIMA
        $sql = "UPDATE ".$tabela." SET status = '".$status."' WHERE $codTabela = ".$codigo;

        if(mysqli_query($conexao, $sql)){
            echo("REGISTRO MODIFICADO");
        }else{
            echo $sql;
        }
    }