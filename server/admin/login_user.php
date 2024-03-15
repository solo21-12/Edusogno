<?php

require_once '../../db/connection.php';

class UserLogin
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function loginUser($email, $password)
    {
        $query = "SELECT id, nome, cognome FROM amministratrice WHERE email = :email AND password = :password";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        $user = $stmt->fetch();

        if ($user !== false) {
            session_start();
            $_SESSION['admin_id'] = $user['id'];
            $_SESSION['admin_nome'] = $user['nome'];
            $_SESSION['admin_cognome'] = $user['cognome'];
            header("Location: ../../client/admin/pages/index.php");
            exit();
        } else {
            header("Location: ../../client/admin/pages/login.php?error=Please provide correct credentials.");
            exit();
        }
    }
}

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $pdo = getConnection();

    $userLogin = new UserLogin($pdo);
    $userLogin->loginUser($email, $password);
} else {
    header("Location: ../../client/admin/pages/login.php");
    exit();
}
