<?php

class CartController extends Controller {

  	public function home() {
		$this->getShoppingCartItems();
		$this->view('pages/cart');
	}

  	public function update() {
  		$items = isset($_POST['items']) ? json_decode($_POST['items']) : null;
  		$order_id = isset($_POST['orderId']) ? json_decode($_POST['orderId']) : null;
  		$cartItems = [];
  		$total_price = 0;

		if (isset($items)) {
	    	foreach ($items as $item) {
	    		if ($item->qty > 0) {
					// update order item qty in the db
					$this->model('OrderItem')->updateQty($item->id, $item->qty);

					// get the orderItem after update
					$orderItem = $this->model('OrderItem')->getById($item->id);
					array_push($cartItems, $orderItem);

					// update item price to total price
					$total_price += $orderItem['quantity']*$orderItem['price'];
	    		} else {
	    			// delete item from orderItems table in the db
	    			$this->model('OrderItem')->delete($item->id);
	    		}
	  		}

	  		if (count($cartItems) > 0) {
				// update total_price in order
				$this->model('Order')->updateTotalPrice($total_price, $order_id);
	  		} else {
	  			// delete order in the db
	  			$this->model('Order')->delete($order_id);
	  		}

			// send response: success + data
	    	echo json_encode([
	    		'success' => 1, 
	    		'totalPrice' => $total_price,
	    		'cartItems' => $cartItems
	    	]);
		} else {
    		echo json_encode(['success' => 0]);
    	}
  	}

  	public function deleteItem() {
		$itemId = isset($_POST['id']) ? $_POST['id'] : null;
		$noItems = 0;

	    if ($itemId) {
			// get $item object from the db
			$item = $this->model('OrderItem')->getById($itemId);
			$order_id = $item['order_id'];

			// delete from the database
			$this->model('OrderItem')->delete($itemId);

			$itemsLeftInCart = $this->model('OrderItem')->getAll($order_id);

			if (count($itemsLeftInCart) > 0) {
				// update total_price in order
				$newPrice = $item['total_price'] - $item['quantity']*$item['price'];
				$this->model('Order')->updateTotalPrice($newPrice, $item['order_id']);
			} else {
				$noItems = 1;

				// delete order
				$this->model('Order')->delete($order_id);
			}

			// send response: success + data
	    	echo json_encode(['success' => 1, 'item' => $item, 'noItems' => $noItems]);
		} else {
    		echo json_encode(['success' => 0]);
    	}
  	}
}

?>