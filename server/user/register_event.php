<?php

require_once '../../db/connection.php';

class PostRequestHandler
{
    private $db;

    public function __construct()
    {
        $this->db = getConnection();
    }

    public function handleRequest($user_id, $event_id)
    {
        try {
            // Validate user_id and event_id

            // Insert data into user_events table
            $stmt = $this->db->prepare('INSERT INTO user_events (user_id, event_id) VALUES (:user_id, :event_id)');
            $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->bindValue(':event_id', $event_id, PDO::PARAM_INT);
            $stmt->execute();

            // Check if the insertion was successful
            if ($stmt->rowCount() > 0) {
                header("Location: ../../client/user/pages/index.php");
                return 'Registration successful';
            } else {
                // Registration failed, send error message
                return 'Registration failed';
            }
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }
}

// Check if user_id and event_id are provided in the POST request
if (isset($_POST['user_id']) && isset($_POST['event_id'])) {
    // Usage example
    $handler = new PostRequestHandler();
    $registrationStatus = $handler->handleRequest($_POST['user_id'], $_POST['event_id']);
    
    // Output registration status
    // echo $registrationStatus;
    exit(); // Stop execution here to prevent further processing
} else {
    // echo 'Error: user_id and event_id are required.';
}
?>
