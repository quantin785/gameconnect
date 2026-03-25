<?php

namespace App\DAO;

use App\Config\Database;
use App\Models\Auth;
use PDO;

/**
 * DAO pour l'Authentification
 */
class AuthDAO {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance();
    }

    /**
     * Vérifier si un utilisateur existe
     */
    public function getUserByEmailOrUsername($emailOrUsername) {
        $stmt = $this->pdo->prepare("
            SELECT id, username, email, password 
            FROM users 
            WHERE email = ? OR username = ?
        ");
        
        $stmt->execute([$emailOrUsername, $emailOrUsername]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Créer un nouvel utilisateur
     */
    public function createUser($username, $email, $password) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        
        $stmt = $this->pdo->prepare("
            INSERT INTO users (username, email, password, created_at) 
            VALUES (?, ?, ?, NOW())
        ");
        
        return $stmt->execute([$username, $email, $hashedPassword]);
    }

    /**
     * Vérifier si un email existe déjà
     */
    public function emailExists($email) {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) as count FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'] > 0;
    }

    /**
     * Vérifier si un username existe déjà
     */
    public function usernameExists($username) {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) as count FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'] > 0;
    }
}
?>
