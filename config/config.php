<?php

// MySQLi settings
$GLOBALS['sql_hostname'] = '127.0.0.1'; // USE IP AND NOT ALIAS LIKE 'localhost' HERE!
$GLOBALS['sql_username'] = 'root';
$GLOBALS['sql_password'] = '';
$GLOBALS['sql_database'] = 'blizzlikecms';

// Get current page
$page = $_GET['page'] ?? 'home';

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
$twig = BLViewRenderer::getInstance();

// Custom template paths
$twig->addPath(__DIR__ . '/../assets/templates/layouts/components', 'components');
$twig->addPath(__DIR__ . '/../assets/templates/layouts/grid', 'grid');

// Twig custom functions
$twig->addGlobalFunction('redirect', [BLTwigRedirect::class, 'redirect']);
$twig->addGlobalFunction('redirectIfLoggedIn', [BLTwigRedirect::class, 'redirectIfLoggedIn']);

$user = (isset($_SESSION['user'])) ? unserialize($_SESSION['user']) : new BLUser();

// Twig data
$data = [
    "site" => [
        "current_page" => $page,
        "current_user" => [
            "logged_in" => $user->getLoggedIn(),
            "username" => $user->getUsername(),
            "email" => $user->getEmail(),
        ],
        "pages" => [
            [
                "name" => "Home",
                "icon" => "default",
                "url" => "home",
                "template" => "index",
                "navigation" => true,
                "requires_login" => false,
            ],
            [
                "name" => "Register",
                "icon" => "default",
                "url" => "register",
                "template" => "register",
                "navigation" => !$user->getLoggedIn(),
                "requires_login" => false,
            ],
            [
                "name" => "Login",
                "icon" => "default",
                "url" => "login",
                "template" => "login",
                "navigation" => !$user->getLoggedIn(),
                "requires_login" => false,
            ],
            [
                "name" => "Profile",
                "icon" => "default",
                "url" => "profile",
                "template" => "profile",
                "navigation" => $user->getLoggedIn(),
                "requires_login" => true,
            ],
        ],
        "users" => $users ?? [],
        "action" => $_SESSION['action'] ?? null,
    ],
];

$_SESSION['action'] = null;

$twig->setData($data);
