<?php

class Conexao{
    private static $instancia;
    private $conexao;
    
    protected function __construct(){
        $servidor='localhost';
        $usuario='root';
        $senha='';
        $nomedb='pet';

        try{
            $this->conexao = new PDO('mysql:host='.$servidor.';dbname='.$nomedb, $usuario, $senha);
            $this->conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
        echo 'ERRO: '.$e->getMessage();
    }
}
    
    public static function getInstancia(){  
        if(!self::$instancia)
            self::$instancia = new self();
        return self::$instancia;
    }

    public function getConexao(){
        return $this->conexao;
    }
}
    
?>
