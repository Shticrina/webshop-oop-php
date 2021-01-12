<?php

class WishlistController extends Controller {
	
	public function all() {
		session_start();

		$userId = isset($_SESSION['user']) && isset($_SESSION['user']['user_id']) ? $_SESSION['user']['user_id'] : null;
		
		if ($userId) {
			$wishlist_items = $this->model('Wishlist')->getAllByUser($userId);

			$this->view('pages/wishlist', ['wishlist_items' => $wishlist_items]);
		} else {
  			$this->view('404');
		}
	}

	public function add() {
		session_start();

		$current_route = isset($_POST['current_route']) ? $_POST['current_route'] : "/";
		$productId = isset($_POST['product_id']) ? $_POST['product_id'] : null;
		$userId = isset($_SESSION['user']) && isset($_SESSION['user']['user_id']) ? $_SESSION['user']['user_id'] : null;
		
		if ($userId && $productId) {
			$this->model('Wishlist')->create($productId, $userId);
			$_SESSION['success_message'] = "Item successfully added to your wishlist.";

			header('location: '.$current_route.'#mainBanner');
		} else {
  			$this->view('404');
		}
	}

	public function delete() {
		session_start();

		if (isset($_POST['deletewishBtn'])) {
			if (!empty($_POST['wishlist_id'])) {
				$wishlistId = $_POST['wishlist_id'];
				$this->model('Wishlist')->delete($wishlistId);
				$_SESSION['success_message'] = "Item successfully removed from the wishlist.";

				header('location: /wishlist/all');
			}
		} else {
  			$this->view('404');
		}
	}
}

?>