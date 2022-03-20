<?php

class Apple extends Fruit
{
    public function __construct() {
        parent::__construct('Apple', 'Red');
    }

    public static function helloWorld(): string {
        return "Hello world!";
    }
}