<?php
namespace App\Models;

/**
 * Modèle User
 */
class User {
    private $id;
    private $username;
    private $email;
    private $password;
    private $createdAt;

    public function __construct($id = null, $username = null, $email = null, $password = null, $createdAt = null) {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->createdAt = $createdAt;
    }

    // Getters
    public function getId() { return $this->id; }
    public function getUsername() { return $this->username; }
    public function getEmail() { return $this->email; }
    public function getPassword() { return $this->password; }
    public function getCreatedAt() { return $this->createdAt; }

    // Setters
    public function setId($id) { $this->id = $id; }
    public function setUsername($username) { $this->username = $username; }
    public function setEmail($email) { $this->email = $email; }
    public function setPassword($password) { $this->password = $password; }
    public function setCreatedAt($createdAt) { $this->createdAt = $createdAt; }

    /**
     * Convertir en tableau associatif
     */
    public function toArray() {
        return [
            'id' => $this->id,
            'username' => $this->username,
            'email' => $this->email,
            'password' => $this->password,
            'created_at' => $this->createdAt
        ];
    }
}
?>
