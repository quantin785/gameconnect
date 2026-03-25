<?php
namespace App\Controllers;

use App\Services\CommentService;

/**
 * Contrôleur pour la gestion des commentaires
 */
class CommentController {
    private CommentService $commentService;

    public function __construct() {
        $this->commentService = new CommentService();
    }

    /**
     * Ajouter un commentaire
     */
    public function add(): array {
        if (!$this->isAuthenticated()) {
            return $this->error('Non authentifié');
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return $this->error('Méthode non autorisée');
        }

        $postId = (int)($_POST['post_id'] ?? 0);
        $comment = trim($_POST['comment'] ?? '');
        $userId = $_SESSION['user_id'];

        if ($postId <= 0 || empty($comment)) {
            return $this->error('Données invalides');
        }

        return $this->commentService->addComment($postId, $userId, $comment)
            ? $this->success('Commentaire ajouté')
            : $this->error('Erreur lors de l\'ajout du commentaire');
    }

    /**
     * Récupérer les commentaires d'un post
     */
    public function getByPostId(int $postId): array {
        return $this->commentService->getCommentsByPostId($postId);
    }

    /**
     * Supprimer un commentaire
     */
    public function delete(int $commentId): array {
        if (!$this->isAuthenticated()) {
            return $this->error('Non authentifié');
        }

        return $this->commentService->deleteComment($commentId)
            ? $this->success('Commentaire supprimé')
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
