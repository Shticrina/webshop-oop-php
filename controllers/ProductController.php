<?php

class ProductController extends Controller {

  	public function detail($product_id) {
	    $product = $this->model('Product')->getProduct($product_id);
	    $this->view('product/show', ['product' => $product]);
  	}

  	public function notFound() {
  		$this->view('404');
  	}
}

?>