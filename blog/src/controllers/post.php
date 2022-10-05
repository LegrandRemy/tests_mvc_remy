<?php
// controllers/post.php responsable d'afficher les billets

require_once('src/model.php');
//creer fonction qui prend en parametre un identifiant ($identifier)
function post(string $identifier)
{

    $post = getPost($identifier);
    $comments = getComments($identifier);

    require('templates/post.php');
}