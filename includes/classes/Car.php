<?php

abstract class Car
{
    public function __construct($name) {
        $this->name = $name;
    }

    abstract public function intro() : string;
    abstract public function outro($name) : string;
}