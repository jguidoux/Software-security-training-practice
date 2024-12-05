<?php

require_once 'bootstrap.php';

use model\AuteurDAO;

 try {
    if(
       isset($_POST['identifiant']) && isset($_POST['motdepasse'])  
    ) {  
        $auteurDAO = new AuteurDAO();
        $auteur = $auteurDAO->authentifier(
            $_POST['identifiant'],
            $_POST['motdepasse']
        ); 
        session_start();
        $_SESSION['_auteur'] = $auteur;
        // On redirige vers la page d'accueil.
        header("Location: index.php");
    }
    else {
      throw new Exception("Données de formulaire incomplètes.");
    }
}
catch(Exception $e) {
    echo $twig->render('erreur.html.twig', ['message_erreur' => $e->getMessage()]);
}
