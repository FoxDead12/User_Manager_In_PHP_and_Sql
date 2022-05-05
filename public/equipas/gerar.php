<?php

    session_start();
    include '../../processes/check_login.php';

    if(!isset($_POST['id_comp'])){

        header("Location: ../../public/home.php");
    }
    if($_POST['id_comp'] == ""){
        header("Location: ../../public/competicoes.php");

    }

    include '../../processes/base_dados/connect.php';
    $competicao_id = $_POST['id_comp'];

    $query_get_competicao = "SELECT * FROM competicao c ,  escaloes es WHERE  c.id_escalao = es.id_escalao AND c.id_competicao = $competicao_id";
    $query_get_Atletas = "SELECT * FROM atletas a , escaloes es  WHERE a.sexo = es.sexo AND  (a.peso / a.potencia) >= es.min_potencia AND  (a.peso / a.potencia) <= es.max_potencia ";
    $query_get_competicao_result = mysqli_query($conn, $query_get_competicao);
    $query_getAtletas_resulta = mysqli_query($conn, $query_get_Atletas);

  //  $dados['jogadores'] = mysqli_fetch_assoc($query_getAtletas_resulta);
    $dados["competicao"] = mysqli_fetch_assoc($query_get_competicao_result);

    $time1 = $dados["competicao"]['horas_prova'];
    $time2 = $dados["competicao"]['duracao'];
    $time = strtotime($time1) + strtotime($time2) - strtotime('00:00:00');
    $time_final = date('H:i', $time);
    $data_fim = $dados["competicao"]['data_prova'];
    $dados["competicao"]['horas_prova'] = date('H:i', strtotime( $dados["competicao"]['horas_prova']));

    if($time_final <=  $dados["competicao"]['horas_prova']){

        $date = new DateTime($data_fim);
        $date->add(new DateInterval('P1D'));
        $data_fim =  $date->format('Y-m-d');
    }

    //Trabalhar Jogadores Disponiveis para esta equipa

    
    while($jogador = mysqli_fetch_assoc($query_getAtletas_resulta)){

        $jogador_compativel = true;
        $idade = CalcularIdade($jogador['data_nascimento']);

        if( ($jogador['peso'] / $jogador['potencia'] ) > $dados['competicao']['max_potencia']){

            $jogador_compativel = false;
        }

        if($idade <= $dados['competicao']['idade_minima'] || $idade >= $dados['competicao']['idade_maxima'] ){

            $jogador_compativel = false;
        }

        $date = $dados["competicao"]['data_prova'];
        $unixTimestamp = strtotime($date);
        $dayOfWeek = date("l", $unixTimestamp);
        $dia_semana = date('N', strtotime($dayOfWeek));

        

        switch($dia_semana){

            case 7: 
                //Domingo
                if($jogador['domingo'] != ''){

                    $horas_array = explode(" ", $jogador['domingo']);

                    $horaInicio = str_replace(":", "", $dados["competicao"]['horas_prova']);
                    $horaFim = str_replace(":", "", $time_final);

                    

                    if($horas_array[0] <= $horaInicio || $horas_array[1] >= $horaFim){

                    }
                    else{

                        $jogador_compativel = false;
                    }
                    
                }
                else{
                    $jogador_compativel = false;
                }
                break;
            
            case 1:
                //Segunda
                if($jogador['segunda'] != ''){

                    $horas_array = explode(" ", $jogador['segunda']);

                    $horaInicio = str_replace(":", "", $dados["competicao"]['horas_prova']);
                    $horaFim = str_replace(":", "", $time_final);

                    

                    if($horas_array[0] <= $horaInicio || $horas_array[1] >= $horaFim){

                    }
                    else{

                        $jogador_compativel = false;
                    }
                    
                }
                else{
                    $jogador_compativel = false;
                }
                break;

            case 2:
                //Terça
                if($jogador['terca'] != ''){

                    $horas_array = explode(" ", $jogador['terca']);

                    $horaInicio = str_replace(":", "", $dados["competicao"]['horas_prova']);
                    $horaFim = str_replace(":", "", $time_final);

                    

                    if($horas_array[0] <= $horaInicio || $horas_array[1] >= $horaFim){

                    }
                    else{

                        $jogador_compativel = false;
                    }
                    
                }
                else{
                    $jogador_compativel = false;
                }
                break;

            case 3:
                //Quarta
                if($jogador['quarta'] != ''){

                    $horas_array = explode(" ", $jogador['quarta']);

                    $horaInicio = str_replace(":", "", $dados['competicao']['horas_prova']);
                    $horaFim = str_replace(":", "", $time_final);

                    

                    if($horas_array[0] <= $horaInicio || $horas_array[1] >= $horaFim){

                    }
                    else{

                        $jogador_compativel = false;
                    }
                    
                }
                else{
                    $jogador_compativel = false;
                }
                
                break;

            case 4:
                //Quinta
                if($jogador['quinta'] != ''){

                    $horas_array = explode(" ", $jogador['quinta']);

                    $horaInicio = str_replace(":", "", $dados["competicao"]['horas_prova']);
                    $horaFim = str_replace(":", "", $time_final);

                    

                    if($horas_array[0] <= $horaInicio || $horas_array[1] >= $horaFim){

                    }
                    else{

                        $jogador_compativel = false;
                    }
                    
                }
                else{
                    $jogador_compativel = false;
                }
                break;

            case 5:
                //Sexta
                if($jogador['sexta'] != ''){

                    $horas_array = explode(" ", $jogador['sexta']);

                    $horaInicio = str_replace(":", "", $dados["competicao"]['horas_prova']);
                    $horaFim = str_replace(":", "", $time_final);

                    

                    if($horas_array[0] <= $horaInicio || $horas_array[1] >= $horaFim){

                    }
                    else{

                        $jogador_compativel = false;
                    }
                    
                }
                else{
                    $jogador_compativel = false;
                }
                break;

            case 6:
                //Sabado
                if($jogador['sabado'] != ''){

                    $horas_array = explode(" ", $jogador['sabado']);

                    $horaInicio = str_replace(":", "", $dados["competicao"]['horas_prova']);
                    $horaFim = str_replace(":", "", $time_final);

                    

                    if($horas_array[0] <= $horaInicio || $horas_array[1] >= $horaFim){

                    }
                    else{

                        $jogador_compativel = false;
                    }
                    
                }
                else{
                    $jogador_compativel = false;
                }
                break;
        }
        
        if($jogador_compativel == true){

            $jogador['idade'] = $idade;
            $dados["jogadores"][] = $jogador;
        }

    }
    
    $equipaJogadores = [];
    

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
<script>

    var jogadoresDisponiveis = <?php echo json_encode($dados["jogadores"]); ?>;
    var dadosCompeticao = <?php echo json_encode($dados["competicao"]); ?>;
    var jogadoresEquipa = [];
    var jogador = {

        'add': function(jogador_id){

            var naEquipa = true;
            for(var i = 0; i <= jogadoresEquipa.length - 1; i++){

                if(jogadoresEquipa[i].id_atleta == jogador_id){
                    naEquipa = false;
                }
            }

            if(naEquipa == true){

                for(var i = 0; i <= jogadoresDisponiveis.length - 1; i++){

                    if(jogadoresDisponiveis[i].id_atleta == jogador_id){
                        jogadoresEquipa.push(jogadoresDisponiveis[i])
                        $('#show-atletas-choose').html( $('#show-atletas-choose').html() 
                        + '<div class="player-card"> <div data-text-tooltip="Remover" onclick="jogador.remove('+ jogador_id +')" class="button-remove-player "><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg></div>'+
                        '<div class="another-info">'+
                        ' <div class="info-container">'+
                                
                                '<div>'+
                                ' <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">'+
                                        '<path d="M12 14l9-5-9-5-9 5 9 5z" />'+
                                        '<path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />'+
                                    ' <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />'+
                                    '</svg>'+
                                '</div>'+

                            ' <h3>Escalão '+ jogadoresDisponiveis[i].nome_escalao +'</h3>'+
                            '</div> '+

                            '<div class="info-container">'+

                                '<div>'+
                                ' <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">'+
                                        '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />'+
                                ' </svg>'+
                                '</div>'+

                                '<h3>'+jogadoresDisponiveis[i].nacionalidade+'</h3>'+
                            '</div>    '+

                        ' <div class="info-container">'+
                                
                            ' <div>'+
                                    '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">'+
                                    ' <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 15.546c-.523 0-1.046.151-1.5.454a2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.701 2.701 0 00-1.5-.454M9 6v2m3-2v2m3-2v2M9 3h.01M12 3h.01M15 3h.01M21 21v-7a2 2 0 00-2-2H5a2 2 0 00-2 2v7h18zm-3-9v-2a2 2 0 00-2-2H8a2 2 0 00-2 2v2h12z" />'+
                                    '</svg>'+
                                '</div>'+

                                '<h3>'+jogadoresDisponiveis[i].idade+'</h3>'+
                        ' </div>   '+
                        '</div>'+

                        '<img src="../../images/atletas/'+ jogadoresDisponiveis[i].imagem +'" alt="" width="220" height="300">'+

                        ' <div class="info">'+

                            '<div class="info-container">'+

                            ' <div>'+
                                    '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">'+
                                    ' <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />'
                                    +'</svg>'+
                                '</div>'+

                                '<h3>'+ jogadoresDisponiveis[i].nome +'</h3>'+
                        ' </div>   '+
                        '   </div>'+
                        ' </div>')
                    }
                }              
            }
            else{

                console.log("Já esta na equipa")
            }

        },
        'remove' : function(jogador_id){

            for(var i = 0; i <= jogadoresEquipa.length - 1; i++){


                if(jogadoresEquipa[i].id_atleta == jogador_id){
                    jogadoresEquipa.splice(i, 1)
                }
            }

             $('#show-atletas-choose').html("")
            for(var i = 0; i <= jogadoresEquipa.length - 1; i++){

                $('#show-atletas-choose').html( $('#show-atletas-choose').html() 
                        + '<div class="player-card"> <div data-text-tooltip="Remover" onclick="jogador.remove('+ jogadoresEquipa[i].id_atleta +')" class="button-remove-player "><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg></div>'+
                        '<div class="another-info">'+
                        ' <div class="info-container">'+
                                
                                '<div>'+
                                ' <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">'+
                                        '<path d="M12 14l9-5-9-5-9 5 9 5z" />'+
                                        '<path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />'+
                                    ' <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />'+
                                    '</svg>'+
                                '</div>'+

                            ' <h3>Escalão '+ jogadoresEquipa[i].nome_escalao +'</h3>'+
                            '</div> '+

                            '<div class="info-container">'+

                                '<div>'+
                                ' <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">'+
                                        '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />'+
                                ' </svg>'+
                                '</div>'+

                                '<h3>'+jogadoresEquipa[i].nacionalidade+'</h3>'+
                            '</div>    '+

                        ' <div class="info-container">'+
                                
                            ' <div>'+
                                    '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">'+
                                    ' <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 15.546c-.523 0-1.046.151-1.5.454a2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.701 2.701 0 00-1.5-.454M9 6v2m3-2v2m3-2v2M9 3h.01M12 3h.01M15 3h.01M21 21v-7a2 2 0 00-2-2H5a2 2 0 00-2 2v7h18zm-3-9v-2a2 2 0 00-2-2H8a2 2 0 00-2 2v2h12z" />'+
                                    '</svg>'+
                                '</div>'+

                                '<h3>'+jogadoresEquipa[i].idade+'</h3>'+
                        ' </div>   '+
                        '</div>'+

                        '<img src="../../images/atletas/'+ jogadoresEquipa[i].imagem +'" alt="" width="220" height="300">'+

                        ' <div class="info">'+

                            '<div class="info-container">'+

                            ' <div>'+
                                    '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">'+
                                    ' <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />'
                                    +'</svg>'+
                                '</div>'+

                                '<h3>'+ jogadoresEquipa[i].nome +'</h3>'+
                        ' </div>   '+
                        '   </div>'+
                        ' </div>')
            }

            console.log(jogadoresEquipa)
        },
        'create': function(){

            $.ajax({

                url: '../../processes/criar_equipa.php',
                type: 'post',
                data: {nome: $('#nome-equipa').val() ,jogadores: jogadoresEquipa, maxJogadores: dadosCompeticao.numero_equipa_max, minJogadores: dadosCompeticao.numero_equipa_min, idCompeticao: dadosCompeticao.id_competicao },
                dataType: "json",
                success: function(json){

                    if(json['erro']){

                        $('#erro-mesage').html("<div class='message-parent'><div class='erro-box'>"+ json['erro'] +"</div></div>");
                    }
                    else if(json['success']){
                        

                        window.location.replace(json['success'] + "/Cenas/Projeto_Final_2/public/equipas.php");

                    }
                    console.log(json)
                }

            })

        }

    }

</script>
<section>
    <?php include '../../components/menu.php' ?>

    
    <div class="form-parent">

        

        <div action="" id="altela-visualizar">



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

                    <input type="text" placeholder="Nome" value="<?php echo $dados["competicao"]['nome_competicao']; ?>" disabled>
                    
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

                    <input type="date" placeholder="Nome" value="<?php echo $dados["competicao"]['data_prova']; ?>" disabled>
                    
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

                    <input type="time" placeholder="Nome" value="<?php echo $dados["competicao"]['horas_prova']; ?>" disabled>
                    
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

                    <input type="text" placeholder="Escalão" value="Escalão <?php echo $dados["competicao"]['nome_escalao']; ?>" disabled>
                    
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

                    <input type="text" placeholder="Idade" value="<?php echo $dados["competicao"]['idade_minima']; ?>" disabled>
                    
                </div>


                <div class="input-container">

                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 15.546c-.523 0-1.046.151-1.5.454a2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.701 2.701 0 00-1.5-.454M9 6v2m3-2v2m3-2v2M9 3h.01M12 3h.01M15 3h.01M21 21v-7a2 2 0 00-2-2H5a2 2 0 00-2 2v7h18zm-3-9v-2a2 2 0 00-2-2H8a2 2 0 00-2 2v2h12z" />
                        </svg>
                    </div>

                    <input type="text" placeholder="Idade" value="<?php echo $dados["competicao"]['idade_maxima']; ?>" disabled>
                    
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

                    <input type="text" placeholder="Jogadores Minimos" value="<?php echo $dados["competicao"]['numero_equipa_min']; ?>" disabled>
                    
                </div>


                <div class="input-container">

                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>

                    <input type="text" placeholder="Jogadores Minimos" value="<?php echo $dados["competicao"]['numero_equipa_max']; ?>" disabled>
                    
                </div>

                
            </div>
        </div>

        <div id="altela-visualizar">

            <div id="erro-mesage"></div>

            <h1>Nova Equipa</h1>

            <h5>Dados Equipa</h5>

            <div class="tipo-dados">
                <!-- Dados Pessoais -->

                <div class="input-container">

                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>

                    <input id="nome-equipa" type="text" placeholder="Nome" >
                    
                </div>
                
            </div>

            <h5>Jogadores</h5>

            <div class="tipo-dados">
                <!-- Dados Pessoais -->

                <div class="input-container">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>

                        <select id="atleta-choose">
                            <option value="0" default>Selecionar Jogadores</option>
                            <?php foreach($dados['jogadores'] as $jogador) { ?>
                                <option onclick="jogador.add(<?php echo $jogador['id_atleta']; ?>);" value="<?php echo $jogador['id_atleta']; ?>"><?php echo $jogador['nome'] ?></option>
                            <?php } ?>
                            
                        </select>
                </div>

            </div>

            
            <div id="show-atletas-choose" class="tipo-dados  list-cards jogadores-selecionados">
                <!-- Dados Pessoais -->

                            
                    <!-- <div class="player-card">

                        <div data-text-tooltip="Remover" onclick="jogador.remove()" class="button-remove-player "><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg></div>

                        <div class="another-info">


                            <div class="info-container">
                                
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path d="M12 14l9-5-9-5-9 5 9 5z" />
                                        <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                                    </svg>
                                </div>

                                <h3>Escalão B</h3>
                            </div> 

                            <div class="info-container">

                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>

                                <h3>Portugês</h3>
                            </div>    

                            <div class="info-container">
                                
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 15.546c-.523 0-1.046.151-1.5.454a2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.701 2.701 0 00-1.5-.454M9 6v2m3-2v2m3-2v2M9 3h.01M12 3h.01M15 3h.01M21 21v-7a2 2 0 00-2-2H5a2 2 0 00-2 2v7h18zm-3-9v-2a2 2 0 00-2-2H8a2 2 0 00-2 2v2h12z" />
                                    </svg>
                                </div>

                                <h3>23</h3>
                            </div>   

                        </div>

                        <img src="../../images/atletas/atleta1.png" alt="" width="220" height="300">

                        <div class="info">
    
                            <div class="info-container">

                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>

                                <h3>Adriano Skora</h3>
                            </div>   

                        
                            
                            
                        </div>


                    </div> -->


            </div>
                
            <div class="btn-parent">
                <div class="btn-container">
                    <button onclick="jogador.create()">Criar Equipa</button>
                </div>
            </div>   


        </div>
    </div>

</section>

<script type="text/javascript">
    
    // var listaJogadores =  <?php echo json_encode($dados['jogadores']); ?>;
    // var choose_atlea = document.getElementById("atleta-choose");
    
    // choose_atlea.addEventListener("change", ()=>{

    //     if(choose_atlea.value == 0) return
    //     addPlayer(choose_atlea.value)
    // })
    // function addPlayer(idPlayer){

    //     var parent = document.getElementById("show-atletas-choose");

    //     listaJogadores.forEach(element => {

    //         if(element.id_atleta == idPlayer){
                

        //         parent.innerHTML = parent.innerHTML + 
        //         '<div class="player-card">'+

        //             '<div class="another-info">'+


        //             ' <div class="info-container">'+
                            
        //                     '<div>'+
        //                     ' <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">'+
        //                             '<path d="M12 14l9-5-9-5-9 5 9 5z" />'+
        //                             '<path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />'+
        //                         ' <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />'+
        //                         '</svg>'+
        //                     '</div>'+

        //                 ' <h3>Escalão '+ element.nome_escalao +'</h3>'+
        //                 '</div> '+

        //                 '<div class="info-container">'+

        //                     '<div>'+
        //                     ' <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">'+
        //                             '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />'+
        //                     ' </svg>'+
        //                     '</div>'+

        //                     '<h3>'+element.nacionalidade+'</h3>'+
        //                 '</div>    '+

        //             ' <div class="info-container">'+
                            
        //                 ' <div>'+
        //                         '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">'+
        //                         ' <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 15.546c-.523 0-1.046.151-1.5.454a2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.701 2.701 0 00-1.5-.454M9 6v2m3-2v2m3-2v2M9 3h.01M12 3h.01M15 3h.01M21 21v-7a2 2 0 00-2-2H5a2 2 0 00-2 2v7h18zm-3-9v-2a2 2 0 00-2-2H8a2 2 0 00-2 2v2h12z" />'+
        //                         '</svg>'+
        //                     '</div>'+

        //                     '<h3>'+element.idade+'</h3>'+
        //             ' </div>   '+

        //             '</div>'+

        //             '<img src="../../images/atletas/'+ element.imagem +'" alt="" width="220" height="300">'+

        //         ' <div class="info">'+

        //                 '<div class="info-container">'+

        //                 ' <div>'+
        //                         '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">'+
        //                         ' <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />'
        //                         +'</svg>'+
        //                     '</div>'+

        //                     '<h3>'+ element.nome +'</h3>'+
        //             ' </div>   '+


                        
                        
        //         '   </div>'+


        //         ' </div>'
        //     }
        // })


        

    // }
    
</script>




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