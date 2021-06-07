<?php

// native method
use Example\Util\MailerTemplate;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception as PMAException;

//Load Composer's autoloader
require 'vendor/autoload.php';

function PHPMailerTestAction()
{
    $mailer = new PHPMailer(true); // Passing `true` enables exceptions

    try {
        //Server settings
        $mailer->isSMTP();                                            //Send using SMTP
        $mailer->SMTPDebug  = SMTP::DEBUG_SERVER;                     //Enable verbose debug output
        $mailer->Host       = '<your.smtp.server.url>';               //Set the SMTP server to send through
        $mailer->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mailer->Username   = 'no-reply@yoursite.com';                //SMTP username
        $mailer->Password   = '<your.smtp.password>';                 //SMTP password
        $mailer->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mailer->Port       = 465;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        $mailer->setFrom('no-reply@yoursite.com', 'www.yoursite.com');
        $mailer->addReplyTo('no-reply@yoursite.com', 'www.yoursite.com');

        // Recipients
        $mailer->addAddress('example@example.com'); //Add a recipient
        // $mailer->addCC('cc@example.com');
        // $mailer->addBCC('bcc@example.com');

        $template = new MailerTemplate('tpl/email/example.php');
        $template->firstName = 'Mustafa';
        $template->lastName = 'Akbaş';
        $template->loginUrl = 'http://stackoverflow.com/questions/3706855/send-email-with-a-template-using-php';

        //Content
        $mailer->isHTML(true); //Set email format to HTML
        $mailer->CharSet = 'UTF-8';
        $mailer->Subject  = 'Mail Subject - ' . rand(1, 1000);
        $mailer->Body = $template->compile(); // or $mailer->msgHTML($template->compile());
        // $mailer->AltBody  = 'This is the body in plain text for non-HTML mail clients';

        //Attachments
        // $mailer->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        // $mailer->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        $mailerRes = $mailer->send();

        if ($mailerRes != '1') throw new PMAException($mailer->ErrorInfo);

        var_dump($mailerRes);
    } catch (PMAException $e) {
        var_dump("Message could not be sent. Mailer Error: {$e->getMessage()}");
    } finally {
        // var_dump($mailerRes);
    }
}

PHPMailerTestAction();
