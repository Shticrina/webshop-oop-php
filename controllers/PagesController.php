<?php

class PagesController extends Controller {

	public function home() {
  		$productModel = $this->model('Product');
	    $products = $productModel->listAll();
	    $this->view('welcome', ['products' => $products, 'nb_products' => $productModel->countProducts]);
  	}
  	
	public function about() {
		$this->view('pages/about');
	}

	public function gallery() {
		$this->view('pages/gallery');
	}

	public function shop() {
		$this->view('pages/shop');
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