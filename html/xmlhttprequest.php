<?php
require_once __DIR__ . '/../vendor/autoload.php';

$action = $_POST['action'] ?? null;

switch ($action) {
    case 'login':
        include ROOT_PATH . '/includes/ajax/login.php';
        break;
    case 'register':
        include ROOT_PATH . '/includes/ajax/register.php';
        break;
    default:
        echo "Invalid action.";
        break;
}