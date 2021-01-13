<?php

class UserController extends Controller {
	public $userModel;

	public function __construct() {
		$this->userModel = $this->model('User');
	}

	public function register() {
		$data = [];
		session_start();

		if (isset($_POST['registerBtn'])) {
			$validation = $this->validationRegister($_POST);

			$data['errors'] = $validation['errors'];
			$data['values'] = $validation['values'];

			if (count($data['errors']) == 0) {
				$passwordHash = password_hash($data['values']['password'], PASSWORD_DEFAULT);

		  		// insert user in the db & connect the user
		  		$user = [];
		  		$user['first_name'] = $data['values']['firstName'];
		  		$user['last_name'] = $data['values']['lastName'];
		  		$user['email'] = $data['values']['email'];
		  		$user['password'] = $passwordHash;

		  		$this->userModel->create($user);
		  		$newUser = $this->userModel->getUserByEmail($user['email']); // array OR false

		  		$_SESSION['user'] = $newUser;
		  		$_SESSION['success_message'] = "Successfully registered. <br/>You are now connected.";

				header('location: /');
			}

			$this->view('auth/register', $data);
		} else {
			// the user accessed this page without passing by the form => redirect the user to the 404 page
	    	$this->view('404');
		}
	}

	public function login() {
		$data = [];
		session_start();

		if (isset($_POST['loginBtn'])) {
    		$validation = $this->validationLogin($_POST);

			$data['errors'] = $validation['errors'];
			$data['values'] = $validation['values'];

			if (count($data['errors']) == 0) {
		        $currentUser = $this->userModel->getUserByEmail($data['values']['email']); // array OR false

		        // check if the user email exists in the db & if password match
		        if ($currentUser != false) {
		            if (password_verify($data['values']['password'], $currentUser['password'])) {
		                $_SESSION['user'] = $currentUser;

		                // update user in the db: is_connected = true
		                $updateUser = $this->userModel->updateUserByConnection($currentUser['user_id'], true); // true or false

		                if ($updateUser) {
		                    $_SESSION['user']['is_connected'] = true;
		                    $_SESSION['success_message'] = "You are now logged in.";
		                    
		                    header('location: /');
		                }
		            } else {
		                $data['errors']['credentials'] = "Wrong credentials! Please try again.";
		            }
		        } else {
		            $data['errors']['credentials'] = "Wrong credentials! Please try again.";
		        }
			}

			$this->view('auth/login', $data);
		} else {
			// the user accessed this page without passing by the form => redirect the user to the 404 page
	    	$this->view('404');
		}
	}

	function validationLogin($form) {
		$result = [];
		$errors = [];
		$values = [];

	    if (!empty($form['login_email'])) {
		  	$email = filter_var($form['login_email'], FILTER_SANITIZE_EMAIL); // Sanitization
		  	$values['email'] = $email;

		  	// Validation
		  	if (false == filter_var($email, FILTER_VALIDATE_EMAIL)) {
			 	$errors['email'] = "Invalid field!";
		  	}

		  	if (strlen($email) > 255) {
			 	$errors['email'] = "This field must contain maximum 255 characters!";
		  	}
		} else {
		 	$errors['email'] = "This field is required!";
		}

		if (!empty($form['login_password'])) {
		  	$password = filter_var($form['login_password'], FILTER_SANITIZE_STRING); // Sanitization
		  	$values['password'] = $password;

		  	// Validation
		  	if (strlen($password) < 6 || strlen($password) > 255) {
			 	$errors['password'] = "This field must contain between 6 and 255 characters!";
		  	}
		} else {
		 	$errors['password'] = "This field is required!";
		}

		$result['values'] = $values;
		$result['errors'] = $errors;

		return $result;
	}

	function validationRegister($form) { // Get input values & validate the form
		$result = [];
		$errors = [];
		$values = [];

		if (isset($form['first_name'])) {
		  	$first_name = filter_var($form['first_name'], FILTER_SANITIZE_STRING); // Sanitization
		  	$values['firstName'] = $first_name;

		  	// Validation
		  	if (strlen($first_name) < 2 || strlen($first_name) > 60) {
			 	$errors['firstName'] = "This field must contain between 2 and 60 characters!";
		  	}
		}

		if (!empty($form['last_name'])) {
			$last_name = filter_var($form['last_name'], FILTER_SANITIZE_STRING); // Sanitization
			$values['lastName'] = $last_name;

			// Validation
			if (strlen($last_name) < 2 || strlen($last_name) > 60) {
			 	$errors['lastName'] = "This field must contain between 2 and 60 characters!";
			}
		} else {
		 	$errors['lastName'] = "This field is required!";
		}

		if (!empty($form['email'])) {
		  	$email = filter_var($form['email'], FILTER_SANITIZE_EMAIL); // Sanitization
		  	$values['email'] = $email;

		  	// Validation
		  	if (false == filter_var($email, FILTER_VALIDATE_EMAIL)) {
			 	$errors['email'] = "Invalid field!";
		  	}

		  	if (strlen($email) > 255) {
			 	$errors['email'] = "This field must contain maximum 255 characters!";
		  	}
		} else {
		 	$errors['email'] = "This field is required!";
		}

		if (!empty($form['password'])) {
		  	$password = filter_var($form['password'], FILTER_SANITIZE_STRING); // Sanitization
		  	$values['password'] = $password;

		  	// Validation
		  	if (strlen($password) < 6 || strlen($password) > 255) {
			 	$errors['password'] = "This field must contain between 6 and 255 characters!";
		  	}
		} else {
		 	$errors['password'] = "This field is required!";
		}

		if (!empty($form['password_confirm'])) {
		  	$password_confirm = filter_var($form['password_confirm'], FILTER_SANITIZE_STRING); // Sanitization
		  	$values['passwordConfirm'] = $password_confirm;
		} else {
		 	$errors['passwordConfirm'] = "This field is required!";
		}

		if (isset($password) && isset($password_confirm) && $password != $password_confirm) {
			$errors['password'] = "Password and password_confirm doesn't match!";
		}

	  	if (isset($values['email'])) {
		  	// check if the user email exists in the db
		  	$checkUser = $this->userModel->getUserByEmail($values['email']); // array OR false

		    if ($checkUser != false) { // if the user email doesn't exists in the db
		    	$errors['email'] = "This email already exists! Please try again.";
			}
		}

		$result['values'] = $values;
		$result['errors'] = $errors;

		return $result;
	}

	public function logout() {
		$data = [];
		session_start();

		$userId = isset($_SESSION['user']) ? $_SESSION['user']['user_id'] : null;

		// update user in the db: is_connected = false
		$updateUser = isset($userId) ? $this->userModel->updateUserByConnection($userId, 0) : false;

		if ($updateUser) {
			$_SESSION['success_message'] = "You are now disconnected.";

			// Go to homepage after signing out
			header('location: /');

			// Delete session user
			// session_destroy();
			unset($_SESSION['user']);
			unset($_SESSION['cartItems']);
			unset($_SESSION['cartItemsNb']);
			unset($_SESSION['totalPrice']);
		}
	}
}

?>