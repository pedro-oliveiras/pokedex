<?php

    class Conexao{

        private $host;
        private $dbname;
        private $user;
        private $password;

        public function __construct(){
            $this->host     = 'localhost';
            $this->dbname   = 'pokedex';
            $this->user     = 'root';
            $this->password = '';
        }

        function conectar(){
            return new PDO("mysql:host=".$this->host.";dbname=".$this->dbname."", $this->user, $this->password);
        }

        function getAllPokemons(){

            $con = $this->conectar();

            $sql = ("SELECT * FROM pokemons");

            $rs = $con->query($sql);
            $resp = $rs->fetchAll(PDO::FETCH_ASSOC);

            return $resp;
        }

        function insertPokemon($idSeed, $nome, $tipos, $cores, $hp, $atack, $defense, $speed, $photo){

            $con = $this->conectar();

            $sql = ("INSERT INTO pokemons(idSeed, nome, tipos, cores, hp, atack, defense, speed, photo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

            $stmt = $con->prepare($sql);

            $stmt->bindParam(1, $idSeed);
            $stmt->bindParam(2, $nome);
            $stmt->bindParam(3, $tipos);
            $stmt->bindParam(4, $cores);
            $stmt->bindParam(5, $hp);
            $stmt->bindParam(6, $atack);
            $stmt->bindParam(7, $defense);
            $stmt->bindParam(8, $speed);
            $stmt->bindParam(9, $photo);

            $stmt->execute();
        }

        function getPokemon($idSeed){

            $con = $this->conectar();

            $sql = ("SELECT * FROM pokemons WHERE idSeed = $idSeed");

            $rs = $con->query($sql);
            $resp = $rs->fetchAll(PDO::FETCH_ASSOC);

            return $resp;
        }

        function updatePokemon($idSeed, $nome){

            $con = $this->conectar();

            $sql = ("UPDATE pokemons SET nome = ? WHERE idSeed = ?");

            $stmt = $con->prepare($sql);

            $stmt->bindParam(1, $nome);
            $stmt->bindParam(2, $idSeed);

            $stmt->execute();
        }

        function lastPokemonAdded(){

            $con = $this->conectar();

            $sql = ("SELECT idSeed FROM pokemons ORDER BY idPokemon DESC LIMIT 1");

            $rs = $con->query($sql);
            $resp = $rs->fetchAll(PDO::FETCH_ASSOC);

            return $resp;
        }

        function createDatabase(){
            $sql = (" CREATE TABLE IF NOT EXISTS pokemons ( idPokemon INT NOT NULL AUTO_INCREMENT ,
                                                            idSeed    INT NOT NULL ,
                                                            nome      VARCHAR(100) NOT NULL ,
                                                            tipos     VARCHAR(45) NOT NULL ,
                                                            cores     VARCHAR(45) NOT NULL ,
                                                            hp        INT NOT NULL ,
                                                            atack     INT NOT NULL ,
                                                            defense   INT NOT NULL ,
                                                            speed     INT NOT NULL ,
                                                            photo     VARCHAR(500) NOT NULL ,
                                                            PRIMARY KEY (idPokemon)); ");

            $con = $this->conectar();
            $stmt = $con->prepare($sql);
            $stmt->execute();     
        }
        
    }  

?>