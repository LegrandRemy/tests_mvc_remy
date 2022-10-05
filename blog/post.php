<?php
// post.php est le conttroleur d'un billet et ses commentaires. Il fait le lien entre le modele et la vue

require('src/model.php');

if (isset($_GET['id']) && $_GET['id'] > 0) {
    $identifier = $_GET['id'];
} else {
    echo 'Erreur : aucun identifiant de billet envoyé';

    die;
}

$post = getPost($identifier);
$comments = getComments($identifier);

require('templates/post.php');