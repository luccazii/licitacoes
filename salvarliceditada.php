<?php

	include_once("classes/controle.class.php");
	include_once("classes/usuario.class.php");
	include_once("classes/licitacao.class.php");
	include_once("classes/licitacaoControle.class.php");
	include_once("classes/historicoControle.class.php");

	session_start();


	$usuario = unserialize($_SESSION['user']);
	$licitacao = unserialize($_SESSION['licitacao']);

	if(!isset($_SESSION['id'])){
    	header('location: index.php?erro=2');
  	}

  	$lc = new licitacaoControle();

  	$descricao = filter_var($_POST['descricao'], FILTER_SANITIZE_STRING);
  	$edital = filter_var($_POST['edital'], FILTER_SANITIZE_STRING);

  	$pdf=$_FILES['pdf'];


  	if($pdf['name'] == "" ){
  		$lici = new licitacao();
  		$lici->setIdLicitacao($licitacao[0]->getIdLicitacao());
  		$lici->setDescricao($descricao);
  		$lici->setEdital($edital);
  		$lici->setData($licitacao[0]->getData());
  		$lici->setStatus($licitacao[0]->getStatus());
  		$lici->setCaminho($licitacao[0]->getCaminho());
  		$lici->setVencedor($licitacao[0]->getVencedor());
  		$lici->setIdUsuario($licitacao[0]->getIdUsuario());
  		$lc->controleAcao("alterar", $lici);
  		header("location:edicao.php");
  	}


  	else{
  		
	mkdir("pdfs/".$edital, 0777);
	$destino = "pdfs/$edital/".uniqid().".pdf";
  $uploadfile = $destino;
	move_uploaded_file($pdf['tmp_name'], $uploadfile);

  		$lici = new licitacao();
  		$lici->setIdLicitacao($licitacao[0]->getIdLicitacao());
  		$lici->setDescricao($descricao);
  		$lici->setEdital($edital);
  		$lici->setData($licitacao[0]->getData());
  		$lici->setStatus($licitacao[0]->getStatus());
  		$lici->setCaminho($uploadfile);
  		$lici->setVencedor($licitacao[0]->getVencedor());
  		$lici->setIdUsuario($licitacao[0]->getIdUsuario());
  		$lc->controleAcao("alterar", $lici);
  		header("location:edicao.php");
  	}
  	