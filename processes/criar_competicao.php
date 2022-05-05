<?php

session_start();
include '../processes/base_dados/connect.php';

$error = checkInput();
if($error != ''){

    header("Location: ../public/competicoes/gerar.php");
    $_SESSION['erro_novo_competicao'] = $error;
    exit();
}



//VERIFICAR SE EXISTE UMA COMPETIÇÃO COM ESTE NOME

$sql_get_comp = "SELECT * FROM competicao where nome_competicao = '".$_POST['nome']."'";
$sql_get_comp_result = mysqli_query($conn, $sql_get_comp);

if (mysqli_num_rows($sql_get_comp_result) == 0){

    //Criar Competição
    $sql_inserir_competicao = "INSERT INTO competicao (nome_competicao, id_escalao, idade_maxima, idade_minima, data_prova, horas_prova, numero_equipa_max, numero_equipa_min, duracao) 
    VALUES ('". $_POST['nome'] ."', ". $_POST['categoria'] .", ". $_POST['idade_max'] ." , ". $_POST['idade_min'] ." , '". $_POST['data'] ."' , '". $_POST['horas'] ."', ". $_POST['jogadores_max'] ." , ". $_POST['jogadores_min'] .", '". $_POST['duracao'] ."') ";
    $sql_inserir_competicao_result = mysqli_query($conn, $sql_inserir_competicao);
    
    if($sql_inserir_competicao_result == 1){
        apagarDadosGuardados();
        $_SESSION['sucesso'] = "Competição Criado com Sucesso";
        header("Location: ../public/competicoes.php");
        exit();

    }
    else {

        header("Location: ../public/competicoes/gerar.php");
        $_SESSION['erro_novo_competicao'] = "Ocorreu algum erro, tente de novo!";
        exit();
    }


}
else{

    header("Location: ../public/competicoes/gerar.php");
    $_SESSION['erro_novo_competicao'] = "Já existe uma competição com este nome";
    exit();
}



function apagarDadosGuardados(){

    unset($_SESSION['nome_comp']);
    unset($_SESSION['data_comp']);
    unset($_SESSION['hora_comp']);
    unset($_SESSION['categoria_comp']);
    unset($_SESSION['idade_min_comp']);
    unset($_SESSION['idade_max_comp']);
    unset($_SESSION['jogadores_min_comp']);
    unset($_SESSION['jogadores_max_comp']);
    unset($_SESSION['duracao_comp']);
}

function guardarInput(){

    $_SESSION['nome_comp'] = $_POST['nome'];
    $_SESSION['data_comp'] = $_POST['data'];
    $_SESSION['hora_comp'] = $_POST['horas'];
    $_SESSION['categoria_comp'] = $_POST['categoria'];
    $_SESSION['idade_min_comp'] = $_POST['idade_min'];
    $_SESSION['idade_max_comp'] = $_POST['idade_max'];
    $_SESSION['jogadores_min_comp'] = $_POST['jogadores_min'];
    $_SESSION['jogadores_max_comp'] = $_POST['jogadores_max'];
    $_SESSION['duracao_comp'] = $_POST['duracao'];
}

function checkInput(){
    guardarInput();
    $error = "";
    if($_POST['nome'] ==  ""){

        $error = "Preencha o campo nome!";
    }
    else if($_POST['data'] ==  ""){
        $error = "Preencha o campo data da competição!";
    }
    else if($_POST['horas'] ==  ""){
        $error = "Preencha o campo das horas da competição!";
    }
    else if($_POST['categoria'] ==  0 || $_POST['categoria'] ==  "0"){
        $error = "Escolha um escalão para a competição!";
    }
    else if($_POST['idade_min'] ==  ""){
        $error = "Preencha o minimo de idade dos jogadores!";
    }
    else if($_POST['idade_max'] ==  ""){
        $error = "Preencha o maximo de idade dos jogadores!";
    }
    else if($_POST['jogadores_min'] ==  ""){
        $error = "Preencha o minimo de jogadores na equipa!";
    }
    else if($_POST['jogadores_max'] ==  ""){
        $error = "Preencha o maximo de jogadores na equipa!";
    }
    else if($_POST['duracao'] == ""){

        $error = "Preencha o campo da doração da prova!";
    }


    return $error;
}

