<?php
require_once '../../db/connection.php';
require_once 'delete_event_notifer.php';

class DeleteEvent
{
    private $conn;
    private $eventNotifier;

    public function __construct()
    {
        $this->conn = getConnection();
        $this->eventNotifier = new EventNotifier();
    }
    public function deleteEvent($id)
    {
        $stmt = $this->conn->prepare("SELECT nome_evento, data_evento FROM eventi WHERE id = ?");
        $stmt->bindParam(1, $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();

        $nome_evento = $result['nome_evento'];
        $data_evento = $result['data_evento'];

        $stmt = $this->conn->prepare("DELETE FROM eventi WHERE id = ?");
        $stmt->bindParam(1, $id);
        $stmt->execute();
        $stmt->closeCursor();

        $this->eventNotifier->notifyUsers($nome_evento, $data_evento);
    }
}

$DeleteEvent = new DeleteEvent();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = $_GET['id'];

    $DeleteEvent->deleteEvent($id);
    header("Location: ../..//client/admin/pages/index.php");
    exit();
}
