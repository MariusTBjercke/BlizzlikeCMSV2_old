<?php

session_start();
require_once('../vendor/autoload.php');

$page = $_GET['page'] ?? 'home';
$action = $_GET['action'] ?? '';

if ($action == 'logout') {
    session_unset();
    session_destroy();
    header("Location: " . basename(__FILE__));
}

switch ($action) {
    case 'logout':
        session_unset();
        session_destroy();
        header("Location: " . basename(__FILE__));
        break;
}

$view = BLViewRenderer::getInstance();


$data = $view->getData();

// Find corresponding view/page template
$key = array_search($page, array_column($data['site']['pages'], 'url'));

$template = $data['site']['pages'][$key]['template'];

// Authentication
if ($data['site']['pages'][$key]['requires_login']) {
    $view->setAuth(true);
} else {
    $view->setAuth(false);
}

$view->render($template);
