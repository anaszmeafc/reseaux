<?php
function getUserIP() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    }

    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        return explode(',', $_SERVER['HTTP_X_FORWARDED_FOR'])[0];
    }

    return $_SERVER['REMOTE_ADDR'];
}

$ip = getUserIP();
$time = date("Y-m-d H:i:s");

// Fichier de log (créé automatiquement si absent)
$logFile = __DIR__ . '/visites.log';

// Ligne à écrire
$entry = "$time - IP: $ip\n";

// Ajouter dans le fichier
file_put_contents($logFile, $entry, FILE_APPEND | LOCK_EX);

echo "Votre IP est : " . htmlspecialchars($ip);
?>
