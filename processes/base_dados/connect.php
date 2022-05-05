<?php


    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ciclismos";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);


    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
        $erro = "Erro a ligar ao servidor!";
    }
    //echo "Connected successfully";

?>