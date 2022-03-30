<?php

class BLUser
{
    private string $username;
    private string $email;
    private bool $loggedIn;

    public function __construct($username = "", $email = "", $loggedIn = false)
    {
        $this->username = $username;
        $this->email = $email;
        $this->loggedIn = $loggedIn;
    }

    public function setUsername(string $username)
    {
        $this->username = $username;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setLoggedIn(bool $isLoggedIn)
    {
        $this->loggedIn = $isLoggedIn;
    }

    public function getLoggedIn(): bool
    {
        return $this->loggedIn;
    }

}