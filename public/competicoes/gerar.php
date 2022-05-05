<?php 

session_start();
include '../../processes/check_login.php';
include '../../processes/base_dados/connect.php';

$query_get_escaloes = "SELECT * FROM escaloes";
$query_get_escaloes_result = mysqli_query($conn, $query_get_escaloes);



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
    <link rel="stylesheet" href="../../css/equipas_visualizar.css">
    <link rel="stylesheet" href="../../css/competicao_visualizar.css">


</head>
<body>
    
    <section>
        <?php include '../../components/menu.php' ?>

        <div class="form-parent">

        

        <form action="../../processes/criar_competicao.php" method="POST" id="altela-visualizar">

            <?php
                if(isset($_SESSION['erro_novo_competicao'])){

                    echo    '<div class="message-parent">
                                <div class="erro-box">'. $_SESSION['erro_novo_competicao'] .'</div> 
                            </div>';
                }
            ?>


            <h1>Dados Competição</h1>
            <h5>Dados Competição</h5>

            <div class="tipo-dados">
                <!-- Dados Pessoais -->
                
                <div class="input-container">

                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>

                    <input type="text" placeholder="Nome" value="<?php if(isset($_SESSION['nome_comp'])){echo $_SESSION['nome_comp'];} ?>" name="nome" >
                    
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

                    <input type="date" placeholder="data" value="<?php if(isset($_SESSION['data_comp'])){echo $_SESSION['data_comp'];} ?>" name="data" >
                    
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

                    <input type="time" placeholder="horas" value="<?php if(isset($_SESSION['hora_comp'])){echo $_SESSION['hora_comp'];} ?>" name="horas" >
                    
                </div>

                <div class="input-container">

                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>

                    <input type="time" placeholder="duracao" value="<?php if(isset($_SESSION['duracao_comp'])){echo $_SESSION['duracao_comp'];} ?>" name="duracao" >
                    
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

                    <select name="categoria" >
                        <option value="0">Escolha o Escalão:</option>
                        <?php  while($row = mysqli_fetch_assoc($query_get_escaloes_result)){ ?>
                            <option <?php if(isset($_SESSION['categoria_comp'])){ if($_SESSION['categoria_comp'] == $row['id_escalao']){echo "selected";} } ?> value="<?php echo $row['id_escalao']; ?>">Escalão <?php echo $row['nome_escalao']; ?>, Sexo: <?php if($row['sexo'] == 1){echo "Masculino";}else{echo "Femenino";} ?></option>
                        <?php } ?>
                    </select>
                    
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

                    <input type="text" placeholder="Idade Minima" value="<?php if(isset($_SESSION['idade_min_comp'])){echo $_SESSION['idade_min_comp'];} ?>" name="idade_min">
                    
                </div>


                <div class="input-container">

                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 15.546c-.523 0-1.046.151-1.5.454a2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.701 2.701 0 00-1.5-.454M9 6v2m3-2v2m3-2v2M9 3h.01M12 3h.01M15 3h.01M21 21v-7a2 2 0 00-2-2H5a2 2 0 00-2 2v7h18zm-3-9v-2a2 2 0 00-2-2H8a2 2 0 00-2 2v2h12z" />
                        </svg>
                    </div>

                    <input type="text" placeholder="Idade Maxima" value="<?php if(isset($_SESSION['idade_max_comp'])){echo $_SESSION['idade_max_comp'];} ?>" name="idade_max">
                    
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

                    <input type="text" placeholder="Jogadores Minimos" value="<?php if(isset($_SESSION['jogadores_min_comp'])){echo $_SESSION['jogadores_min_comp'];} ?>" name="jogadores_min">
                    
                </div>


                <div class="input-container">

                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>

                    <input type="text" placeholder="Jogadores Maximo" value="<?php if(isset($_SESSION['jogadores_max_comp'])){echo $_SESSION['jogadores_max_comp'];} ?>" name="jogadores_max" >
                    
                </div>

                
            </div>

            <div class="btn-parent">
                <div class="btn-container">
                    <button onclick="">Criar Equipa</button>
                </div>
            </div>  
        </form>

       
    </div>

    </section>


</body>

<?php
    unset($_SESSION['erro_novo_competicao']);
?>
