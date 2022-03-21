<?php
session_start();

require_once('../../vendor/autoload.php');

$username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
$password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

$db = new BLSqlConnection();

$result = $db->validateUser($username, $password);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $_SESSION['current_user'] = $row['username'];
    echo "1";
} else {
    echo "0";
}
