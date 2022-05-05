<head>

    <link rel="stylesheet" href="../css/atletas_table.css">

</head>


<div class="atletas-parent-container">

    <form id="form-seact-atleta" action="">

        <div class="seacth-container">
                
            <input type="text" name="search" id="input-seach" value="<?php echo $pesquisa ; ?>" placeholder="Procura">

            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </div>

    </form>

    <table class="atletas-table">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Competição</th>
                <th>Visualizar</th>
            </tr>
        </thead>

        <tbody>

            <?php

                if(mysqli_num_rows($query_getEquipas_result) > 0){

                        while($row = mysqli_fetch_assoc($query_getEquipas_result)){
                                                       
                            echo "<tr>";
                            echo "<td data-label='Nome'>". $row['nome_equipa'] ."</td>";
                            echo "<td data-label='Competição'>". $row['nome_competicao'] ."</td>";
                            echo "<td data-label='Visualizar'>";
                                echo "<a href='../public/equipas/visualizar.php?equipa=". $row['id_equipa'] ."'>";
                                    echo '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">';
                                        echo '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />';
                                        echo '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />';
                                    echo '</svg>';
                                echo "</a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                }
            ?>

<!-- 
            <tr>
                <td data-label="Competição">Competição A</td>
                <td data-label="Atletas">4</td>
                <td data-label="Escalão">B</td>
                <td data-label="Visualizar">
                    <a href="equipas/visualizar.php" >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </a>
                </td>
            </tr> -->

            
            
        </tbody>
    </table>
    

    <form action="../processes/changepageequipas.php?page=<?php echo $current_pagina; ?>&search=<?php echo $pesquisa; ?> " id="form-atleta-table-buttons" method="POST">


        <div class="buttons-group">
            <div class="button-container">
                <button name="min">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                </button>
            </div>


            <div class="button-container">
                <button name="max">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
                </button>
            </div>
        </div>


    </form>
</div>