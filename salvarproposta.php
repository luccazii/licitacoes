<?php

	include_once("classes/usuario.class.php");
	include_once("classes/licitacaoControle.class.php");
	include_once("classes/historicoControle.class.php");
	$lc = new licitacaoControle();
	$hc = new historicoControle();
	session_start();
	$licitacao = unserialize($_SESSION['licitacao']);

	$time = $hc->timeNow();

	if(!isset($_SESSION['id'])){
		header('location: index.php?erro=2');
	}

    $usuario = unserialize($_SESSION['user']);

    $nome = $usuario->getNome();

	$recebe = $_FILES['proposta'];
	mkdir("propostas/".$nome, 0777);
	$destino = "propostas/".uniqid().".pdf";
	$uploadfile = $destino;
	move_uploaded_file($recebe['tmp_name'], $uploadfile);

	$bd = new bd();
	$bd->executa("INSERT INTO proposta(idproposta, data, caminho, estado, idfornecedor, idlicitacao) VALUES ('','".$time."','".$uploadfile."','0','".$usuario->getId()."','".$licitacao[0]->getIdLicitacao()."')");
	$_SESSION['mensagem'] == "6";
	header("location:edicao.php");