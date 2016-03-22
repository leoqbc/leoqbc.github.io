<?php

// PHP 7.0.0Beta2
echo (new class extends ArrayIterator {
    public $name;
    public function offsetGet($name)
    {
        $this->name = $name;
        return $this;
    }
    public function hello(string $string) : string 
    {
        return $string . ' ' . $this->name;
    }
})['World']->hello('Hello');

// Imprime: Hello World