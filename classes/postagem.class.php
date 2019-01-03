<?php

class Postagem {
	private $id;
	private $titulo;
	private $data;
	private $descricao;
	private $imagem;
	private $fk_user;
	private $idpost;
	private $autor;
    private $imgantes;
	
	public function __set($atributo, $valor){
        $this->$atributo = $valor;
    }
    
    public function __get($atributo){
        return $this->$atributo;
    }
	
	
}

?>