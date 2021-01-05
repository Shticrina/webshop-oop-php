<?php

class PagesController extends Controller {

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
}

?>