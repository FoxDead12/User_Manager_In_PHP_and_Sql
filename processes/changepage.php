<?php

    $page = (int) $_GET['page'];

    $search = "";
    if(isset($_GET['search'])){

        $search = $_GET['search'];
    }

    echo $search;
    if(isset($_POST['min']))
    {

        $page -= 1;

        if($page <= 0){

            $page = 0;
        }

        if($search != ""){
            header("Location: ../public/atletas.php?page=$page&search=$search");
            exit();
        }
        else{
            header("Location: ../public/atletas.php?page=$page");
            exit();
        }
    }

    if(isset($_POST['max']))
    {

        $page += 1;
        
        if($search != ""){
            header("Location: ../public/atletas.php?page=$page&search=$search");
            exit();
        }
        else{

           header("Location: ../public/atletas.php?page=$page");
           exit();
        }
    }

?>