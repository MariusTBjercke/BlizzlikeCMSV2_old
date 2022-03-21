<?php

// Twig settings
$GLOBALS['templateDir'] = __DIR__ . '/../assets/templates';

// MySQLi settings
$GLOBALS['sql_hostname'] = '127.0.0.1'; // USE IP AND NOT ALIAS LIKE 'localhost' HERE!
$GLOBALS['sql_username'] = 'root';
$GLOBALS['sql_password'] = '';
$GLOBALS['sql_database'] = 'blizzlikecms';

/**
 * Initialize page data.
 */

$db = new BLSqlConnection();
$users = $db->getUsers();

$GLOBALS['data'] = [
    "site" => [
        "current_user" => $_SESSION['current_user'] ?? null,
        "pages" => [
            [
                "name" => "Home",
                "icon" => "default",
                "url" => "home",
                "template" => "index",
            ],
            [
                "name" => "Register",
                "icon" => "default",
                "url" => "register",
                "template" => "register",
            ],
            [
                "name" => "Login",
                "icon" => "default",
                "url" => "login",
                "template" => "login",
            ],
            [
                "name" => "Other",
                "icon" => "default",
                "url" => "other",
                "template" => "other",
            ],
        ],
        "users" => $users,
    ],
];
