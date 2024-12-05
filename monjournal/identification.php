<?php

use cm\CSRF;

require_once 'bootstrap.php';

try {
    // On génère un jeton CSRF
    $token = CSRF::genererJeton();

    echo $twig->render(
        'identification.html.twig', 
        ['_csrf_token' => $token]       // On transmet le jeton au template d'affichage du formulaire.
    );
}
catch(Exception $e) {
    echo $twig->render('erreur.html.twig', ['message_erreur' => $e->getMessage()]);
}
