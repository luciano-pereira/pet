<?php 
require_once '../includes/topo.php';
require_once '../classes/comentario.class.php'; 
require_once '../classes/comentariodao.class.php';


if(isset($_POST['descricao'])){
    
				$comentariodao = new comentarioDAO();
				$comentario = new comentario();
                
				$coment = $_POST['descricao'];
                $resposta = $_POST['resposta'];
                $lido = $_POST['lido'];
                $dono = $_POST['dono'];
                
				$comentario->comentario = $coment;
				$comentario->nome = $_SESSION['nome'];
				$comentario->fk_user = $_SESSION['iduser'];
				$comentario->fk_post = $_SESSION['idurl'];
				$comentario->resposta = $resposta ;
				$comentario->lido = $lido ;
				$comentario->dono = $dono ;
                
                
				
				$comentariodao->grava($comentario);


}