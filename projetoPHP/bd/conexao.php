<?php
    // FUNÇÃO DE CONEXÃO COM O BANCO DE DADOS MY SQL
    function conexaoMySql(){
        // $conexao = null; //VARIAVEL QUE RECEBERA OS PARAMETROS DA CONEXÃO

        $server = 'localhost'; //VARIAVEL QUE GUARDA O LOCAL DO SERVIDOR DO BANCO
        $user = 'root'; //VARIAVEL QUE GUARDA O USUARIO DO BANCO
        $password = 'bcd127'; //VARIAVEL QUE GUARDA A SENHA DO BANCO
        $database = 'db_rrcb'; //VARIAVEL QUE GUARDA O O NOME DO BANCO

        $conexao = mysqli_connect($server, $user, $password, $database);//CRIANDO CONEXÃO COM O BANCO A PARTIR DOS PARAMETROS
        return $conexao;
    }
?>