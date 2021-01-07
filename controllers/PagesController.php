<?php

class PagesController extends Controller {

	public function home() {
		$categories = $this->model('Category')->getAllCategories();
  		$products = $this->model('Product')->getAllProducts();

	    $this->view('welcome', ['categories' => $categories, 'products' => $products]);
  	}
  	
	public function about() {
		$this->view('pages/about');
	}

	public function gallery() {
		$categories = $this->model('Category')->getAllCategories();
		$products = $this->model('Product')->getAllProducts();

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

	    $this->view('pages/shop', ['categories' => $completeCategories, 'products' => $products]);
	}

	public function shopDetail() {
		$this->view('pages/shop-detail');
	}

	public function cart() {
		$this->view('pages/cart');
	}

	public function checkout() {
		$this->view('pages/checkout');
	}

	public function contactUs() {
		$this->view('pages/contact-us');
	}

	public function myAccount() {
		$this->view('pages/my-account');
	}

	public function wishlist() {
		$this->view('pages/wishlist');
	}

	public function register() {
		$this->view('auth/register');
	}

	public function login() {
		$this->view('auth/login');
	}

	public function notFound() {
  		$this->view('404');
  	}
}

?>