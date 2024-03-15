<?php
// Include the database connection file
require_once '../../db/connection.php';

// Check if it's a GET request
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Get the user_id from the request
    $user_id = isset($_GET['user_id']) ? $_GET['user_id'] : null;

    if ($user_id !== null) {
        try {
            // Establish a connection to the SQLite database
            $pdo = getConnection();

            // Prepare the SQL query to get the list of event_ids for the user
            $userEventsQuery = "SELECT event_id FROM user_events WHERE user_id = :user_id";

            // Prepare the statement to get user events
            $stmtUserEvents = $pdo->prepare($userEventsQuery);
            $stmtUserEvents->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmtUserEvents->execute();
            $userEventIds = $stmtUserEvents->fetchAll(PDO::FETCH_COLUMN);

            // Prepare the SQL query to get all events
            $allEventsQuery = "SELECT * FROM eventi";
            $stmtAllEvents = $pdo->query($allEventsQuery);
            $allEvents = $stmtAllEvents->fetchAll(PDO::FETCH_ASSOC);

            // Separate user events and new events
            $userEvents = [];
            $newEvents = [];

            foreach ($allEvents as $event) {
                if (in_array($event['id'], $userEventIds)) {
                    $userEvents[] = $event;
                } else {
                    $newEvents[] = $event;
                }
            }

            // Return the event details as JSON
            echo json_encode(['user_events' => $userEvents, 'new_events' => $newEvents]);
        } catch (PDOException $e) {
            // Handle database errors
            echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
        }
    } else {
        echo json_encode(['error' => 'User ID not provided']);
    }
} else {
    // Handle invalid request method
    echo json_encode(['error' => 'Invalid request method']);
}
?>
