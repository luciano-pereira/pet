    <?php
session_start();
require_once("../classes/postagemdao.class.php");
require_once("../classes/postagem.class.php");


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





	if(isset($_POST['cadastrar'])){
		 $titulo = $_POST['titulo'];
		 $iframe = $_POST['iframe'];
        
		 $postagem = new Postagem();
		 $postagemdao = new PostagemDAO();
		 $postagem->titulo = $titulo;
		 $postagem->iframe = $iframe;
		 $postagem->fk_user = $_SESSION['iduser'];
		 $postagemdao->cadpodcast($postagem);

	}
?>