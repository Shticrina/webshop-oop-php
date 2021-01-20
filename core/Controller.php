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

	public function getWishlistProductIds() {
		if(!isset($_SESSION)){session_start();}
		$userId = isset($_SESSION['user']) && isset($_SESSION['user']['user_id']) ? $_SESSION['user']['user_id'] : null;
		
		if ($userId) {
			$wishlist_items = $this->model('Wishlist')->getAllByUser($userId);
	        $ids = array_column($wishlist_items, 'product_id');
	        $_SESSION['wishlistProductIds'] = $ids; // array of product ids for the current user
	    }
	}

	public function currentShoppingCart() {
		if(!isset($_SESSION)){session_start();}

        $cart_items = [];
        $nb_items = 0;
        $userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
        $connected = isset($_SESSION['user']) && isset($_SESSION['user']['user_id']);

        if ($userId) {
	    	$cart = $this->model('Order')->getCurrentOrder($connected, $userId); // array or false
        	// var_dump($connected, $userId, $cart);

			if ($cart != false) {
				$cart_items = $this->model('OrderItem')->getAllByUserAndOrder($userId, $cart['order_id']);
				$nb_items = array_reduce($cart_items, function(&$res, $item) { 
					$res += $item['quantity']; 
					return $res;
				}, 0);

		    	$_SESSION['totalPrice'] = isset($cart_items) && isset($cart_items[0]['total_price']) ? $cart_items[0]['total_price'] : 0;
			}
		}

        $_SESSION['cartItems'] = $cart_items;
    	$_SESSION['cartItemsNb'] = $nb_items;
    }
}

?>