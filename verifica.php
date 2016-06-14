<?php
	include_once("classes/usuarioControle.class.php");
	$userControle = new usuarioControle();
	$user = new usuario();
	$user->setEmail($_POST['email']);
	$user->setSenha($_POST['senha']);
	$log = $user;
	$resp = $userControle->verificar($log);
	if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
			  header("location: index.php?erro=3");
		}
	if($resp[0][6] == "admin" || $resp[0][6] == "vendedor" || $resp[0][6] == "fornecedor"){
		$user->setIdUsuario($resp[0][0]);
		$user->setNome($resp[0][1]);
		$user->setSenha($resp[0][2]);
		$user->setEmail($resp[0][3]);
		$user->setCidade($resp[0][4]);
		$user->setTelefone($resp[0][5]);
		$user->setCargo($resp[0][6]);
		$d = serialize($user);
		session_start();
        $_SESSION['id'] = "logado";
        $_SESSION['user'] = $d;
		header("location:edicao.php");
	}
	if($resp == false){
		header("location: index.php?erro=1");
	}
?>