<?php
/**
 * Script de test pour l'autoloader PSR-4
 */

require_once __DIR__ . '/bootstrap.php';

echo "🧪 Test de l'autoloader PSR-4\n\n";

try {
    // Test des Models
    echo "✅ Test des Models:\n";
    $post = new \App\Models\Post();
    echo "   - Post: OK\n";
    
    $comment = new \App\Models\Comment();
    echo "   - Comment: OK\n";
    
    $user = new \App\Models\User();
    echo "   - User: OK\n";
    
    // Test des DAOs
    echo "\n✅ Test des DAOs:\n";
    $postDAO = new \App\DAO\PostDAO();
    echo "   - PostDAO: OK\n";
    
    $commentDAO = new \App\DAO\CommentDAO();
    echo "   - CommentDAO: OK\n";
    
    // Test des Services
    echo "\n✅ Test des Services:\n";
    $postService = new \App\Services\PostService();
    echo "   - PostService: OK\n";
    
    $commentService = new \App\Services\CommentService();
    echo "   - CommentService: OK\n";
    
    // Test des Controllers
    echo "\n✅ Test des Controllers:\n";
    $postController = new \App\Controllers\PostController();
    echo "   - PostController: OK\n";
    
    $commentController = new \App\Controllers\CommentController();
    echo "   - CommentController: OK\n";
    
    echo "\n🎉 Tous les tests réussis ! L'autoloader fonctionne parfaitement.\n";
    
} catch (Exception $e) {
    echo "❌ Erreur: " . $e->getMessage() . "\n";
    echo "   Fichier: " . $e->getFile() . "\n";
    echo "   Ligne: " . $e->getLine() . "\n";
}
?>
