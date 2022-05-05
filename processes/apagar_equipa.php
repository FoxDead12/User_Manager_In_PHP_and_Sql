<?php 

session_start();

    if(isset($_POST['sim'])){

        //Apagar
        include '../processes/base_dados/connect.php';    
        $query_delete_equipa = "DELETE FROM equipas where id_equipa = " . (int)$_GET['equipa'];
        $query_delete_jogadores_equipa = "DELETE FROM equipa_jogadores where id_equipa = " . (int)$_GET['equipa'];
        if(mysqli_query($conn, $query_delete_equipa)){
            if(mysqli_query($conn, $query_delete_jogadores_equipa)){
                
                $_SESSION['sucesso'] = "Equipa apagado com sucesso!";
                header("Location: ../public/equipas.php");
            }
        } 

        // $query_buscar_imagem = "SELECT imagem FROM atletas WHERE id_atleta = ". (int)$_GET['atleta'];
        // $query_delete_player = "DELETE FROM atletas WHERE id_atleta = ". (int)$_GET['atleta'];


        // $result = mysqli_query($conn, $query_buscar_imagem);
        
        // $imagem_nome = mysqli_fetch_assoc($result);

       

        // $files = glob('../images/atletas/*'); // get all file names

        // foreach($files as $file){ // iterate files
            
        //     $temp_file_name = explode("/",$file);
            
        //     if($temp_file_name[3] == $imagem_nome['imagem']){
        //        unlink($file); // delete file
        //     }
        //     // if(is_file($file)) {
        //     //     //unlink($file); // delete file
        //     //     echo $file.'<br>';
        //     // }
        // }


        // if(mysqli_query($conn, $query_delete_player)){

        //     $_SESSION['sucesso'] = "Atleta apagado com sucesso!";

        //     header("Location: ../public/atletas.php");
            
        // }
         mysqli_close($conn);


    }
    else{

        header("Location: ../public/equipas/visualizar.php?equipa=".$_GET['equipa']);
    }