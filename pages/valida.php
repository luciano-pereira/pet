	<?php
	session_start();

	require_once '../classes/usuario.class.php';
	require_once '../classes/usuariodao.class.php';
		
	


	if(isset($_POST['email']) && ($_POST['senha']) ){
		$email = $_POST['email'];
		$senha = $_POST['senha'];
		$usuariodao = new UsuarioDAO();
		$usuario = new Usuario();	 
		$usuario->email = $email;
		$usuario->senha = $senha;	 
		$usuariodao->logar($usuario);
	}
?>