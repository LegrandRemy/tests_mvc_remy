<?php

namespace Application\lib\Database;
// On crée la classeDatabaseConnection, qui encapsule la connexionPDOdans la propriété$database. 

// Ensuite, on définit une méthodegetConnection(), qui renvoie forcément une instance dePDO. 

// À l'intérieur de cette méthode, on initialise la connexion si elle ne l'est pas déjà. Et voilà !

class DatabaseConnection
{
    public ?\PDO $database = null;

    public function getConnection(): \PDO
    {
        if ($this->database === null) {
            $this->database = new \PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '');
        }
        return $this->database;
    }
}