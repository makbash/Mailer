<?php

return array(
    'lang'     => 'tr', // Enable verbose debug output
    'debug'    => FALSE, // Enable verbose debug output
    'protocol' => 'smtp', // Set mailer to use SMTP or MAIL
    'auth'     => TRUE, // Enable SMTP authentication
    'host'     => '<your.smtp.server.url>', // Specify main and backup SMTP servers
    'user'     => 'no-reply@yoursite.com', // SMTP username
    'pass'     => '<your.smtp.password>', // SMTP password
    'port'     => 465, // TCP port to connect to
    'secure'   => 'ssl', // Enable TLS encryption, `ssl` also accepted
    'html'     => TRUE,
    'from'     => 'no-reply@yoursite.com',
    'fromName' => 'www.yoursite.com',
);
