<?php

//src/model/comment.php

//Declaration de class Comment
//Puis dans la boucle while, pour chaque ligne de resultat SQL, on instancie un nouvel objet de type Commment
//Enfin on renseigne la valeur de chacune des propriétés

namespace Application\model\comment;

use Application\lib\Database\DatabaseConnection;

class Comment
{
    public string $author;
    public string $frenchCreationDate;
    public string $comment;
}

class CommentRepository
{
    //public DatabaseConnection $connection: on remplace la propriété $database par la propriété $connection de type DatabaseConnection
    public DatabaseConnection $connection;
    public function getComments(string $post): array
    {



        $statement = $this->connection->getConnection()->prepare(
            "SELECT id, author, comment, DATE_FORMAT(comment_date, '%d/%m/%Y à %Hh%imin%ss') AS 
        french_creation_date FROM comments WHERE post_id = ? ORDER BY comment_date DESC"
        );
        $statement->execute([$post]);

        $comments = [];
        while (($row = $statement->fetch())) {

            $comment = new Comment();
            $comment->author = $row['author'];
            $comment->frenchCreationDate = $row['french_creation_date'];
            $comment->comment = $row['comment'];

            $comments[] = $comment;
        }

        return $comments;
    }
    //fonction createComment utilisé dans le controlleur add_comment
    // Prend en parametre l'identifiant du billet, l'auteur et le commentaire
    // qui renvoie un booleen pour savoir si reussite ou echec
    public function createComment(string $post, string $author, string $comment): bool
    {

        //Requete SQL INSERT INTO dans la table comments
        $statement = $this->connection->getConnection()->prepare(
            'INSERT INTO comments(post_id, author, comment, comment_date) VALUES(?, ?, ?, NOW())'
        ); // la date est une responsabilité donnée a mySQL via la fonction NOW
        // on recupere le nombre de ligne afféctée 
        $affectedLines = $statement->execute([$post, $author, $comment]);

        return ($affectedLines > 0);
    } // si >0 on a reussi a creer le commentaire

}