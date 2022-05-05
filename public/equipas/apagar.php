<?php

session_start();
include '../../processes/check_login.php';


if(!isset($_POST['equipa'])){

    header("Location: ../../public/home.php");
}
if($_POST['equipa'] == ""){
    header("Location: ../../public/equipas.php");

}

include '../../processes/base_dados/connect.php';
$equipa = $_POST['equipa'];

$query_get_Equipa = "SELECT * FROM equipas e, competicao c , escaloes es  WHERE  e.id_competicao = c.id_competicao AND c.id_escalao = es.id_escalao AND   e.id_equipa = $equipa";
$query_get_Atletas = "SELECT * FROM equipa_jogadores ej, atletas a, escaloes es WHERE (a.peso / a.potencia) >= es.min_potencia AND (a.peso / a.potencia) <= es.max_potencia AND es.sexo = a.sexo AND a.id_atleta = ej.id_jogador AND  ej.id_equipa = $equipa";
$query_get_Equipa_result = mysqli_query($conn, $query_get_Equipa);
$query_get_Atletas_result = mysqli_query($conn, $query_get_Atletas);

$dados_equipa = mysqli_fetch_assoc($query_get_Equipa_result);



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atletas</title>

    <link rel="stylesheet" href="../../css/visualizar_atleta.css">
    <link rel="stylesheet" href="../../css/equipas_visualizar.css">
    <link rel="stylesheet" href="../../css/editar_atleta.css">


</head>
<body>
    
    <section>

    <div class="container-delete">
                <form action="../../processes/apagar_equipa.php?equipa=<?php echo $equipa; ?>" method="POST">
                    <h1>Tem a certeza?</h1>
                    <h5>Vai apagar permanentemente a equipa <?php echo $dados_equipa['nome_equipa']; ?></h5>
                    <div class="btns-group">

                        <div class="btn-container ">
                            <button name="sim">Sim</button>
                        </div>

                        <div class="btn-container btn-apagar">
                            <button name="nao">Não</button>
                        </div>

                    </div>
                </form>
            </div>


        <?php include '../../components/menu.php' ?>

        <div class="form-parent">

            <form action="" id="altela-visualizar">

                <h1>Equipa</h1>

                <h5>Equipa</h5>
                <div class="tipo-dados">
                    <!-- Dados Pessoais -->
                    
                    <div class="input-container">

                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>

                        <input type="text" placeholder="Nome" value=" <?php echo $dados_equipa['nome_equipa']; ?> " disabled>
                        
                    </div>


                </div>

                <h5>Competição</h5>
                <div class="tipo-dados">
                    <!-- Dados Pessoais -->
                    
                    <div class="input-container">

                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>

                        <input type="text" placeholder="Nome" value=" <?php echo $dados_equipa['nome_competicao']; ?> " disabled>
                        
                    </div>

                   <div class="input-container">

                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M12 14l9-5-9-5-9 5 9 5z" />
                                <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                            </svg>
                        </div>

                        <input type="text" placeholder="Escalão" value="Escalão <?php echo $dados_equipa['nome_escalao']; ?>" disabled>
                        
                    </div>
                    

                </div>


                <h5>Jogadores</h5>

                <div class="tipo-dados list-cards">
                <?php if(mysqli_num_rows($query_get_Atletas_result) > 0){ 
                    while($jogadore = mysqli_fetch_assoc($query_get_Atletas_result)){ 
                        $idade = CalcularIdade($jogadore['data_nascimento']);
                    ?>

                

                    <div class="player-card">
                        <a target="_blank" href="../atletas/visualizar.php?atleta=<?php echo $jogadore['id_atleta']; ?>"></a>

                        <div class="another-info">


                            <div class="info-container">
                                
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path d="M12 14l9-5-9-5-9 5 9 5z" />
                                        <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                                    </svg>
                                </div>

                                <h3>Escalão <?php echo $jogadore['nome_escalao']; ?></h3>
                            </div> 

                            <div class="info-container">

                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>

                                <h3><?php echo $idade; ?></h3>
                            </div>    

                            <div class="info-container">
                                
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 15.546c-.523 0-1.046.151-1.5.454a2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.701 2.701 0 00-1.5-.454M9 6v2m3-2v2m3-2v2M9 3h.01M12 3h.01M15 3h.01M21 21v-7a2 2 0 00-2-2H5a2 2 0 00-2 2v7h18zm-3-9v-2a2 2 0 00-2-2H8a2 2 0 00-2 2v2h12z" />
                                    </svg>
                                </div>

                                <h3><?php echo $jogadore['nacionalidade']; ?></h3>
                            </div>   

                        </div>

                        <img src="../../images/atletas/<?php echo $jogadore['imagem']; ?>" alt="" width="220" height="300">

                        <div class="info">
     
                            <div class="info-container">

                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>

                                <h3><?php echo $jogadore['nome']; ?></h3>
                            </div>   

                           
                            
                            
                        </div>


                    </div>
                    
                    

                  
                    
                

                <?php } }?>
                </div>



                <div class="btn-parent">

                    <div class="btn-container btn-apagar">
                        <button name="apagar">Apagar</button>
                    </div>
                                        
                </div>
            </div>

            </form>
        </div>

    </section>

    
</body>
</html>



<?php


    function CalcularIdade($data){

        list($ano, $mes, $dia) = explode('-', $data);
        $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));


        // Descobre a unix timestamp da data de nascimento do fulano
        $nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);
        $idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);

        return $idade;
    }

?>