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
        // Prepare and execute the query to check if the email and password are correct
        $query = "SELECT * FROM amministratrice WHERE email = :email AND password = :password";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        $user = $stmt->fetch();

        // Check if a matching user is found
        if ($user !== false) {
            // Set a cookie that expires in 1 hour
            setcookie('admin', $user['id'], time() + 3600, '/');

            // Redirect to index.php if the email and password are correct
            header("Location: ../../client/admin/pages/index.php");
            exit();
        } else {
            // Redirect back to the login page with an error message in the URL
            header("Location: ../../client/admin/pages/login.php?error=Please provide a correct credentials.");
            exit();
        }
    }
}

// Check if email and password are provided
if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Create a PDO connection to the SQLite database
    $pdo = getConnection();

    // Create an instance of UserLogin and call the loginUser method
    $userLogin = new UserLogin($pdo);
    $userLogin->loginUser($email, $password);
} else {
    // Redirect back to the login page if email and password are not provided
    header("Location: ../../client/admin/pages/login.php");
    exit();
}
