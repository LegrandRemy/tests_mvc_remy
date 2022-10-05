<?php
// controllers/post.php
require_once('src/model.php');

function post(string $identifier)
{

    $post = getPosts($identifier);
    $comments = getComments($identifier);

    require('templates/post.php');
}