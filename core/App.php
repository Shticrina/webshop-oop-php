<?php

class App {
	//This class contains controller, method, & params attributes, initialized with default values.
	public $controller = 'PagesController';
	public $method = 'index';
	public $params = []; // default route: HomeController, method index, no params
	public $pages = ['about', 'gallery', 'contactUs', 'shop', 'shopDetail', 'cart', 'myAccount', 'wishlist', 'checkout'];

	public function __construct() {
		$url = $this->parseURL();
		// var_dump($url); // null

		if (file_exists('controllers/' . ucfirst($url[0]) . 'Controller.php')) {
			$this->controller = ucfirst($url[0]) . 'Controller';
			unset($url[0]);
		}

		if (isset($url[0]) && !in_array($url[0], $this->pages)) {
			$this->controller = 'NotfoundController';
		}

		// var_dump($this->controller); // ProductController, ok
		require_once 'controllers/' . $this->controller . '.php';
		$this->controller = new $this->controller();

		if (isset($url[1])) {
			if (method_exists($this->controller, $url[1])) {
				$this->method = $url[1];
				unset($url[1]);
			} else {
				$this->method = 'notFound';
			}
		} elseif (isset($url[0]) && in_array($url[0], $this->pages)) {
			$this->method = $url[0];
		} else {
			$this->method = 'notFound';
		}

		$this->params = $url ? array_values($url) : [];
		// var_dump($this->method);
		// var_dump($this->params);

		call_user_func_array([$this->controller, $this->method], $this->params);
	}

	private function parseUrl() {
		if (isset($_GET['url'])) {
			return $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
		}
	}
}

?>