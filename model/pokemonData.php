<?php    

    include_once('../controler/conexao.php');

    $con = new Conexao();

    if(!empty($_GET['rand'])){
        $random_number = $_GET['rand'];
    } else if(empty($_GET['rand'])) {
        $pokemonSeed = $con->lastPokemonAdded();
        $random_number = $pokemonSeed[0]['idSeed'];
    }

    $pokemon = $con->getPokemon($random_number);  

    $idSeed  = $pokemon[0]['idSeed'];
    $nome    = $pokemon[0]['nome'];
    $tipos   = $pokemon[0]['tipos'];
    $cores   = $pokemon[0]['cores'];
    $hp      = $pokemon[0]['hp'];
    $atack   = $pokemon[0]['atack'];
    $defense = $pokemon[0]['defense'];
    $speed   = $pokemon[0]['speed'];
    $photo   = $pokemon[0]['photo'];

    //echo $teste_str = implode('/', $teste);  

    $tipos = explode('/', $tipos);
    $cores = explode('/', $cores);   
    
    $contador = 0;
    foreach($tipos as $tipo){    
        $contador++;
    }   

    $tipo = $tipos[0];
    $cor = $cores[0];
    if($contador > 1){
        $tipo2 = $tipos[1];    
        $cor2 = $cores[1];
    }    

    function pokemonsList(){
        $con = new Conexao();
        return $con->getAllPokemons();
    }     

?>