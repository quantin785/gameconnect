<?php
/**
 * Autoloader PSR-4 complet pour l'application
 * Gère automatiquement le chargement de toutes les classes
 */

spl_autoload_register(function ($class) {
    // Préfixes de namespaces et leurs répertoires
    $namespaces = [
        'App\\' => __DIR__ . '/',
        '' => __DIR__ . '/' // Pour les classes sans namespace
    ];

    foreach ($namespaces as $prefix => $base_dir) {
        // Vérifier si la classe utilise le namespace de base
        $len = strlen($prefix);
        if (strncmp($prefix, $class, $len) !== 0) {
            continue;
        }

        // Obtenir le nom de la classe sans le namespace de base
        $relative_class = substr($class, $len);
        
        // Remplacer les séparateurs de namespace par des séparateurs de répertoire
        $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

        // Si le fichier existe, l'inclure
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

// Enregistrement de l'autoloader
spl_autoload_register(function ($class) {
    // Pour les classes dans des sous-répertoires spécifiques
    $directories = [
        'Controllers' => __DIR__ . '/Controllers/',
        'Models' => __DIR__ . '/Models/',
        'Services' => __DIR__ . '/Services/',
        'DAO' => __DIR__ . '/DAO/',
        'Config' => __DIR__ . '/config/',
        'Utils' => __DIR__ . '/utils/'
    ];

    foreach ($directories as $dir_name => $dir_path) {
        $file = $dir_path . $class . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});
?>
