<?php

class CartController extends Controller {

  	public function home() {
		$this->getShoppingCartItems();
		$this->view('pages/cart');
	}

  	public function deleteItem() {
		$itemId = isset($_POST['id']) ? $_POST['id'] : null;
  		// echo("in CartController deleteItem");

	    if ($itemId) {
			// get $item object from the db
			$item = $this->model('OrderItem')->getById($itemId);

			// delete from the database
			$this->model('OrderItem')->delete($itemId);

			// update total_price in order
			// let newPrice = oldPrice - itemToRemove.quantity*itemToRemove.price;
			// $this->model('Order')->updateTotalPrice($item['order_id'], $);

			// send response: success + $item object
	    	echo json_encode(['success' => 1, 'item' => $item]);
		} else {
    		echo json_encode(['success' => 0]);
    	}
  	}

  	/*public function notFound() {
  		$this->view('404');
  	}*/
}

?>