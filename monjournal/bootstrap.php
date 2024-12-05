<?php

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
