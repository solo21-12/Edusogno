<?php
require_once '../../db/connection.php';

class UserRegistration {
    private $conn;

    public function __construct() {
        $this->conn = getConnection();
    }

    public function registerUser($nome, $cognome, $email, $password) {
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM amministratrice WHERE email = ?");
        $stmt->bindParam(1, $email);
        $stmt->execute();
        $count = $stmt->fetchColumn();

        if ($count > 0) {
            header("Location: ../../client/user/pages/sign_up.php?error=User with this email already exists.");
            exit();
        }

        $stmt = $this->conn->prepare("INSERT INTO amministratrice (nome, cognome, email, password) VALUES (?, ?, ?, ?)");
        $stmt->bindParam(1, $nome);
        $stmt->bindParam(2, $cognome);
        $stmt->bindParam(3, $email);
        $stmt->bindParam(4, $password);
        $stmt->execute();
        $stmt->closeCursor();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $cognome = $_POST['cognome'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $userRegistration = new UserRegistration();
    $userRegistration->registerUser($nome, $cognome, $email, $password);

    header("Location: ../../client/admin/pages/login.php");
    exit();
}
