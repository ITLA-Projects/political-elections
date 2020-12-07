<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class EmailHandler
{

    public $mail;

    function __construct()
    {
        $this->mail = new PHPMailer(true);
    }

    function SendEmail($to, $subject, $body)
    {
        try {
            $this->mail->SMTPDebug = 2;
            $this->mail->isSMTP();
            $this->mail->Host = constant('EMAIL_HOST');
            $this->mail->SMTPAuth = true;
            $this->mail->Username = constant('EMAIL_USERNAME');
            $this->mail->Password = constant('EMAIL_PASSWORD');
            $this->mail->SMTPSecure = "tls";
            $this->mail->Port = constant("EMAIL_PORT");
            $this->mail->setFrom(constant('EMAIL_USERNAME'), constant('EMAIL_FROM'));

            //To

            $this->mail->addAddress($to);

            //content

            $this->mail->isHTML(true);
            $this->mail->Subject = $subject;
            $this->mail->Body = $body;

            $this->mail->send();
        } catch (Exception $e) {
            echo "This message didnt send because {$this->mail->ErrorInfo}";
            exit();

        }
    }
}
