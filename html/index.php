<?php

require_once('../vendor/autoload.php');

$page = $_GET['page'] ?? 'home';
$template = 'index';

// Get corresponding template from data array
foreach ($GLOBALS['data']['site']['pages'] as $item) {
    $template = $item['url'] == $page ? $item['template'] : $template;
}

$view = new BLViewRenderer();
$view->render($template);
