<?php
// Include the database connection file
require_once '../../db/connection.php';

// Check if it's a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the event_id and user_id from the POST data
    $event_id = isset($_POST['event_id']) ? $_POST['event_id'] : null;
    $user_id = isset($_POST['user_id']) ? $_POST['user_id'] : null;

    if ($event_id !== null && $user_id !== null) {
        try {
            // Establish a connection to the SQLite database
            $pdo = getConnection();

            // Prepare the SQL query to remove the user from the event
            $query = "DELETE FROM user_events WHERE event_id = :event_id AND user_id = :user_id";

            // Prepare the statement
            $stmt = $pdo->prepare($query);

            // Bind the event_id and user_id parameters
            $stmt->bindParam(':event_id', $event_id);
            $stmt->bindParam(':user_id', $user_id);

            // Execute the query
            $stmt->execute();

            // Check if any rows were affected
            $rowsAffected = $stmt->rowCount();
            if ($rowsAffected > 0) {
                // Return success message
                echo json_encode(['message' => 'User removed from event successfully']);
            } else {
                // Return error message if no rows were affected
                echo json_encode(['error' => 'Failed to remove user from event']);
            }
        } catch (PDOException $e) {
            // Handle database errors
            echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
        }
    } else {
        echo json_encode(['error' => 'Event ID or User ID not provided']);
    }
} else {
    // Handle invalid request method
    echo json_encode(['error' => 'Invalid request method']);
}
?>
