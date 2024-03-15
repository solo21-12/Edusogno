<?php
require_once '../../db/connection.php';

class AddEvent
{
    private $conn;

    public function __construct()
    {
        $this->conn = getConnection();
    }

    public function addEvent($attendees, $nome_evento, $data_evento)
    {
        $stmt = $this->conn->prepare("INSERT INTO eventi (attendees, nome_evento, data_evento) VALUES (?, ?, ?)");
        $stmt->bindParam(1, $attendees);
        $stmt->bindParam(2, $nome_evento);
        $stmt->bindParam(3, $data_evento);
        $stmt->execute();
        $stmt->closeCursor();
    }
}

$AddEvent = new AddEvent();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Add new event
    $attendees = $_POST['attendees'];
    $nome_evento = $_POST['nome_evento'];
    $data_evento = $_POST['data_evento'];

    $AddEvent->addEvent($attendees, $nome_evento, $data_evento);
    header("Location: ../../client/admin/pages/index.php");
    exit();
}
?>
