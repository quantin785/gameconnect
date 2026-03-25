<?php
namespace App\Config;

use PDO;
use PDOException;

/**
 * Configuration de la base de données
 */
class Database {
    private static $pdo = null;

    /**
     * Connexion à la base de données
     * @return PDO
     */
    public static function connect() {
        if (self::$pdo === null) {
            try {
                self::$pdo = new PDO(
                    'mysql:host=localhost;dbname=game;charset=utf8',
                    'root',
                    ''
                );
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Erreur de connexion à la base de données: " . $e->getMessage());
            }
        }
        return self::$pdo;
    }

    /**
     * Récupère l'instance PDO
     * @return PDO
     */
    public static function getInstance() {
        return self::connect();
    }
}
?>
