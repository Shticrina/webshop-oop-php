<?php

class CartController extends Controller {

  	public function home() {
		$this->getShoppingCartItems();
		$this->view('pages/cart');
	}

	public function add() {
		session_start();

  		$product_id = isset($_POST['productId']) ? $_POST['productId'] : null;
  		$price = isset($_POST['price']) ? $_POST['price'] : null;
  		$quantity = isset($_POST['quantity']) ? $_POST['quantity'] : null;
  		$image = isset($_POST['image']) ? $_POST['image'] : null;
  		$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
  		$connected = isset($_SESSION['user']) && isset($_SESSION['user']['user_id']);
  		$nb_items = isset($_SESSION['cartItemsNb']) ? $_SESSION['cartItemsNb'] : 0;
  		$user_session = session_id();
  		$total_price = 0;
  		$new_item = false;

  		if ($product_id && $price && $image && $quantity && $user_id) {
	  		$order = $this->model('Order')->getCurrentOrder($connected, $user_id);

			if (!$order) {
				// create first order
				$order = $this->model('Order')->create($user_id, $user_session, $connected);
			}

  			if ($order) {
  				// verify if order item already exists in the db
	  			$item = $this->model('OrderItem')->getByOrderAndProductId($order['order_id'], $product_id);

  				if ($item) {
					$newQuantity = $item['quantity']+$quantity;
					$item['quantity'] = $newQuantity;

  					// update quantity for existing item
		  			$updateItem = $this->model('OrderItem')->updateQty($item['id'], $newQuantity);
  				} else {
		  			// add new order item to the db order items
		  			$this->model('OrderItem')->create($order['order_id'], $product_id, $price, $image, $quantity);
		  			$item = $this->model('OrderItem')->getByOrderAndProductId($order['order_id'], $product_id);
		  			$new_item = true;
  				}

  				$nb_items += $quantity;
  				$total_price = $order['total_price'] + $price*$quantity;
  				$_SESSION['cartItemsNb'] = $nb_items;

  				// update order total price
				$this->model('Order')->updateTotalPrice($total_price, $order['order_id']);

		    	echo json_encode([
		    		'success' => 1, 
		    		'totalPrice' => $total_price,
		    		'cartItemsNb' => $nb_items,
		    		'new_item' => $new_item,
		    		'item' => $item
		    	]);
	  		}
  		} else {
    		echo json_encode(['success' => 0]);
    	}
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