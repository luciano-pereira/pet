<?php 
require_once '../includes/topo.php';
require_once '../classes/comentario.class.php'; 
require_once '../classes/comentariodao.class.php';


	if(isset($_GET['id'])){
		$idurl = $_GET['id'];
		$_SESSION['idurl'] = $idurl;
	$postagemdao = new PostagemDAO();
	foreach ($postagemdao->idurl($idurl) as $value) { 
	
	?>
		
        <div class="container" style="margin-top:100px; ">
            
         <div class="col-lg-8" >   <!-- col-lg-8 col-md-10 mx-auto -->
        <div class="card mb-4" >
                    <img class="card-img-top" src="upload/<?php echo $value['imagem']; ?>"  alt="">
                    <div class="card-body">
                      <h2 class="card-title"><?php echo $value['titulo']; ?></h2>
                      <p class="card-text text-justify"><?php echo $value['descricao']; ?></p>

                    </div>
                    <div class="card-footer text-muted">
                      Postado na data <?php echo $value["data"]; ?> por
                      <a href="perfil/<?php echo $value["fk_user"]  .'/'. $value["autor"]; ?>"><?php echo $value["autor"]; ?></a>
                    </div>
            <div class="card-footer " style="background-color:#fff;">
                                  <div class="form-group">
                    <label for="exampleFormControlTextarea1">Comente</label>
                    <form id="formcoment" method="post">
                    <textarea class="form-control" id="descricao" name="comentario" rows="3"></textarea>
                     <input name="resposta" id="resposta" type="hidden" value="<?php echo '0'; ?>  "/>
                     <input name="dono" id="dono" type="hidden" value="<?php echo $value["fk_user"]; ?>  "/>
                     <input name="lido" id="lido" type="hidden" value="<?php if($_SESSION['iduser'] == $value["fk_user"]){ echo '0';}else{echo '1';} ?>  "/>
                        
                    <button type="submit" class="btn btn-primary">comentar</button>
                    </form>
                  </div>
             
                  
            
            
    

            
            <?php
                $comentariodao = new ComentarioDAO();
                $comentariodao->listarcoment($idurl);

            ?>
                
                
                
                
                  </div>
                  </div>
             

        </div>

            <div style="margin-bottom:100px;"></div>
            

        
        
        
        

			<?php }} ?>
        </div>	



<?php require("../includes/footer.php"); ?>

<script>
    
$(document).ready(function(){
    $(".resp").click(function(){
        $(this).siblings(".respinput").toggle();
    });
});


    
    
        $(function(){
                $(".formresp").on('submit', function(){

                   $.ajax({
                       url: 'pages/enviacoment.php',
                        data: {
                            respondercoment:$(this).children("#respondercoment").val(),
                            lido:$(this).children("#lido").val(),
                            idc:$(this).children("#idc").val(),
                            dono:$(this).children("#dono").val()
                        },
                        cache: false,
                        type: 'POST', 
                       success: function(data){
                            window.location.reload();

 
                       }
                    });                
                    return false;
                });

                });
    
    
    
            $(function(){
                $("#formcoment").on('submit', function(){
                        var descricao = $("#descricao").val();
                        var resposta = $("#resposta").val();
                        var lido = $("#lido").val();
                        var dono = $("#dono").val();
                   $.ajax({
                       url: 'pages/cadcomentario.php',
                        data: {descricao, resposta, lido, dono},
                        cache: false,
                        type: 'POST', 
                       success: function(data){
                            window.location.reload();

 
                       }
                    });                
                    return false;
                });

                });

</script>



