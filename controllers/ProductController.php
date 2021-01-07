<?php

class ProductController extends Controller {

  	public function detail($product_id) {
	    $product = $this->model('Product')->getProduct($product_id);
	    $this->view('product/show', ['product' => $product]);
  	}

  	public function notFound() {
  		$this->view('404');
  	}

  	/*public function categories() {
  		$categories = $this->model('Category')->getAllCategories();
	    $this->view('welcome', ['categories' => $categories]);
	    $this->view('pages/galerry', ['categories' => $categories]);
	    $this->view('pages/shop', ['categories' => $categories]);
  	}*/
}

?>