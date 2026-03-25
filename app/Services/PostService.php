<?php
namespace App\Services;

use App\DAO\PostDAO;

/**
 * Service pour la gestion des posts
 */
class PostService {
    private PostDAO $postDAO;
    private const UPLOAD_DIR = __DIR__ . '/../../uploads/';
    private const ALLOWED_EXTENSIONS = ['jpg', 'jpeg', 'png', 'gif', 'mp4'];

    public function __construct() {
        $this->postDAO = new PostDAO();
    }

    /**
     * Créer un nouveau post
     */
    public function createPost(int $userId, string $content, ?array $mediaFile): bool {
        $mediaName = null;
        
        // Gérer l'upload seulement si un fichier est fourni
        if ($mediaFile && !empty($mediaFile['tmp_name'])) {
            $mediaName = $this->handleMediaUpload($mediaFile);
            
            // Si l'upload échoue, retourner false
            if ($mediaName === null) {
                return false;
            }
        }

        return $this->postDAO->addPost($userId, $content, $mediaName);
    }

    /**
     * Gérer l'upload de fichier média
     */
    private function handleMediaUpload(?array $mediaFile): ?string {
        if (!$mediaFile || empty($mediaFile['tmp_name'])) {
            return null;
        }

        $extension = strtolower(pathinfo($mediaFile['name'], PATHINFO_EXTENSION));
        
        if (!in_array($extension, self::ALLOWED_EXTENSIONS)) {
            return null;
        }

        $mediaName = uniqid() . "." . $extension;
        
        if (!is_dir(self::UPLOAD_DIR)) {
            mkdir(self::UPLOAD_DIR, 0755, true);
        }

        return move_uploaded_file($mediaFile['tmp_name'], self::UPLOAD_DIR . $mediaName) 
            ? $mediaName 
            : null;
    }

    /**
     * Récupérer tous les posts avec leurs commentaires
     */
    public function getAllPosts(): array {
        $posts = $this->postDAO->getAllPostsWithComments();
        return $this->formatPostsWithComments($posts);
    }

    /**
     * Formater les posts avec leurs commentaires
     */
    private function formatPostsWithComments(array $posts): array {
        $formattedPosts = [];

        foreach ($posts as $row) {
            $postId = $row['post_id'];

            if (!isset($formattedPosts[$postId])) {
                $formattedPosts[$postId] = [
                    'post_id' => $row['post_id'],
                    'content' => $row['content'],
                    'media' => $row['media'],
                    'created_at' => $row['post_created_at'],
                    'username' => $row['post_username'],
                    'like_count' => $row['like_count'],
                    'comments' => []
                ];
            }

            if ($row['comment_id']) {
                $formattedPosts[$postId]['comments'][] = [
                    'comment_id' => $row['comment_id'],
                    'comment' => $row['comment'],
                    'username' => $row['comment_username'],
                    'created_at' => $row['comment_created_at']
                ];
            }
        }

        return $formattedPosts;
    }

    /**
     * Récupérer un post par son ID
     */
    public function getPostById(int $postId): ?array {
        return $this->postDAO->getPostById($postId);
    }

    /**
     * Supprimer un post
     */
    public function deletePost(int $postId): bool {
        return $this->postDAO->deletePost($postId);
    }

    /**
     * Compter les likes d'un post
     */
    public function getLikeCount(int $postId): int {
        return $this->postDAO->getLikeCount($postId);
    }
}
