<?php
require_once '../../db/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $user_id = isset($_GET['user_id']) ? $_GET['user_id'] : null;

    if ($user_id !== null) {
        try {
            $pdo = getConnection();

            $userEventsQuery = "SELECT event_id FROM user_events WHERE user_id = :user_id";

            $stmtUserEvents = $pdo->prepare($userEventsQuery);
            $stmtUserEvents->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmtUserEvents->execute();
            $userEventIds = $stmtUserEvents->fetchAll(PDO::FETCH_COLUMN);

            $allEventsQuery = "SELECT * FROM eventi";
            $stmtAllEvents = $pdo->query($allEventsQuery);
            $allEvents = $stmtAllEvents->fetchAll(PDO::FETCH_ASSOC);

            $userEvents = [];
            $newEvents = [];

            foreach ($allEvents as $event) {
                if (in_array($event['id'], $userEventIds)) {
                    $userEvents[] = $event;
                } else {
                    $newEvents[] = $event;
                }
            }

            echo json_encode(['user_events' => $userEvents, 'new_events' => $newEvents]);
        } catch (PDOException $e) {
            echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
        }
    } else {
        echo json_encode(['error' => 'User ID not provided']);
    }
} else {
    echo json_encode(['error' => 'Invalid request method']);
}
?>
