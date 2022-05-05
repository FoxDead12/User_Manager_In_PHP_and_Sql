<?php
    session_start();
    if(isset($_POST['guardar'])){

        if(!isset($_GET['atleta'])){
            header("Location: ../public/atletas.php");
        }

        $id_atlete = $_GET['atleta'];
        
        
        $erro = VerificarInputs();
        if($erro != ""){

            $_SESSION['erro_editar_atleta'] = $erro;

            header("Location: ../public/atletas/editar.php?atleta=$id_atlete");
            
        }


        if(is_uploaded_file($_FILES['imagem']['tmp_name'])){
                 
        }



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

        include '../processes/base_dados/connect.php';

        $query_update_atleta = 
        "UPDATE atletas SET 
        nome = '" . $_POST['nome'] . "' , 
        data_nascimento = '" . $_POST['data_nascimento'] . "' , 
        nacionalidade = '" . $_POST['nacionalidade'] . "' , 
        peso = " . (float)$_POST['peso'] . ", potencia = " . (float)$_POST['potencia'] . ", 
        segunda = '".$horario[0]." ". $horario[1] . " ', terca = '".$horario[2]." ".$horario[3] . "', quarta = '".$horario[4]." ". $horario[5] . "', 
        quinta = '".$horario[6]." ". $horario[7] . "', sexta = '".$horario[8]." ".$horario[9] . "', sabado = '".$horario[10]." ". $horario[11] . "' , domingo = '".$horario[12]." ". $horario[13] . "' , sexo = " . (int)$_POST['sexo'] . " WHERE id_atleta = $id_atlete";
        
        echo $query_update_atleta;
        if(mysqli_query($conn, $query_update_atleta)){

            header("Location: ../public/atletas/visualizar.php?atleta=$id_atlete");
        }
        else{
            $_SESSION['erro_editar_atleta'] = "Erro ao editar atleta!";
            header("Location: ../public/atletas/visualizar.php?atleta=$id_atlete");
        }

    }
    else{

        header("Location: ../public/atletas.php");

    }




    function VerificarInputs(){

        $erro = "";

        // $image_info = @getimagesize($_FILES['image']['tmp_name']);

        
        if($_POST['sexo'] == "2" || (int) $_POST['sexo'] == 2){
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

?>