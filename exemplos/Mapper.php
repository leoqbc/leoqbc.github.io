<?php

class Funcionario implements \ArrayAccess
{
    private $pdo;
    
    public function __construct() 
    {
        $this->pdo = new PDO('mysql:dbname=sistema', 'root', '');
    }
    
    public function offsetExists ( $offset ) 
    {
        return (bool)$this->pdo
                ->query('SELECT * FROM funcionarios WHERE id=' . $offset)
                ->fetch(PDO::FETCH_OBJ);
    }
    
    public function offsetGet ( $offset )
    {
        $stmt = $this->pdo
                ->query('SELECT * FROM funcionarios WHERE id=' . $offset);
        foreach($stmt->fetch(PDO::FETCH_OBJ) as $prop => $val) {
            $this->$prop = $val;
        }
        return $this;
    }
    
    public function offsetSet ( $offset , $value )
    {
        echo 'Adicionou: ' . $value . ' na chave ' . $offset;
    }
    
    public function offsetUnset ( $offset ) 
    {
        
    }
    
    // Isso ta mal feito, e pode melhorar muito!
    public function __call($prop, $val) 
    {
        if (isset($this->$prop)) {
            $this->pdo->query("UPDATE funcionarios SET $prop='{$val[0]}'");
        }
        return $this;
    }
    
    public function nome($nome)
    {
        if (!is_string($nome)) {
            throw new Exception('Nome deve ser string', 500);
        }
        $this->nome = $nome;
        return $this;
    }
}

// Strange Data Mapper
// Update data
(new Funcionario)[2]
        ->nome('Leonardo')
        ->endereco('Rua 123, teste 12')
        ->email('novoemail@teste.com');

// Get data from Database
$funcionario = (new Funcionario)[2];
echo $funcionario->nome; // Imprime nome do funcionario id 2


