<?php

namespace model;

class DBUtil
{
    const URL = "mysql:host=localhost;port=3306;dbname=monjournal";
    const USER = 'MonJournal_4cce$';
    const PWD = 'Pa$$w0rd';
    
    /**
     * @return PDO L'objet de connexion PDO
     */
    public static function connexion() : \PDO {
        $db = new \PDO(self::URL, self::USER, self::PWD,
            array(
                \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
            )    
        );
        // Demander à PDO de lever des exceptions en cas d'erreurs
        $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        return $db;
    }
    
    /**
     * @param resource $db L'objet de connexion PDO
     */
    public static function deconnexion(\PDO $db) {
        $db = null;
    }
}
