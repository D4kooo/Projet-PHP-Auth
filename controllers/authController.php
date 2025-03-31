<?php
class AuthController {
    private $utilisateur;

    public function __construct($db) {
        $this->utilisateur = new Utilisateur($db);
    }

    public function login($email, $mot_de_passe) {
        if ($this->utilisateur->login($email, $mot_de_passe)) {
            // Générer un jeton simple (base64 de l'ID utilisateur et timestamp)
            $token = base64_encode($this->utilisateur->id . ":" . time());
            return [
                "status" => "success",
                "token" => $token,
                "message" => "Connexion réussie"
            ];
        }
        return [
            "status" => "error",
            "message" => "Identifiants incorrects"
        ];
    }
}
?>