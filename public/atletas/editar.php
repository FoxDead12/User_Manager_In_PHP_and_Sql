<?php

    session_start();
    include '../../processes/check_login.php';

    if(!isset($_GET['atleta'])){

        header("Location: ../../public/home.php");
    }
    if($_GET['atleta'] == ""){
        header("Location: ../../public/atletas.php");

    }


    include '../../processes/base_dados/connect.php';
    $atleta_id = $_GET['atleta'];

    $query_get_Atleta = "SELECT * FROM atletas a, escaloes e WHERE a.id_atleta = $atleta_id AND (a.peso / a.potencia) >= e.min_potencia AND (a.peso / a.potencia) <= e.max_potencia AND e.sexo = a.sexo";
    $query_get_Atleta_result = mysqli_query($conn, $query_get_Atleta);

    
    if(mysqli_num_rows($query_get_Atleta_result) == 0){

        return;

        
    }

    $dados_player = mysqli_fetch_assoc($query_get_Atleta_result);

    $apagar = false;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        if(isset($_POST['apagar'])){

            $apagar = true;
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

    <link rel="stylesheet" href="../../css/novo_atleta.css">
    <link rel="stylesheet" href="../../css/visualizar_atleta.css">
    <link rel="stylesheet" href="../../css/editar_atleta.css">

</head>
<body>
    
    <section class="<?php if($apagar == true) echo 'apagar'; ?>">

        <!-- Menu Apagar -->
        <?php if($apagar == true){ ?>
            <div class="container-delete">
                <form action="../../processes/apagar_atleta.php?atleta=<?php echo $atleta_id; ?>" method="POST">
                    <h1>Tem a certeza?</h1>
                    <h5>Vai apagar permanentemente o jogador <?php echo $dados_player['nome']; ?></h5>
                    <div class="btns-group">

                        <div class="btn-container ">
                            <button name="sim">Sim</button>
                        </div>

                        <div class="btn-container btn-apagar">
                            <button name="nao">N??o</button>
                        </div>

                    </div>
                </form>
            </div>
        <?php } ?>

        <?php include '../../components/menu.php' ?>

        <div class="form-parent">

            <form action="../../processes/editar_atleta.php?atleta=<?php echo $atleta_id;?>" method="POST" id="altela-visualizar" enctype="multipart/form-data">

                
                <?php
                    if(isset($_SESSION['erro_editar_atleta'])){

                        echo    '<div class="message-parent">
                                    <div class="erro-box">'. $_SESSION['erro_editar_atleta'] .'</div> 
                                </div>';
                    }
                ?>


                <h1>Editar Atleta</h1>


                <div class="tipo-dados img-parent">

                    <div class="container-img">
                        <img id="img-atleta" name="imagem" src="<?php echo '../../images/atletas/'.$dados_player['imagem']; ?>" alt="" width="200" height="200">
                    
                        <input type="file" name="imagem" id="imagem" value="<?php echo '../../images/atletas/'.$dados_player['imagem']; ?>" onchange="defenirImg(event)" onchange="AtivarButao()">
                        <!-- <label for="imagem">Escolha uma imagem</label> -->
                    </div>

                </div>

                <h5>Dados Pessoais</h5>
                <div class="tipo-dados">
                    <!-- Dados Pessoais -->
                    
                    <div class="input-container">

                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>

                        <input type="text" name="nome" placeholder="Nome" value="<?php echo $dados_player['nome']; ?>" onchange="AtivarButao()">
                        
                    </div>

                    <div class="input-container">

                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>

                        <input type="date" name="data_nascimento"  value="<?php echo $dados_player['data_nascimento']; ?>" placeholder="Data Nascimento" onchange="AtivarButao()" >
                        
                    </div>


                </div>

                <div class="tipo-dados">
                    <!-- Dados Pessoais -->
                    
                    <div class="input-container">

                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>

                        <input type="text" name="nacionalidade" placeholder="Nacionalidade" value="<?php echo $dados_player['nacionalidade']; ?>" onchange="AtivarButao()">
                        
                    </div>

        

                </div>

                <h5>Dados Fisicos</h5>

                <div class="tipo-dados">
                    <!-- Dados Fisicos -->
                    
                    <div class="input-container">

                        <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.879 16.121A3 3 0 1012.015 11L11 14H9c0 .768.293 1.536.879 2.121z" />
                        </svg>
                        </div>

                        <input type="number" name="peso" placeholder="Peso" value="<?php echo $dados_player['peso']; ?>" onchange="AtivarButao()">
                        
                    </div>

                    <div class="input-container">

                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>

                        <input type="number" name="potencia" placeholder="Pot??ncia" value="<?php echo $dados_player['potencia']; ?>" onchange="AtivarButao()">
                        
                    </div>

                </div>

                <div class="tipo-dados">
                    <!-- Dados Fisicos -->
                    
                    <div class="input-container">

                        <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M12 14l9-5-9-5-9 5 9 5z" />
                        <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                        </svg>
                        </div>

                        <input type="text" disabled placeholder="Escal??o" value="Escal??o <?php echo $dados_player['nome_escalao']; ?>" onchange="AtivarButao()">
                        
                    </div>

                    <div class="input-container">

                        

                        <!-- <input type="text" onchange="AtivarButao()" placeholder="Pot??ncia" value="<?php if($dados_player['sexo'] == 0){echo "Masculino";}else{echo "Feminino";} ?>" > -->

                        <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                        </div>

                        <select name="sexo" onchange="AtivarButao()">
                            <!-- <option name="sexo" value="2" <?php echo ''; ?>>Escolha o sexo:</option> -->
                            <option name="sexo" value="0" <?php if($dados_player['sexo'] == 0) {echo 'selected '; } ?>>Masculino</option>
                            <option name="sexo" value="1" <?php if($dados_player['sexo'] == 1) {echo 'selected '; } ?>>Feminino</option>
                        </select>
                    
                    </div>

                </div>

                <h5>Hor??rio</h5>

                <div class="dias">
                <!-- Horario -->
                    <div class="dia-container">
                        <h5>Segunda</h5>

                        <div class="dia-row"> 
                            
                            <div class="input-container time">
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <input type="time" name="segunda_inicio" value="<?php $time =  explode(" ", $dados_player['segunda']); $horas = $time[0]; echo substr($horas, 0, 2) . ":". substr($horas, 2); ?>" onchange="AtivarButao()">
                            </div>

                            <div class="input-container time">
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <input type="time" name="segunda_fim" value="<?php $time =  explode(" ", $dados_player['segunda']); $horas = $time[1]; echo substr($horas, 0, 2) . ":". substr($horas, 2); ?>" onchange="AtivarButao()">
                            </div>

                        </div>
                    </div>

                    <div class="dia-container">

                        <h5>Ter??a</h5>

                        <div class="dia-row" > 
                            
                            <div class="input-container time">
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <input type="time" name="terca_inicio" value="<?php $time =  explode(" ", $dados_player['terca']); $horas = $time[0]; echo substr($horas, 0, 2) . ":". substr($horas, 2); ?>" onchange="AtivarButao()">
                            </div>

                            <div class="input-container time">
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <input type="time" name="terca_fim" value="<?php $time =  explode(" ", $dados_player['terca']); $horas = $time[1]; echo substr($horas, 0, 2) . ":". substr($horas, 2); ?>" onchange="AtivarButao()">
                            </div>

                        </div>


                    </div>

                    <div class="dia-container">

                        <h5>Quarta</h5>

                        <div class="dia-row"> 
                            
                            <div class="input-container time">
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <input type="time" name="quarta_inicio" value="<?php $time =  explode(" ", $dados_player['quarta']); $horas = $time[0]; echo substr($horas, 0, 2) . ":". substr($horas, 2); ?>" onchange="AtivarButao()">
                            </div>

                            <div class="input-container time">
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <input type="time" name="quarta_fim" value="<?php $time =  explode(" ", $dados_player['quarta']); $horas = $time[1]; echo substr($horas, 0, 2) . ":". substr($horas, 2); ?>" onchange="AtivarButao()">
                            </div>

                        </div>


                    </div>

                    <div class="dia-container">

                        <h5>Quinta</h5>

                        <div class="dia-row"> 
                            
                            <div class="input-container time">
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <input type="time" name="quinta_inicio" value="<?php $time =  explode(" ", $dados_player['quinta']); $horas = $time[0]; echo substr($horas, 0, 2) . ":". substr($horas, 2); ?>" onchange="AtivarButao()">
                            </div>

                            <div class="input-container time">
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <input type="time" name="quinta_fim" value="<?php $time =  explode(" ", $dados_player['quinta']); $horas = $time[1]; echo substr($horas, 0, 2) . ":". substr($horas, 2); ?>" onchange="AtivarButao()">
                            </div>

                        </div>


                    </div>

                    <div class="dia-container">

                        <h5>Sexta</h5>

                        <div class="dia-row"> 
                            
                            <div class="input-container time">
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <input type="time" name="sexta_inicio" value="<?php $time =  explode(" ", $dados_player['sexta']); $horas = $time[0]; echo substr($horas, 0, 2) . ":". substr($horas, 2); ?>" onchange="AtivarButao()">
                            </div>

                            <div class="input-container time">
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <input type="time" name="sexta_fim" value="<?php $time =  explode(" ", $dados_player['sexta']); $horas = $time[1]; echo substr($horas, 0, 2) . ":". substr($horas, 2); ?>" onchange="AtivarButao()">
                            </div>

                        </div>


                    </div>

                    <div class="dia-container">

                        <h5>S??bado</h5>

                        <div class="dia-row"> 
                            
                            <div class="input-container time">
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <input type="time" name="sabado_inicio" value="<?php $time =  explode(" ", $dados_player['sabado']); $horas = $time[0]; echo substr($horas, 0, 2) . ":". substr($horas, 2); ?>" onchange="AtivarButao()">
                            </div>

                            <div class="input-container time">
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <input type="time" name="sabado_fim" value="<?php $time =  explode(" ", $dados_player['sabado']); $horas = $time[1]; echo substr($horas, 0, 2) . ":". substr($horas, 2); ?>" onchange="AtivarButao()">
                            </div>

                        </div>


                    </div>

                    <div class="dia-container">

                        <h5>Domingo</h5>

                        <div class="dia-row"> 
                            
                            <div class="input-container time">
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <input type="time" name="domingo_inicio" value="<?php $time =  explode(" ", $dados_player['domingo']); $horas = $time[0]; echo substr($horas, 0, 2) . ":". substr($horas, 2); ?>" onchange="AtivarButao()">
                            </div>

                            <div class="input-container time">
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <input type="time" name="domingo_fim" value="<?php $time =  explode(" ", $dados_player['domingo']); $horas = $time[1]; echo substr($horas, 0, 2) . ":". substr($horas, 2); ?>" onchange="AtivarButao()">
                            </div>

                        </div>


                    </div>
                </div>

                <h5></h5>

                <div class="btn-parent">
                    
                    <!-- <div class="btn-container btn-apagar">
                        <button name="apagar">Apagar</button>
                    </div> -->

                    <div class="btn-container">
                        <button id="edit_guardar" name="guardar" disabled>Guardar</button>
                    </div>
                
                </div>


            </div>

            </form>
        </div>

    </section>


    <script>

        var btn_gaurdar = document.getElementById("edit_guardar");

        btn_gaurdar.disabled = true;
        function AtivarButao(){

            btn_gaurdar.disabled = false;
            console.log("MUDOU ESTADO");
        }

    </script>
    
</body>
</html>


<?php

mysqli_close($conn);
unset($_SESSION['erro_editar_atleta']);

?>