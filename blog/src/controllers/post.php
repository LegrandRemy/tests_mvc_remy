<?php
// controllers/post.php responsable d'afficher les billets

require_once('src/lib/database.php');
require_once('src/model/post.php');
require_once('src/model/comment.php');

// use pour dire a php que le nom PostRepository peut etre utilisé tel quel comme un alias a Application\....\post dans tout le fichier
use Application\model\post\PostRepository;
use Application\model\comment\CommentRepository;
use Application\lib\Database\DatabaseConnection;

//creer fonction qui prend en parametre un identifiant ($identifier)
function post(string $identifier)
{
    $connection = new DatabaseConnection();

    $postRepository = new PostRepository();
    $postRepository->connection = new DatabaseConnection();
    $post = $postRepository->getPost($identifier);

    $commentRepository = new Commentrepository();
    $commentRepository->connection = new DatabaseConnection();
    $comments = $commentRepository->getComments($identifier);

    require('templates/post.php');
}