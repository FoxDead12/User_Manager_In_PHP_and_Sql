<?php



    session_start();
    
    if(!is_uploaded_file($_FILES['imagem']['tmp_name'])){

        $erro = "Tem de carregar uma imagem!";
        header("Location: ../public/atletas/novo.php");

    }

    $erro = VerificarInputs();
    if($erro != ""){

        $_SESSION['erro_novo_atleta'] = $erro;
        DevolverInput();
        header("Location: ../public/atletas/novo.php");
        return;

    }
    //Tratar da imagem
    $image_NameNew = ""; //Variavel onde vai guardar o nome da imagem
    $imagem = $_FILES['imagem'];
    $imagem_name = $_FILES['imagem']['name'];
    $imagem_Tempname = $_FILES['imagem']['tmp_name'];
    $imagem_error = $_FILES['imagem']['error'];
    $imagem_type = $_FILES['imagem']['type'];
    $imagem_ext = explode('.', $imagem_name);
    $imagem_extension = strtolower($imagem_ext[1]);
    $extension_allowed = array("jpg", "jpeg", "png");
    if(in_array($imagem_extension, $extension_allowed)){ //Aqui vai verificar se esta variavel está no array

        if($imagem_error === 0){ //Verificar se não ouve algum erro

            //Mover Ficheiro
            $image_NameNew = uniqid('', true).".".$imagem_extension;
            $image_destino = $_SERVER['DOCUMENT_ROOT'] . "/cenas/Projeto_Final_2/images/atletas/".$image_NameNew;
            move_uploaded_file($imagem_Tempname, $image_destino);

        }
        else{
            $erro = "Ocorreu um erro ao carregar a imagem";
        }
    }
    else{

        $erro = "Só é permitido carregar imagens";
    }

    //Realizar outra verificação
    if($erro != ""){

        $_SESSION['erro_novo_atleta'] = $erro;
        DevolverInput();
        header("Location: ../public/atletas/novo.php");
        return;
    }


    include '../processes/base_dados/connect.php';    
    //Agora vamos realizar a criação do jogador
    $nome = $_POST['nome'];
    $data_nascimento = $_POST['data_nascimento'];
    $nacionalidade = $_POST['nacionalidade'];
    $peso = (float) $_POST['peso'];
    $potencia = (float) $_POST['potencia'];
    $sexo = (int) $_POST["sexo"];

    $horario = array(

        0 => str_replace(':','', $_POST['segunda_inicio']) ,
        1 => str_replace(':','', $_POST['segunda_fim']) ,

        2 => str_replace(':','', $_POST['terca_inicio']),
        3 => str_replace(':','', $_POST['terca_fim']),

        4 => str_replace(':','', $_POST['quarta_inicio']),
        5 => str_replace(':','', $_POST['quarta_fim']),

        6 => str_replace(':','', $_POST['quinta_inicio']),
        7 => str_replace(':','', $_POST['quinta_fim']),

        8 => str_replace(':','', $_POST['sexta_inicio']),
        9 => str_replace(':','', $_POST['sexta_fim']),

        10 => str_replace(':','', $_POST['sabado_inicio']),
        11 => str_replace(':','', $_POST['sabado_fim']),

        12 => str_replace(':','', $_POST['domingo_inicio']),
        13 => str_replace(':','', $_POST['domingo_fim']),


    );



   
    //Gerar Query
    $query_create_atleta = 
    "INSERT INTO atletas (nome, data_nascimento, nacionalidade , peso , potencia , segunda , terca , quarta , quinta , sexta , sabado , domingo , sexo, imagem) " .
    "VALUES ( '$nome', '$data_nascimento', '$nacionalidade', $peso , $potencia, ";
    for($i = 0; $i <= 13; $i+=2){


        $query_create_atleta = $query_create_atleta ."'". $horario[$i]." ".$horario[$i + 1]. "'" . ',';
    }
    $query_create_atleta = $query_create_atleta . $sexo . ", '". $image_NameNew ."')";
    //QUERY GERADA


    if(mysqli_query($conn, $query_create_atleta)){

        $_SESSION['sucesso'] = "Atleta criado com sucesso!";
        ApagarDados();
        header("Location: ../public/atletas.php");
                return;

    }
    else{

        $erro = "Erro ao criar jogador";
    }
    
    if($erro != ""){

        $_SESSION['erro_novo_atleta'] = $erro;
        DevolverInput();
        header("Location: ../public/atletas/novo.php");
        return;

    }



    function VerificarInputs(){

        $erro = "";

        // $image_info = @getimagesize($_FILES['image']['tmp_name']);

        if(!is_uploaded_file($_FILES['imagem']['tmp_name'])){

            $erro = "Tem de carregar uma imagem!";
        }
        else if($_POST['sexo'] == "2" || (int) $_POST['sexo'] == 2){
            $erro = "Selecione no campo sexo!";
        }
        else if($_POST['nome'] == ""){

            $erro = "Preencha o campo nome!";
        }
        else if($_POST['nacionalidade'] == "") {

            $erro = "Preencha o campo nacionalidade!";
        }
        else if($_POST['peso'] == ""){

            $erro = "Preencha o campo peso!";
        }
        else if(isset($_POST['peso'])){
            
            $peso = (int) $_POST['peso'];
            if( !is_int($peso) ){

                $erro = "O campo peso é de um valor númerico!";
            }
        }
        else if ($_POST['data_nascimento'] == ""){

            $erro = "Preencha o campo data nascimento!";
        }
        else if ($_POST['potencia'] == ""){

            $erro = "Preencha o campo potencia!";
        }
        else if(isset($_POST['potencia'])){
            
            $potencia = (int) $_POST['potencia'];
            if( !is_int($potencia) ){

                $erro = "O campo potencia é de um valor númerico!";
            }
        }


        return $erro;
    }

    function DevolverInput(){

        
        if(isset($_POST['nome'])){

            $_SESSION['nome'] = $_POST['nome']; 
        }
        
        if(isset($_POST['nacionalidade'])) {

            $_SESSION['nacionalidade'] = $_POST['nacionalidade']; 
        }
        
        if(isset($_POST['peso'])){

            $_SESSION['peso'] = $_POST['peso']; 
        } 

        if(isset($_POST['data_nascimento'])){

            $_SESSION['data_nascimento'] = $_POST['data_nascimento']; 
        } 

        if(isset($_POST['potencia'])){

            $_SESSION['potencia'] = $_POST['potencia']; 
        } 

        if($_POST['sexo'] != 2){

            $_SESSION['sexo'] = (int) $_POST['sexo'] ;
        }
    }

    function ApagarDados(){

        unset($_SESSION['nome']);
        unset($_SESSION['nacionalidade']);
        unset($_SESSION['peso']);
        unset($_SESSION['data_nascimento']);
        unset($_SESSION['potencia']);
        unset($_SESSION['sexo']);
    }


    mysqli_close($conn);
?>