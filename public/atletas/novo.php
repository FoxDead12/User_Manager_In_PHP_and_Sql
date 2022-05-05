<?php

    session_start();
    include '../../processes/check_login.php';
    //include '../../processes/base_dados/connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atletas</title>

    
    <link rel="stylesheet" href="../../css/novo_atleta.css">

</head>
<body>

<section class="page">

    
    <?php include '../../components/menu.php' ?>

    <div class="form-parent">

       

        <form action="../../processes/criar_atleta.php" method="POST" id="altela-novo" enctype="multipart/form-data">

            <!-- <div class="message-parent">
                <div class="erro-box">Erro</div> 
            </div>  -->

            <?php
                if(isset($_SESSION['erro_novo_atleta'])){

                    echo    '<div class="message-parent">
                                <div class="erro-box">'. $_SESSION['erro_novo_atleta'] .'</div> 
                            </div>';
                }
            ?>

            <h1>Novo Atleta</h1>

            <h5>Foto</h5>

            
            <div class="tipo-dados img-parent">



                <div class="container-img">
                    <img id="img-atleta" src="../../images/user.png" alt="" width="200" height="200">
                   
                    <input type="file" name="imagem" id="imagem" onchange="defenirImg(event)">
                    <label for="imagem">Escolha uma imagem</label>
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

                    <input type="text" value="<?php if(isset($_SESSION['nome'])){ echo $_SESSION['nome']; } ?>" placeholder="Nome" name="nome">
                    
                </div>

                <div class="input-container">

                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>

                    <input type="date" value="<?php if(isset($_SESSION['data_nascimento'])){ echo $_SESSION['data_nascimento']; } ?>" placeholder="Data Nascimento" name="data_nascimento">
                    
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

                    <input type="text" value="<?php if(isset($_SESSION['nacionalidade'])){ echo $_SESSION['nacionalidade']; } ?>" placeholder="Nacionalidade" name="nacionalidade">
                    
                </div>

                <div class="input-container">

                    <div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                    </div>
                    <select name="sexo" >
                        <option value="2" <?php if(isset($_SESSION['sexo'])){ echo 'default'; }else{ echo '';} ?>>Escolha o sexo:</option>
                        <option value="0" <?php if(isset($_SESSION['sexo'])){ if($_SESSION['sexo'] == 0) echo 'default'; } ?> ?>Masculino</option>
                        <option value="1" <?php if(isset($_SESSION['sexo'])){ if($_SESSION['sexo'] == 1) echo 'default'; } ?>>Feminino</option>
                    </select>
                    
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

                    <input type="number" value="<?php if(isset($_SESSION['peso'])){ echo $_SESSION['peso']; } ?>" placeholder="Peso" name="peso">
                    
                </div>

                <div class="input-container">

                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>

                    <input type="number" value="<?php if(isset($_SESSION['potencia'])){ echo $_SESSION['potencia']; } ?>" placeholder="Potência" name="potencia">
                    
                </div>

            </div>

            <h5>Horário</h5>

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
                            <input type="time" name="segunda_inicio">
                        </div>

                        <div class="input-container time">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <input type="time" name="segunda_fim">
                        </div>

                    </div>
                </div>

                <div class="dia-container">

                    <h5>Terça</h5>

                    <div class="dia-row"> 
                        
                        <div class="input-container time">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <input type="time" name="terca_inicio">
                        </div>

                        <div class="input-container time">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <input type="time" name="terca_fim">
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
                            <input type="time" name="quarta_inicio">
                        </div>

                        <div class="input-container time">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <input type="time" name="quarta_fim">
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
                            <input type="time" name="quinta_inicio">
                        </div>

                        <div class="input-container time">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <input type="time" name="quinta_fim">
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
                            <input type="time" name="sexta_inicio">
                        </div>

                        <div class="input-container time">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <input type="time" name="sexta_fim">
                        </div>

                    </div>


                </div>

                <div class="dia-container">

                    <h5>Sábado</h5>

                    <div class="dia-row"> 
                        
                        <div class="input-container time">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <input type="time" name="sabado_inicio">
                        </div>

                        <div class="input-container time">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <input type="time" placeholder="Nacionalidade" name="sabado_fim">
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
                            <input type="time" name="domingo_inicio">
                        </div>

                        <div class="input-container time">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <input type="time" name="domingo_fim">
                        </div>

                    </div>


                </div>
            </div>

            <h5></h5>

            <div class="btn-parent">

                

                <div class="btn-container">
                    <button>Adicionar</button>
                </div>
            </div>
        </form>

    </div>
    
</section>


<script>

    function defenirImg(event){

        // var file_input = document.getElementById("input-img");
        // var img = file_input.value
        // console.log("Image: " + img);

        // var img_element = document.getElementById("img-atleta");
        // img_element.src = img;

        var image = document.getElementById('img-atleta');
	    image.src = URL.createObjectURL(event.target.files[0]);

    }  


</script>

</body>
</html>

<?php
    unset($_SESSION['erro_novo_atleta']);
?>