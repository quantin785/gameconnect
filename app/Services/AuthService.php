<?php
namespace App\Services;

use App\DAO\AuthDAO;

/**
 * Service pour l'Authentification
 */
class AuthService {
    private $authDAO;

    public function __construct() {
        $this->authDAO = new AuthDAO();
    }

    /**
     * Se connecter
     */
    public function login($emailOrUsername, $password) {
        // Validation
        if (empty(trim($emailOrUsername)) || empty(trim($password))) {
            return ['success' => false, 'message' => 'Email/Username et password requis'];
        }

        // Récupérer l'utilisateur
        $user = $this->authDAO->getUserByEmailOrUsername($emailOrUsername);
        
        if (!$user) {
            return ['success' => false, 'message' => '❌ Email/Username ou mot de passe incorrect'];
        }

        // Vérifier le mot de passe
        if (!password_verify($password, $user['password'])) {
            return ['success' => false, 'message' => '❌ Email/Username ou mot de passe incorrect'];
        }

        // Créer la session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['email'] = $user['email'];

        return ['success' => true, 'message' => '✅ Connexion réussie'];
    }

    /**
     * S'inscrire
     */
    public function register($username, $email, $password, $confirmPassword) {
        // Validation
        if (empty(trim($username)) || empty(trim($email)) || empty(trim($password))) {
            return ['success' => false, 'message' => 'Tous les champs sont requis'];
        }

        if (strlen($username) < 3) {
            return ['success' => false, 'message' => 'Le username doit avoir au moins 3 caractères'];
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return ['success' => false, 'message' => 'Email invalide'];
        }

        if (strlen($password) < 6) {
            return ['success' => false, 'message' => 'Le password doit avoir au moins 6 caractères'];
        }

        if ($password !== $confirmPassword) {
            return ['success' => false, 'message' => 'Les passwords ne correspondent pas'];
        }

        // Vérifier si l'email existe
        if ($this->authDAO->emailExists($email)) {
            return ['success' => false, 'message' => 'Cet email existe déjà'];
        }

        // Vérifier si le username existe
        if ($this->authDAO->usernameExists($username)) {
            return ['success' => false, 'message' => 'Ce username existe déjà'];
        }

        // Créer l'utilisateur
        if ($this->authDAO->createUser($username, $email, $password)) {
            return ['success' => true, 'message' => '✅ Inscription réussie! Vous pouvez maintenant vous connecter.'];
        } else {
            return ['success' => false, 'message' => 'Erreur lors de l\'inscription'];
        }
    }

    /**
     * Se déconnecter
     */
    public function logout() {
        session_destroy();
        return ['success' => true, 'message' => 'Déconnexion réussie'];
    }

    /**
     * Vérifier si connecté
     */
    public function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }
}
?>
