<?php

// extended class method
use Example\Util\Mailer;

//Load Composer's autoloader
require 'vendor/autoload.php';

function MailerTestAction()
{
    $config = require 'config.php';

    try {
        $mailer = new Mailer(true, $config);

        // $mailer->setFrom('no-reply@yoursite.com');
        // $mailer->addReplyTo('no-reply@yoursite.com');

        // Recipients
        $mailer->addAddress('example@example.com');
        // $mailer->addCC('cc@example.com');
        // $mailer->addBCC('bcc@example.com');

        $mailer->Subject = 'Mail Subject - ' . rand(1, 1000);

        $mailer->setTemplate('tpl/email/example.php');
        $mailer->template->firstName = 'Mustafa';
        $mailer->template->lastName = 'Akbaş';
        $mailer->template->loginUrl = 'http://stackoverflow.com/questions/3706855/send-email-with-a-template-using-php';

        //Content
        $mailer->isHTML(true); // optional
        $mailer->CharSet = 'UTF-8';  // optional
        $mailer->Body = $mailer->template->compile(); // or $mailer->msgHTML($mailer->template->compile());
        // $mailer->AltBody  = 'This is the body in plain text for non-HTML mail clients';

        //Attachments
        // $mailer->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        // $mailer->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        $mailerRes = $mailer->send();

        if ($mailerRes != '1') throw new \Exception($mailer->ErrorInfo);

        var_dump($mailerRes);
    } catch (\Exception $e) {
        var_dump("Message could not be sent. Mailer Error: {$e->getMessage()}");
    } finally {
        // var_dump($mailerRes);
    }
}

MailerTestAction();
