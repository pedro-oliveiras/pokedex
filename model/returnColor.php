<?php

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
?>