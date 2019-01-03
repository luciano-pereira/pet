<?php require("../includes/topo.php"); ?>


    <div class="container" style="margin-top:90px;">

        

                  <div class="card col-md-10 offset-md-1" style="margin-bottom: 30px;"><!-- card col-md-8 -->
<form id="cadpost" method="post" enctype="multipart/form-data">
<div class="row">
  <div class="form-group col-md-6">
    <label for="exampleFormControlInput1">Titulo</label>
    <input type="text" class="form-control" id="titulo" name="titulo" required>
  </div>
<div class="form-group col-md-6">
    <label for="exampleFormControlFile1">Escolha uma foto</label>
    <input type="file" class="form-control" id="img" name="img[]" required >
  </div>
</div>
  <div class="form-group">
    <label for="exampleFormControlTextarea1">Descrição</label>
    <textarea class="form-control" name="descricao" id="descricao" rows="3" required></textarea>
  </div>
<input class="btn btn-primary" type="submit" name="cadastrar" value="cadastrar">
</form>
          </div>
	<div class="row">


    <div id="load_dado" class="row" ></div>
    <div id="load_dado_message"></div> 
        
        
   <div id="load_data" class="row" ></div>
    <div id="load_data_message"></div>
        
        
        
     </div>

	</div>

      
    
<div style="margin-bottom:100px;"></div>
	
<?php require("../includes/footer.php"); ?>
      
<script>
      
      
    $(function(){
                $("#cadpost").on('submit', function(){
                   var form = $('#cadpost')[0];
                   var formData = new FormData(form);
                   $.ajax({
                        url: 'pages/cadpost.php',
                        data: formData,
                        cache: false,
                        type: 'POST',
                        cache: false,
                        processData: false, 
                        contentType: false, 
                       success: function(data){
                            window.location.reload();

                            $('#cadpost')[0].reset();
 
                       }
                    });                
                    return false;
                });

                });
          
      
   
</script>
      

        
<script>
 
    $(function(){
 
 var limit = 6;
 var start = 0;
 var action = 'inactive';
 function load_country_data(limit, start) {
  $.ajax({
   url:"fetch",
   method:"POST",
   data:{limit:limit, start:start},
   cache:false,
   success:function(data)
   {
    $('#load_data').append(data);
    if(data == '')
    {
     $('#load_data_message').html("");
     action = 'active';
    }
    else
    {
     $('#load_data_message').html("<img src='imagens/ic.gif' style='height:60px; width:100px;'>");
     action = "inactive";
    }
   }
  });
 }

 if(action == 'inactive')
 {
  action = 'active';
  load_country_data(limit, start);
 }
 $(window).scroll(function(){
  if($(window).scrollTop() + $(window).height() > $("#load_data").height() && action == 'inactive')
  {
   action = 'active';
   start = start + limit;
   setTimeout(function(){
    load_country_data(limit, start);
   }, 2000);
  }
 });
 
});
   
</script>
                
      

      
      
      
      
<script>
      
      
    $(function(){
                $("#ir").on('submit', function(){
                   var busca = $("#palavra").val();
                   var limit = $("#limit").val();
                   var start = $("#start").val();
                    
                    //alert(busca);
                    //alert(limit);
                    //alert(start);
                    
                   var vazio = null;
                   $('#load_dado').html(vazio);
                    
                   $('#load_data').remove();
                   $('#load_data_message').remove();

                   var action = 'inactive';
                   
                     function load_country_dado(busca, limit, start) {
                          $.ajax({
                           url:"pesquisa",
                           method:"POST",
                           data:{busca, limit, start },
                           cache:false,
                           success:function(data)
                           {
                            $('#load_dado').append(data);
                            if(data == '')
                            {
                             $('#load_dado_message').html("");
                             action = 'active';
                            }
                            else
                            {
                             $('#load_dado_message').html("<img src='imagens/ic.gif' style='height:60px; width:100px;'>");
                             action = "inactive";
                            }
                           }
                          });

                         }
                    
                    
                     if(action == 'inactive')
                         {
                          action = 'active';
                          load_country_dado(busca, limit, start);
                         }
                         $(window).scroll(function(){
                          if($(window).scrollTop() + $(window).height() > $("#load_dado").height() && action == 'inactive')
                          {
                           action = 'active';
                           start = start + limit;
                           setTimeout(function(){
                            load_country_dado(busca, limit, start);
                           }, 2000);
                          }
                         });
                return false;

                });

                });
          
      
   
</script>

