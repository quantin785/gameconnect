<?php
namespace App\DAO;

use App\Models\Comment;
use App\Config\Database;
use PDO;

/**
 * DAO pour les Commentaires
 */
class CommentDAO {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance();
    }

    /**
     * Ajouter un commentaire
     */
    public function addComment($postId, $userId, $comment) {
        $stmt = $this->pdo->prepare("INSERT INTO comments (post_id, user_id, comment, created_at) VALUES (?, ?, ?, NOW())");
        return $stmt->execute([$postId, $userId, $comment]);
    }

    /**
     * Récupérer les commentaires d'un post
     */
    public function getCommentsByPostId($postId) {
        $stmt = $this->pdo->prepare("
            SELECT 
                comments.id,
                comments.post_id,
                comments.user_id,
                comments.comment,
                comments.created_at,
                users.username
            FROM comments
            INNER JOIN users ON comments.user_id = users.id
            WHERE comments.post_id = ?
            ORDER BY comments.created_at ASC
        ");
        
        $stmt->execute([$postId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Supprimer un commentaire
     */
    public function deleteComment($commentId) {
        $stmt = $this->pdo->prepare("DELETE FROM post_comments WHERE id = ?");
        return $stmt->execute([$commentId]);
    }

    /**
     * Récupérer un commentaire par ID
     */
    public function getCommentById($commentId) {
        $stmt = $this->pdo->prepare("
            SELECT 
                comments.id,
                comments.post_id,
                comments.user_id,
                comments.comment,
                comments.created_at,
                users.username
            FROM comments
            INNER JOIN users ON comments.user_id = users.id
            WHERE comments.id = ?
        ");
        
        $stmt->execute([$commentId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($result) {
            $comment = new Comment($result['id'], $result['post_id'], $result['user_id'], $result['comment'], $result['created_at']);
            $comment->setUsername($result['username']);
            return $comment;
        }
        return null;
    }
}
?>
