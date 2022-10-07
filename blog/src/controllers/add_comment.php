<?php
//src/controllers/add_comment.php

require_once('src/lib/database.php');
require_once('src/model/comment.php');

use Application\model\comment\CommentRepository;
use Application\lib\Database\DatabaseConnection;

// creer une fonction addComment qui prend en parametre l'identifiant du billet concerné($post) et un input sous forme de tableau
// cet input : données soumise par le formulaire
// on recupere donc l'auteur et le commentaire
function addComment(string $post, array $input)
{
    $author = null;
    $comment = null;
    // On verifie les données inscrite dans le formulaire
    if (!empty($input['author']) && !empty($input['comment'])) {
        $author = $input['author'];
        $comment = $input['comment'];
    } else {
        throw new Exception('les données du formulaires sont invalides');
    }
    // Ensuite on appel la fonction createComment definit par un nouveau modele
    // elle prend en parametre l'identifiant du billet, l'auteur et le commentaire
    // renvoi si l'operation de creation a bien reussi
    $commentRepository = new CommentRepository();
    $commentRepository->connection = new DatabaseConnection();
    $succes = $commentRepository->createComment($post, $author, $comment);

    if (!$succes) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    } else {
        // si bien reussi rediriger l'utilisateur vers la page du billet
        header('Location: index.php?action=post&id=' . $post);
    }
    // la fonction create sera definit dans le controller 'src/model/comment.php'
}