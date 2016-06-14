<?php
  include_once("classes/usuario.class.php");
  include_once("classes/licitacaoControle.class.php");
  include_once("classes/historicoControle.class.php");
  session_start();
  if(!isset($_SESSION['id'])){
    header('location: index.php?erro=2');
  }
    $usuario = unserialize($_SESSION['user']);
    if($_SESSION['mensagem'] != ''){
      if($_SESSION['mensagem'] == "1"){
        ?>
        <script>alert("Alteração efetuada com sucesso.");</script>
        <?php
       $_SESSION['mensagem'] = '';
      }
      if($_SESSION['mensagem'] == "2"){
        ?>
        <script>alert("Licitação aberta com sucesso.");</script>
        <?php
       $_SESSION['mensagem'] = '';
      }
      if($_SESSION['mensagem'] == "3"){
        ?>
        <script>alert("Licitação encerrada com sucesso.");</script>
        <?php
       $_SESSION['mensagem'] = '';
      }
      if($_SESSION['mensagem'] == "4"){
        ?>
        <script>alert("Licitação homologada com sucesso.");</script>
        <?php
       $_SESSION['mensagem'] = '';
      }
      if($_SESSION['mensagem'] == "5"){
        ?>
        <script>alert("Usuário cadastrado com sucesso.");</script>
        <?php
       $_SESSION['mensagem'] = '';
      }
      if($_SESSION['mensagem'] == "6"){
        ?>
        <script>alert("Proposta enviada com sucesso.");</script>
        <?php
       $_SESSION['mensagem'] = '';
      }
    }

  ?>
       

  <!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Starter Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/starter-template.css" rel="stylesheet">
    <link href="//cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="edicao.php">Licitações</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="edicao.php">Home</a></li>
            <li><a href="user.php">Alterar Dados</a></li>
            <?php
              if($usuario->getCargo() == "admin"){
                echo "<li><a href='cadastro.php'>Cadastro de usuários</a></li>";
              }
            ?>
            <li><a href="destroy.php">Sair</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">

      <div class="starter-template">
        <h1>lista das licitações</h1>
          <p class="lead">
          <?php
          $lc = new LicitacaoControle();
              if($usuario->getCargo() == "admin"){
                $todas = $lc->controleAcao("selecionarTodos");
              }
              if($usuario->getCargo() == "vendedor"){
                $todas = $lc->controleAcao("selecionarClassificado", $usuario->getId());
              }
              if($usuario->getCargo() == "fornecedor"){
        $bd = new bd();
        $linhas = $bd->executa ("SELECT * FROM licitacoes WHERE status != 'Criada' ");
        if($linhas->num_rows == '0'){
       echo "<p> Ainda não há licitações cadastradas.</p>";
      die;
    }
    else{
      foreach($linhas as $lic){
        $licitacao = new licitacao();
        $licitacao->setIdLicitacao($lic["idlicitacao"]);
        $licitacao->setDescricao($lic["descricao"]);
        $licitacao->setData($lic["data"]);
        $licitacao->setEdital($lic["edital"]);
        $licitacao->setStatus($lic["status"]);
        $licitacao->setCaminho($lic["caminho"]);
        $licitacao->setVencedor($lic["vencedor"]);
        $licitacao->setIdUsuario($lic["idusuario"]);

        $todas[] = $licitacao;
      }
    }
  }
          if($todas != "1"){
            ?>
          <table id="table_id" class="display">
            <thead>
              <tr>
                <th>Data</th>
                <th>Edital</th>
                <th>Status</th>
                <th>Edição</th>
              </tr>
            </thead>
            <tbody>
              <?php
              if($todas != NULL){
                foreach($todas as $toda){
              echo "<tr>";
               echo "<td width='150px'>".$toda->getData()."</td>";
               echo "<td width='90px'>".$toda->getEdital()."</td>";
               echo "<td width='90px'>".$toda->getStatus()."</td>";
               echo "<td><a href='editarLicitacao.php?id=".$toda->getIdLicitacao()."'>Editar</td>";
               echo "</tr>";
               }
             }
              ?>
            </tbody>
          </table>
          <?php
        }
        else{
              echo "<p> Ainda não há licitações cadastradas.</p>";
             }
        ?>
          </p>
        <br>
        <?php
          if($usuario->getCargo() == "admin" || $usuario->getCargo() == "vendedor"){
            echo "<a href='novali.php'> Nova Licitação </a>";
          }
        ?>
      </div>

    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>$(document).ready( function () {
    $('#table_id').DataTable();
} );
window.jQuery || document.write('<script src="js/jquery.js"><\/script>')</script>
    <script src="js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css"/>
    <script type="text/javascript" src="js/jquery.js"></script>
 
<script type="text/javascript" src="js/datatable.js">
    </script>
  </body>
</html>