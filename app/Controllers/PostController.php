<?php
namespace App\Controllers;

use App\Services\PostService;

/**
 * Contrôleur pour la gestion des posts
 */
class PostController {
    private PostService $postService;

    public function __construct() {
        $this->postService = new PostService();
    }

    /**
     * Créer un post
     */
    public function create(): array {
        if (!$this->isAuthenticated()) {
            return $this->error('Non authentifié');
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return $this->error('Méthode non autorisée');
        }

        $content = trim($_POST['content'] ?? '');
        $mediaFile = $_FILES['media'] ?? null;

        if (empty($content)) {
            return $this->error('Le contenu ne peut pas être vide');
        }

        $userId = $_SESSION['user_id'];

        return $this->postService->createPost($userId, $content, $mediaFile)
            ? $this->success('Post créé avec succès')
            : $this->error('Erreur lors de la création du post');
    }

    /**
     * Récupérer tous les posts
     */
    public function getAllPosts(): array {
        return $this->postService->getAllPosts();
    }

    /**
     * Récupérer un post par son ID
     */
    public function getPost(int $postId): ?array {
        return $this->postService->getPostById($postId);
    }

    /**
     * Supprimer un post
     */
    public function delete(int $postId): array {
        if (!$this->isAuthenticated()) {
            return $this->error('Non authentifié');
        }

        return $this->postService->deletePost($postId)
            ? $this->success('Post supprimé')
            : $this->error('Erreur lors de la suppression');
    }

    /**
     * Vérifier si l'utilisateur est authentifié
     */
    private function isAuthenticated(): bool {
        return isset($_SESSION['user_id']);
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
