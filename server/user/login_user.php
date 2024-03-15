<?php

require_once '../../db/connection.php';

class UserHandler
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function loginUser($email, $password)
    {
        $query = "SELECT id, nome, cognome FROM utenti WHERE email = :email AND password = :password";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        $user = $stmt->fetch();

        if ($user !== false) {
            // Start session
            session_start();

            // Set session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['first_name'] = $user['nome'];
            $_SESSION['last_name'] = $user['cognome'];

            // Redirect to user's page
            header("Location: ../../client/user/pages/index.php");
            exit();
        } else {
            // Redirect with error message
            header("Location: ../../client/user/pages/login.php?error=Please provide correct credentials.");
            exit();
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $pdo = getConnection();
        $userLogin = new UserHandler($pdo);
        $userLogin->loginUser($email, $password);
    } else {
        header("Location: ../../client/user/pages/login.php");
        exit();
    }
} else {
    http_response_code(405);
    echo json_encode(array('error' => 'Method Not Allowed'));
}
