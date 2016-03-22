<?php

class Request extends \ArrayIterator
{
    public function checkSend() 
    {
        $class = get_class($this);
        if($class != $_SERVER['REQUEST_METHOD']) {
            header('Wrong Request', true, 404);
            echo '<h1>Wrong REQUEST_METHOD!';
            exit;
        }
    }
    public function offsetSet($url, $action)
    {
        $this->exec($url, $action);
        return $this;
    }
    
    public function offsetGet($url)
    {
        $this->url = $url;
        return $this;
    }
    
    public function to($url)
    {
        $this->url = $url;
        return $this;
    }
    
    public function exec($url, callable $action)
    {
        if ($_SERVER['PATH_INFO'] == $url) {
            $this->checkSend();
            echo $action();
        }
    }
    
    public function doing(callable $action)
    {
        $this->exec($this->url,$action);
    }
    
    public function __call($name, $args)
    {
        $this->$name = $args[0];
        return $this;
    }
    
    public function action($action)
    {
        $this->exec($this->url, function() use ($action){
            $controller = new $this->controller();
            echo $controller->$action();
        });
    }
}

class GET extends Request
{
    
}

class POST extends Request
{
    
}

class Carro
{
    public function index()
    {
        return 'FOI!!';
    }
    public function hello()
    {
        return 'Hola! mundo..';
    }
}

$get = new GET;
$post = new POST;

$request = (object)[
    'method'    => new GET, 
    'url'       => '/teste', 
    'action'    => function() {
        return 'Melhor hein!';
    }
];

$request->method[$request->url] = $request->action;

$get->controller('Carro');

(new GET)['/ola']
        ->controller('Carro')
        ->action('hello');

$get['/hella']->action('hello');

$post['/form'] = function () {
    return 'Isso é um POST';
};

request('GET')->to('/delete')->doing(function(){
    return 'DELETE!';
});

get()
    ->to('/do/it')
    ->doing(function(){
    return 'Doing it!';
});

get()
    ->to('/cliente')
    ->controller('Carro')
    ->action('hello');

request('POST')
        ->to('/cliente')
        ->controller('Carro')
        ->action('hello');

function get()
{
    return new GET;
}

function request($type)
{
    return (new $type);
}