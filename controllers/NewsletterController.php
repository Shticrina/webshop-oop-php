<?php

class NewsletterController extends Controller {
	public $newsletterModel;

	public function __construct() {
		$this->newsletterModel = $this->model('Newsletter');
	}

	public function create() {
		session_start();

		$_SESSION['errors'] = [];
		$_SESSION['values'] = [];
		$current_route = "/";

		if (isset($_POST['newsletterBtn'])) {
			if (!empty($_POST['current_route'])) {
				$current_route = $_POST['current_route'];
			}

			if (!empty($_POST['news_email'])) {
			  	$email = filter_var($_POST['news_email'], FILTER_SANITIZE_EMAIL); // Sanitization
			  	$_SESSION['values']['email'] = $email;

			  	// Validation
			  	if (false == filter_var($email, FILTER_VALIDATE_EMAIL)) {
				 	$_SESSION['errors']['email'] = "Invalid field!";
			  	}

			  	if (strlen($email) > 255) {
				 	$_SESSION['errors']['email'] = "This field must contain maximum 255 characters!";
			  	}

			  	if (strlen($email) < 8) {
				 	$_SESSION['errors']['email'] = "Invalid field!";
			  	}
			} else {
			 	$_SESSION['errors']['email'] = "This field is required!";
			}
			
			if (empty($_SESSION['errors'])) {
				$hasEmail = $this->newsletterModel->emailExists($_SESSION['values']['email']); // array OR false

		        // check if the email exists in the db
		        if ($hasEmail != false) {
					$_SESSION['errors']['email'] = "This email already exists in the db!";
				} else {
					// add email in the db
					$this->newsletterModel->create($email);
					$_SESSION['success_message'] = "Your email has been added to the db.";
				}
			}

			header('location: '.$current_route.'#footerMain');
		} else {
			// the user accessed this page without passing by the form => redirect the user to the 404 page
	    	$this->view('404');
		}
	}
}

?>