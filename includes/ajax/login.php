<?php
session_start();

require_once(__DIR__ . '/../../vendor/autoload.php');

$username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
$password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

// Validate all fields before continuing
if (!$username || !$password) {
    echo "0";
    return;
}

$db = BLSqlConnection::getInstance();

$result = $db->validateUser($username, $password);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $user = new BLUser($row['username'], $row['email'], true);
    $_SESSION['user'] = serialize($user);
    $_SESSION['action'] = "success";
    echo "1";
} else {
    echo "0";
}
