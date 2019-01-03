<?php

class Usuario{
	private $idl;
	private $nome;
	private $email;
	private $senha;
	
	private $emaillogado;
    private $senhalogado;
	private $cidade;
	private $facebook;
    private $instagram;
    private $telefone;
	private $bio;
	private $foto;
	private $nivel;
	 public function __set($atributo, $valor){
        $this->$atributo = $valor;
    }
    
    public function __get($atributo){
        return $this->$atributo;
    }

}


?>