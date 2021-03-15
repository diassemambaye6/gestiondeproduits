<?php


try{
    $user="root";
    $pass="";

    
        $bdd = new PDO('mysql:host=localhost:3306;dbname=authentification', $user,$pass);

    
            //On définit le mode d'erreur de PDO sur Exception
        } 
        catch (PDOException $e) {
            if ($e->getCode() == '2A000')
                echo "Syntax Error: ".$e->getMessage();
        }


?>