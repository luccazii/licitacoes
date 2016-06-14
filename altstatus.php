<?php

include_once("classes/controle.class.php");
	include_once("classes/usuario.class.php");
	include_once("classes/licitacao.class.php");
	include_once("classes/licitacaoControle.class.php");
	include_once("classes/historicoControle.class.php");
	include_once("classes/bd.class.php");

	session_start();


	$usuario = unserialize($_SESSION['user']);
	$licitacao = unserialize($_SESSION['licitacao']);

	if(!isset($_SESSION['id'])){
    	header('location: index.php?erro=2');
  	}

  	$lc = new licitacaoControle();

  	$abrir = $_GET['abrir'];

	if($abrir == 'abrir'){
		$lici = new licitacao();
  		$lici->setIdLicitacao($licitacao[0]->getIdLicitacao());
  		$lici->setDescricao($licitacao[0]->getDescricao());
  		$lici->setEdital($licitacao[0]->getEdital());
  		$lici->setData($licitacao[0]->getData());
  		$lici->setStatus('Aberta');
  		$lici->setCaminho($licitacao[0]->getCaminho());
  		$lici->setVencedor($licitacao[0]->getVencedor());
  		$lici->setIdUsuario($licitacao[0]->getIdUsuario());
  		$lc->controleAcao("alterar", $lici);
  		header("location:edicao.php");
  		die;
	}

	if($abrir == 'fechar'){
		$lici = new licitacao();
  		$lici->setIdLicitacao($licitacao[0]->getIdLicitacao());
  		$lici->setDescricao($licitacao[0]->getDescricao());
  		$lici->setEdital($licitacao[0]->getEdital());
  		$lici->setData($licitacao[0]->getData());
  		$lici->setStatus('Encerrada');
  		$lici->setCaminho($licitacao[0]->getCaminho());
  		$lici->setVencedor($licitacao[0]->getVencedor());
  		$lici->setIdUsuario($licitacao[0]->getIdUsuario());
  		$lc->controleAcao("alterar", $lici);
  		header("location:edicao.php");
  		die;
	}

	if($abrir == 'homologar'){

		$bd = new bd();

		$idproposta = $_GET['idprop'];

		$proposta = $bd->executa("SELECT * FROM proposta WHERE idproposta ='".$idproposta."' ");
		foreach ($proposta as $prop) {
			$id = $prop['idfornecedor'];
			$usuario = $bd->executa("SELECT * FROM usuario WHERE id ='".$id."' ");
			foreach($usuario as $user){

				//mail( $user['email'] , 'Vencedor da licitação!' , 'Parabéns! Você venceu a licitação!!!');
				mail( 'nic.voy@hotmail.com' , 'Vencedor da licitação!' , 'Parabéns! Você venceu a licitação!!!');
				$lici = new licitacao();
		  		$lici->setIdLicitacao($licitacao[0]->getIdLicitacao());
		  		$lici->setDescricao($licitacao[0]->getDescricao());
		  		$lici->setEdital($licitacao[0]->getEdital());
		  		$lici->setData($licitacao[0]->getData());
		  		$lici->setStatus('Homologada');
		  		$lici->setCaminho($licitacao[0]->getCaminho());
		  		$lici->setVencedor($user['nome']);
		  		$lici->setIdUsuario($licitacao[0]->getIdUsuario());
		  		$lc->controleAcao("alterar", $lici);
		  		header("location:edicao.php");
		  		die;

			}
		}
	}