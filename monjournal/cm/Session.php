<?php

namespace cm;

use model\Auteur;

class Session
{
    public static function creerSession($auteur) : void {
        // On force la création d'une nouvelle session
        session_start();
        session_destroy();
        session_start();

        // On stocke l'objet Auteur pour pouvoir vérifier que l'utilisateur est bien authentifié.
        $_SESSION['_auteur_auth'] = $auteur;

        // On stocke dans la session des informations propre au client (navigateur) pour pouvoir
        // corréler cette session avec un utilisateur.
        // Pour éviter le Session Hijacking et le Session Fixation.
        $_SESSION['_user_agent'] = crypt($_SERVER['HTTP_USER_AGENT'], $auteur->getIdentifiant());
        $_SESSION['_ip_address'] = crypt($_SERVER['REMOTE_ADDR'], $auteur->getIdentifiant());
    }

    public static function verifierSession() : bool {
        session_start();
        if(
            // Vérifier l'authentification
            isset($_SESSION['_auteur_auth']) &&
            $_SESSION['_auteur_auth'] instanceof Auteur
        ) {
            // On récupère l'auteur
            $auteur = $_SESSION['_auteur_auth'];
            
            // Vérification Session Fixation & Session Hijacking
            if(
                isset($_SESSION['_user_agent']) &&
                $_SESSION['_user_agent'] === crypt($_SERVER['HTTP_USER_AGENT'], $auteur->getIdentifiant()) &&
                isset($_SESSION['_ip_address']) &&   
                $_SESSION['_ip_address'] === crypt($_SERVER['REMOTE_ADDR'], $auteur->getIdentifiant()) 
            ) {
                // La session est valide et fiable !
                // On regénère l'identifiant de session
                session_regenerate_id();

                return true;
            }
        }    
        return false;    
    }
}