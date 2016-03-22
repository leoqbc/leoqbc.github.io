<?php

class DataMaker
{
    const TO_OBJ = 1;
    const TO_CLASS = 256;
    const TO_ARRAY = 512;
    
    protected $matrix;
    
    public function __call($name, $args) 
    {
        $this->matrix[$name] = $args[0];
        return $this;
    }
    
    public function make($return=self::TO_ARRAY, $class=null, $params=null)
    {
        switch ($return) {
            case self::TO_ARRAY:
                return $this->matrix;
            case self::TO_OBJ:
                return (object)$this->matrix;
        }
    }
    
    protected function objHydrator($object)
    {
        foreach($this->matrix as $prop => $value) {
            $object->$prop = $value;
        }
        return $object;
    }
    
    public function toClass($className)
    {
        return $this->objHydrator(new $className());
    }
    
    public function toObject($obj)
    {
        return $this->objHydrator($obj);
    }
    
    public function __invoke($return=self::TO_ARRAY, $class=null, $params=null) 
    {
        return $this->make($return, $class, $params);
    }
}

class Customer
{
    
}

$dados = (new DataMaker)
        ->nome('Leonardo')
        ->telefone('11 97379-7752')
        ->endereco('Rua Teste 123')
        ->teste('colocando char especial')
        ->toClass('Customer');
        
var_dump($dados);
