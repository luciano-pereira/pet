<?php
session_start();

require_once '../classes/usuario.class.php'; 
require_once '../classes/usuariodao.class.php'; 

	// Cadastro de Usuario
	if (isset($_POST['cad'])){
		$usuariodao = new UsuarioDAO();
		$usuario = new Usuario();
        
		$nome = $_POST['nome'];
		$email = $_POST['email'];
		$senha = $_POST['senha'];
		$city = $_POST['cidade'];
		$url = $_POST['url'];
		$bio = $_POST['bio'];
        
		$foto = "perfil.jpg";
        
		$nivel = $_POST['nivel'];

		$usuario->nome = $nome;
		$usuario->email = $email;
		$usuario->senha = $senha;
		$usuario->cidade = $city;
		$usuario->url = $url;
		$usuario->foto = $foto;
		$usuario->nivel = $nivel;
		
		$usuariodao->grava($usuario);
	}