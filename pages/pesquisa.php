<?php
require("../classes/postagemdao.class.php"); 

if (isset($_POST['busca']) ){
    
      $busca = $_POST['busca'];
    $busca = preg_replace('/[ %]+/' , '%' , $busca);
     $limit = $_POST["limit"]; 
     $start = $_POST["start"];

$postagemdao = new PostagemDAO();

 $postagemdao->busca($busca, $start, $limit);   
}


	

?>