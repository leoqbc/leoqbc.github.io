<?php

class Robot
{
    public function talk($parm1, $parm2)    
    {
        echo $parm1, $parm2;
    }
}

$arr = ['hello', 'world'];
// Old but GOLD
call_user_func_array([new Robot, 'talk'], $arr);

// OR WARNING PHP 5.6+
$robot = new Robot;
$robot->talk(...$arr);

