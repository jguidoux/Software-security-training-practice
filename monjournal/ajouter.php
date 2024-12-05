<?php

use cm\CSRF;
use cm\Session;

require_once 'bootstrap.php';

try {
    if(Session::verifierSession()) {

        $token = CSRF::genererJeton();

        echo $twig->render(
            'ajouter.html.twig',
            ['_csrf_token' => $token]
        );
    }
    else {
        header('Location: identification.php');
    }
}
catch(Exception $e) {
    echo $twig->render('erreur.html.twig', ['message_erreur' => $e->getMessage()]);
}
