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
            $stmt = $this->db->prepare('INSERT INTO user_events (user_id, event_id) VALUES (:user_id, :event_id)');
            $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->bindValue(':event_id', $event_id, PDO::PARAM_INT);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                header("Location: ../../client/user/pages/index.php");
                return 'Registration successful';
            } else {
                return 'Registration failed';
            }
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }
}
if (isset($_POST['user_id']) && isset($_POST['event_id'])) {
    $handler = new PostRequestHandler();
    $registrationStatus = $handler->handleRequest($_POST['user_id'], $_POST['event_id']);
    exit();
} else {
}
?>
