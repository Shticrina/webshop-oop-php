<?php

class ContactController extends Controller {

	public function sendMessage() {
		$data = [];
		session_start();

		if (isset($_POST['contactBtn'])) {
			$validation = $this->validationContact($_POST);

			$data['errors'] = $validation['errors'];
			$data['values'] = $validation['values'];

			if (count($data['errors']) == 0) {
				// send email to admin
				$Subject = "New Message Received from Freshshop";

				$name = $data['values']['contact_name'];
				$email = $data['values']['contact_email'];
				$subject = $data['values']['contact_subject'];
				$message = $data['values']['contact_message'];

				// from contact form exercice
				$message = wordwrap($message, 70);
		        $body = '<h4 class="text-info">You have a messsage from your website!</h4>';
		        $body .= '<p class="text-dark"><strong>Name: </strong>'.$name.'</p>';
		        $body .= '<p class="text-dark"><strong>Email: </strong>'.$email.'</p>';
		        $body .= '<p class="text-dark"><strong>Subject: </strong>'.$subject.'</p>';
		        $body .= '<p class="text-success"><strong>Message: </strong>'.$message.'</p>';

		        $mailSent = $this->sendEmail($email, 'Freshshop Contact form', $Subject, $body); // from, fromName, Subject, Body

		        if ($mailSent) { // true or false
					$_SESSION['success_message'] = "Message successfully send. We will contact you as soon as possible.";
					unset($data['values']);
		        } /*else {
		            echo "Sorry! Something's wrong: ".$this->mail->ErrorInfo;
		        }*/
			}

			$this->view('pages/contact-us', $data);
		} else {
			// the user accessed this page without passing by the form => redirect the user to the 404 page
	    	$this->view('404');
		}
	}

	function validationContact($form) { // Get input values & validate the form
		$result = [];
		$errors = [];
		$values = [];

		if (isset($form['contactName'])) {
		  	$contactName = filter_var($form['contactName'], FILTER_SANITIZE_STRING); // Sanitization
		  	$values['contact_name'] = $contactName;

		  	// Validation
		  	if (strlen($contactName) < 2 || strlen($contactName) > 60) {
			 	$errors['contact_name'] = "This field must contain between 2 and 60 characters!";
		  	}
		}

		if (!empty($form['contactEmail'])) {
		  	$contactEmail = filter_var($form['contactEmail'], FILTER_SANITIZE_EMAIL); // Sanitization
		  	$values['contact_email'] = $contactEmail;

		  	// Validation
		  	if (false == filter_var($contactEmail, FILTER_VALIDATE_EMAIL)) {
			 	$errors['contact_email'] = "Invalid field!";
		  	}

		  	if (strlen($contactEmail) > 255) {
			 	$errors['contact_email'] = "This field must contain maximum 255 characters!";
		  	}
		} else {
		 	$errors['contact_email'] = "This field is required!";
		}

		if (isset($form['contactSubject'])) {
		  	$contactSubject = filter_var($form['contactSubject'], FILTER_SANITIZE_STRING); // Sanitization
		  	$values['contact_subject'] = $contactSubject;

		  	// Validation
		  	if (strlen($contactSubject) < 2 || strlen($contactSubject) > 120) {
			 	$errors['contact_subject'] = "This field must contain between 2 and 120 characters!";
		  	}
		}

		if (isset($form['contactMessage'])) {
		  	$contactMessage = filter_var($form['contactMessage'], FILTER_SANITIZE_STRING); // Sanitization
		  	$values['contact_message'] = $contactMessage;

		  	// Validation
		  	if (strlen($contactMessage) < 2 || strlen($contactMessage) > 800) {
			 	$errors['contact_message'] = "This field must contain between 2 and 800 characters!";
		  	}
		}

		$result['values'] = $values;
		$result['errors'] = $errors;

		return $result;
	}
}

?>