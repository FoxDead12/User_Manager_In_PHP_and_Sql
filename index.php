<?php


//Realizar a ligação a base de dados


//Verificar se existe alguem logado
//Rederiecionar para o Login

    session_start();

    
    include 'processes/check_login.php';

    header("Location: public/home.php");
    exit();

?>