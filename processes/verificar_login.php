
<?php

    session_start();
    $email = $_POST['email'];
    $passwordd = $_POST['password'];
    $erro = VerificarInput($email, $passwordd);


    //Caso exista algum erro de input ele vai rederecionar para a pagina de login de novo
    if($erro != ""){

        $_SESSION['erro_login'] = $erro;
        header("Location: ../public/login.php");
    }

    
    //Iniciar Conexão a base de dados
    include '../processes/base_dados/connect.php';

    $passwordd = md5($passwordd);
    echo $passwordd;
    $sql = "SELECT token FROM users WHERE email = '$email' AND palavrachave = '$passwordd' ";
    $result = mysqli_query($conn, $sql);


    if (mysqli_num_rows($result) > 0) {

        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
          
            $_SESSION['id_user'] = $row['token'];
            header("Location: ../public/home.php");

        }

    } else {

        $erro = "Utilizador não existe!";
    }


    if($erro != ""){

        $_SESSION['erro_login'] = $erro;
        header("Location: ../public/login.php");
    }

    $conn->close();

    function VerificarInput($email, $password){

        $erroFound = "";

        if($email == "" || $password == ""){

            $erroFound = "Preencha todos os campos!";
        }
        else if(stripos($email, '@') == false){

            $erroFound = "Insira um email valido!";
        }
        else if(strlen($password) < 4){

            $erroFound = "Password deve possuir 4 caracteres!";
        }
        

        return $erroFound;
    }

    
    
?>