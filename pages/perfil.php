<?php require("../includes/topo.php"); ?>
<div class="container" style="margin:bottom:50px;">
	<?php

        $postagemdao = new PostagemDAO();

	if(isset($_GET['id'])){
	$fk_user = $_GET['id'];
	
	///$postagemdao = new PostagemDAO();
	///$postagemdao->dadosperfil($fk_user);

        

	?>
<div class="row">

  <div class="col-sm-12" style="margin-top:80px;">
    <div class="card">
	<div class="row">
      <div class="card-body">
          <?php 
        
          
        $usuariodao = new UsuarioDAO();
	    foreach ($usuariodao->perfil($fk_user) as $value) { 
          ?>
          <div class="float-left col-md-3">
            <img src="fotoperfil/<?php echo $value['foto']; ?>" style="width:230px; height:230px;" class="rounded-circle img-thumbnail img-fluid float-left" alt="...">
          </div>
          <h3><?php echo $value['nome']; ?></h3><br>
          <p style="bold"><?php echo $value['cidade']; ?>
          <br>
          <p><?php echo $value['bio']; ?></p>
          
          
        

        <br>

          

<ul class="list-inline">
    <?php if(!empty($value['facebook'])){ ?>
  <li class="list-inline-item">
      
      <div class="sc-truncate">
            <a href="<?php echo $value['facebook']; ?>" target="_blank" rel="me nofollow" class="web-profile sc-link-light sc-social-logo-interactive">
               <img src="imagens/facebook.png" style="width:40px;">
            </a>
    </div>
    </li>
 <?php } ?>

    
    
        <?php if(!empty($value['instagram'])){ ?>
  <li class="list-inline-item">
      
      <div class="sc-truncate">
            <a href="<?php echo $value['instagram']; ?>" target="_blank" rel="me nofollow" class="web-profile sc-link-light sc-social-logo-interactive">
               <img src="imagens/instagram.png" style="width:40px;">
            </a>
    </div>
    </li>
 <?php } ?>
    

    
            <?php if(!empty($value['telefone'])){ ?>
  <li class="list-inline-item">
      
      <div class="sc-truncate">
            <a  target="_blank" rel="me nofollow" class="web-profile sc-link-light sc-social-logo-interactive">
                <img src="imagens/phone.png" style="width:40px; height:;"></a><b><?php echo $value['telefone']; ?></b>
            
    </div>
    </li>
 <?php } ?>
    
    
</ul>
          
          <?php } ?>
	  </div>
    </div>
  </div>

</div>
</div>
<br>
	
	<div class="row" >
	<?php
	

	
	$postagemdao = new PostagemDAO();
	foreach ($postagemdao->perfil($fk_user) as $value) { 
	
	?>
		
        <div class="col-lg-4 col-sm-6 col-12 " style="margin-bottom:30px;">
            <!-- <div class="shadow mb-5 bg-white "> -->
             <img class="card-img-top" src="upload/<?php echo $value['imagem']; ?>"  alt="Card image cap">
            <div class="card">
              <div class="card-body" style="height: 300px;">
                <h5 class="card-title"><?php echo mb_strimwidth($value['titulo'],0, 35 , "..."); ?></h5>
                <p class="card-text text-justify"><?php echo mb_strimwidth($value['descricao'],0, 138 , "..."); ?></p>
                  <div class="card-body"  style="position: absolute; left:0;    bottom: 0;">
                      <?php if(isset($_SESSION['iduser']) && ($_SESSION['iduser'] == $fk_user )){ ?>
                        <form action="editar-postagem" method="post" style="display: inline-flex;" >
                            <input name="idpost" type="hidden" value="<?php echo  $value['id']; ?>"/>
                            <button style="background-color:#fff; border:1px solid #ccc; cursor:pointer;"  type="submit" ><i class="material-icons" >create</i>Alterar</button>
                        </form>
                      
                        <form class="excluirpost"  style="display: inline-flex;" >
                            <input  id="iddelete"  type="hidden" value="<?php echo $value['id']; ?>"/>
                            <button  style="background-color:#fff; border:1px solid #ccc; cursor:pointer;"  onclick="return confirm('excluir?')" type="submit" ><i class="material-icons" >delete</i>Excluir</button>
                        </form>
                      <?php   } ?>
                      <a href="ver-postagem/<?php echo $value['id'];?>" style="display: inline-flex; border:0;" >
                        <input  type="hidden"  type="submit" value="<?php echo $value['id'] ; ?>"/>
                            <button  style="background-color:#fff; border:1px solid #ccc; cursor:pointer;"  type="submit" ><i class="material-icons" >visibility</i>Ler mais</button>
                          </a>
                         
                  </div>
              </div>
            </div>
          <!--</div>-->
          </div>
	<?php } } ?>
	</div>
	</div>
<div style="margin-bottom:100px;"></div>



<?php require("../includes/footer.php"); ?>





<script>
      
      
    $(function(){
                $('.excluirpost').on('submit', function(){
                   var iddelete = $('#iddelete').val();
                   
                    //alert(busca);
                   $.ajax({
                        url: 'pages/excluirpost.php',
                        data: {iddelete},
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