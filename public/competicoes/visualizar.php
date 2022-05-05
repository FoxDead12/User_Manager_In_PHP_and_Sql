<?php

    session_start();
    include '../../processes/check_login.php';

    if(!isset($_GET['competicao'])){

        header("Location: ../../public/home.php");
    }
    if($_GET['competicao'] == ""){
        header("Location: ../../public/atletas.php");

    }

    include '../../processes/base_dados/connect.php';
    $atleta_id = $_GET['competicao'];

    $query_get_competicao = "SELECT * FROM competicao c ,  escaloes es WHERE  c.id_escalao = es.id_escalao AND c.id_competicao = $atleta_id";
    $query_get_equipas = "SELECT * FROM competicao c ,  equipas e WHERE c.id_competicao = e.id_competicao AND c.id_competicao = $atleta_id";

    $query_get_competicao_result = mysqli_query($conn, $query_get_competicao);
    $query_get_equipas_result = mysqli_query($conn, $query_get_equipas);


    //Carregar Dados Competição
    
    if(mysqli_num_rows($query_get_competicao_result) > 0){

        $dados["dados"] = mysqli_fetch_assoc($query_get_competicao_result);
    }


    $time1 = $dados["dados"]['horas_prova'];
    $time2 = $dados["dados"]['duracao'];
    $time = strtotime($time1) + strtotime($time2) - strtotime('00:00:00');
    $time_final = date('H:i', $time);
    $data_fim = $dados["dados"]['data_prova'];
    $dados["dados"]['horas_prova'] = date('H:i', strtotime( $dados["dados"]['horas_prova']));

    if($time_final <=  $dados["dados"]['horas_prova']){

        $date = new DateTime($data_fim);
        $date->add(new DateInterval('P1D'));
        $data_fim =  $date->format('Y-m-d');
    }



    //Carregar Equipas Inscritas Nesta competição
    if(mysqli_num_rows($query_get_equipas_result) > 0){

        while($row = mysqli_fetch_assoc($query_get_equipas_result)){
            $dados["equipas"][] = $row;
        }

    }


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atletas</title>

    <link rel="stylesheet" href="../../css/visualizar_atleta.css">
    <link rel="stylesheet" href="../../css/competicao_visualizar.css">


</head>
<body>
    
    <section>
        <?php include '../../components/menu.php' ?>

        <div class="form-parent">
            <form action="../equipas/gerar.php" id="altela-visualizar" method="POST">
                <input type="text" name="id_comp" style="display:none;"  value="<?php echo $dados['dados']['id_competicao']; ?>" >
                <h1>Competição</h1>

                <h5>Dados Competição</h5>
                <div class="tipo-dados">
                    <!-- Dados Pessoais -->
                    
                    <div class="input-container">

                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>

                        <input type="text" placeholder="Nome" value="<?php echo $dados['dados']['nome_competicao'] ?>" disabled>
                        
                    </div>
                    
                </div>

                <div class="tipo-dados">
                    <!-- Dados Pessoais -->
                    
                    <div class="input-container">

                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>

                        <input type="date" placeholder="Nome" value="<?php echo $dados["dados"]['data_prova']; ?>" disabled>
                        
                    </div>

                    <div class="input-container">

                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>

                        <input type="date" placeholder="Nome" value="<?php echo $data_fim; ?>" disabled>
                        
                    </div>
                    
                </div>

                <div class="tipo-dados">
                    <!-- Dados Pessoais -->
                    
                   
                    <div class="input-container">

                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>

                        <input type="time" placeholder="Nome" value="<?php echo $dados["dados"]['horas_prova']; ?>" disabled>
                        
                    </div>

                    <div class="input-container">

                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>

                        <input type="time" placeholder="Nome" value="<?php echo $time_final; ?>" disabled>

                    </div>
                    
                </div>

                <h5>Dados Inscrição</h5>

                <div class="tipo-dados">
                    <!-- Dados Pessoais -->
                    
                   <div class="input-container">

                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M12 14l9-5-9-5-9 5 9 5z" />
                                <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                            </svg>
                        </div>

                        <input type="text" placeholder="Escalão" value="<?php echo $dados['dados']['nome_escalao'] ?>" disabled>
                        
                    </div>

                   
                </div>

                <div class="tipo-dados">
                    <!-- Dados Pessoais -->
                    
                    <div class="input-container">

                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 15.546c-.523 0-1.046.151-1.5.454a2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.701 2.701 0 00-1.5-.454M9 6v2m3-2v2m3-2v2M9 3h.01M12 3h.01M15 3h.01M21 21v-7a2 2 0 00-2-2H5a2 2 0 00-2 2v7h18zm-3-9v-2a2 2 0 00-2-2H8a2 2 0 00-2 2v2h12z" />
                            </svg>
                        </div>

                        <input type="text" placeholder="Idade" value="<?php echo $dados['dados']['idade_minima'] ?>" disabled>
                        
                    </div>


                    <div class="input-container">

                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 15.546c-.523 0-1.046.151-1.5.454a2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.701 2.701 0 00-1.5-.454M9 6v2m3-2v2m3-2v2M9 3h.01M12 3h.01M15 3h.01M21 21v-7a2 2 0 00-2-2H5a2 2 0 00-2 2v7h18zm-3-9v-2a2 2 0 00-2-2H8a2 2 0 00-2 2v2h12z" />
                            </svg>
                        </div>

                        <input type="text" placeholder="Idade" value="<?php echo $dados['dados']['idade_maxima'] ?>" disabled>
                        
                    </div>

                   
                </div>

                <div class="tipo-dados">
                    <!-- Dados Pessoais -->
                    
                    <div class="input-container">

                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>

                        <input type="text" placeholder="Jogadores Minimos" value="<?php echo $dados['dados']['numero_equipa_min'] ?>" disabled>
                        
                    </div>


                    <div class="input-container">

                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>

                        <input type="text" placeholder="Jogadores Minimos" value="<?php echo $dados['dados']['numero_equipa_max'] ?>" disabled>
                        
                    </div>

                   
                </div>

                <h5>Equipas Inscritas</h5>

                <div class="tipo-dados show-equipas">
                    <!-- Dados Pessoais -->
                    
                    <?php 
                        if(isset($dados['equipas'])){
                            foreach($dados['equipas'] as $equipa) {
                                ?>
                                <div class="input-container">
                                    <a href="../equipas/visualizar.php?equipa=<?php echo $equipa['id_equipa'] ?>"></a>
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                        </svg>
                                    </div>
                                    <input type="text" placeholder="Equipa" value="<?php echo $equipa['nome_equipa'] ?>" disabled>
                                </div>
                                <?php
                            }
                        }
                        else{
                            echo "<h5>Sem Equipas Inscritas</h5>";
                        }
                    ?>



                    <!-- <div class="input-container">

                        <a href="../equipas/visualizar.php"></a>

                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>

                        <input type="text" placeholder="Equipa" value="equipa_22_competicao_A" disabled>
                        
                    </div> -->
                  
                </div>

                <h5></h5>

                <div class="btn-parent">

                    <div class="btn-container">
                        <button>Inscrever Equipa</button>
                    </div>

                </div>


            </form>
        </div>

    </section>

    
</body>
</html>