<?php

$url = explode('/', $_SERVER['REQUEST_URI']); // full url path
$root = !empty($url[1]) ? '../..' : '.';
$page_title = isset($url[1]) && $url[1] != '' ? $url[1] :  'home';
// var_dump($page_title);
?>