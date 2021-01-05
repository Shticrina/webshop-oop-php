<?php

$url = explode('/', $_SERVER['REQUEST_URI']); // full url path
// var_dump($url[1]);

$root = !empty($url[1]) ? '../..' : '.';
// $pages_root = $url[3] == 'pages' ? '.' : './pages';
$page_title = isset($url[1]) && $url[1] != '' ? $url[1] :  'home';
// var_dump($page_title);

/*$root = $url[3] == 'pages' ? '..' : '.';
$pages_root = $url[3] == 'pages' ? '.' : './pages';
$page_title = ($url[3] == 'pages' && isset($url[4])) ? substr($url[4], 0, strpos($url[4], '.')) : 'Moosic';
$current_page = ($url[3] == 'pages' && isset($url[4])) ? "../".$url[3]."/".$url[4] : '../index.php';*/

?>