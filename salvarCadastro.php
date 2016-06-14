<?php
	include_once("classes/usuario.class.php");
	include_once("classes/fornecedor.class.php");
    include_once("classes/controle.class.php");
    include_once("classes/fornecedorControle.class.php");
    include_once("classes/usuarioControle.class.php");
	session_start();
	if(!isset($_SESSION['id'])){
    header('location: index.php?erro=2');
  }
    $usuario = unserialize($_SESSION['user']);

    if($_SESSION['cadastrado'] == "fornecedor"){

        if((filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))== false){
           header("location:cadastroDados.php?erro=4");
        }
        else{
        $fornecedor = new fornecedor();
        $fc = new fornecedorControle();
        $fornecedor->setNomeEmpresa($_POST['nomeEmpresa']);
        $fornecedor->setCNPJ($_POST['CNPJ']);
        $fornecedor->setEmail($_POST['email']);
        $fornecedor->setNomeResponsavel($_POST['nomeResponsavel']);
        $fornecedor->setCidade($_POST['cidade']);
        $fornecedor->setSenha($_POST['senha']);
        $fornecedor->setCargo($_SESSION['cadastrado']);
        $fornecedor->setEndereco($_POST['endereco']);
        $fornecedor->setTelefone($_POST['telefone']);
        $fc->controleAcao("inserirFornecedor", $fornecedor);
        $_SESSION['mensagem'] = "5";
        header("location:edicao.php");
        }
    }

    if($_SESSION['cadastrado'] == "vendedor"){

        if((filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))== false){
           header("location:cadastroDados.php?erro=4");
        }
        else{
        $usuario = new usuario();
        $uc = new usuarioControle();
        $usuario->setNome($_POST['nome']);
        $usuario->setEmail($_POST['email']);
        $usuario->setSenha($_POST['senha']);
        $usuario->setCidade($_POST['cidade']);
        $usuario->setCPF($_POST['CPF']);
        $usuario->setCargo($_SESSION['cadastrado']);
        $usuario->setTelefone($_POST['telefone']);
        $uc->controleAcao("inserirUsuario", $usuario);
        $_SESSION['mensagem'] = "5";
        header("location:edicao.php");
        }
    }