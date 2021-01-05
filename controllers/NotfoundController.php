<?php

class NotfoundController extends Controller {

  	public function index() {
	    $this->view('404');
  	}

  	public function notFound() {
  		$this->view('404');
  	}
}

?>