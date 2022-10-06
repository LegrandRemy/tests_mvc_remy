<!-- index.php est le controleur de la page d'accueil

** src/model.php: se connecte à la base de données et récupère les billets.

** templates/homepage.php: affiche la page. Ce fichier ne va pas changer du tout.

** index.php: fait le lien entre le modèle et l'affichage (oui, juste ça !).


ces 3 fichiers forment la base d'une structure MVC (Modèle - Vue - Contrôleur) :

** Le modèle traite les données (src/model.php).

** La vue affiche les informations (templates/homepage.php).

** Le contrôleur fait le lien entre les deux (index.php). -->


<?php
// index.php est le routeur de la page d'accueil

//on charge nos fichier de controleurs
require_once('src/controllers/add_comment.php');
require_once('src/controllers/homepage.php');
require_once('src/controllers/post.php');

// on teste le parametre action pour savoir quel controleur appeler. Si le parametre n'est pas present, 
// on charge le controleur de la pge d'accueil contenant la liste des derniers billets(ligne 60 (dernier else))
// on verifie la presence du parametre action avec isset($_GET['action']) && qu'il n'est pas vide
try {
    if (isset($_GET['action']) && $_GET['action'] !== '') {
        //si il y a un parametre action et que l'action vaut post
        if ($_GET['action'] === 'post') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $identifier = $_GET['id'];

                //si l'action vaut post alors 
                post($identifier);
            } else {
                // throw new Exception arrete  le bloc try et amene directement l'ordi au bloc catch
                throw new Exception('Erreur : aucun identifiant de billet envoyé... oohhhh l\'action ne vaut pas post');

                die;
            }
        }
        // Verifier si l'action vaut add comment
        // si c'est le cas on appele le nouveau controller addComment
        elseif ($_GET['action'] === 'addComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $identifier = $_GET['id'];
                //$_post est une variable globale pour recuperer tous les parametres
                addComment($identifier, $_POST);
            } else {
                // throw new Exception arrete  le bloc try et amene directement l'ordi au bloc catch
                throw new Exception('Erreur : aucun identifiant de billet envoyé... oohhhh l\'action ne vaut pas addComment');

                die;
            }
        } else {
            // throw new Exception arrete  le bloc try et amene directement l'ordi au bloc catch
            throw new Exception('Erreur 404 : la page que vous cherchez n\'existe pas');
        }
    } else {
        homepage();
    }
} catch (Exception $e) { //si il y a eu une erreur, alors...
    //echo 'Erreur : ' . $e->getMessage(); //affiche l'erreur qui nous a été envoyée...
    $errorMessage = $e->getMessage();
    //Ici, notre bloc catch se contente de récupérer le message d'erreur qu'on a transmis et de l'afficher.
    require('template/error.php');
}