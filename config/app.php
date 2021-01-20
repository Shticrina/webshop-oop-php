<?php

// $app_root = $_SERVER['HTTP_REFERER'];
$url = explode('/', $_SERVER['REQUEST_URI']); // full url path
$root = !empty($url[1]) ? '../..' : '.';
// $page_title = isset($url[1]) && $url[1] != '' ? $url[1] :  'home';
$page_title = 'home';
$page_url = '/';

if (isset($url[1]) && $url[1] != '') {
	$page_title = $url[1];

	if (isset($url[2]) && $url[1] != 'wishlist') {
		$page_title .= " ".$url[2];
	}
}

if (isset($url[1]) && $url[1] != '') {
	$page_url = $url[1];

	if (isset($url[2])) {
		$page_url .= "/".$url[2];
	}

	if (isset($url[3])) {
		$page_url .= "/".$url[3];
	}
}

define('APP_ROOT', $root);
define('APP_PAGE', $page_title); // only the first parameter
define('APP_URL', $page_url); // all parameters in the url
?>