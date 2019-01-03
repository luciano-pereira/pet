<?php require("../includes/topo.php"); ?>
<?php

require_once("../classes/postagemdao.class.php");
require_once("../classes/postagem.class.php");


	if(isset($_POST['cadastrar'])){
		 $titulo = $_POST['titulo'];
		 $descricao = $_POST['descricao'];
		 $imagem = $_FILES['img'];
		 $id = $_SESSION['iduser'];
		 
		 $postagem = new Postagem();
		 $postagemdao = new PostagemDAO();
		 $postagem->titulo = $titulo;
		 $postagem->data =  date('d-m-Y');
		 $postagem->descricao = $descricao;
		 $postagem->imagem = $imagem;
		 $postagem->autor = $_SESSION['nome'];
		 $postagem->fk_user = $id;
		 $postagemdao->gravar($postagem);

	}
?>



<main>
<div class="container" >
<h4>Cadastrar postagem</h4>
<form action="" method="post" enctype="multipart/form-data">
<div class="row">
  <div class="col">
    <label for="titulo">Titulo</label>
    <input type="text" class="form-control" id="titulo" name="titulo"  placeholder="titulo da postagem" required>
  </div>
  <div class="col">
    <label for="data">Data</label>
    <input type="text" class="form-control" id="data" value="<?php date_default_timezone_set('America/Sao_Paulo'); echo $dataLocal = date('d/m/Y H:i:s', time()); ?>" placeholder="data da postagem" readonly>
  </div>
 </div>
  <div class="form-group">
    <label for="imagem">Imagem</label>
    <input type="file" class="form-control" id="" name="img[]" >
  </div>
  <div class="form-group">
    <label for="imagem">Descrição</label>
    <textarea class="form-control" id="editor" name="descricao" rows="7" placeholder="descreva aqui.."></textarea>
  </div>
  <input class="btn btn-primary" type="submit" name="cadastrar" value="cadastrar">


</form>

</div>
</main>
<?php require("../includes/footer.php"); ?>