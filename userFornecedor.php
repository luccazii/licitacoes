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
$usuario = unserialize($_SESSION['user']);
$uc = new usuarioControle();

$id = $usuario->getId();
$fc = new fornecedorControle();
$resp = $fc->controleAcao("selecionarFornecedor", $id);
$todos = new fornecedor();
$todos->setIdUsuario($resp[0][0][0]);
$todos->setNomeEmpresa($resp[0][0][1]);
$todos->setCNPJ($resp[1][0][2]);
$todos->setNomeResponsavel($resp[1][0][3]);
$todos->setCidade($resp[0][0][4]);
$todos->setEmail($resp[0][0][3]);
$todos->setSenha($resp[0][0][2]);
$todos->setCargo($resp[0][0][6]);
$todos->setEndereco($resp[1][0][4]);
$todos->setTelefone($resp[0][0][5]);
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Livraria Landscape</title>

  <!-- Bootstrap Core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom CSS -->
  <link href="css/3-col-portfolio.css" rel="stylesheet">
  <link href="css/global.css" rel="stylesheet">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->

</head>

<body>

<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top navbar-global" role="navigation">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Navegação</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#"></a>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li>
          <a href="edicao.php">Home</a>
        </li>
                  <?php if($usuario->getCargo() == "fornecedor") { ?>
                      <li>
                          <a href="parti.php">Licitações que Participo</a>
                      </li>
                      <li>
                          <a href="userFornecedor.php">Editar Informações Pessoais</a>
                      </li>
                      <?php
        }else{ ?>
                    <li>
                        <a href="userAdmin.php">Editar Informações Pessoais</a>
                    </li>
                    <li>
                        <a href="cadastrar_vendedor.php">Criar Vendedor</a>
                    </li>
                    <li>
                        <a href="cadastrar_fornecedor.php">Criar Fornecedor</a>
                    </li>
                    <?php
                }
                ?>
        <li>
          <a href="destroy.php">Sair</a>
        </li>
      </ul>
    </div>
    <!-- /.navbar-collapse -->
  </div>
  <!-- /.container -->
</nav>

<!-- Page Content -->
<div class="container">

  <!-- Page Header -->
  <form role="form" action="editar.php" method="post">
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">Alterar Informações da conta de <?php echo $usuario->getNome();?> <span class="licitacao_item_icone glyphicon glyphicon-pencil"></span> </h1><br /><br />

        <div class="row">
          <div class="col-md-12 portfolio-item"><?php
            if(isset($_GET['erro'])){
              if($_GET['erro']==4){
                echo '<h2>Por favor digite um email válido!</h2>';
              }
            }?>
            <div class="row">	<div class="col-md-6"><label for="nomeEmpresa" class="licitacao_item_title">Razão Social:</label></div>
              <div class="col-md-6"><input type="text" class="form-control" rows="4" id="nomeEmpresa" name="nomeEmpresa" value="<?php echo $todos->getNomeEmpresa();?>"  disabled></div>				</div><hr>
            <div class="row">	<div class="col-md-6"><label for="senha" class="licitacao_item_title">Senha:</label></div>
              <div class="col-md-6"><input type="password" class="form-control" rows="4" id="senha" name="senha" value="<?php echo $todos->getSenha();?>"  required></div>				</div><hr>
            <div class="row">	<div class="col-md-6"><label for="CNPJ" class="licitacao_item_title">CNPJ:</label></div>
              <div class="col-md-6"><input type="text" class="form-control" rows="4" id="CNPJ" name="CNPJ" value="<?php echo $todos->getCNPJ();?>"  disabled></div>				</div><hr>
            <div class="row">	<div class="col-md-6"><label for="telefone" class="licitacao_item_title">Telefone p/ contato:</label></div>
              <div class="col-md-6"><input type="text" class="form-control" rows="4" id="telefone" name="telefone" value="<?php echo $todos->getTelefone();?>"  required ></div>		</div><hr>
            <div class="row">	<div class="col-md-6"><label for="email" class="licitacao_item_title">E-Mail p/ contato:</label></div>
              <div class="col-md-6"><input type="email" class="form-control" rows="4" id="email" name="email" value="<?php echo $todos->getEmail();?>"  required></div>				</div><hr>
            <div class="row">	<div class="col-md-6"><label for="responsavel" class="licitacao_item_title">Responsável:</label></div>
              <div class="col-md-6"><input type="text" class="form-control" rows="4" id="responsavel" name="responsavel" value="<?php echo $todos->getNomeResponsavel();?>"  required></div>				</div><hr>
            <div class="row">	<div class="col-md-6"><label for="endereco" class="licitacao_item_title">Endereço:</label></div>
              <div class="col-md-6"><input type="text" class="form-control" rows="4" id="endereco" name="endereco"  value="<?php echo $todos->getEndereco();?>" required></div>				</div><hr>
            <div class="row">	<div class="col-md-6"><label for="cidade" class="licitacao_item_title">Cidade: </label></div>
              <div class="col-md-6"><input type="text" class="form-control" rows="4" id="cidade" name="cidade" value="<?php echo $todos->getCidade();?>" required></div>				</div><hr>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 portfolio-item">
        <input type="submit" class="btn btn-success">
      </div>
    </div>
  </form>
  <!-- /.row -->

  <hr>

  <!-- Footer -->
  <footer>
    <div class="row">
      <div class="col-lg-12">
        <p>Copyright 2016 &copy; Júlia Pivatto, Lucca Zimmermann, Nícolas Agostini</p>
      </div>
    </div>
    <!-- /.row -->
  </footer>

</div>
<!-- /.container -->

<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

</body>

</html>
