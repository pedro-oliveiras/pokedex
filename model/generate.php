<?php   
    
    include_once('../controler/conexao.php');
    include_once('../model/returnColor.php');

    $random_number = rand(1, 151);    

    $url = "https://pokeapi.co/api/v2/pokemon/$random_number";

    $pokemon = json_decode(file_get_contents($url));

    $contador = 0;
    foreach($pokemon->types as $type){    
        $contador++;
    }

    $idSeed  = $random_number;
    $nome    = ucfirst($pokemon->forms[0]->name);
    $tipo    = strtoupper($pokemon->types[0]->type->name);
    $cor     = returnColor($tipo);
    $tipo2   = $contador < 2 ? '' : strtoupper($pokemon->types[1]->type->name);
    $cor2    = $contador < 2 ? '' : returnColor($tipo2);  
    $hp      = $pokemon->stats[0]->base_stat; 
    $atack   = $pokemon->stats[1]->base_stat;
    $defense = $pokemon->stats[2]->base_stat;
    $speed   = $pokemon->stats[5]->base_stat; 
    $photo   = $pokemon->sprites->other->dream_world->front_default;

    if($contador > 1){
        $tipos = array($tipo, $tipo2);
        $cores = array($cor, $cor2);
        $tipos = implode('/', $tipos);
        $cores = implode('/', $cores);
    } else {
        $tipos = $tipo;
        $cores = $cor;
    }        

    $con = new Conexao();

    $testePokemons = $con->getPokemon($random_number);

    if($testePokemon) {
        header("Location: ../view/page.php?rand=$random_number");
    }
    else {
        $con->insertPokemon($idSeed, $nome, $tipos, $cores, $hp, $atack, $defense, $speed, $photo);

        header("Location: ../view/page.php?rand=$random_number");
    }         
?>