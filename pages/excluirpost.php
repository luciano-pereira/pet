<?php 

require_once '../classes/postagemdao.class.php';



    $postagemdao = new PostagemDAO();
	if(isset($_POST['iddelete'])){
	$id_delete = $_POST['iddelete'];
	$postagemdao->excluir($id_delete);
        
    }


?>