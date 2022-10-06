<?php
function test()
{
    try {
        throw new Exception('ma seconde exception');
    } catch (Exception $exception) {
        throw new Exception('ma troisieme exception');


        die($exception->getMessage());
    }
    throw new Exception('mon exception depuis une fonction');
}


try {
    test();
    //on lance une nouvelle exception avec message'mon exception'
    throw new Exception('mon exception');
    //on affiche message je continue mais ne sera pas executé
    echo 'je continue';
} catch (Exception $exception) {
    //on attrape l'exception 
    die($exception->getMessage()); // et on affiche le message lié a l'exception
}

// les exceptions remontent l'entiereté de l'arbre d'execution meme a l'interieur d'une fonction jusqu'au premier bloc try
//  