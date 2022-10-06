<?php

//src/model/comment.php

function getComments(string $post)
{

    $database = commentDbConnect();

    $statement = $database->prepare(
        "SELECT id, author, comment, DATE_FORMAT(comment_date, '%d/%m/%Y à %Hh%imin%ss') AS 
        french_creation_date FROM comments WHERE post_id = ? ORDER BY comment_date DESC"
    );
    $statement->execute([$post]);

    $comments = [];
    while (($row = $statement->fetch())) {
        $comment = [
            'author' => $row['author'],
            'french_creation_date' => $row['french_creation_date'],
            'comment' => $row['comment'],
        ];
        $comments[] = $comment;
    }

    return $comments;
}
//fonction createComment utilisé dans le controlleur add_comment
// Prend en parametre l'identifiant du billet, l'auteur et le commentaire
// qui renvoie un booleen pour savoir si reussite ou echec
function createComment(string $post, string $author, string $comment)
{
    //Connexion a la base de donnée
    $database = commentDbConnect();
    //Requete SQL INSERT INTO dans la table comments
    $statement = $database->prepare(
        'INSERT INTO comments(post_id, author, comment, comment_date) VALUES(?, ?, ?, NOW())'
    ); // la date est une responsabilité donnée a mySQL via la fonction NOW
    // on recupere le nombre de ligne afféctée 
    $affectedLines = $statement->execute([$post, $author, $comment]);

    return ($affectedLines > 0);
} // si >0 on a reussi a creer le commentaire

function commentDbConnect()
{
    try {
        $database = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '');

        return $database;
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}