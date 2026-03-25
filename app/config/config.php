<?php
/**
 * Configuration de l'Application
 * À personnaliser selon votre environnement
 */

return [
    // Mode application
    'app_env' => getenv('APP_ENV') ?? 'development',
    'app_debug' => getenv('APP_DEBUG') ?? true,
    
    // Base de données
    'database' => [
        'driver' => 'mysql',
        'host' => getenv('DB_HOST') ?? 'localhost',
        'dbname' => getenv('DB_NAME') ?? 'game',
        'user' => getenv('DB_USER') ?? 'root',
        'password' => getenv('DB_PASSWORD') ?? '',
        'charset' => 'utf8mb4',
    ],
    
    // Uploads
    'uploads' => [
        'path' => getenv('UPLOADS_PATH') ?? __DIR__ . '/../uploads/',
        'max_size' => 5242880, // 5MB en bytes
        'allowed_extensions' => ['jpg', 'jpeg', 'png', 'gif', 'mp4', 'webm'],
    ],
    
    // Pagination
    'pagination' => [
        'per_page' => 10,
    ],
    
    // Sécurité
    'security' => [
        'password_hash_algo' => PASSWORD_BCRYPT,
        'session_timeout' => 3600, // 1 heure
    ],
    
    // URLs
    'app_url' => getenv('APP_URL') ?? 'http://localhost',
    
    // Logging
    'logging' => [
        'enabled' => true,
        'path' => __DIR__ . '/../logs/',
        'level' => 'info',
    ],
];
?>
