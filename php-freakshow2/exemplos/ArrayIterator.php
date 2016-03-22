<?php

class Writer extends \ArrayIterator
{
    public function offsetGet($index) 
    {
        echo $index . ' ';
        return $this;
    }
}

$whiter = new Writer();
$whiter['Hello']['World']; // Imprime: Hello World

$whiter['But']['when']['this']['is']['over?']; // Imprime: But when this is over? 