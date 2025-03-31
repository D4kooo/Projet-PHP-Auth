<?php
class Utilisateur {
    private $conn;
    private $table_name = "utilisateurs";

    public $id;
    public $email;
    public $mot_de_passe;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function login($email, $mot_de_passe) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($mot_de_passe, $row['mot_de_passe'])) {
                $this->id = $row['id'];
                $this->email = $row['email'];
                return true;
            }
        }
        return false;
    }
}
?>