<?php

if(count($argv) == 2) {
    $hash = password_hash($argv[1], PASSWORD_ARGON2ID);
    echo $hash;
}
else {
    echo "Usage: php encrypt.php <mot de passe en clair>";
}