<?php

namespace model;

use cm\Filter;

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

            /*
            $sql = "INSERT INTO article(titre,intro,texte,date_publication,auteur) VALUES('" . $titre . "', '" . $intro . "', '" . $texte . "', '" . $date . "', '" . $auteur . "')";
            $cnx->query($sql);
            */

            $sql = "INSERT INTO article(titre,intro,texte,date_publication,auteur) VALUES(:titre, :intro, :texte, :date, :auteur)";
            $st = $cnx->prepare($sql);
            $st->execute(
                [
                    ':titre' => $titre,
                    ':intro' => $intro,
                    ':texte' => $texte,
                    ':date' => $date,
                    ':auteur' => $auteur
                ]
            );

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
                // On filtre les données sortantes
                $article->setId(Filter::filtreXSS($enreg['id']));
                $article->setTitre(Filter::filtreXSS($enreg['titre']));
                $article->setIntro(Filter::filtreXSS($enreg['intro']));
                $article->setTexte(Filter::filtreXSS($enreg['texte']));
                $article->setDatePublication(\DateTime::createFromFormat('Y-m-d H:i:s', Filter::filtreXSS($enreg['date_publication'])));
                $article->setAuteur(Filter::filtreXSS($enreg['auteur']));
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
            /*
            $sql = "SELECT titre,intro,texte,date_publication,auteur FROM article WHERE id=$id";
            $st = $cnx->query($sql);
            */
            $sql = "SELECT titre,intro,texte,date_publication,auteur FROM article WHERE id=:id";
            $st = $cnx->prepare($sql);
            $st->execute(
                [
                    ':id' => $id
                ]
            );

            if($enreg = $st->fetch()) {
                $article = new Article();
                $article->setId($id);
                // On filtre les données sortantes
                $article->setTitre(Filter::filtreXSS($enreg['titre']));
                $article->setIntro(Filter::filtreXSS($enreg['intro']));
                $article->setTexte(Filter::filtreXSS($enreg['texte']));
                $article->setDatePublication(\DateTime::createFromFormat('Y-m-d H:i:s', Filter::filtreXSS($enreg['date_publication'])));
                $article->setAuteur(Filter::filtreXSS($enreg['auteur']));
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
