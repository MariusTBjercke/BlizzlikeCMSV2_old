<?php

/**
 * BlizzlikeCMS SQl connection class.
 */
class BLSqlConnection extends mysqli
{

    /**
     * Parent constructor with values from configuration file.
     */
    public function __construct() {
        parent::__construct(
            $GLOBALS['sql_hostname'],
            $GLOBALS['sql_username'],
            $GLOBALS['sql_password'],
            $GLOBALS['sql_database']
        );
    }

    /**
     * Returns a user array from the database.
     *
     * @return array
     */
    public function getUsers(): array {
        $query = 'SELECT * FROM users ORDER BY id DESC';
        return $this->query($query)->fetch_all(MYSQLI_ASSOC);
    }

    public function validateUser(string $username, string $password) {
        $query = "SELECT * FROM users WHERE username = '{$username}' AND password = '{$password}'";
        return $this->query($query);
    }

    public function registerUser(string $username, string $password, string $email) {
        $query = "INSERT INTO users (username, password, email) VALUES ('{$username}', '{$password}', '{$email}')";
        return $this->query($query);
    }
}