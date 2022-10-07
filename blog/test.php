<?php
// function test1()
// {
//     try {
//         throw new Exception('ma seconde exception');
//     } catch (Exception $exception) {
//         throw new Exception('ma troisieme exception');


//         die($exception->getMessage());
//     }
//     throw new Exception('mon exception depuis une fonction');
// }


// try {
//     test1();
//     //on lance une nouvelle exception avec message'mon exception'
//     throw new Exception('mon exception');
//     //on affiche message je continue mais ne sera pas executé
//     echo 'je continue';
// } catch (Exception $exception) {
//     //on attrape l'exception 
//     die($exception->getMessage()); // et on affiche le message lié a l'exception
// }

// les exceptions remontent l'entiereté de l'arbre d'execution meme a l'interieur d'une fonction jusqu'au premier bloc try
// 

class Comment
{
    public string $author;
    public string $frenchCreationDate;
    public string $comment;
}
$comment = new Comment();
//initialiser chacune des proprietes
//assigne nouvelle valeur a chacune des proprietes
//"$comment" => "Objet" , "->" => "operateur fleche" , "author" => "nom de la propriete" , "Auteur" => "nouvelle valeur

$comment->author = 'Auteur';
$comment->frenchCreationDate = '07/10/2022 à 14h03';
$comment->comment = 'Commentaire';

// on peut reassigner une nouvelle valeur a une propriété
$comment->author = 'Nouvel Auteur';

//utiliser les proprietes d'un objet
//afficher le contenu de la propriete auteur
//echo + on passe en parametre la propriete auteur avec $comment suivi nom de propriete pareil que variable
// echo $comment->author;



// fonction test qui prend comme parametre un objet type commentaire
function test(Comment $comment)
{
    var_dump($comment);
}
test($comment);