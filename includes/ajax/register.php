<?php
session_start();

require_once('../../vendor/autoload.php');

$username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
$password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
$email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);

// Validate all fields before continuing
if (!$username || !$password || !$email) {
    echo "2";
    return;
}

$db = new BLSqlConnection();

$result = $db->registerUser($username, $password, $email);

if ($result) {
    echo "1";
} else {
    echo "0";
}
