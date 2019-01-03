<?php
session_start();
require_once '../classes/postagemdao.class.php';
require_once '../classes/postagem.class.php';

	if(extract($_POST)){
        
    $titulo = $_POST['titulo'];
    $imagem = $_FILES['img'];
    $descricao = $_POST['descricao'];
    $imgantes = $_POST['imgantes'];
        
    $postagemdao = new PostagemDAO();
	$postagem = new Postagem();
        
	$postagem->titulo = $titulo;
	$postagem->imagem = $imagem;
	$postagem->idpost= $_SESSION['idpostedt'];
	$postagem->imgantes= $imgantes;
	$postagem->descricao= $descricao;
        
	$postagemdao->update($postagem); 
	}