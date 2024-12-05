<?php

require_once 'bootstrap.php';

use model\ArticleDAO;

try {
    $articleDAO = new ArticleDAO();
    
    $listeArticles = $articleDAO->rechercherTousLesArticles();
    
    echo $twig->render('index.html.twig', ['lesArticles' => $listeArticles]);
}
catch(Exception $e) {
    echo $twig->render('erreur.html.twig', ['message_erreur' => $e->getMessage()]);
}
