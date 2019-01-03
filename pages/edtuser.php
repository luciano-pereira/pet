<?php
session_start();
require_once '../classes/usuariodao.class.php';
require_once '../classes/usuario.class.php';

	if(extract($_POST)){
        
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $imagem = $_FILES['img'];
    $imgantes = $_POST['imgantes'];
    $cidade = $_POST['cidade'];
    $bio = $_POST['bio'];
    $facebook = $_POST['facebook'];
    $instagram = $_POST['instagram'];
    $telefone = $_POST['tel'];
    $id = $_POST['id'];

        
    $usuariodao = new UsuarioDAO();
	$usuario = new Usuario();
        
	$usuario->nome = $nome;
	$usuario->email = $email;
	$usuario->imagem = $imagem;
    $usuario->imgantes = $imgantes;
	$usuario->cidade = $cidade;
	$usuario->bio = $bio;
	$usuario->facebook = $facebook;
	$usuario->instagram = $instagram;
	$usuario->telefone = $telefone;
	$usuario->idl = $id;
        
	$usuariodao->update($usuario); 
	}