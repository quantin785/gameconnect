<?php
// Charger le bootstrap qui utilise l'autoloader PSR-4
require_once(__DIR__ . '/../bootstrap.php');

use App\Controllers\PostController;

// Créer un post
$controller = new PostController();
$result = $controller->create();

if ($result['success']) {
    redirect('../html/index.php');
} else {
    echo $result['message'];
}
?>
