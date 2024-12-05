<?php

// Invalider une session
session_start(); // Parce que l'on va manipuler le tableau de session

// 1 - Supprimer toutes les données stockées dans la session
$_SESSION = []; // On vide le tableau

// 2 - Appeler la fonction permettant d'invalider la session
session_destroy();

// Rediriger l'utilisateur vers ...
header('Location: index.php');
