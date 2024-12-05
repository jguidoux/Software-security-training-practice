<?php

require_once 'bootstrap.php';

use cm\CSRF;
use cm\Filter;
use cm\Session;
use model\AuteurDAO;

 try {

    if(isset($_POST['_csrf_token']) && CSRF::verifierJeton(Filter::filtreXSS($_POST['_csrf_token']))) {
        if(
        isset($_POST['identifiant']) && isset($_POST['motdepasse'])  
        ) {  
            $auteurDAO = new AuteurDAO();
            $auteur = $auteurDAO->authentifier(
                // Filtrage des données du formulaire
                Filter::filtreXSS($_POST['identifiant']),
                Filter::filtreXSS($_POST['motdepasse'])
            ); 
            // On créé une session sécurisée
            Session::creerSession($auteur);

            // On redirige vers la page d'accueil.
            header("Location: index.php");
        }
        else {
        throw new Exception("Données de formulaire incomplètes.");
        }
    }
    else {
        // Jeton CSRF introuvable ou invalide.
        header('Location: index.php');
    }
}
catch(Exception $e) {
    echo $twig->render('erreur.html.twig', ['message_erreur' => $e->getMessage()]);
}
