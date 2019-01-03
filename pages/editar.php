<?php require("../includes/topo.php"); ?>
<div class="container" style="margin-top:80px;">
<div class="col-md-8 order-md-1">
          <h4 class="mb-3">Editar perfil</h4>
    
    
    <?php
    $id = $_SESSION['iduser'];
        $usuariodao = new UsuarioDAO();
    foreach($usuariodao->selecionadadouser($id) as $value) { ?>
        <div id="msg"></div>
          <form class="needs-validation" id="edtuser">
            <input type="hidden" id="id"  name="id" value="<?php echo $id; ?>">
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="firstName">nome</label>
                <input type="text" class="form-control" id="nome" name="nome" placeholder="" value="<?php echo $value['nome']; ?>" required="">
                <div class="invalid-feedback">
                  Valid first name is required.
                </div>
              </div>
                
                            <div class="col-md-6 mb-3">
              <label for="email">Email</label>
              <input type="email" class="form-control" id="email" name="email" value="<?php echo $value['email']; ?>" placeholder="you@example.com">
              <div class="invalid-feedback">
                Please enter a valid email address for shipping updates.
              </div>
            </div>
            </div>



            <div class="mb-3">
              <label for="address2">foto </label>
              <input type="file" class="form-control" id="imagem" name="img[]"  >
              <input type="hidden" class="form-control" id="imagem" value="<?php echo $value['foto']; ?>" name="imgantes"  >
            </div>
              

            <div class="mb-3">
              <label for="address2">cidade </label>
              <input type="text" class="form-control" id="cidade" name="cidade" value="<?php echo $value['cidade']; ?>" placeholder="cidade">
            </div>
            <div class="mb-3">
              <label for="address2">bio </label>
              <input type="text" class="form-control" id="bio" name="bio" value="<?php echo $value['bio']; ?>" placeholder="diga algo sobre voce">
            </div>
            <div class="mb-3">
              <label for="address2">facebook </label>
              <input type="text" class="form-control" id="facebook" name="facebook" value="<?php echo $value['facebook']; ?>" placeholder="cole o link do seu facebook aqui">
            </div>
            <div class="mb-3">
              <label for="address2">instagram </label>
              <input type="text" class="form-control" id="instagram" name="instagram" value="<?php echo $value['instagram']; ?>" placeholder="cole o link do seu instagram aqui">
            </div>
            <div class="mb-3">
              <label for="address2">telefone </label>
              <input type="text" class="form-control" id="tel" name="tel" value="<?php echo $value['telefone']; ?>" placeholder="(16)32024654">
            </div>
            <hr class="mb-4">
            <button class="btn btn-primary btn-lg btn-block" type="submit">editar</button>
          </form>
    
<?php }    ?>
        </div>
    
    
    
</div>
<div style="margin-bottom:100px;"></div>

<?php require("../includes/footer.php"); ?>




<script>
      
      
    $(function(){
                $("#edtuser").on('submit', function(){
                   var form = $('#edtuser')[0];
                   var formData = new FormData(form);
                   $.ajax({
                        url: 'pages/edtuser.php',
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