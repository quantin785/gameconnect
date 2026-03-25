<?php
/**
 * Index Bootstrap - Point d'entrée centralisé pour l'application
 * À utiliser en lieu et place d'appels directs
 */

define('ROOT_PATH', __DIR__);
define('APP_PATH', ROOT_PATH . '/app');
define('PUBLIC_PATH', ROOT_PATH . '/public');
define('VIEWS_PATH', ROOT_PATH . '/views');
define('UPLOADS_PATH', ROOT_PATH . '/uploads');

// Charger l'autoloader PSR-4
require_once APP_PATH . '/autoload.php';

// Charger la configuration (nécessite un require manuel pour l'instant)
require_once APP_PATH . '/config/Database.php';

// Charger les utilitaires
require_once APP_PATH . '/utils/helpers.php';

// Démarrer la session si non déjà fait
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
