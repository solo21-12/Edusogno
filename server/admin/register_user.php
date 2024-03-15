<?php
require_once '../../db/connection.php';

class UserRegistration {
    private $conn;

    public function __construct() {
        $this->conn = getConnection();
    }

    public function registerUser($nome, $cognome, $email, $password) {
        // Check if the email already exists
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM amministratrice WHERE email = ?");
        $stmt->bindParam(1, $email);
        $stmt->execute();
        $count = $stmt->fetchColumn();

        if ($count > 0) {
            // Email already exists, redirect back to sign_up.php with error message
            header("Location: ../../client/user/pages/sign_up.php?error=User with this email already exists.");
            exit();
        }

        // Prepare the SQL statement
        $stmt = $this->conn->prepare("INSERT INTO amministratrice (nome, cognome, email, password) VALUES (?, ?, ?, ?)");

        // Bind the parameters
        $stmt->bindParam(1, $nome);
        $stmt->bindParam(2, $cognome);
        $stmt->bindParam(3, $email);
        $stmt->bindParam(4, $password);

        // Execute the statement
        $stmt->execute();

        // Close the statement
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
