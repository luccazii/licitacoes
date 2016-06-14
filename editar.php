<?php

include_once("classes/bd.class.php");
include_once("classes/usuario.class.php");

session_start();
  if(!isset($_SESSION['id'])){
    header('location: index.php?erro=2');
  }

$usuario = unserialize($_SESSION['user']);
$bd = new bd();

if($usuario->getCargo() == "admin" || $usuario->getCargo() == "vendedor"){

      $id = $usuario->getId();
      $nome = filter_var($_POST['nome'], FILTER_SANITIZE_STRING);
      $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
      $senha = filter_var($_POST['senha'], FILTER_SANITIZE_STRING);
      $cidade = filter_var($_POST['cidade'], FILTER_SANITIZE_STRING);
      $telefone = filter_var($_POST['telefone'], FILTER_SANITIZE_NUMBER_INT);
      $cargo = $usuario->getCargo();

      $bd->executa("update usuario set nome = '".$nome."', email = '".$email."', senha = '".$senha."', cidade = '".$cidade."', telefone = '".$telefone."' where id = '".$id."'");
      $_SESSION['mensagem'] = "1";
      header("location:edicao.php");
}

if($usuario->getCargo() == "fornecedor"){
        $id = $usuario->getId();
        $CNPJ = filter_var($_POST['CNPJ'], FILTER_SANITIZE_NUMBER_INT);
        $nomeResponsavel = filter_var($_POST['responsavel'], FILTER_SANITIZE_STRING);
        $cidade = filter_var($_POST['cidade'], FILTER_SANITIZE_STRING);
		$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $senha = filter_var($_POST['senha'], FILTER_SANITIZE_STRING);
        $telefone = filter_var($_POST['telefone'], FILTER_SANITIZE_NUMBER_INT);
        $endereco = filter_var($_POST['endereco'], FILTER_SANITIZE_STRING);

        $bd->executa("update usuario set email = '".$email."', senha = '".$senha."', cidade = '".$cidade."', telefone = '".$telefone."' where id = '".$id."'");
        $bd->executa("update fornecedor set CNPJ = '".$CNPJ."', responsavel = '".$nomeResponsavel."', endereco = '".$endereco."' where idusuario = '".$id."'");
        $_SESSION['mensagem'] = "1";
        header("location:edicao.php");
}