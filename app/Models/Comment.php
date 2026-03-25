<?php
namespace App\Models;

/**
 * Modèle Comment
 */
class Comment {
    private $id;
    private $postId;
    private $userId;
    private $comment;
    private $createdAt;
    private $username;

    public function __construct($id = null, $postId = null, $userId = null, $comment = null, $createdAt = null) {
        $this->id = $id;
        $this->postId = $postId;
        $this->userId = $userId;
        $this->comment = $comment;
        $this->createdAt = $createdAt;
    }

    // Getters
    public function getId() { return $this->id; }
    public function getPostId() { return $this->postId; }
    public function getUserId() { return $this->userId; }
    public function getComment() { return $this->comment; }
    public function getCreatedAt() { return $this->createdAt; }
    public function getUsername() { return $this->username; }

    // Setters
    public function setId($id) { $this->id = $id; }
    public function setPostId($postId) { $this->postId = $postId; }
    public function setUserId($userId) { $this->userId = $userId; }
    public function setComment($comment) { $this->comment = $comment; }
    public function setCreatedAt($createdAt) { $this->createdAt = $createdAt; }
    public function setUsername($username) { $this->username = $username; }

    /**
     * Convertir en tableau associatif
     */
    public function toArray() {
        return [
            'comment_id' => $this->id,
            'post_id' => $this->postId,
            'user_id' => $this->userId,
            'comment' => $this->comment,
            'created_at' => $this->createdAt,
            'username' => $this->username
        ];
    }
}
?>
