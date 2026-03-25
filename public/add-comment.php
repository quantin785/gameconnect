<?php
// Charger le bootstrap qui utilise l'autoloader PSR-4
require_once(__DIR__ . '/../bootstrap.php');

use App\Controllers\CommentController;

// Ajouter un commentaire
$controller = new CommentController();
$result = $controller->add();

if ($result['success']) {
    redirect('../html/index.php');
} else {
    echo $result['message'];
}
?>
