<?php

    // session_start();
   
    if(!isset($_SESSION['id_user'])){

        //Sem Sessão Aberta

        $ola = $_SERVER['PHP_SELF'];

        if(stripos($ola, 'public')){

            $pageUrl = explode('/', $ola);
            $url = $_SERVER['HTTP_HOST'];
            $tempUrl= "";
            foreach( $pageUrl as $string){


                if($string == 'public'){

                    $url = $url . $tempUrl. $string . '/login.php';

                }
                else{

                    $tempUrl= $tempUrl.$string."/";
                }
            }

            header("Location: //$url");

        }
        else{

            header("Location: public/login.php");
        }

       session_destroy();
       exit();
    }

?>