<!-- 
** src/model.php: se connecte à la base de données et récupère les billets.

** templates/homepage.php: affiche la page. Ce fichier ne va pas changer du tout.

** index.php: fait le lien entre le modèle et l'affichage (oui, juste ça !).


ces 3 fichiers forment la base d'une structure MVC (Modèle - Vue - Contrôleur) :

** Le modèle traite les données (src/model.php).

** La vue affiche les informations (templates/homepage.php).

** Le contrôleur fait le lien entre les deux (index.php). -->


<?php

//recuperer model.php
require('src/model.php');

//utiliser le code de model.php (bibliotheque)
$posts = getPosts();

//recuperer homepage.php pour affichage a renvoyer a l'utilisateur
require('templates/homepage.php');