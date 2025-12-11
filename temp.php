<?php
function getUserIP() {
    // Si le visiteur est derrière un proxy ou un load balancer
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    }

    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        // Peut contenir plusieurs IP, on prend la première
        return explode(',', $_SERVER['HTTP_X_FORWARDED_FOR'])[0];
    }

    // Adresse IP directe
    return $_SERVER['REMOTE_ADDR'];
}

$ip = getUserIP();
echo "Votre adresse IP est : " . htmlspecialchars($ip);

?>