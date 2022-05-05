
<?php


    //Aqui vai gerar um url para todas as paginas principais
    $ola = $_SERVER['PHP_SELF'];
    $pageUrl = explode('/', $ola);
    $url = $_SERVER['HTTP_HOST'];

    $tempUrl= "";
    foreach( $pageUrl as $string){


        if($string == 'public'){

            $url = $url . $tempUrl. $string . '/';

        }
        else{

            $tempUrl= $tempUrl.$string."/";
        }
    }
    


?>

<head>

    <link rel="stylesheet" href="../../css/menu.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>


<div class="menu-bar" id="menu-bar">
        <!-- {{-- Menu --}} -->

        <ul id="header-title">
            <li id="home">
                <a href="//<?php echo $url; ?>home.php">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Home
                </a>
            </li>
            <li id="atletas">
                <a href="//<?php echo $url; ?>atletas.php">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                    Atletas
                </a>
            </li>
            <li id="equipas">
                <a href="//<?php echo $url; ?>equipas.php">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                    Equipas
                </a>
            </li>
            <li id="competicoes">
                <a href="//<?php echo $url; ?>competicoes.php">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                    Competições
                </a>
            </li>
        </ul>

        <div class="logout">
            <div>
                <a href="//<?php echo $url; ?>logout.php">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    Sair
                </a>
            </div>

            <div class="hamburger" id="hamburger"> </div>
        </div>

    </div>


<script>

    var menuopen = true;



    function changeMenuMode(){

        console.log("MUDAR")
        if(menuopen == true){

            document.getElementById("hamburger").classList.add("open")
            menuopen = false;
            document.getElementById("header-title").classList.add("open")

        }
        else{
            menuopen = true;
            document.getElementById("hamburger").classList.remove("open")
            document.getElementById("header-title").classList.remove("open")
        }

    }


    document.getElementById("hamburger").addEventListener("click", () => {

        changeMenuMode();
    })


    var url = window.location.href;
    var menu = url.split("/");

    menu.forEach((element, i) => {
        

        if(element == "public"){

            var currentPageName = menu[(i + 1)];
            currentPageName = currentPageName.replace('.php', '');


            var tempArr = currentPageName.split('?')
            currentPageName = tempArr[0]
            

            document.getElementById(currentPageName).classList.add("currentPage");

        }
    });
</script>


<?php


    
?>