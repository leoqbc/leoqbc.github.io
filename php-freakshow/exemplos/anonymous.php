<?php

class BindClosure
{
    private $nome='Pedro';
    public function __set($name, $value) 
    {
        $this->$name = (is_callable($value))?
                    $value->bindTo($this, $this):$value;
    }
    public function __call($name, $args) 
    {
        $closure = $this->$name;
        $closure(...$args);
    }
}

class CrazyClosure implements \ArrayAccess
{
    private $closureIn;
    private $closureOut;
    
    public function __construct(callable $closure1, callable $closure2) 
    {
        $this->closureIn = $closure1->bindTo($this, $this);
        $this->closureOut = $closure2->bindTo($this, $this);
    }
    public function __call($name, $args) 
    {
        $closure = $this->$name;
        $closure(...$args);
    }
    
    public function offsetGet($index) {
        $closureIn = $this->closureIn;
        $closureOut = $this->closureOut;
        $closureIn(...$index);
        $closureOut(...$index);
    }

    public function offsetExists($offset) {
        
    }

    public function offsetSet($offset, $value) {
        
    }

    public function offsetUnset($offset) {
        
    }
}

//$var = Closure::bind(function () {
//    return [1,2,3];
//}, new stdClass)->__invoke();

(new CrazyClosure(function($a, $b, $c){
    echo 'In:', $a, $b, $c;
}, function($a, $b, $c) {
    echo 'Out:', $a, $b, $c;
}))[Closure::bind(function () {
    return [1,2,3];
}, new stdClass)->__invoke()]; // Imprime In:123Out:123


// $bind = new BindClosure();

//$bind->teste = function(){
//    echo $this->nome;
//};

//$bind->teste();

