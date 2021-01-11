<?php

include('config/Database.php');
include('config/Mail.php');

class Controller {

	protected function model($model) {
		$database = new Database();
		$conn = $database->getConnection();

		if (file_exists('models/' . $model . '.php')) {
			require_once 'models/' . $model . '.php';
			return new $model($conn);
		} else {
			return null;
		}
	}
  
	protected function view($name, $data = null) {
		if (file_exists('views/'.$name.'.php')) {
			include('views/'.$name.'.php');
		} else {
			echo "ERROR: View $view not found!";
		}
	}

	protected function sendEmail($from, $fromName, $subject, $body) {
		$mail = new Mail();
		$mail->config->SetFrom($from, $fromName); // From email address and name
		$mail->config->Subject = $subject;
		$mail->config->Body = $body;
		// var_dump($mail->config);

		/*if (!$mail->config->send()) { // true or false
			echo "Sorry! Something's wrong: ".$mail->config->ErrorInfo;
			return false;
		}*/

		return true;
		// return $mail->config->send();
	}

	public function slugify($string) {
		return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $string), '-'));
	}
}

?>