<?php
// -------------------------------------------------------------
//  FONCTION QUI RÉCUPÈRE L'IP DU VISITEUR
// -------------------------------------------------------------
function getUserIP() {
    // Cas où l'utilisateur est derrière un proxy
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    }

    // Cas où plusieurs IP sont présentes (proxy, load balancer...)
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        return explode(',', $_SERVER['HTTP_X_FORWARDED_FOR'])[0];
    }

    // Cas standard : IP directe
    return $_SERVER['REMOTE_ADDR'];
}

// -------------------------------------------------------------
//  RÉCUPÉRATION DES INFORMATIONS DU VISITEUR
// -------------------------------------------------------------
$ip        = getUserIP();
$time      = date("Y-m-d H:i:s");
$userAgent = $_SERVER['HTTP_USER_AGENT'];   // navigateur et OS
$page      = $_SERVER['REQUEST_URI'];        // page visitée

// -------------------------------------------------------------
//  ENREGISTREMENT DANS LE FICHIER DE LOG
// -------------------------------------------------------------
$logFile = __DIR__ . '/visites.log';


$entry = "[$time] IP: $ip | Page: $page | Agent: $userAgent\n";

// On ajoute la ligne en fin de fichier (mode APPEND)
file_put_contents($logFile, $entry, FILE_APPEND | LOCK_EX);

// -------------------------------------------------------------
//  MESSAGE D'AFFICHAGE POUR LE VISITEUR
// -------------------------------------------------------------
echo "<h1 style='color:red; font-family:Arial;'>
        T’AS RIEN COMPRIS À MON COURS ! 🤣
      </h1>";

echo "<p style='font-family:Arial; font-size:18px;'>
        Mais ne t'inquiète pas : grâce à ce site,
        tu apprends maintenant comment un serveur web peut :
      </p>";

echo "<ul style='font-family:Arial; font-size:16px;'>
        <li>récupérer ton adresse IP</li>
        <li>enregistrer automatiquement les visiteurs</li>
        <li>construire des journaux (logs) comme en cybersécurité</li>
        <li>analyser le navigateur et la page consultée</li>
      </ul>";

echo "<p style='font-family:Arial; font-size:16px;'>
        Voici ton adresse IP : <b>$ip</b>
      </p>";
?>
