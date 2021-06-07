<?php

namespace Example\Util;

use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception as PMAException;

// use Example\Util\MailerTemplate;

/**
 * Use PHPMailer as a base class and extend it.
 */
class Mailer extends PHPMailer
{
    public $template;

    public function __construct($exceptions = null, $config = null)
    {
        parent::__construct($exceptions);

        // another method get your application config
        // $config = Application::getConfig("email");

        //Server settings
        if (isset($config) && $config['protocol'] === 'smtp') {
            $this->isSMTP();
            $this->Port       = $config['port'];
            $this->Host       = $config['host'];
            $this->Username   = $config['user'];
            $this->Password   = $config['pass'];
            $this->SMTPAuth   = $config['auth'];
            $this->SMTPSecure = $config['secure'];
            $this->SMTPDebug  = $config['debug'];

            if (isset($config['from'])) {
                $this->setFrom($config['from'], $config['fromName']);
            }

            $this->setLanguage($config['lang']);
        } else {
            $this->isMail();
        }
    }

    public function setTemplate($tplFile)
    {
        $this->template = new MailerTemplate($tplFile);
    }

    /**
     * Overrides parent send()
     *
     * @return boolean
     */
    public function send()
    {
        $return = FALSE;

        try {
            $return = parent::send();
        } catch (PMAException $ex) {
            $return = $this->ErrorInfo;
        } finally {
            return $return;
        }
    }
}
