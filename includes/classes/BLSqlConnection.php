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
}