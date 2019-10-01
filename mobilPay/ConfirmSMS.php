<?php


class ConfirmSMS
{
    private $allowIP = array();
    private $redirectURL = 'https://www.mobilpay.ro';
    private $error;
    private $operation;
    private $message;
    private $sender;
    private $destination;
    private $msgid;
    private $timestamp;

    public function __construct()
    {
        $this->message = $_GET['message'];
        $this->sender = $_GET['sender'];
        $this->destination = $_GET['destination'];
        $this->msgid = $_GET['msgid'];
        $this->timestamp = $_GET['timestamp'];
    }

    public function allow($ipArray){
        $this->allowIP = $ipArray;
    }

    public function redirectTo($url){
        $this->redirectURL = $url;
    }

    public function waitForRequest(){
        if(!empty($this->allowIP)) {
            if (!in_array($_SERVER['REMOTE_ADDR'], $this->allowIP) && !in_array($_SERVER["HTTP_X_FORWARDED_FOR"], $this->allowIP)) {
                header('Location: ' . $this->redirectURL);
                die();
            }
        }
    }

    public function setOperation($operation){
        switch ($operation){
            case 1:
                $this->operation = 'charge';
                break;
            case 0:
            default:
                $this->operation = 'free';
                break;
        }
    }

    public function setErrorCode($errorCode){
        $this->error  = $errorCode;
    }

    public function reply($message){
        // Pregatim header-ul pentru un mesaj XML.
        header('Content-Type: application/xml;');

        // Oferim mesajul in format XML
        echo '<?xml version="1.0" encoding="utf-8"?>';
        echo '<reply_message operation="' . $this->operation . '" reply="1" error_code="' . $this->error . '">';
        echo $message;
        echo '</reply_message>';
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return mixed
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * @return mixed
     */
    public function getDestination()
    {
        return $this->destination;
    }

    /**
     * @return mixed
     */
    public function getMsgID()
    {
        return $this->msgid;
    }

    /**
     * @return mixed
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }



}