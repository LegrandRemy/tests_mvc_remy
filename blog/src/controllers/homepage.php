<?php
// controllers/homepage.php responsable d'afficher la page d'accueil

require_once('src/lib/database.php');
require_once('src/model/post.php');

use Application\model\post\PostRepository;
use Application\lib\Database\DatabaseConnection;

function homepage()
{
    $postRepository = new PostRepository();
    $postRepository->connection = new DatabaseConnection();
    $posts = $postRepository->getPosts();

    require('templates/homepage.php');
}