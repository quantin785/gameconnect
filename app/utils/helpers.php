<?php
/**
 * Utilitaires généraux
 */

function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = [
        'y' => 'an',
        'm' => 'mois',
        'w' => 'sem',
        'd' => 'j',
        'h' => 'h',
        'i' => 'min',
        's' => 's',
    ];
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v;
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) : 'Maintenant';
}

/**
 * Sécuriser l'affichage HTML
 */
function secure($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

/**
 * Valider une email
 */
function isValidEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

/**
 * Redirection sécurisée
 */
function redirect($location) {
    if (headers_sent()) {
        echo "<script>window.location.href='" . htmlspecialchars($location) . "';</script>";
    } else {
        header("Location: " . $location);
    }
    exit();
}
?>
