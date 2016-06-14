<?php

	include_once("classes/usuario.class.php");
	include_once("classes/licitacaoControle.class.php");
	include_once("classes/historicoControle.class.php");
	$lc = new licitacaoControle();
	$hc = new historicoControle();

	session_start();
	if(!isset($_SESSION['id'])){
		header('location: index.php?erro=2');
	}

    $usuario = unserialize($_SESSION['user']);

	$descricao = $_POST['descricao'];
	$edital = $_POST['edital'];
	$recebe = $_FILES['pdf'];

	mkdir("pdfs/".$edital, 0777);
	$destino = "pdfs/$edital/".uniqid().".pdf";
	$uploadfile = $destino;
	move_uploaded_file($recebe['tmp_name'], $uploadfile);


	$licitacao = new licitacao();
	$licitacao->setDescricao($descricao);
	$licitacao->setEdital($edital);
	$licitacao->setStatus("Criada");
	$licitacao->setCaminho($uploadfile);
	$licitacao->setVencedor("NULL");
	$licitacao->setIdUsuario($usuario->getId());

	$lc->controleAcao("inserir",$licitacao);

	header("location:edicao.php");
	die;