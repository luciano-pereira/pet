<?php
require_once '../includes/topo.php'; 
require_once '../classes/postagemdao.class.php';
require_once '../classes/postagem.class.php';



?>
<div class="container" style="margin-top:80px;" >

<h1>Editar postagem</h1>
    
<?php
    	
    if(isset($_POST['idpost'])){
	$idpost = $_POST['idpost'];
	$_SESSION['idpostedt'] = $idpost;
 
    $postagemdao = new PostagemDAO();
    foreach($postagemdao->idpost($idpost) as $value) { ?>
  <div id="msg"></div>  
<form id="edtpost" enctype="multipart/form-data" style="margin-bottom:80px;">
<div class="row">
  <div class="col">
    <label for="titulo">Titulo</label>
    <input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo $value['titulo']; ?>" placeholder="titulo da postagem">
  </div>
  </div>
  <div class="form-group">
    <label for="imagem">Imagem</label>
    <input type="file" class="form-control" id="imagem" name="img[]"  >
    <input type="hidden" class="form-control" id="imagem" value="<?php echo $value['imagem']; ?>" name="imgantes"  >
  </div>
  <div class="form-group">
    <label for="descricao">Descrição</label>
    <textarea class="form-control" id="editor" name="descricao" rows="" style="resize:vertical" placeholder="descreva aqui.."><?php echo $value['descricao']; ?></textarea>
  </div>
  <input class="btn btn-primary" type="submit" name="atualizar" value="atualizar" style="margin-bottom: 50px;">
</form>

<?php }} ?>
</div>



<?php require("../includes/footer.php"); ?>



<script>
      
      
    $(function(){
                $("#edtpost").on('submit', function(){
                   var form = $('#edtpost')[0];
                   var formData = new FormData(form);
                   $.ajax({
                        url: 'pages/edtpost.php',
                        data: formData,
                        cache: false,
                        type: 'POST',
                        cache: false,
                        processData: false, 
                        contentType: false, 
                       success: function(data){
             
                           
                            $("#msg").html(data); 
                           
 
                       }
                    });                
                    return false;
                });

                });
          
      
   
</script>