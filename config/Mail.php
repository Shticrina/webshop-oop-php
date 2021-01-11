<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once "vendor/autoload.php";

class Mail {

	// PHPMailer connection details
	public $config;

	public function __construct() {
		$this->config = new PHPMailer();

		$this->config->isSMTP();
		$this->config->SMTPAuth = true;
		$this->config->SMTPSecure = 'ssl'; //tls
		$this->config->Host = 'smtp.gmail.com';
		$this->config->Port = '465';
		$this->config->isHTML(true);
		// $this->config->SMTPDebug = SMTP::DEBUG_SERVER;

		$this->config->Username = 'cristinadinca.cd@gmail.com';
		$this->config->Password = '************'; // have to change this

		//To address and name
		$this->config->AddAddress('cristinadinca.cd@gmail.com');
	}
}

?>