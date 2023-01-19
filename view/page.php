<?php
    include_once('../model/pokemonData.php');
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" type="image/x-icon" href="../img/pokeball.svg">

    <link rel="stylesheet" href="../styles/page.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;700&display=swap" rel="stylesheet">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <title>Pokedex</title>

    <style>
        aside {
            background-image: linear-gradient(to bottom, <?php echo $cor ?>, #FFFFFF); 
        }

        aside > .generate > a {
            background-color: <?php echo $cor ?>;
        }

        .type-pokemon {
            background-color: <?php echo $cor ?>;
        }
        
        .type-pokemon2 {
            background-color: <?php echo $cor2 ?>;
        }

    </style>
</head>
<body>

    <aside>
        <div class="pokemon-content">
            <div class="pokemon-photo">
                <img src="<?php echo $photo ?>" alt="">
            </div>
            <div class="pokemon-name">
                <p id="pokemon-name"><?php echo $nome ?></p>
                <button id="edit-button"><i class='bx bxs-edit'></i></button>
            </div>
            <div class="pokemon-type">
                <p class="seed-pokemon">Seed Pokémon <?php echo '#'.$idSeed ?></p>
                <div class="type-colors">
                    <p class="type-pokemon"><?php echo $tipo ?></p>
                    <?php
                        if($contador > 1){
                            echo "<p class='type-pokemon type-pokemon2'>".$tipo2."</p>";
                        }
                    ?>
                </div>                             
            </div>
            <div class="pokemon-stats">
                <div class="stats border">
                    <p class="stats-value"><?php echo $hp ?></p>
                    <p class="stats-name">HP</p>
                </div>
                <div class="stats border">
                    <p class="stats-value"><?php echo $atack ?></p>
                    <p class="stats-name">ATTACK</p>
                </div>
                <div class="stats border">
                    <p class="stats-value"><?php echo $defense ?></p>
                    <p class="stats-name">DEFENSE</p>
                </div>
                <div class="stats">
                    <p class="stats-value"><?php echo $speed ?></p>
                    <p class="stats-name">SPEED</p>
                </div>
            </div>
        </div>        
        <div class="generate">
            <a href="../model/generate.php">Generate</a>
        </div>        
    </aside>
    <main>

        <?php
            $pokemons = pokemonsList();

            foreach($pokemons as $pokemon):

                $tipos = explode('/', $pokemon['tipos']);
                $cores = explode('/', $pokemon['cores']);   
                
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
        ?>
        <a href='../view/page.php?rand="<?php echo $pokemon['idSeed'] ?>"' class="card">
            <div class="card-photo" style="background-image: linear-gradient(to bottom, <?php echo $cor ?>, #FFFFFF);">
                <img src="<?php echo $pokemon['photo'] ?>" alt="">
            </div>
            <div class="card-info">
                <div class="pokemon-info">
                    <p class="pokemon-name"><?php echo $pokemon['nome'] ?></p>
                    <div class="pokemon-type-seed">
                        <p><?php echo '#'.$pokemon['idSeed'] ?></p>
                        <p>Seed Pokémon</p>
                        <p class='type-pokemon' style="background-color: <?php echo $cor ?>;"><?php echo $tipo ?></p>
                        <?php
                            if($contador > 1){
                                echo "<p class='type-pokemon type-pokemon2' style='background-color:".$cor2.";'>".$tipo2."</p>";
                            }
                        ?>
                    </div>
                </div>                
                <div class="pokemon-stats">
                    <div class="stats border">
                        <p class="stats-value"><?php echo $pokemon['hp'] ?></p>
                        <p class="stats-name">HP</p>
                    </div>
                    <div class="stats border">
                        <p class="stats-value"><?php echo $pokemon['atack'] ?></p>
                        <p class="stats-name">ATTACK</p>
                    </div>
                    <div class="stats border">
                        <p class="stats-value"><?php echo $pokemon['defense'] ?></p>
                        <p class="stats-name">DEFENSE</p>
                    </div>
                    <div class="stats">
                        <p class="stats-value"><?php echo $pokemon['speed'] ?></p>
                        <p class="stats-name">SPEED</p>
                    </div>
                </div>
            </div>
        </a>
        <?php
            endforeach;
        ?>
        
    </main>

    <div id="modal" class="modal">
        <div class="modal-card">
            <div class="card-header">
                <h1>Editar nome</h1>    
            </div>
            
            <div class="card-body">
                <form action="../model/updateName.php" id="nameChange">
                    <input type="text" name="nomePokemon" placeholder="digite o novo nome aqui" required>
                    <input type="hidden" name="seedPokemon" value="<?php echo $idSeed ?>">
                </form>            
            </div>            

            <div class="card-footer">
                <button class="btn card-cancel" id="close-modal">Cancelar</button>
                <button class="btn card-send" form="nameChange">Enviar</button>
            </div>            
        </div>        
    </div>

    <script>
        var element = document.getElementById('pokemon-name');
        var nome = document.getElementById('pokemon-name').textContent;
        var btn = document.getElementById('edit-button');
        var modal = document.getElementById('modal');
        var closeModal = document.getElementById('close-modal');

        btn.addEventListener('click', function(){
            modal.style.display = 'flex';
        });
        
        closeModal.addEventListener('click', function(){
            modal.style.display = 'none';
        });
        
    </script>
    
</body>
</html>