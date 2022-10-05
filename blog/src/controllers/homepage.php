<?php
// controllers/homepage.php responsable d'afficher la page d'accueil

require_once('src/model.php');

function homepage()
{
    $posts = getPosts();

    require('templates/homepage.php');
}