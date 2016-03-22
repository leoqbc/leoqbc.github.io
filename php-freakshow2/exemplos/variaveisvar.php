<?php

$first = 'what';
$what = 'the';
$the = 'hell';
$hell = 'is this!!';

echo $$$$first;

class Robot
{
    private $mine='No!!';
    protected $name;
    protected $serialNum;
    
    public function __construct($name, $serialNum)
    {
        $this->name = $name;
        $this->serialNum = $serialNum;
    }
    
    public function getProp($prop)
    {
        return $this->$prop;
    }
    
    public function say($words)
    {
        echo $words;
    }
}

$robot = new Robot('Mike', 436878);
$mine = $robot->getProp('mine');
var_dump($mine);

// The Freak!
$obj = 'myRobot';
$class = 'Robot';
$param1 = 'Robotron';
$param2 = 5532;       
$method = 'say';
$word = 'Hello Humans';

$$obj = (new $class($param1, $param2))->$method($word);

