<?php

    session_start();
    include '../processes/check_login.php';
    include '../processes/base_dados/connect.php';


    //Verificar se existe pesquisa
    $pesquisa = "";
    if(isset($_GET['search'])){

        $pesquisa = $_GET['search'];
    }

    //Buscar Pagina
    $current_pagina = 0;
    $linhas_para_mostrar = 5;

    if(isset($_GET['page'])){

        $current_pagina = (int) $_GET['page'];
    }

    //Buscar Atletas de pesquisa
    $query_getAtletas = "SELECT * FROM atletas a , escaloes es  WHERE a.sexo = es.sexo AND  (a.peso / a.potencia) >= es.min_potencia AND  (a.peso / a.potencia) <= es.max_potencia   and a.nome LIKE '$pesquisa%' ORDER BY a.nome LIMIT ". ($current_pagina * $linhas_para_mostrar) ."," . $linhas_para_mostrar ."";
    $query_getAtletas_result = mysqli_query($conn, $query_getAtletas);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atletas</title>

    
    <link rel="stylesheet" href="../css/menu.css">
    <link rel="stylesheet" href="../css/atletas.css">

</head>
<body>


<?php

    if(isset($_SESSION['sucesso'])){

        echo '<div class="sucesso-box" id="succes-message">'.$_SESSION['sucesso'].'</div>';
    }
?>

<section class="page">

    



    <?php include '../components/menu.php' ?>

    <div>


        <?php include '../components/atletas_table.php' ?>

        <div style="padding: 1rem;">

            
        </div>
    </div>
</section>


<script>

    

    setTimeout(() => {
        var message = document.getElementById("succes-message");
        console.log(message)

        message.style.opacity = "0"
        
        setTimeout(() => {
            message.style.display = "none"
        }, 200)
    }, 3000)

</script>

</body>
</html>


<?php

    unset($_SESSION['sucesso']);
?>
