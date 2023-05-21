<?php


function connect_database():?PDO{

    try {
        return new PDO('mysql:host=localhost;dbname=sistema_de_registro_login','root','');
    } catch (PDOException $e) {
        echo $e->getMessage();
        die();
    }

}