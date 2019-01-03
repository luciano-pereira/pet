<?php 
session_start();
require_once '../classes/comentario.class.php'; 
require_once '../classes/comentariodao.class.php';






			if (isset($_POST['respondercoment']) && isset($_POST['idc'])){
				$comentariodao = new comentarioDAO();
				$comentario = new comentario();
                
				 $respondercoment = $_POST['respondercoment'];
				 $idc = $_POST['idc'];
				 $lido = $_POST['lido'];
				 $dono = $_POST['dono'];
                
				$comentario->comentario = $respondercoment;
				$comentario->nome = $_SESSION['nome'];
				$comentario->fk_user = $_SESSION['iduser'];
				$comentario->fk_post = $_SESSION['idurl'];
				$comentario->resposta = $idc ;
				$comentario->lido = $lido ;
				$comentario->dono = $dono ;
                
				
				$comentariodao->grava($comentario);
			}



?>
