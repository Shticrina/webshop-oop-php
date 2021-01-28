<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once "vendor/autoload.php";

class Mail {

	// PHPMailer connection details
	public $config;

	public function __construct($host, $port, $username, $password) {
		$this->config = new PHPMailer();

		$this->config->isSMTP();
		$this->config->SMTPAuth = true;
		$this->config->SMTPSecure = 'ssl'; //tls
		$this->config->isHTML(true);

		$this->config->Host = $host;
		$this->config->Port = $port;
		$this->config->Username = $username;
		$this->config->Password = $password; // have to change this

		//To address and name
		$this->config->AddAddress($username);
		// $this->config->SMTPDebug = SMTP::DEBUG_SERVER;
	}
}

?>