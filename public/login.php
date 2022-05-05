<?php
    session_start();

    if(isset($_SESSION['id_user'])){

        //Sem Sessão Aberta

       header("Location: ../public/home.php");
       exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="stylesheet" href="../css/login.css">

</head>
<body>
    
<div class="container">


    <div class="container-login">

                
       
       
        <?php
            if(isset($_SESSION['erro_login'])){

                echo    '<div class="message-parent">
                            <div class="erro-box">'. $_SESSION['erro_login'] .'</div> 
                        </div> ';
            }
        ?>


        <div class="login-info">
            <div class="trinagulo"></div>
            
            <div class="titulo">
                <div>
                    <h1>Bem-Vindo</h1>
                    <!-- {{-- <h2>de volta</h2> --}} -->
                </div>

                <img src="../images/loginImage.svg" height="300" alt="">
            </div>

            
            
        </div>

        <form class="login-form" action="../processes/verificar_login.php" method="post" novalidate>
            <h1>Login</h1>



            <div>

                <div>

                    <div class="input-container">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </span>
                        <input type="email" placeholder="Email" name="email" id="email" value="" required>
                    </div>


                    <div class="input-container">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </span>
                        <input type="password" placeholder="Password" name="password" id="password" value="" required minlength="4">
                    </div>

                    <div class="submit-container">
                        <input type="submit"  value="Login">
                    </div>

                </div>



            </div>

        </form>
    </div>


</div>


</body>
</html>


<?php
    unset($_SESSION['erro_login']);
?>