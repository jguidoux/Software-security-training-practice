<?php

require_once 'bootstrap.php';

use cm\Filter;
use model\ArticleDAO;

try {
    if(isset($_GET['id']) && !empty($_GET['id']) && is_integer((int) $_GET['id'])) {

        // On filtre le paramètre id
        $id = Filter::filtreXSS((int) $_GET['id']);

        $articleDAO = new ArticleDAO();
        $article = $articleDAO->rechercherArticleParId((int) $id);
    
        echo $twig->render('article.html.twig', ['article' => $article]);    
    }
    else {
        throw new Exception("Impossible de visualiser cet article.");
    }
}
catch(Exception $e) {
    echo $twig->render('erreur.html.twig', ['message_erreur' => $e->getMessage()]);
}
