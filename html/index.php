<?php
session_start();

require_once('../vendor/autoload.php');

$page = $_GET['page'] ?? 'home';

// Find corresponding view/page template
$key = array_search($page, array_column($GLOBALS['data']['site']['pages'], 'url'));

$template = $GLOBALS['data']['site']['pages'][$key]['template'];

$view = new BLViewRenderer();
$view->render($template);
