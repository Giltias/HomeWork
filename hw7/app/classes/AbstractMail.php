<?php

namespace HW7\App\Classes;

use PHPMailer\PHPMailer\PHPMailer;

/**
 * Class AbstractMail
 * @package HW7\App\Classes
 */
abstract class AbstractMail
{
    /**
     * @var PHPMailer
     */
    private $mail;
    /**
     * @var mixed
     */
    private $user;
    /**
     * @var mixed
     */
    private $password;

    /**
     * AbstractMail constructor.
     */
    public function __construct()
    {
        $this->user = DBConfig::getItem('mailUser');
        $this->password = DBConfig::getItem('mailPass');

        $this->mail = new PHPMailer();
        $this->mail->isSMTP();
        $this->mail->SMTPDebug = 0;
        $this->mail->Host = 'smtp.gmail.com';
        $this->mail->Port = 465;
        $this->mail->SMTPSecure = 'ssl';
        $this->mail->SMTPAuth = true;
        $this->mail->Username = $this->user;
        $this->mail->Password = $this->password;
        $this->mail->CharSet  = 'UTF-8';
    }

    /**
     * @param array $data
     * @return mixed
     */
    abstract function setParams($data = []);

    /**
     *
     */
    public function sendMessage()
    {
        if (!$this->mail->send()) {
            echo "Mailer Error: " . $this->mail->ErrorInfo;
        } else {
            echo "Message sent!";
        }
    }

    /**
     * @param $aliasName
     */
    protected function setFrom($aliasName)
    {
        $this->mail->setFrom($this->user, $aliasName);
    }

    /**
     * @param $subject
     */
    protected function setSubject($subject)
    {
        $this->mail->Subject = $subject;
    }

    /**
     * @param $filename
     * @param array $data
     */
    protected function setHtmlFromFile($filename, $data = [])
    {
        $view = new View();
        $this->mail->msgHTML($view->render($filename, $data), __DIR__);
    }

    /**
     * @param $text
     */
    protected function setAltBody($text)
    {
        $this->mail->AltBody = $text;
    }

    /**
     * @param array $addresses
     */
    protected function addAddresses($addresses = [])
    {
        foreach ($addresses as $address) {
            $this->mail->addAddress($address['email'], $address['name']);
        }
    }

}