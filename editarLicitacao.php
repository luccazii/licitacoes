<?php
include_once("classes/bd.class.php");
include_once("classes/controle.class.php");
include_once("classes/usuario.class.php");
include_once("classes/licitacao.class.php");
include_once("classes/licitacaoControle.class.php");
include_once("classes/historicoControle.class.php");

session_start();

$bd = new bd();

$usuario = unserialize($_SESSION['user']);

if(!isset($_SESSION['id'])){
    session_destroy();
    header('location: index.php?erro=2');
}

$lc = new licitacaoControle();

$todas = $lc->controleAcao("selecionarClassificadoId", $_GET['id']);
$_SESSION['licitacao'] = serialize($todas);

$idlix = $_GET['id'];
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
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">LIVRARIA</a>
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
        <div class="row">
            <div class="col-lg-7">
		<h1 class="page-header">Licitação <span class="licitacao_item_icone glyphicon glyphicon-pencil"></span> </h1>
            <?php if($todas[0]->getStatus() == 'Criada'){ ?>
            <form action="salvarliceditada.php" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12 portfolio-item">
                    <div class="col-md-6"><a class="licitacao_item_title">Descrição:</a></div>
                    <p class="licitacao_item_texto"><input type="text" name="descricao" value="<?php echo $todas[0]->getDescricao(); ?>" required="required"></input><br></p>
                    <hr>
                    <div class="col-md-6"><a class="licitacao_item_title">Data da Criação:</a></div>
                    <p class="licitacao_item_texto"><?php echo $bd->consulta("SELECT data FROM historico WHERE idlicitacoes = '".$idlix."' ORDER BY idhistorico ASC LIMIT 1")[0][0];?></p>
                    <hr>
                    <div class="col-md-6"><a class="licitacao_item_title">Data da Alteração:</a></div>
                    <p class="licitacao_item_texto"><?php echo $bd->consulta("SELECT data FROM historico WHERE idlicitacoes = '".$idlix."' ORDER BY idhistorico DESC LIMIT 1")[0][0];?></p>
                    <hr>
                    <div class="col-md-6"><a class="licitacao_item_title">Referência do Edital:</a></div>
                    <p class="licitacao_item_texto"><input type="text" name="edital" value="<?php echo $todas[0]->getEdital(); ?>"></input></p>
                    <hr>
                    <div class="col-md-6"><a class="licitacao_item_title">Arquivo:</a></div>
                    <p class="licitacao_item_texto"><i><a href="<?php echo $todas[0]->getCaminho(); ?>">Download do arquivo .PDF</a></i></p>
                    <hr>
                </div>
             </div>
                <?php
            }
            elseif($todas[0]->getStatus() == 'Aberta' || $todas[0]->getStatus() == 'Encerrada' || $todas[0]->getStatus() == 'Homologada'){ ?>
                <div class="row">
                    <div class="col-md-12 portfolio-item">
                        <div class="col-md-6"><a class="licitacao_item_title">Descrição:</a></div>
                        <p class="licitacao_item_texto"><?php echo $todas[0]->getDescricao(); ?></p>
                        <hr>
                        <div class="col-md-6"><a class="licitacao_item_title">Data da Criação:</a></div>
                        <p class="licitacao_item_texto"><?php echo $bd->consulta("SELECT data FROM historico WHERE idlicitacoes = '".$idlix."' ORDER BY idhistorico ASC LIMIT 1")[0][0];?></p>
                        <hr>
                        <div class="col-md-6"><a class="licitacao_item_title">Data da Alteração:</a></div>
                        <p class="licitacao_item_texto"><?php echo $bd->consulta("SELECT data FROM historico WHERE idlicitacoes = '".$idlix."' ORDER BY idhistorico DESC LIMIT 1")[0][0];?></p>
                        <hr>
                        <div class="col-md-6"><a class="licitacao_item_title">Referência do Edital:</a></div>
                        <p class="licitacao_item_texto"><i><?php echo $todas[0]->getEdital(); ?></i></p>
                        <hr>
                        <div class="col-md-6"><a class="licitacao_item_title">Arquivo:</a></div>
                        <p class="licitacao_item_texto"><i><a href="<?php echo $todas[0]->getCaminho(); ?>">Download do arquivo .PDF</a></i></p>
                        <hr>
                    </div>
                </div>
            <?php } ?>
            </div>
            <div class="col-lg-5">
                <h1 class="page-header">Histórico
                    <small>Últimas Atualizações</small></h1>
			
			<div>           
			  <table class="table table-striped">
			    <thead>
			      <tr>
				<th>Data</th>
				<th>Descrição</th>
			      </tr>
			    </thead>
			    <tbody>
                <?php

                $h = $bd->executa("SELECT * FROM historico WHERE idlicitacoes = '".$idlix."'");
                foreach ($h as $hs){
                ?>
                    <tr>
                        <td><?php echo $hs['data'];?></td>
                        <td><?php echo $hs['texto'];?></td>
                    </tr>
                    <?php
                    }
                ?>
			    </tbody>
			  </table>
			</div>
            </div>
            <div class="col-lg-5">
                <?php
                if($usuario->getCargo() == "fornecedor"){
                    echo "<p><b><i><center>".$usuario->getNome().", aguarde a conclusão da licitação</center></i></b></p>";
                }else{

                    $bd = new bd();
                    $ts = $bd->executa("SELECT * FROM proposta WHERE idlicitacao = '".$_GET['id']."'");
                    $oi = $ts->fetch_assoc();
                    ?>
                    <h1 class="page-header">Propostas <small></small></h1>
                    <?php
                    if($oi == ''){
                        echo "<p><b><i><center>Ainda não há propostas cadastradas</center></i></b></p>";
                    }
                    else{
                        echo'
                        <table id="table_id" class="table table-striped">
                            <thead>
                            <tr>
                                <th>Fornecedor</th>
                                <th>Edital</th>
                                <th>Data</th>';
                                if($todas[0]->getStatus() == "Encerrada"){
                                    echo "<th>Ação</th>";
                                }
                        foreach($ts as $ta){
                            ?>
                            <?php
                            $idkrl = $ta["idfornecedor"];
                            $us = $bd->executa("SELECT nome FROM usuario WHERE id = '".$idkrl."'");
                            foreach($us as $as){
                                echo "<tr>";
                                echo "<td width='150px'>".$as['nome']."</td>";
                                echo "<td width='90px'><a href=".$ta['caminho'].">Proposta</a></td>";
                                echo "<td width='90px'>".$ta['data']."</td>";
                                if($todas[0]->getStatus() == "Encerrada"){
                                    echo "<td><a href='altstatus.php?abrir=homologar&idprop=".$ta['idproposta']."'>Aprovar</td>";
                                }
                                echo "</tr>";
                            }
                        }?>
                        </tr>
                            </thead>
                            <tbody>
                        </tbody>
                        </table>
                        <?php
                        if($usuario->getCargo() != "fornecedor" && $todas[0]->getStatus() == "Homologada"){
                            echo '<center><b>O vencedor da licitação é '.$todas[0]->getVencedor().'!</b></center>';
                        }
                    }
                }
                ?>
            </div>
            <div class="row">
            <div class="col-md-6 portfolio-item">
                <?php
//                if($todas[0]->getStatus() == 'Encerrada'){
//                    echo '<button type="button" class="btn btn-primary">Homologar Licitação</button>';
//                }
                if($todas[0]->getStatus() == 'Aberta'){
                    if($usuario->getCargo() == "fornecedor"){
                        echo '<form action="salvarproposta.php" method="post" enctype="multipart/form-data">
                        <input type="file" name="proposta"><br>
                        <input type="submit" class="btn btn-primary" value="Enviar Proposta">';
                    }else{
                        ?>
                    <!--                    <button type="button" class="btn btn-success">Enviar</button>-->

                    <a href="altstatus.php?abrir=fechar"><button type="button" class="btn btn-primary">Encerrar Licitação</button></a>
                    <?php
                    }
                }
                if($todas[0]->getStatus() == 'Criada'){?>
                    <label class="control-label">Selecionar Arquivo</label>
                    <span style="margin-left: 20px;"></span> <input id="input-1" name="pdf" type="file" class="file"><br/><?php
                    echo '<span style="margin-left: 20px;"></span><input type="submit" value="Salvar Licitação" class="btn btn-info"></form> ';
                    echo '<a href="altstatus.php?abrir=abrir"><button type="button" class="btn btn-success">Abrir Licitação</button></a>';

                }
                ?>
                <!--			<button type="button" class="btn btn-danger">Cancelar Licitação</button>-->
            </div>
        </div>
        </div>
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
