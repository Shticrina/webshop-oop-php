<?php

class ProductController extends Controller {

	public function detail($slug) { // slug
		$product = $this->model('Product')->getProduct($slug);
		
		if ($product) {
			$this->view('product/show', ['product' => $product]);
		} else {
			$this->view('404');
		}
	}

	public function notFound() {
		$this->view('404');
	}

	public function search() {
		session_start();

		if (isset($_POST['searchBtn'])) {
			if (!empty($_POST['search'])) {
				$search = filter_var($_POST['search'], FILTER_SANITIZE_STRING); // Sanitization
				$items = $this->model('Product')->searchProducts($search);
				$_SESSION['products'] = $items;

				header('location: /shop');
			}
		} else {
			// the user accessed this page without passing by the form => redirect the user to the 404 page
	    	$this->view('404');
		}
	}

	public function addProduct() {
		// $word = "dgdS Dddddd??.. ; fooo";
		// var_dump($word, $this->slugify($word)); // ok
		// $this->view('404');
	}
}

?>