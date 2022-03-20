<?php
/**
 * Class for common fruits.
 **/
class Fruit {
    public string $name;
    public string $color;

    /**
     * Fruit constructor.
     *
     * @param string $name Name of fruit.
     * @param string $color Color of fruit.
     */
    public function __construct(string $name, string $color) {
        $this->name = $name;
        $this->color = $color;
    }

    /**
     * Return the value of fruit name.
     *
     * @return string
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * Destructor.
     *
     * @return void
     */
    public function __destruct() {
    }
}
