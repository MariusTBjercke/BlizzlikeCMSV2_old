<?php

// MySQLi settings
$GLOBALS['sql_hostname'] = '127.0.0.1'; // USE IP AND NOT ALIAS LIKE 'localhost' HERE!
$GLOBALS['sql_username'] = 'root';
$GLOBALS['sql_password'] = '';
$GLOBALS['sql_database'] = 'blizzlikecms';

// Get current page
$GLOBALS['page'] = $_GET['page'] ?? 'home';

/**
 * Initialize page data.
 */

try {
    $db = BLSqlConnection::getInstance();
    $users = $db->getUsers();
} catch (Exception $e) {
    echo 'Connection error: '.$e->getMessage();
}

// Twig settings
$GLOBALS['twig_template_dir'] = __DIR__ . '/../assets/templates';

$twig = BLViewRenderer::getInstance();

// Other custom template paths
$twig->addPath(__DIR__ . '/../assets/templates/layouts/components', 'components');
$twig->addPath(__DIR__ . '/../assets/templates/layouts/grid', 'grid');

// Twig custom functions
$twig->addGlobalFunction('bem', [Bem::class, 'bemx']);

// Twig data
$GLOBALS['data'] = [
    "site" => [
        "current_page" => $GLOBALS['page'],
        "current_user" => $_SESSION['current_user'] ?? null,
        "pages" => [
            [
                "name" => "Home",
                "icon" => "default",
                "url" => "home",
                "template" => "index",
                "navigation" => true,
            ],
            [
                "name" => "Register",
                "icon" => "default",
                "url" => "register",
                "template" => "register",
                "navigation" => true,
            ],
            [
                "name" => "Login",
                "icon" => "default",
                "url" => "login",
                "template" => "login",
                "navigation" => true,
            ],
            [
                "name" => "Other",
                "icon" => "default",
                "url" => "other",
                "template" => "index",
                "navigation" => true,
            ],
        ],
        "users" => $users ?? [],
    ],
];
