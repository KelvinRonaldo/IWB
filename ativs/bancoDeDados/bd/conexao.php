<?php

    function conexaoMySql(){
        /*
            mysql_connect() → biblioteca de conexão com BD mysql
            vigente até o PHP 5.6

            mysqli() → biblioteca de conexão com BD mysql
            vigente até o PHP 5.6

            PDO → biblioteca de conexão com BD mysql
            mais utilizado em projetos de Orientação a Objetos
        */
        // ↓ varuável que recebe a conexão com o banco de dados
        $conexao = null;

        // Variáveis que estabelecem as conex]ao com o banco de dados
            // ↓caso o server for remoto, essa variavel recebe o ip do server
        $server = "localhost";
        $user = "root";
        $password = "bcd127";
        $database = "db_inf3t20191";

        $conexao = mysqli_connect($server, $user, $password, $database);

        return $conexao;
    }
?>