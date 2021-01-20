<?php

class PagesController extends Controller {

	public function home() {
		$categories = $this->model('Category')->getAllCategories();
  		$products = $this->model('Product')->getAllProducts();

  		$this->currentShoppingCart();
	    $this->view('welcome', ['categories' => $categories, 'products' => $products]);
  	}
  	
	public function about() {
		$this->currentShoppingCart();
		$this->view('pages/about');
	}

	public function gallery() {
		$categories = $this->model('Category')->getAllCategories();
		$products = $this->model('Product')->getAllProducts();

	    $this->getWishlistProductIds();
	    $this->currentShoppingCart();
	    $this->view('pages/gallery', ['categories' => $categories, 'products' => $products]);
	}

	public function shop() {
		$categories = $this->model('Category')->getAllCategories();
		$products = $this->model('Product')->getAllProducts();
		$completeCategories = [];

		// categories with products
		foreach ($categories as $category) {
			$cat_products = $this->model('Product')->getProductsByCat($category['category_id']);
			$category['products'] = $cat_products;
			array_push($completeCategories, $category);
		}

	    $this->getWishlistProductIds();
	    $this->currentShoppingCart();
	    $this->view('pages/shop', ['categories' => $completeCategories, 'products' => $products]);
	}

	/*public function shopDetail() {
		$this->getWishlistProductIds();
		$this->view('pages/shop-detail');
	}*/

	/*public function cart() {
		$this->getShoppingCartItems();
		$this->view('pages/cart');
	}*/

	public function checkout() {
		$this->currentShoppingCart();
		$this->view('pages/checkout');
	}

	public function contactUs() {
		$this->currentShoppingCart();
		$this->view('pages/contact-us');
	}

	public function myAccount() {
		$this->currentShoppingCart();
		$this->view('pages/my-account');
	}

	public function register() {
		$this->currentShoppingCart();
		$this->view('auth/register');
	}

	public function login() {
		$this->currentShoppingCart();
		$this->view('auth/login');
	}

	public function notFound() {
		$this->currentShoppingCart();
  		$this->view('404');
  	}
}

?>