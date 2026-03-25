<?php
namespace App\DAO;

use App\Models\Post;
use App\Config\Database;
use PDO;

/**
 * DAO pour les Posts
 */
class PostDAO {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance();
    }

    /**
     * Ajouter un post
     */
    public function addPost(int $userId, string $content, ?string $mediaName): bool {
        $stmt = $this->pdo->prepare(
            "INSERT INTO posts (user_id, content, media, created_at) VALUES (?, ?, ?, NOW())"
        );
        return $stmt->execute([$userId, $content, $mediaName]);
    }

    /**
     * Récupérer tous les posts avec leurs commentaires et likes
     */
    public function getAllPostsWithComments(): array {
        $stmt = $this->pdo->prepare("
            SELECT 
                posts.id AS post_id, 
                posts.content, 
                posts.media, 
                posts.created_at AS post_created_at,
                post_author.id AS post_user_id, 
                post_author.username AS post_username,
                comments.id AS comment_id,
                comments.comment,
                comments.created_at AS comment_created_at,
                comment_author.id AS comment_user_id,
                comment_author.username AS comment_username,
                (SELECT COUNT(*) FROM post_likes WHERE post_likes.post_id = posts.id) AS like_count
            FROM posts
            INNER JOIN users AS post_author ON posts.user_id = post_author.id
            LEFT JOIN comments ON comments.post_id = posts.id
            LEFT JOIN users AS comment_author ON comments.user_id = comment_author.id
            ORDER BY posts.created_at DESC, comments.created_at ASC
        ");
        
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Récupérer un post par ID
     */
    public function getPostById(int $postId): ?array {
        $stmt = $this->pdo->prepare("
            SELECT 
                posts.id, 
                posts.user_id, 
                posts.content, 
                posts.media, 
                posts.created_at,
                users.username
            FROM posts
            INNER JOIN users ON posts.user_id = users.id
            WHERE posts.id = ?
        ");
        
        $stmt->execute([$postId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($result) {
            $post = new Post($result['id'], $result['user_id'], $result['content'], $result['media'], $result['created_at']);
            $post->setUsername($result['username']);
            return $post;
        }
        return null;
    }

    /**
     * Supprimer un post
     */
    public function deletePost(int $postId): bool {
        $stmt = $this->pdo->prepare("DELETE FROM posts WHERE id = ?");
        return $stmt->execute([$postId]);
    }

    /**
     * Compter les likes d'un post
     */
    public function getLikeCount(int $postId): int {
        $stmt = $this->pdo->prepare(
            "SELECT COUNT(*) FROM post_likes WHERE post_id = ?"
        );
        
        $stmt->execute([$postId]);
        return (int)$stmt->fetchColumn();
    }
}
?>
