<?php

class Comentario {
	private $idc;
	private $comentario;
	private $nome;
	private $k_user;
	private $fk_post;
	private $resposta;
	private $lido;
	private $idurl;
	private $dono;
	
	public function __set($atributo, $valor){
        $this->$atributo = $valor;
    }
    
    public function __get($atributo){
        return $this->$atributo;
    }
	
	
}

?>