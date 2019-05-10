<?php


    session_start();
    if(isset($_SESSION['cod_usuario'])){
        if(empty($_SESSION['cod_usuario'])){
            session_destroy();
            header('location: ../index.php');
        }
    }else{
        session_destroy();
        header('location: ../index.php');
    }
