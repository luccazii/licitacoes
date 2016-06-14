<?php

include_once("classes/licitacaoControle.class.php");
include_once("classes/historicoControle.class.php");
require_once("classes/usuario.class.php");
session_start();

if(!isset($_SESSION['id'])){
    header('location: index.php?erro=2');
}

$usuario = unserialize($_SESSION['user']);
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Livraria do Luccão</title>

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
		<form role="form" action="salvarlic.php" method="post" enctype="multipart/form-data">
			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header">Cadastrar Nova Licitação <span class="licitacao_item_icone glyphicon glyphicon-pencil"></span> </h1>
					<div class="row">
						<div class="col-md-12 portfolio-item">
								<div class="col-md-6"><label for="descricao" class="licitacao_item_title">Descrição:</label></div>
								<input type class="form-control" rows="4" id="descricao" name="descricao" required>
                                <hr>
                                <div class="col-md-6"><label for="edital" class="licitacao_item_title">Referência do Edital:</label></div>
                                <input type class="form-control" rows="4" id="edital" name="edital" required>
								<hr>
							
						</div>
					</div>
				</div>
			</div>	<div class="row">
			<div class="col-md-12 portfolio-item">
				<label class="control-label">Selecionar Arquivo</label>
				<input id="pdf" name="pdf" type="file" class="file" required>
				<hr>
				<input type="submit" class="btn btn-success">
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
