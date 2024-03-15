<?php
require_once '../../db/connection.php';

class DeleteEvent
{
    private $conn;

    public function __construct()
    {
        $this->conn = getConnection();
    }

    public function deleteEvent($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM eventi WHERE id = ?");
        $stmt->bindParam(1, $id);
        $stmt->execute();
        $stmt->closeCursor();
    }
}

$DeleteEvent = new DeleteEvent();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Delete event
    $id = $_GET['id']; // Retrieve the ID from the URL parameters for DELETE request

    $DeleteEvent->deleteEvent($id);
    header("Location: ../..//client/admin/pages/index.php"); // Change the route here
    exit();
}
