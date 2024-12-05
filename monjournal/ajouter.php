<?php

require_once 'bootstrap.php';

try {
    session_start();
    if(isset($_SESSION['_auteur'])) {
        echo $twig->render('ajouter.html.twig');
    }
    else {
        header('Location: identification.php');
    }
}
catch(Exception $e) {
    echo $twig->render('erreur.html.twig', ['message_erreur' => $e->getMessage()]);
}
