<?php

session_start();
require_once('../vendor/autoload.php');

$page = $_GET['page'] ?? 'home';
$action = $_GET['action'] ?? '';

if ($action == 'logout') {
    session_unset();
    session_destroy();
}

// Find corresponding view/page template
$key = array_search($page, array_column($GLOBALS['data']['site']['pages'], 'url'));

$template = $GLOBALS['data']['site']['pages'][$key]['template'];

$view = BLViewRenderer::getInstance();

$view->render($template);
