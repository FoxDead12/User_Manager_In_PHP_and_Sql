<?php

session_start();

if(!isset($_POST['nome'])){
    
    $json['erro'] = "Preencha o campo nome.";
    echo json_encode($json);
    exit;

}
else if(!isset($_POST['jogadores'])){
    
    $json['erro'] = "Selecione Jogadores.";
    echo json_encode($json);
    exit;

}

include '../processes/base_dados/connect.php';


//Tenho de verificar se o numero da equipa esta nas permisoes 
$numeroJogadores = 0;
foreach ($_POST['jogadores'] as &$jogador) {
    $numeroJogadores++;
}

if($_POST['nome'] != ""){

    if($numeroJogadores <= $_POST['maxJogadores'] && $numeroJogadores >= $_POST['minJogadores']){

        //Vamos Gerar Equipa 

        $nome = $_POST['nome'];
        $idCompeticao = $_POST['idCompeticao'];

        $sql_getEquipa = "SELECT * FROM equipas where nome_equipa = '$nome' ";
        $sql_getId = "SELECT MAX(id_equipa) as id FROM equipas ";
        $result_get_equipa = mysqli_query($conn, $sql_getEquipa);
        
        
        if (mysqli_num_rows($result_get_equipa) == 0) {

            $result_sql_getId = mysqli_query($conn, $sql_getId);
            $tempDados = mysqli_fetch_assoc($result_sql_getId);
            $id = $tempDados['id'] + 1;
            //Já possuimos o id por isso agora e so fazer inputs

            $sql_equipa = "INSERT INTO equipas (id_equipa ,nome_equipa, id_competicao) VALUES ($id , '$nome', $idCompeticao)";
            $result_sql_equipa = mysqli_query($conn, $sql_equipa);

            foreach ($_POST['jogadores'] as &$jogador) {
                $sql_jogadores_equipa = "INSERT INTO equipa_jogadores (id_equipa , id_jogador) VALUES ( $id, '". $jogador['id_atleta'] . "' )";
                $result_sql_jogadores_equipa = mysqli_query($conn, $sql_jogadores_equipa);
                
                
            }

            $json['success'] = 'http://'.$_SERVER['HTTP_HOST'];
            $_SESSION['sucesso'] = "Equipa criada";

        }
        else{

            $json['erro'] = "Já existe uma equipa com este nome.";
        }

        
    }
    else{

        $json['erro'] = "O número de atletas não é permitido.";
    }
}
else{

    $json['erro'] = "Preencha o campo nome.";
}


echo json_encode($json);
?>