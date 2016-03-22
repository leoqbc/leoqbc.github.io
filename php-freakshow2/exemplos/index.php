<?php

// freak show :O
function __($class, array $parm=[]) {
    return new $class(...$parm);
}

class FreakPower extends \ArrayObject
{
    public $funcs = [];
    
    public function __construct()
    {
        var_dump(func_get_args());
    }

    public function offsetget($value) 
    {
        $this->funcs[] = $value;
        return $this;
    }
    
    public function fire()
    {
        shuffle($this->funcs);
        foreach ($this->funcs as $func) {
            $func();
        }
    }
}

__('FreakPower')
    [function () {
        echo '1';
    }][function () {
        echo '2';
    }][function () {
        echo '3';
    }][function () {
        echo '4';
    }][function () {
        echo '5';
    }];
//->fire();
    
$freak = 'ola';
$ola = 'como';
$como = 'vai';
$vai = 'voce';
$voce = 'cara';
$cara = 'zoeira';
$zoeira = 'never ends!';

echo $$$$$$$freak;
    
    
class Robot
{
    private $precious1 = 'Nooo 1';
    protected $precious2 = 'Nooo 2';
    
    public function __get($prop)
    {
        return $this->$prop;
    }
}

//$rb = new Robot;
//echo $rb->precious1;
//echo $rb->precious2;


class Crazy implements \ArrayAccess
{
    public function offsetExists($offset)
    {
        
    }
    public function offsetGet($offset) 
    {
        $this->phrase[] = $this->tagIn() . $offset . $this->tagOut();
        return $this;
    }
    public function offsetSet($offset, $value) 
    {
        
    }
    public function offsetUnset($offset) 
    {
        
    }
    
    public function tagIn()
    {
        return '<p>';
    }
    
    public function tagOut()
    {
        return '</p>';
    }
    
    public function color($colorHex)
    {
        $last = &$this->phrase[count($this->phrase)-1];
        $last = '<div style="color: ' . $colorHex .'">'
                . $last . '</div>';
        return $this;
    }
    
    public function write()
    {
        foreach($this->phrase as $phrase) {
            echo $phrase;
        }
    }
}

(new Crazy)
    ['só da']->color('brown')
    ['louco']
    ['aqui']->color('red')
    ['olha o que']
    ['esse barba']
    ['esta']->color('blue')
    ['fazendo']
    ['que']->color('red')
    ['maluco']
    ['das']->color('green')
    ['ideias']
->write();
