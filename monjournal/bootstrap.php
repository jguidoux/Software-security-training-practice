<?php

// ------------------------------------------------
// Configuration de sécurité pour les sessions
// ------------------------------------------------

// Interdire la gestion de sessions par réécriture d'URL
ini_set('session.use_only_cookies', 1);
ini_set('session.use_trans_sid', 0);

// Interdire la manipulation des cookies de session en JS
ini_set('session.cookie_httponly', true);

// Transmettre les cookies de session uniquement en HTTPS
// ini_set('session.cookie_secure', true);

// Définir un délai d'expiration de session -> Par défaut : 1440 secondes (24 minutes)
ini_set('session.gc_maxlifetime', 900); // 15 minutes

require_once 'vendor/autoload.php';

function monAutoloader($classe) {
	
	set_include_path(
		get_include_path() 
	);
	
	$classe = str_replace('\\', '/', $classe);
	
	require_once($classe . '.php');
}

spl_autoload_register('monAutoloader');

$loader = new \Twig\Loader\FilesystemLoader('views');
$twig = new \Twig\Environment($loader, [
    // 'cache' => 'cache',
	'debug' => true,
	'autoescape' => false,
	'optimizations' => 0 
]);
