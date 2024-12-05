<?php

require_once 'bootstrap.php';

use model\ArticleDAO;

try {
    if(isset($_GET['id'])) {
    
        $articleDAO = new ArticleDAO();
        $article = $articleDAO->rechercherArticleParId($_GET['id']);
    
        echo $twig->render('article.html.twig', ['article' => $article]);    
    }
    else {
        throw new Exception("Impossible de visualiser cet article.");
    }
}
catch(Exception $e) {
    echo $twig->render('erreur.html.twig', ['message_erreur' => $e->getMessage()]);
}
