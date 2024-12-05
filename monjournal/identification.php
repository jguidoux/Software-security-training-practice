<?php

require_once 'bootstrap.php';

try {
    echo $twig->render('identification.html.twig');
}
catch(Exception $e) {
    echo $twig->render('erreur.html.twig', ['message_erreur' => $e->getMessage()]);
}
