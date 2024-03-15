<?php

set_include_path(get_include_path() . PATH_SEPARATOR . __DIR__ . '/../../vendor');
require '../../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['email'])) {
    $receiver_email = $_POST['email'];

    $reset_link = "http://localhost:3000/client/user/pages/set_password.php?email=$receiver_email";

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'dawitabrham0021@gmail.com';
        $mail->Password = 'oqpeusbspssjxpqa';
        $mail->Port = 587;

        $mail->setFrom('dawitabrham0021@gmail.com', 'Dawit Abrham');

        $mail->addAddress($receiver_email);

        $mail->isHTML(true);
        $mail->Subject = 'Password Reset Link';
        $mail->Body = "Dear user,<br><br>
                       Please click the following link to reset your password:<br>
                       <a href='$reset_link'>$reset_link</a><br><br>
                       Regards,<br>
                       Dawit Abrham";

        $mail->send();
        header("Location: ../../client/common/pages/check_email.php");
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo "Email address not provided.";
}
