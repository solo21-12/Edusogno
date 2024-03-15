<?php

require_once '../../db/connection.php';

class PasswordSetterServer
{
    private $db;

    public function __construct()
    {
        $this->db = getConnection();
    }

    public function setPassword($email, $password)
    {
        $query = "SELECT * FROM utenti WHERE email = :email";
        $statement = $this->db->prepare($query);
        $statement->bindValue(':email', $email);
        $statement->execute();

        $result = $statement->fetch();

        if ($result) {
            $query = "UPDATE utenti SET password = :password WHERE email = :email";
            $statement = $this->db->prepare($query);
            $statement->bindValue(':password', $password);
            $statement->bindValue(':email', $email);
            $statement->execute();

            return true;
        }

        return false;
    }
}

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
