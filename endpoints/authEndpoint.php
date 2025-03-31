<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

require_once '../config/database.php';
require_once '../models/utilisateur.php';
require_once '../controllers/authController.php';

// Instancier la connexion à la base de données
$db = new Database();
$conn = $db->getConnection();

// Instancier le contrôleur
$authController = new AuthController($conn);

// Récupérer la méthode HTTP
$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'POST') {
    // Récupérer les données JSON envoyées
    $data = json_decode(file_get_contents("php://input"), true);
    $email = $data['email'] ?? '';
    $mot_de_passe = $data['mot_de_passe'] ?? '';

    // Vérifier que les champs ne sont pas vides
    if (!empty($email) && !empty($mot_de_passe)) {
        $result = $authController->login($email, $mot_de_passe);
        echo json_encode($result);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Données manquantes (email ou mot de passe)"
        ]);
    }
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Méthode non autorisée (seule la méthode POST est acceptée)"
    ]);
}
?>