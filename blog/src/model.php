<?php
function getPosts()
{
    // Connexion à la base de données
    try {
        $database = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '');
    } catch (Exception $e) {
        die('Erreurs : ' . $e->getMessage());
    }

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
        ];

        $posts[] = $post;
    }

    return $posts;
}