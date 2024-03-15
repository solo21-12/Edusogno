<?php
require_once '../../db/connection.php';

class EventHandler
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

    public function deleteEvent($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM eventi WHERE id = ?");
        $stmt->bindParam(1, $id);
        $stmt->execute();
        $stmt->closeCursor();
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
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $attendees = $_POST['attendees'];
    $nome_evento = $_POST['nome_evento'];
    $data_evento = $_POST['data_evento'];

    $EventHandler = new EventHandler();
    $EventHandler->addEvent($attendees, $nome_evento, $data_evento);
    header("Location: ../../client/admin/pages/index.php");
    exit();
} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    parse_str(file_get_contents("php://input"), $deleteParams);
    $id = $deleteParams['id'];

    $EventHandler = new EventHandler();
    $EventHandler->deleteEvent($id);
    // You can add additional logic here, such as returning a response or redirecting to another page
    exit();
} elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    parse_str(file_get_contents("php://input"), $putParams);
    $id = $putParams['id'];
    $attendees = $putParams['attendees'];
    $nome_evento = $putParams['nome_evento'];
    $data_evento = $putParams['data_evento'];

    $EventHandler = new EventHandler();
    $EventHandler->editEvent($id, $attendees, $nome_evento, $data_evento);
    // You can add additional logic here, such as returning a response or redirecting to another page
    exit();
}
