<?php

namespace model;

class DBUtil
{
    private static string $url = ""; 
    private static string $user = "";
    private static string $pwd = "";
    
    private static ?array $config = null;

    /**
     * @return PDO L'objet de connexion PDO
     */
    public static function connexion() : \PDO {

        // Chargement de la configuration
        if(self::$config === null) {
            self::$config = parse_ini_file('../../config/monjournal.ini');
            self::$url = "mysql:host=" . self::$config['db.host'] . ";port=" . self::$config['db.port'] . ";dbname=" . self::$config['db.name'];
            self::$user = self::$config['db.user'];
            self::$pwd = self::$config['db.password'];
        }

        $db = new \PDO(self::$url, self::$user, self::$pwd,
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
