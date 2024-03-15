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
        // Prepare and execute the query to check if the email and password are correct
        $query = "SELECT * FROM utenti WHERE email = :email AND password = :password";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        $user = $stmt->fetch();

        // Check if a matching user is found
        if ($user !== false) {
            // Set a cookie that expires in 1 hour
            setcookie('user', $user['id'], time() + 3600, '/');

            // Redirect to index.php if the email and password are correct
            header("Location: ../../client/user/pages/index.php");
            exit();
        } else {
            // Redirect back to the login page with an error message in the URL
            header("Location: ../../client/user/pages/login.php?error=Please provide a correct credentials.");
            exit();
        }
    }
    public function getUserById($id)
    {
        // Prepare and execute the query to retrieve user details by ID
        $query = "SELECT first_name, last_name FROM utenti WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $user = $stmt->fetch();

        return $user;
    }
}

// Check if email and password are provided



// Check if email and password are provided
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    // Retrieve user ID from the GET request
    $id = $_GET['id'];

    // Create an instance of UserHandler
    $userHandler = new UserHandler($pdo);

    // Call getUserById method to retrieve user details
    $user = $userHandler->getUserById($id);

    // Check if user is found
    if ($user) {
        // User found, return JSON response with user details
        header('Content-Type: application/json');
        echo json_encode($user);
    } else {
        // User not found, return 404 error response
        http_response_code(404);
        echo json_encode(array('error' => 'User not found'));
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle POST request to retrieve user details

    // Check if ID is provided in the POST request
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Create a PDO connection to the SQLite database
        $pdo = getConnection();

        // Create an instance of UserLogin and call the loginUser method
        $userLogin = new UserHandler($pdo);
        $userLogin->loginUser($email, $password);
    } else {
        // Redirect back to the login page if email and password are not provided
        header("Location: ../../client/user/pages/login.php");
        exit();
    }
} else {
    // Invalid request method, return 405 error response
    http_response_code(405);
    echo json_encode(array('error' => 'Method Not Allowed'));
}
