<?php
	include_once("classes/controle.class.php");
	include_once("classes/usuario.class.php");
	include_once("classes/usuarioControle.class.php");
	include_once("classes/fornecedor.class.php");
	include_once("classes/fornecedorControle.class.php");

	session_start();
	if(!isset($_SESSION['id'])){
    header('location: index.php?erro=2');
  }
  if(isset($_GET['erro'])){
    if($_GET['erro']==4){
      echo '<h2>Por favor digite um email válido!</h2>';
    }
  }
    $usuario = unserialize($_SESSION['user']);
    $uc = new usuarioControle();
    if($usuario->getCargo() == "admin" || $usuario->getCargo() == "vendedor"){
      $id = $usuario->getId();
      $resp = $uc->controleAcao("selecionarUm", $id);
      $todos = new usuario();
      $todos->setIdUsuario($resp[0][0]);
      $todos->setNome($resp[0][1]);
      $todos->setEmail($resp[0][3]);
      $todos->setSenha($resp[0][2]);
      $todos->setCidade($resp[0][4]);
      $todos->setTelefone($resp[0][5]);
      $todos->setCargo($resp[0][6]);

      echo '<form action="editar.php" method="post">
            <input type="text" name="nome" value="'.$todos->getNome().'" required></input><br>
            <input type="email" name="email" value="'.$todos->getEmail().'" required></input><br>
            <input type="password" name="senha" value="'.$todos->getSenha().'" required></input><br>
            <input type="text" name="cidade" value="'.$todos->getCidade().'" required></input><br>
            <input type="text" name="telefone" value="'.$todos->getTelefone().'" required></input><br>
            <input type="submit" value="Salvar"></input>

          </form>';
   }
        if($usuario->getCargo() == "fornecedor"){
        $id = $usuario->getId();
          $fc = new fornecedorControle();
          $resp = $fc->controleAcao("selecionarFornecedor", $id);
          $todo = new fornecedor();
          $todo->setIdUsuario($resp[0][0][0]);
          $todo->setNomeEmpresa($resp[0][0][1]);
          $todo->setCNPJ($resp[1][0][2]);
          $todo->setNomeResponsavel($resp[1][0][3]);
          $todo->setCidade($resp[0][0][4]);
          $todo->setEmail($resp[0][0][3]);
          $todo->setSenha($resp[0][0][2]);
          $todo->setCargo($resp[0][0][6]);
          $todo->setEndereco($resp[1][0][4]);
          $todo->setTelefone($resp[0][0][5]);

      echo '
          <form action="editar.php" method="post">
            <input type="text" name="nomeEmpresa" value="'.$todo->getNomeEmpresa().'" required disabled></input><br>
            <input type="text" name="CNPJ" value="'.$todo->getCNPJ().'" required disabled></input><br>
            <input type="text" name="responsavel" value="'.$todo->getNomeResponsavel().'" required></input><br>
            <input type="text" name="cidade" value="'.$todo->getCidade().'" required></input><br>
            <input type="email" name="email" value="'.$todo->getEmail().'" required></input><br>
            <input type="text" name="senha" value="'.$todo->getSenha().'" required></input><br>
            <input type="text" name="telefone" value="'.$todo->getTelefone().'" required></input><br>
            <input type="text" name="endereco" value="'.$todo->getEndereco().'" required></input><br>
            <input type="submit" value="Salvar"></input>

          </form>';
     }