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

    //Buscar Competições
    $query_getCompeticoes = "SELECT * , (SELECT COUNT(e.id_equipa) FROM equipas e WHERE e.id_competicao = c.id_competicao) AS NumEquipas FROM competicao c , escaloes es WHERE c.id_escalao = es.id_escalao ORDER BY c.nome_competicao LIKE '$pesquisa%' LIMIT ". ($current_pagina * $linhas_para_mostrar) ."," . $linhas_para_mostrar ."";
    $query_getCompeticoes_result = mysqli_query($conn, $query_getCompeticoes);



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Competições </title>

    <link rel="stylesheet" href="../css/menu.css">

</head>
<body>

    <?php

        if(isset($_SESSION['sucesso'])){

            echo '<div class="sucesso-box" id="succes-message">'.$_SESSION['sucesso'].'</div>';
        }
    ?>
    
    <section>
        <?php include '../components/menu.php' ?>

        <div>
            <?php include '../components/competicoes_table.php' ?>
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
