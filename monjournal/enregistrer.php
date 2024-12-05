<?php

require_once 'bootstrap.php';

use cm\CSRF;
use cm\Filter;
use cm\Session;
use model\ArticleDAO;
use model\Article;

try {
    if(CSRF::verifierJeton(Filter::filtreXSS($_POST['_csrf_token']))) {
        if(Session::verifierSession()) {
            if(
                isset($_POST['titre']) && isset($_POST['intro']) &&
                isset($_POST['texte']) // && isset($_POST['auteur']) 
            ) {  
                // Filtrage des données du formulaire
                $titre = Filter::filtreXSS($_POST['titre']);
                $intro = Filter::filtreXSS($_POST['intro']);
                $texte = Filter::filtreXSS($_POST['texte']);
                $auteur =  Filter::filtreXSS($_POST['auteur']);
                
                $article = new Article();
                $article->setTitre($titre);
                $article->setIntro($intro);
                $article->setTexte($texte);
                                
                $article->setAuteur($auteur);
                $article->setDatePublication(DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s')));
                
                $articleDAO = new ArticleDAO();
                $id = $articleDAO->ajouterArticle($article);
                
                header('Location: article.php?id=' . $id);
            }
            else {
                throw new Exception("Données de formulaire incomplètes.");
            }
        }
        else {
            header('Location: identification.php');
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
