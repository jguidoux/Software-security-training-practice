<?php

namespace cm;

class CSRF
{
    public static function genererJeton() : string {
        // On génère un jeton unique
        $token = uniqid(rand(), true);

        // On le stocke dans la session 
        session_start();

        $_SESSION['_csrf_token'] = $token;

        // On retourne le jeton pour qu'il soit injecté dans la réponse au client.
        return $token;
    }

    public static function verifierJeton(string $jeton) : bool {
        // On vérifie que le jeton transmis en paramètre (venant du client)
        // correspond à celui présent dans la session.
        $fiable = false;
        session_start();
        if(
            isset($_SESSION['_csrf_token']) &&
            $_SESSION['_csrf_token'] === $jeton
        ) {
            // Le jeton est OK -> transaction fiable
            $fiable = true;
        }

        // Dans tous les cas on supprime le jeton de la session
        unset($_SESSION['_csrf_token']);
        
        return $fiable;
    }
}