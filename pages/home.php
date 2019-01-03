<?php
session_start();
?>
<!doctype html>
<html lang="pt-br">
  <head>
    <title>pet</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<base href="<?php echo 'http://localhost/pet/'; ?>" />
    <style>

  
.d-md-block {
    display: inline!important;
}
        
        .carousel-caption {
    position: absolute;
     right: 0%; 
    bottom: 20px;
    left: 0%;
    z-index: 0;
    padding-top: 0px;
    padding-bottom: 0px;
    color: #fff;
    text-align: center;
}
        



    </style>
  </head>
  <body>
     <header>

     <nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
    <div class="container">
     <a class="navbar-brand" ><img src="imagens/logo.png" style="height:40px;"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
       <i class="material-icons">menu</i>
      </button>

        
      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
        </ul>
        <form class="form-inline my-2 my-lg-0" method="post" action="" enctype="multipart/form-data">
		  <input class="form-control mr-sm-2" type="email" placeholder="email" name="email" style="border-color:#004d40">
          <input class="form-control mr-sm-2" type="password" placeholder="senha" name="senha" style="border-color:#004d40">
		  
          <button class="btn btn-primary" id="logar" type="submit" name="logar">entrar</button>
        </form>
      </div>
     </div>
    </nav>

	</header>
	


      <div class="container" >
    	<?php
	
	require_once '../classes/usuario.class.php';
	require_once '../classes/usuariodao.class.php';
	
	
	
	if(isset($_POST['logar'])){
		$email = $_POST['email'];
		$senha = $_POST['senha'];
		$usuariodao = new UsuarioDAO();
		$usuario = new Usuario();	 
		$usuario->email = $email;
		$usuario->senha = $senha;	 
		$usuariodao->logar($usuario);
	}
          
    if (isset($_POST['cad'])){
		$usuariodao = new UsuarioDAO();
		$usuario = new Usuario();
        
		$nome = $_POST['nome'];
		$email = $_POST['email'];
		$senha = $_POST['senha'];
		$city = "";
		$facebook = "";
		$instagram = "";
		$telefone = "";
		$bio = "";
		$foto = "perfil.png";
		$nivel = "";

		$usuario->nome = $nome;
		$usuario->email = $email;
		$usuario->senha = $senha;
		$usuario->cidade = $city;
		$usuario->facebook = $facebook;
		$usuario->instagram = $instagram;
		$usuario->telefone = $telefone;
		$usuario->foto = $foto;
		$usuario->nivel = $nivel;
		
		$usuariodao->grava($usuario);
	}
?>
          
<div class="row my-4">
        <div class="col-lg-8">
            
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
      
  </ol>

  <div class="carousel-inner" >
    <div class="carousel-item active" >
          <img class="img-fluid " id="img" src="imagens/c3.jpg" style="width:100%; height:30rem;" alt="">

    </div>
    <div class="carousel-item" >
            <img class="" id="img" src="imagens/baner.jpg" style="width:100%; height:30rem;" alt="">

    </div>
                           <div class="carousel-caption d-none d-md-block " style="width:100%;   background: #000;   opacity: 0.7">
            <h3>Eles precisam da sua ajuda.</h3>
            <p>abra uma conta e comece a ajudá-los</p>
          </div>   
  </div>

  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>

</div>
            
      

        </div>
        <!-- /.col-lg-8 -->
        <div class="col-lg-4" style="border: 1px solid #ccc;">
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
      <form method="post" action="" class="form-signin"><br><br>
        <h2 class="form-signin-heading text-center">Cadastre-se</h2><br>
    <div class="form-group row">
    <label for="staticEmail" class="col-sm-2 col-form-label">Nome</label>
    <div class="col-sm-10">
      <input type="text" class="form-control"  name="nome" required placeholder="digite seu nome">
    </div>
  </div>
<div class="form-group row">
    <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
    <div class="col-sm-10">
      <input type="email" class="form-control"  name="email" required placeholder="digite seu email">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputPassword" class="col-sm-2 col-form-label">Senha</label>
    <div class="col-sm-10">
      <input type="password" class="form-control"  name="senha" required placeholder="sigite sua senha">
    </div>
  </div>
<br>
        <button class="btn btn-lg btn-primary btn-block" name="cad" type="submit">Cadastrar</button>
      </form></div>

</div>
        </div>
        <!-- /.col-md-4 -->
      </div>
          
          <div class="container-fluid"><br>
<h3 class="text-center">Como ajudar os animais ?</h3><br><br>
        <!-- Three columns of text below the carousel -->
        <div class="row">
          <div class="col-lg-4">
            <div class="card" >
  <div class="card-body">
    <h5 class="card-title">Doação</h5>
    <p class="card-text">Faça uma postagem de um animal para doação, doe tambem  ração, remedio etc.</p>
  </div>
</div>
</div>

                      <div class="col-lg-4">
            <div class="card" >
  <div class="card-body">
    <h5 class="card-title">Adoção</h5>
    <p class="card-text">Com o sistema você conseguira encontrar um novo companheiro.</p>
  </div>
</div>
</div>
            
                                  <div class="col-lg-4">
            <div class="card" >
  <div class="card-body">
    <h5 class="card-title">Lar temporário</h5>
    <p class="card-text">Você pode dar um lar temporario para um animal de rua enquanto tenta encontrar o antigo ou novo dono.</p>
  </div>
</div>
</div>

        </div><!-- /.row -->


      </div>
      



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    <script>
        
        $(function() {
                setTimeout(function(){
            $(".alert").hide(".close"); 
        }, 4000);
        });
    </script>
  </body>
</html>