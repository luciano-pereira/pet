<?php
session_start();


 
require_once '../classes/postagemdao.class.php';
require_once '../classes/postagem.class.php';
require_once '../classes/usuariodao.class.php';
require_once '../classes/usuario.class.php';
require_once '../classes/comentario.class.php'; 
require_once '../classes/comentariodao.class.php';


                 	if(isset($_POST['sair'])){
                            UsuarioDAO::deslogar();
                    } 

if(isset($_SESSION['session_email'])){
$emaillogado = $_SESSION['session_email'];
//seleciona usuario
$usuariodao = new UsuarioDAO();
$usuario = new Usuario();
$usuario->emaillogado = $emaillogado;
$usuariodao->selectuserlogado($usuario);
}



?>




<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

     <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
      
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
      
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
      
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
      
      <base href="<?php echo 'http://localhost/pet/'; ?>" />

    <title>pet</title>
      <style>
    
          
          html {
  position: relative;
  min-height: 100%;
}
          
.embed-responsive .embed-responsive-item, .embed-responsive embed, .embed-responsive iframe, .embed-responsive object, .embed-responsive video {
    position: relative;
    top: 0;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 500px;
    border: 0;
}
          
          .dropdown-item {
    display: block;
    width: 100%;
    padding: .25rem 1.5rem;
    clear: both;
    font-weight: 400;
    color: #212529;
    text-align: inherit;
    white-space: nowrap;
    background-color: transparent;
    border: 0;
    cursor: pointer;
}
          
          .card-body {
    -ms-flex: 1 1 auto;
    flex: 1 1 auto;
    padding: 0.7rem;
}
          
.navbar-dark .navbar-nav .nav-link:focus, .navbar-dark .navbar-nav .nav-link:hover {
    color: #fff!important;
}
          
          .navbar-dark .navbar-nav .nav-link {
    color: #fff!important;
}

      </style>
  </head>
  <body>
        <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top"  >
      <div class="container">
     <a class="navbar-brand" ><img src="imagens/logo.png" style="height:40px;"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
              <?php

                        //server name é www
                        //server uri é url
        $url = "http://".$_SERVER['SERVER_NAME'].$_SERVER ['REQUEST_URI'];
              
               if($url == "http://localhost/pet/inicio"){
              
              ?>
      <li class="nav-item">
          <form method="post" id="ir" class="form-inline my-2 my-lg-0 mr-lg-2">
            <div class="input-group">
              <input class="form-control" autocomplete="off" id="palavra" name="palavra" type="text" style="width:300px;" placeholder="procure por doação, perdidos etc">
              <input  id="start" type="hidden"  value="0" >
              <input  id="limit" type="hidden"  value="6">
              <span class="input-group-append">
                <button class="btn btn-primary" type="submit" >
                  buscar
                </button>
              </span>
            </div>
          </form>
        </li> 
          
           <?php    } ?>
            <li class="nav-item active">
              <a class="nav-link" href="inicio">Inicio</a>
            </li>
            <li class="nav-item active">
              <?php if(isset($_SESSION['iduser']) && (isset($_SESSION['nome']))){
            ?>
              <a class="nav-link" href="perfil/<?php echo  $_SESSION['iduser'] . "/" . $_SESSION['nome']; ?>">Meu perfil</a>
           <?php } ?>
            </li>
           <?php if(isset($_SESSION['iduser']))  { ?>
         <li class="nav-item dropdown show">
             
            <a class="nav-link " href="http://example.com"  name="update" id="dropdown01 noti" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Notificação 
             </a>
                 
    
            <div class="dropdown-menu " aria-labelledby="dropdown01">
              <?php
        $fk_user = $_SESSION['iduser'];
        $comentariodao = new ComentarioDAO();
        $comentariodao->listalert($fk_user);
?>
            </div>
          </li>
            <?php  } ?>
            <li class="nav-item active">
              <a class="nav-link" href="gifs">Gifs</a>
            </li>
            <li class="nav-item dropdown" style="cursor:pointer;">
            <a class="nav-link dropdown-toggle" style="cursor:pointer;"  id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                

                <?php if(isset($_SESSION['nome'])){
               echo $_SESSION['nome'];
                }else{
                echo 'visitante';
            } ?>
                
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
                            <?php if(isset($_SESSION['nome'])){

  ?>
              <form action="" method="post">
              <button class="dropdown-item" name="sair" type="submit">sair</button>
              </form>
              <a class="dropdown-item" href="editar">Editar</a>
            <?php  }else{?>
                  <form action="" method="post">
              <button class="dropdown-item" name="sair" type="submit">sair</button>
              </form>
<?php }   ?>
            </div>
          </li>
          </ul>
        </div>
      </div>
    </nav>
      

