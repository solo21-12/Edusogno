<?php
require_once '../../db/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $event_id = isset($_POST['event_id']) ? $_POST['event_id'] : null;
    $user_id = isset($_POST['user_id']) ? $_POST['user_id'] : null;

    if ($event_id !== null && $user_id !== null) {
        try {
            $pdo = getConnection();
            $query = "DELETE FROM user_events WHERE event_id = :event_id AND user_id = :user_id";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':event_id', $event_id);
            $stmt->bindParam(':user_id', $user_id);
            $stmt->execute();
            $rowsAffected = $stmt->rowCount();
            if ($rowsAffected > 0) {
                echo json_encode(['message' => 'User removed from event successfully']);
            } else {
                echo json_encode(['error' => 'Failed to remove user from event']);
            }
        } catch (PDOException $e) {
            echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
        }
    } else {
        echo json_encode(['error' => 'Event ID or User ID not provided']);
    }
} else {
    echo json_encode(['error' => 'Invalid request method']);
}
?>
