<?php

    echo $nome = ucfirst(strtolower($_GET['nomePokemon']));
    echo $idSeed =  $_GET['seedPokemon'];

    include_once('../controler/conexao.php');
    
    $con = new Conexao();    
    
    $con->updatePokemon($idSeed, $nome); 

    header("Location: ../view/page.php?rand=$idSeed");

?>

