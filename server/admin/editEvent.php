<?php
require_once '../../db/connection.php';
require_once 'event_modified_notifier.php';

class EditEvent
{
    private $conn;
    private $eventNotifier;

    public function __construct()
    {
        $this->conn = getConnection();
        $this->eventNotifier = new EventNotifier();
    }

    public function editEvent($id, $attendees, $nome_evento, $data_evento)
    {
        $stmt = $this->conn->prepare("UPDATE eventi SET attendees = ?, nome_evento = ?, data_evento = ? WHERE id = ?");
        $stmt->bindParam(1, $attendees);
        $stmt->bindParam(2, $nome_evento);
        $stmt->bindParam(3, $data_evento);
        $stmt->bindParam(4, $id);
        $stmt->execute();
        $stmt->closeCursor();

        $this->eventNotifier->notifyUsers($nome_evento, $data_evento);
    }
}

$EditEvent = new EditEvent();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Update event
    parse_str(file_get_contents("php://input"), $putParams);
    $id = $putParams['id'];
    $attendees = $putParams['attendees'];
    $nome_evento = $putParams['nome_evento'];
    $data_evento = $putParams['data_evento'];

    $EditEvent->editEvent($id, $attendees, $nome_evento, $data_evento);
    header("Location: ../../client/admin/pages/index.php");

    exit();
}
