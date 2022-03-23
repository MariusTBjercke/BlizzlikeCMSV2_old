<?php

/**
 * BlizzlikeCMS SQl connection class.
 */
class BLSqlConnection extends mysqli
{
    private static array $instances = [];

    /**
     * Parent constructor with values from configuration file.
     * @throws Exception
     */
    protected function __construct() {
        parent::__construct(
            $GLOBALS['sql_hostname'],
            $GLOBALS['sql_username'],
            $GLOBALS['sql_password'],
            $GLOBALS['sql_database']
        );

        if ($this->connect_error) {
            throw new Exception($this->connect_error);
        }
    }

    /**
     * Returns a user array from the database.
     *
     * @return array
     */
    public function getUsers(): array {
        $query = 'SELECT * FROM users ORDER BY id DESC';
        $result = $this->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function validateUser(string $username, string $password) {
        $query = "SELECT * FROM users WHERE username = '{$username}' AND password = '{$password}'";
        return $this->query($query);
    }

    public function registerUser(string $username, string $password, string $email) {
        $query = "INSERT INTO users (username, password, email) VALUES ('{$username}', '{$password}', '{$email}')";
        return $this->query($query);
    }
    public static function getInstance() {
        $class = static::class;

        if (!isset(self::$instances[$class])) {
            self::$instances[$class] = new static();
        }

        return self::$instances[$class];
    }

    /**
     * Should not be cloneable.
     *
     */
    private function __clone() {}

    /**
     * Should not be restorable.
     *
     */
    private function __wakeup() {}

}