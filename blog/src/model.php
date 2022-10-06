<?php
// model.php est le modele, qui contient différentes fonctions pour récuperer des infos dans la base


function getPosts()
{
    // Connexion à la base de données

    $database = dbConnect();

    // On récupère les 5 derniers billets
    $statement = $database->query(
        "SELECT id, title, content, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%imin%ss') AS 
        french_creation_date FROM posts ORDER BY creation_date DESC LIMIT 0, 5"
    );
    $posts = [];
    while ($row = $statement->fetch()) {
        $post = [
            'title' => $row['title'],
            'content' => $row['content'],
            'french_creation_date' => $row['french_creation_date'],
            'identifier' => $row['id'],
        ];

        $posts[] = $post;
    }

    return $posts;
}

function getPost($identifier)
{

    $database = dbConnect();

    $statement = $database->prepare(
        "SELECT id, title, content, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%imin%ss') AS french_creation_date FROM posts WHERE id = ?"
    );
    $statement->execute([$identifier]);
    // retourner title, content, identifier(identifiant), ... depuis la base de données
    $row = $statement->fetch();
    $post = [
        'title' => $row['title'],
        'french_creation_date' => $row['french_creation_date'],
        'content' => $row['content'],
        'identifier' => $row['id'],
    ];

    return $post;
}


// Nouvelle fonction qui nous permet d'eviter de repeter du code
function dbConnect()
{
    try {
        $database = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '');
        return $database;
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}