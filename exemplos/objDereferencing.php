<?php

class Robot
{
    // ...
    public function getBag()    
    {
        return ['arms','legs','shoulders','head'];
    }
    // ...
    public function sayHello()
    {
        echo 'Hello Human';
    }
}

// Gangsta style execute sayHello
(new Robot)->sayHello(); // Imprime: Hello Human

// 
echo (new Robot)->getBag()[1]; // Imprime: legs