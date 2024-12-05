<?php

require_once 'bootstrap.php';

use model\ArticleDAO;
use model\Article;

try {
    session_start();
    if(isset($_SESSION['_auteur'])) {
        if(
            isset($_POST['titre']) && isset($_POST['intro']) &&
            isset($_POST['texte']) // && isset($_POST['auteur']) 
        ) {  
            $titre = $_POST['titre'];
            $intro = $_POST['intro'];
            $texte = $_POST['texte'];
            $auteur =  $_POST['auteur'];
            
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
catch(Exception $e) {
    echo $twig->render('erreur.html.twig', ['message_erreur' => $e->getMessage()]);
}
