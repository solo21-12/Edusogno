<?php

require_once '../../db/connection.php';

class PasswordSetterServer
{
    private $db;

    public function __construct()
    {
        $this->db = getConnection(); // Use the connection from connection.php
    }

    public function setPassword($email, $password)
    {
        // Check if the user exists in the database
        $query = "SELECT * FROM utenti WHERE email = :email";
        $statement = $this->db->prepare($query);
        $statement->bindValue(':email', $email);
        $statement->execute();

        $result = $statement->fetch(); // Fetch a single row

        if ($result) {
            // Update the password for the user
            $query = "UPDATE utenti SET password = :password WHERE email = :email";
            $statement = $this->db->prepare($query);
            $statement->bindValue(':password', $password);
            $statement->bindValue(':email', $email);
            $statement->execute();

            return true; // Password updated successfully
        }

        return false; // User not found
    }
}

// Usage example
$server = new PasswordSetterServer();
$email = $_POST['email'];
$password = $_POST['password'];

if ($server->setPassword($email, $password)) {
    header("Location: ../../client/user/pages/login.php");
    exit;
} else {
    header("Location: ../../client/user/pages/sign_up.php");
    exit;
}
