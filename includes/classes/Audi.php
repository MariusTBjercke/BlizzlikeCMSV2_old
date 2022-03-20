<?php

class Audi extends Car
{

    public function intro(): string
    {
        return Apple::helloWorld();
    }

    public function outro($name): string
    {
        return Apple::helloWorld();
    }
}
