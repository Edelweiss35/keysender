<?php

namespace App\Services;

use PHPMailer\PHPMailer\PHPMailer;

class Mailer
{
    public $config;

    public function __construct($config)
    {
        $this->config = $config;
    }

    public function send($address, $receiverName, $subject, $body)
    {
        $mail = new PHPMailer(true);
        $mail->SMTPDebug = 2;
        $mail->isSMTP();
        $mail->Host = $this->config['host'];
        $mail->SMTPAuth = true;
        $mail->Username = $this->config['username'];
        $mail->Password = $this->config['password'];
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        //Recipients
        $mail->setFrom($this->config['from'], $this->config['sender_name']);
        $mail->addAddress($address, $receiverName);

        //Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body;

        $mail->send();
    }
}