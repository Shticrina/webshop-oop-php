<?php

class HomeController extends Controller {

  	public function index() {
  		$productModel = $this->model('Product');
	    $products = $productModel->listAll();
	    $this->view('welcome', ['products' => $products, 'nb_products' => $productModel->countProducts]);
  	}
}

?>