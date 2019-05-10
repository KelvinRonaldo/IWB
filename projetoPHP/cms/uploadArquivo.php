<?php

    require_once ('./verificarUsuario.php');

    // FAZENDO CONEXAO COM BANCO DE DADOS
    require_once('../bd/conexao.php');
    $conexao = conexaoMySql();

    function excluirArquivo($nomeArquivo){
        //APAGAR UM ARQUIVO
        if(unlink('../arquivos/'.$nomeArquivo)){
            return true;
        }else{
            return false;
        }
    }


    function salvarArquivo($imagem, $modo){

        //TIPOS DE ARQUIVOS PERMITIDOS NO UPLOAD DE IMAGEM
        $arquivosPermitidos = array(".jpg", ".jpeg", ".png");

        // DIRETORIO ONDE SERÃO ENVIADOS OS ARQUIVOS
        $diretorio = "../arquivos/";

        // PARA PEGAR O OBJETO QUE FOI SELCIONA, UTILIZAMOS O '$_FILES' ao invés de post
        // ATRIBUINDO O NOME DO ARQUIVO UPADO À UMA VARIÁVEL
        $arquivo = $imagem['name'];

        // ATRIBUINDO O TAMANHO DO ARQUIVO UPADO À UMA VARIÁVEL
        $tamanhoArquivo = $imagem['size'];

        // CONVERTO O TAMANHO DO ARQUIVO, QUE VEM EM BYTES EM KILOBYTES DIVIDINDO-O POR 1024
        $tamanhoArquivo /= 1024;

        // round() = ARRENDONDA O NUMERO
        $tamanhoArquivo = round($tamanhoArquivo);

        // RETORNA A EXTENSAO DO ARQUIVO(busca na string de trás pra frente)
        $extensaoArquivo = strrchr($arquivo, ".");

        // RETORNA SOMENTE O NOME DO ARQUIVO
        // ---file 'PATHINFO' - pode retornar a extensão
        $nomeArquivo = pathinfo($arquivo, PATHINFO_FILENAME);

        //USAMOS O md5 PARA CRIPTOGRAFAR O NOME DO ARQUIVO ALEM DE GERAR UM ID UNICO QUE NUNCA IRÁ SE REPETIR
        $nomeArquivoCrypt = md5(uniqid(time()).$nomeArquivo);

        /*
            FUNÇÕES DO PHP PARA REALIZAR CRIPTOGRAFIA DE DADOS
            md5('elemento');
            sha1('elemento');
            base64('elemento');
            hash("sha512" ou "sha256", 'elemento')
        */

        // VALIDAÇÃO DE EXTENSOES PERMITIDAS
        if(in_array($extensaoArquivo, $arquivosPermitidos)){
            if($tamanhoArquivo <= 10000){
                //LOCAL QUE A IMAGEM FOI GUARDADA PELO POST DO FORM
                $arquivoTmp = $imagem['tmp_name'];

                //CRIAMOS UM NOVO NOME DO ARQUIVO COM A SUA EXTENSAO
                $foto = $nomeArquivoCrypt.$extensaoArquivo;

                move_uploaded_file($arquivoTmp, $diretorio.$foto);
                if($modo == 'atualizar'){
                    unlink('../arquivos/'.$_SESSION['img']);
                }

                return $foto;
                
            }else{
                // Erro Tamanho do arquivo inválido
                return "sizeError";
            }
        }else{
            // Erro Extensão Inválida
            return "extensionError";
        }
    }
    

?>