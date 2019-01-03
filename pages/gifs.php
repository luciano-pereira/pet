<?php require("../includes/topo.php");
require_once("../classes/postagemdao.class.php");
require_once("../classes/postagem.class.php");


	if(isset($_POST['cadastrar'])){
		 $iframe = $_POST['iframe'];

		 
		 $postagem = new Postagem();
		 $postagemdao = new PostagemDAO();
		 $postagem->iframe =  $iframe;
		 $postagem->fk_user =  $_SESSION['iduser'];
		 $postagemdao->gravargif($postagem);

	}
?>




<div class="container" style="margin-top:80px;">
<?php 

if(isset($_SESSION['nivel']) && ($_SESSION['nivel'] == 1)){

?>
<h1>Cadastrar gifs</h1>
<form action="" method="post">
    <div class="form-group">
    <label for="exampleInputEmail1">url do gif</label>
    <input type="text" class="form-control" name="iframe">
  </div>
  <button type="submit" class="btn btn-primary"  name="cadastrar">cadastrar</button>
</form>

<?php } ?>
<h2>Gifs de animais</h2>
<?php

	$pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1; 
	
	$qnt_pagina = 2;
	
	$inicio =  ($qnt_pagina * $pagina) - $qnt_pagina;
	$postagemdao = new PostagemDAO();
	$postagemdao->listargif($pagina, $inicio, $qnt_pagina);
?>
    

</div>

<div style="margin-bottom:100px;"></div>

<?php require("../includes/footer.php"); ?>