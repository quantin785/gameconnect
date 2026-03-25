<?php

namespace App\Controllers;

use App\Services\AuthService;

/**
 * Contrôleur pour la gestion de l'authentification
 */
class AuthController {
    private AuthService $authService;

    public function __construct() {
        $this->authService = new AuthService();
    }

    /**
     * Se connecter
     */
    public function login(): array {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return $this->error('Méthode non autorisée');
        }

        $emailOrUsername = trim($_POST['emailOrUsername'] ?? '');
        $password = $_POST['password'] ?? '';

        return $this->authService->login($emailOrUsername, $password);
    }

    /**
     * S'inscrire
     */
    public function register(): array {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return $this->error('Méthode non autorisée');
        }

        $username = trim($_POST['username'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $confirmPassword = $_POST['confirmPassword'] ?? '';

        return $this->authService->register($username, $email, $password, $confirmPassword);
    }

    /**
     * Se déconnecter
     */
    public function logout(): array {
        return $this->authService->logout();
    }

    /**
     * Vérifier si l'utilisateur est connecté
     */
    public function isLoggedIn(): bool {
        return $this->authService->isLoggedIn();
    }

    /**
     * Retourner une réponse de succès
     */
    private function success(string $message): array {
        return ['success' => true, 'message' => $message];
    }

    /**
     * Retourner une réponse d'erreur
     */
    private function error(string $message): array {
        return ['success' => false, 'message' => $message];
    }
}
