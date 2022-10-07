<?php
// model.php est le modele, qui contient différentes fonctions pour récuperer des infos dans la base

//pour ajouter un namespace suivi de l'espace de nom souhaité. Les class Post et PostRepository sont maintenant dans le namespace
//il suffit d'aller changer dans le controller qui utilisé les class
// ne pas oublié le backslash "\" de DatabaseConnection
//dans controller utiliser use
namespace Application\model\post;

require_once('src/lib/database.php');

use Application\lib\Database\DatabaseConnection;

class Post
{
    public string $title;
    public string $content;
    public string $frenchCreationDate;
    public string $identifier;
}
//on ecrit une classe PostRepository avec une propriete nullable nommée $database qui presente une potentielle connexion avec une BDD
//le parametre PostRepository $repository a ete ajouté a chaque fonction cela permet d'avoir la connexion a la BDD si elle existe
//la fonction dbConnect() recoit aussi un PostRepository mais elle c'est plutot pour le modifier.C'est elle qui va etre responsable d'initialiser
//la connexion a la BDD la premiere fois

//propriete PDO qui peut etre null par defaut
class PostRepository
{
    //public DatabaseConnection $connection: on remplace la propriété $database par la propriété $connection de type DatabaseConnection
    public DatabaseConnection $connection;

    public function getPost(/*PostRepository $this,PostRepository $repository, */string $identifier): post
    {
        //$statement = $this->connection->getConnection()->prepare(: on remplace l'accès à la propriété$databasepar 
        //l'appel de la méthodegetConnection()de la propriété$connection;
        //$statement = $this->connection->getConnection()->query(: on fait exactement la même chose !
        $statement = $this->connection->getConnection()->prepare(
            "SELECT id, title, content, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%imin%ss') AS french_creation_date FROM posts WHERE id = ?"
        );
        $statement->execute([$identifier]);
        // retourner title, content, identifier(identifiant), ... depuis la base de données
        $row = $statement->fetch();
        $post = new Post();
        $post->title = $row['title'];
        $post->content = $row['content'];
        $post->frenchCreationDate = $row['french_creation_date'];
        $post->identifier = $row['id'];

        return $post;
    }
    //chaque fonction va vouloir utiliser la meme connexion a la BDD donc on passe en parametre

    public function getPosts(): array
    {
        // On récupère les 5 derniers billets
        $statement = $this->connection->getConnection()->query(
            "SELECT id, title, content, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%imin%ss') AS 
        french_creation_date FROM posts ORDER BY creation_date DESC LIMIT 0, 5"
        );
        $posts = [];
        while ($row = $statement->fetch()) {
            $post = new Post();
            $post->title = $row['title'];
            $post->content = $row['content'];
            $post->frenchCreationDate = $row['french_creation_date'];
            $post->identifier = $row['id'];


            $posts[] = $post;
        }

        return $posts;
    }
}