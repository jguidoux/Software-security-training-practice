<?php

namespace model;

class ArticleDAO
{
    /**
     * @param Article $article L'article à insérer
     * @return integer L'id d'article généré
     */
    public function ajouterArticle(Article $article) : int {
        $cnx = null;
        try {
            $cnx = DBUtil::connexion();

            $titre = $article->getTitre();
            $intro = $article->getIntro();
            $texte = $article->getTexte();
            $date = $article->getDatePublication()->format('Y-m-d H:i:s');
            $auteur = $article->getAuteur();

            $sql = "INSERT INTO article(titre,intro,texte,date_publication,auteur) VALUES('" . $titre . "', '" . $intro . "', '" . $texte . "', '" . $date . "', '" . $auteur . "')";
            $cnx->query($sql);

            return $cnx->lastInsertId();
        }
        catch(\PDOException $e) {
            throw new \Exception("Erreur d'enregistrement de l'article. " . $e->getMessage());
        }
        finally {
            DBUtil::deconnexion($cnx);
        }
    }
    
    /**
     * @return array Un tableau d'objets Article
     */
    public function rechercherTousLesArticles() : array {
        $cnx = null;
        try {
            $cnx = DBUtil::connexion();
            $sql = "SELECT id,titre,intro,texte,date_publication,auteur FROM article ORDER BY date_publication DESC";
            $st = $cnx->query($sql);
            $listeArticles = array();
            while($enreg = $st->fetch()) {
                $article = new Article();
                $article->setId($enreg['id']);
                $article->setTitre($enreg['titre']);
                $article->setIntro($enreg['intro']);
                $article->setTexte($enreg['texte']);
                $article->setDatePublication(\DateTime::createFromFormat('Y-m-d H:i:s', $enreg['date_publication']));
                $article->setAuteur($enreg['auteur']);
                $listeArticles[] = $article;
            }
            return $listeArticles;
        }
        catch(\PDOException $e) {  
            throw new \Exception("Erreur de récupération de la liste des articles.");
        }
        finally {
            DBUtil::deconnexion($cnx);
        }
    }
    
    /**
     * @param integer $id L'identifiant de l'article recherché
     * @return Article L'objet Article correspondant.
     */
    public function rechercherArticleParId(int $id) : Article {
        $cnx = null;
        try {
            $cnx = DBUtil::connexion();
            $sql = "SELECT titre,intro,texte,date_publication,auteur FROM article WHERE id=$id";
            $st = $cnx->query($sql);
            if($enreg = $st->fetch()) {
                $article = new Article();
                $article->setId($id);
                $article->setTitre($enreg['titre']);
                $article->setIntro($enreg['intro']);
                $article->setTexte($enreg['texte']);
                $article->setDatePublication(\DateTime::createFromFormat('Y-m-d H:i:s', $enreg['date_publication']));
                $article->setAuteur($enreg['auteur']);
                return $article;
            }
            else {
                throw new \Exception("Article Introuvable.");
            }
        }
        catch(\PDOException $e) {
            throw new \Exception("Erreur de récupération de l'article.");
        }
        finally {
            DBUtil::deconnexion($cnx);
        }
    }
    
}
