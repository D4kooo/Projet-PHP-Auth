<?php
header("Content-Type: application/json");
echo json_encode([
    "message" => "Bienvenue sur l'API d'authentification (Projet-PHP-Auth)",
    "endpoints" => [
        "POST /endpoints/authEndpoint.php" => "Connexion (email, mot_de_passe)"
    ]
]);
?>