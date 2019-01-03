<?php
require("../classes/postagemdao.class.php"); 

if(isset($_POST["limit"], $_POST["start"])){
    
    $limit = $_POST["limit"]; 
    $start = $_POST["start"];

$postagemdao = new PostagemDAO();
$postagemdao->findAll($start, $limit);
    
}

?>