<?php
namespace App\Services;

use App\DAO\CommentDAO;

/**
 * Service pour la gestion des commentaires
 */
class CommentService {
    private CommentDAO $commentDAO;

    public function __construct() {
        $this->commentDAO = new CommentDAO();
    }

    /**
     * Ajouter un commentaire
     */
    public function addComment(int $postId, int $userId, string $comment): bool {
        if (empty(trim($comment))) {
            return false;
        }

        return $this->commentDAO->addComment($postId, $userId, $comment);
    }

    /**
     * Récupérer les commentaires d'un post
     */
    public function getCommentsByPostId(int $postId): array {
        return $this->commentDAO->getCommentsByPostId($postId);
    }

    /**
     * Supprimer un commentaire
     */
    public function deleteComment(int $commentId): bool {
        return $this->commentDAO->deleteComment($commentId);
    }

    /**
     * Récupérer un commentaire par son ID
     */
    public function getCommentById(int $commentId): ?array {
        return $this->commentDAO->getCommentById($commentId);
    }
}
