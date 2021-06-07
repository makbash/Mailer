<?php

$config = array(
    'lang'     => 'tr', // Enable verbose debug output
    'debug'    => FALSE, // Enable verbose debug output
    'protocol' => 'smtp', // Set mailer to use SMTP or MAIL
    'auth'     => TRUE, // Enable SMTP authentication
    'host'     => 'smtp.yandex.com', // Specify main and backup SMTP servers
    'user'     => 'no-reply@yoursite.com', // SMTP username
    'pass'     => '12345678', // SMTP password
    'port'     => 465, // TCP port to connect to
    'secure'   => 'ssl', // Enable TLS encryption, `ssl` also accepted
    'html'     => TRUE,
    'from'     => 'no-reply@yoursite.com',
    'fromName' => 'www.yoursite.com',
);

return $config;
