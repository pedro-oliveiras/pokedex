<?php

    $random_number = rand(1, 151);
    //$random_number = 148;
    //$random_number = 1;

    $url = "https://pokeapi.co/api/v2/pokemon/$random_number";

    $pokemon = json_decode(file_get_contents($url));

    $contador = 0;
    foreach($pokemon->types as $type){    
        $contador++;
    }

    $idSeed = $random_number;
    $nome = ucfirst($pokemon->forms[0]->name);
    $tipo = strtoupper($pokemon->types[0]->type->name);
    $cor = returnColor($tipo);
    $tipo2 = $contador < 2 ? '' : strtoupper($pokemon->types[1]->type->name);
    $cor2 = $contador < 2 ? '' : returnColor($tipo2);  
    $hp = $pokemon->stats[0]->base_stat; 
    $atack = $pokemon->stats[1]->base_stat;
    $defense = $pokemon->stats[2]->base_stat;
    $speed = $pokemon->stats[5]->base_stat; 
    $photo = $pokemon->sprites->other->dream_world->front_default;

    //print_r($pokemon_color[1]->tipo);

    function returnColor($tipo) {

        $color;

        $pokemon_color = '{"pokemonColor": '.
            '[{"tipo":"NORMAL",   "cor":"#A8A878"},'.
             '{"tipo":"FIRE",     "cor":"#F08030"},'.
             '{"tipo":"FIGHTING", "cor":"#C03028"},'.
             '{"tipo":"WATER",    "cor":"#6890F0"},'.
             '{"tipo":"FLYING",   "cor":"#A890F0"},'.
             '{"tipo":"GRASS",    "cor":"#78C850"},'.
             '{"tipo":"POISON",   "cor":"#A040A0"},'.
             '{"tipo":"ELECTRIC", "cor":"#F8D030"},'.
             '{"tipo":"GROUND",   "cor":"#E0C068"},'.
             '{"tipo":"PSYCHIC",  "cor":"#F85888"},'.
             '{"tipo":"ROCK",     "cor":"#B8A038"},'.
             '{"tipo":"ICE",      "cor":"#98D8D8"},'.
             '{"tipo":"BUG",      "cor":"#A8B820"},'.
             '{"tipo":"DRAGON",   "cor":"#7038F8"},'.
             '{"tipo":"GHOST",    "cor":"#705898"},'.
             '{"tipo":"DARK",     "cor":"#705848"},'.
             '{"tipo":"STEEL",    "cor":"#B8B8D0"},'.
             '{"tipo":"FAIRY",    "cor":"#EFABEE"}]'.
        '}';    
    
        $pokemon_color = json_decode($pokemon_color);
    
        $pokemon_color = $pokemon_color->pokemonColor;

        foreach($pokemon_color as $pc){

            if($pc->tipo == $tipo){
                $color = $pc->cor;
            }        
        }  

        return $color;
    }      

    /*echo '<pre>';
    echo '<img src='.$pokemon->sprites->front_default.'></img>';
    echo '</br>';
    echo $nome;
    echo '</br>';
    echo $tipo; 
    echo '</br>';
    echo $hp;
    echo '</br>';
    echo $atack;
    echo '</br>';
    echo $defense; 
    echo '</br>';
    echo $speed;
    echo '</pre>';   

    //retornar um numero, verificar se ele existe no array, se sim gerar outro, se nao, imprimir


    include('../controler/conexao.php');

    $con = new Conexao();
    
    $testePokemonSite = $con->getPokemon($random_number);

    if($testePokemonSite) {
        echo '<pre>';
        print_r($testePokemonSite);
        echo '</pre>';
    }
    else {
        $con->insertPokemon($idSeed, $nome, $tipo, $hp, $atack, $defense, $speed);
    }    

    $testepokemons = $con->getAllPokemons();

    echo '<pre>';
    print_r($testepokemons);
    echo '</pre>'; */


?>