<?php
require_once '../../db/connection.php';
require '../../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class EventNotifier
{
    private $conn;

    public function __construct()
    {
        $this->conn = getConnection();
    }

    public function notifyUsers($nome_evento, $data_evento)
    {
        $stmt = $this->conn->prepare("SELECT email FROM utenti");
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();

        foreach ($users as $user) {
            $this->sendEmail($user['email'], $nome_evento, $data_evento);
        }
    }

    private function sendEmail($email, $nome_evento, $data_evento)
    {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'dawitabrham0021@gmail.com';
            $mail->Password = 'oqpeusbspssjxpqa'; // Change this to your Gmail app password
            $mail->Port = 587;
            $mail->SMTPSecure = 'tls';

            $mail->setFrom('dawitabrham0021@gmail.com', 'Dawit Abrham');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Event Modification Notification';
            $mail->Body = "Dear user,<br><br>
                       An event has been modified:<br><br>
                       Event Name: $nome_evento<br>
                       Date: $data_evento<br><br>
                       Regards,<br>
                       Dawit Abrham";

            $mail->send();
        } catch (Exception $e) {
            echo $e;
        }
    }
}
