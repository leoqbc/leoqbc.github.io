<?php

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

$crazy = new Crazy;

$crazy['Hello']
        ['world']->color('blue')
        ['what`s up?']
        ['is this']->color('red')
        ['too']
        ['crazy for you?']->color('green')
        ->write();
        
