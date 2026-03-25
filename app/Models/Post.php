<?php
namespace App\Models;

/**
 * Modèle Post
 */
class Post {
    private $id;
    private $userId;
    private $content;
    private $media;
    private $createdAt;
    private $username;
    private $likeCount;
    private $comments = [];

    public function __construct($id = null, $userId = null, $content = null, $media = null, $createdAt = null, $comments = []) {
        $this->id = $id;
        $this->userId = $userId;
        $this->content = $content;
        $this->media = $media;
        $this->comments = $comments;
        $this->createdAt = $createdAt;
    }

    // Getters
    public function getId() { return $this->id; }
    public function getUserId() { return $this->userId; }
    public function getContent() { return $this->content; }
    public function getMedia() { return $this->media; }
    public function getCreatedAt() { return $this->createdAt; }
    public function getUsername() { return $this->username; }
    public function getLikeCount() { return $this->likeCount; }
    public function getComments() { return $this->comments; }

    // Setters
    public function setId($id) { $this->id = $id; }
    public function setUserId($userId) { $this->userId = $userId; }
    public function setContent($content) { $this->content = $content; }
    public function setMedia($media) { $this->media = $media; }
    public function setCreatedAt($createdAt) { $this->createdAt = $createdAt; }
    public function setUsername($username) { $this->username = $username; }
    public function setLikeCount($likeCount) { $this->likeCount = $likeCount; }
    public function setComments($comments) { $this->comments = $comments; }

    /**
     * Convertir en tableau associatif
     */
    public function toArray() {
        return [
            'post_id' => $this->id,
            'user_id' => $this->userId,
            'content' => $this->content,
            'media' => $this->media,
            'created_at' => $this->createdAt,
            'username' => $this->username,
            'like_count' => $this->likeCount,
            'comments' => $this->comments
        ];
    }
}
?>
