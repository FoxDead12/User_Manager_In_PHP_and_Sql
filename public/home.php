<?php

    session_start();
    include '../processes/check_login.php';
    include '../processes/base_dados/connect.php';

    //echo $_SESSION['id_user'];

    $query_count_atletas = "SELECT COUNT(id_atleta) as atletas FROM atletas ";
    $query_count_equipas = "SELECT COUNT(id_equipa) as equipas FROM equipas ";
    $query_get_comp_sem_equipa = "SELECT * FROM competicao c WHERE c.id_competicao NOT IN (SELECT e.id_competicao FROM equipas e)";
    $query_get_user_values = "SELECT nome FROM users where token = '". $_SESSION['id_user'] ."'";

    $query_count_atletas_result = mysqli_query($conn, $query_count_atletas);
    $query_count_equipas_result = mysqli_query($conn, $query_count_equipas);
    $query_get_comp_sem_equipa_result = mysqli_query($conn, $query_get_comp_sem_equipa);
    $query_get_user_values_result = mysqli_query($conn, $query_get_user_values);


    //Variaveis Globais
    $numero_atletas = 0;
    $numero_equipas = 0;
    
    
    //Carregar Número Atletas
    if(mysqli_num_rows($query_count_atletas_result) > 0){

        $count = mysqli_fetch_assoc($query_count_atletas_result);
        $numero_atletas = $count['atletas'];      
    }

    //Carregar Número Equipas
    if(mysqli_num_rows($query_count_equipas_result) > 0){

        $count = mysqli_fetch_assoc($query_count_equipas_result);
        $numero_equipas = $count['equipas'];      
    }

    //Carregar Lista de Competições Sem Equipas
    if(mysqli_num_rows($query_get_comp_sem_equipa_result) > 0){

        while($row = mysqli_fetch_assoc($query_get_comp_sem_equipa_result)){

            $lista_competicao ['lista_competicao'][] = array(
                
                'name' => $row['nome_competicao'],
                'id' => $row['id_competicao']
            );

        }

        
    }
    else{

        $lista_competicao ['lista_competicao'][] = array(

            'name' => 'Nenhuma',
        );
    }
    
    //Carregar Dados Utilizador
    $user_dados = mysqli_fetch_assoc($query_get_user_values_result);
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <link rel="stylesheet" href="../css/home.css">
    <link rel="stylesheet" href="../css/menu.css">


</head>
<body>

<section class="page">


    <?php include '../components/menu.php' ?>

    <div class="home-container">
        <!-- Pagina -->


            

            <div class="container">

                <div class="info">
                    <div>
                        <img src="../images/user.png" alt="" width="60" height="60">
                    </div>

                    <div class="info-text">
                        <h1><?php echo $user_dados['nome']; ?></h1>
                        <h2>Treinador</h2>
                    </div>


                </div>

                <!-- Número de Jogadores -->
                <div class="container-total container-total-jogadores jogadores">
                    <h2>Quantidade Jogadores</h2>
                    <div>
                        <h1><?php echo $numero_atletas; ?></h1>
                    </div>
                </div>


                <div class="container-total container-total-jogadores equipas">
                    <h2>Quantidade Equipas</h2>
                    <div>
                        <h1><?php echo $numero_equipas; ?></h1>
                    </div>
                </div>

                <!-- Competições por inscrever -->
                <div class="container-total competicao">
                    <h2>Competições por Inscrever</h2>
                    <div>
                        <ul>
                            <?php
                            
                                foreach($lista_competicao['lista_competicao'] as $value){
                                    
                                    if(isset($value['id'])){
                                        echo  "<li><a href='../public/competicoes/visualizar.php?competicao=". $value['id'] ."' >". $value['name'] ."</a></li>";
                                    }
                                    else{
                                        echo  "<li><a>". $value['name'] ."</a></li>";

                                    }

                                    
                                }
                            ?>
                        </ul>
                    </div>
                </div>

                
            </div>
    </div>
</section>
    
</body>
</html>


<?php

mysqli_close($conn);

?>