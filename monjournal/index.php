<?php

require_once 'bootstrap.php';

use cm\Session;
use model\ArticleDAO;

try {
    $articleDAO = new ArticleDAO();
    
    $listeArticles = $articleDAO->rechercherTousLesArticles();

    $session_active = Session::verifierSession();
    
    echo $twig->render(
        'index.html.twig', 
        [
            'lesArticles' => $listeArticles,
            'session_active' => $session_active
        ]
    );
}
catch(Exception $e) {
    echo $twig->render('erreur.html.twig', ['message_erreur' => $e->getMessage()]);
}
