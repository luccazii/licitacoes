<?php
  include_once("classes/usuario.class.php");
  include_once("classes/licitacaoControle.class.php");
  include_once("classes/historicoControle.class.php");
  session_start();
  if(!isset($_SESSION['id'])){
    header('location: index.php?erro=2');
  }
    $usuario = unserialize($_SESSION['user']);
    if(isset($_SESSION['mensagem'])){
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

if($usuario->getCargo() == "fornecedor") {
    ////////////////////PAGINAÇÃO

    $total_reg = "9";
  
  if(isset($_GET['categoria'])){
    $c = $_GET['categoria'];
    $categoria = "= '".$c."'";
  }else{
    $categoria = "!= 'Criada' ";
  }
  
    if(isset($_POST['pesquisa'])){
        $busca = "SELECT * FROM licitacoes WHERE status ".$categoria." AND descricao LIKE '%".$_POST['pesquisa']."%' ";
    }else{
        $busca = "SELECT * FROM licitacoes WHERE status ".$categoria." ";
    }
  
    if (empty($_GET['pagina'])) {
        $pc = "1";
    } else {
        $pc = $_GET['pagina'];
    }

    $inicio = $pc - 1;
    $inicio = $inicio * $total_reg;

    $bd = new bd();
    $limite = $bd->executa("$busca LIMIT $inicio,$total_reg");
    $todos = $bd->executa("$busca");
    $tr = mysqli_num_rows($todos);
    $tp = $tr / $total_reg;

    $linhas = $limite;
}
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
<meta charset="UTF-8">
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
  <?php if($usuario->getCargo() == "fornecedor") { ?>
  <!-- Page Content -->
  <div class="container">

      <!-- Page Header -->
      <div class="row">
          <div class="col-lg-12">
              <h1 class="page-header">Introdução</h1>
              <p> <?php echo $usuario->getNome();?>, seja bem vindo ao novo sistema de Licitações da Livraria Landscape. Devido a grande necessidade de materiais, este sistema ajudará a organizar nossos pedidos para você, fornecedor, encontrar mais rapidamente nossos pedidos.</p>
          </div>
      </div>
      <div class="row">
          <div class="col-lg-12">
              <h1 class="page-header">Últimas Licitações
                  <small></small>
              </h1>
          </div>
      </div>
      <!-- /.row -->

      <div class="row">
          <div class="col-lg-12">
              <h4>Pesquise pela Descrição</h4>
              <form action="edicao.php" method="post">
              <div id="custom-search-input">
                  <div class="input-group col-md-12">
                      <input type="text" class="search-query form-control" name="pesquisa" placeholder="Ex: cadeira" />
                            <span class="input-group-btn">
                                <input type="submit" class="btn btn-danger" type="button">
                                    <span class=" glyphicon glyphicon-search"></span>
                                </input>
                            </span>
                  </div>
              </div>
                  </form>
          </div>
      </div><br />
          <div class="row">
        <div class="col-lg-12">
          <div class="btn-group btn-group-justified" role="group" aria-label="...">
            <div class="btn-group" role="group">
              <a href="edicao.php"><button type="button" class="btn btn-default <?php if(empty($_GET['categoria'])){$_GET['categoria'] = "todo"; echo "active"; }?>">Todas</button></a>
            </div>          
            <div class="btn-group" role="group">
              <a href="?categoria=Aberta"><button type="button" class="btn btn-default <?php if($_GET['categoria'] == "Aberta"){echo "active"; }?>">Abertas</button></a>
            </div>
            <div class="btn-group" role="group">
              <a href="?categoria=Encerrada"><button type="button" class="btn btn-default <?php if($_GET['categoria'] == "Encerrada"){echo "active"; }?>">Encerradas</button></a>
            </div>
            <div class="btn-group" role="group">
              <a href="?categoria=Homologada"><button type="button" class="btn btn-default <?php if($_GET['categoria'] == "Homologada"){echo "active"; }?>">Homologadas</button></a>
            </div>
          </div>
        </div>
      </div><br /><br /><br /><br />
      <!-- Projects Row -->
      <?php
      $lc = new LicitacaoControle();
          if($linhas->num_rows == '0'){
              echo "<p> Não há licitações disponíveis.</p>";
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
      if($todas != "1"){
          ?>
              <?php
              if($todas != NULL){
                  $cont = 0;
                  echo '<div class="row">';
                  foreach($todas as $toda){
                      if($cont == 3){
                          $cont = 0;
                          echo "</div>";
                          echo '<div class="row">';
                      }
                      $cont++;
                      ?>
                      <div class="col-md-4 portfolio-item">
                          <div class="quadrado-lista">
                              <h3>
                                  <a class="title" href="editarLicitacao.php?id=<?php echo $toda->getIdLicitacao(); ?>"> <?php echo $toda->getDescricao(); ?></a> <br />
                                  <small>CRIADA EM: <?php echo $toda->getData(); ?></small><br /><br/>
                                  <small><?php echo $toda->getStatus(); ?></small>
                              </h3>
                          </div>
                      </div>
                      <?php
                  }
                  echo "</div>";
              }
              ?>
          <?php
      }
      else{
          echo "<p> Ainda não há licitações cadastradas.</p>";
      }
      ?>

      <hr>

      <!-- Pagination -->
      <div class="row text-center">
          <div class="col-lg-12">
              <ul class="pagination">
                  <li>
                      <a href="#">&laquo;</a>
                  </li>
                  <?php
                  for($i = 1; $i <= ceil($tp); $i++){
                        if($i == $pc){?>
                          <li class="active">
                              <a href="#"><?php echo $i; ?></a>
                          </li><?php
                        }else{
                      ?>
                          <li>
                          <a href="edicao_html.php?pagina=<?php echo $i; ?>"><?php echo $i; ?></a>
                          </li>
                  <?php } } ?>
                  <li>
                      <a href="#">&raquo;</a>
                  </li>
              </ul>
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

  <?php
  }
  elseif($usuario->getCargo() == "vendedor" || $usuario->getCargo() == "admin") {?>
      <div class="container">

          <hr>
          <div class="starter-template">
              <h1>Licitações</h1>
          <div class="row">
        <div class="col-lg-12">
          <div class="btn-group btn-group-justified" role="group" aria-label="...">
            <div class="btn-group" role="group">
              <a href="edicao.php"><button type="button" class="btn btn-default <?php if(empty($_GET['categoria'])){$_GET['categoria'] = "todo"; echo "active"; }?>">Todas</button></a>
            </div>          
            <div class="btn-group" role="group">
              <a href="?categoria=Aberta"><button type="button" class="btn btn-default <?php if($_GET['categoria'] == "Aberta"){echo "active"; }?>">Abertas</button></a>
            </div>
            <div class="btn-group" role="group">
              <a href="?categoria=Encerrada"><button type="button" class="btn btn-default <?php if($_GET['categoria'] == "Encerrada"){echo "active"; }?>">Encerradas</button></a>
            </div>
            <div class="btn-group" role="group">
              <a href="?categoria=Homologada"><button type="button" class="btn btn-default <?php if($_GET['categoria'] == "Homologada"){echo "active"; }?>">Homologadas</button></a>
            </div>
          </div>
        </div>
      </div><br /><br />
              <p class="lead">
                  <?php
                  $lc = new LicitacaoControle();
                  if($_GET['categoria'] == 'todo'){
                    if($usuario->getCargo() == "admin"){
                        $todas = $lc->controleAcao("selecionarTodos");
                    }
                    if($usuario->getCargo() == "vendedor"){
                      $todas = $lc->controleAcao("selecionarClassificado", $usuario->getId());
                  }
                }
                else{
                  if($usuario->getCargo() == "admin" && $_GET['categoria'] == 'Aberta'){
                      $bd = new bd();
                      $todasF = $bd->executa("SELECT * FROM licitacoes WHERE status = 'Aberta'");
                      foreach ($todasF as $tod) {
                        $licta = new licitacao();
                              $licta->setIdLicitacao($tod["idlicitacao"]);
                              $licta->setDescricao($tod["descricao"]);
                              $licta->setData($tod["data"]);
                              $licta->setEdital($tod["edital"]);
                              $licta->setStatus($tod["status"]);
                              $licta->setCaminho($tod["caminho"]);
                              $licta->setVencedor($tod["vencedor"]);
                              $licta->setIdUsuario($tod["idusuario"]);

                              $todas[] = $licta;
                      }
                  }
                  if($usuario->getCargo() == "admin" && $_GET['categoria'] == 'Encerrada'){
                      $bd = new bd();
                      $todasF = $bd->executa("SELECT * FROM licitacoes WHERE status = 'Encerrada'");
                      foreach ($todasF as $tod) {
                        $licta = new licitacao();
                              $licta->setIdLicitacao($tod["idlicitacao"]);
                              $licta->setDescricao($tod["descricao"]);
                              $licta->setData($tod["data"]);
                              $licta->setEdital($tod["edital"]);
                              $licta->setStatus($tod["status"]);
                              $licta->setCaminho($tod["caminho"]);
                              $licta->setVencedor($tod["vencedor"]);
                              $licta->setIdUsuario($tod["idusuario"]);

                              $todas[] = $licta;
                      }
                  }
                  if($usuario->getCargo() == "admin" && $_GET['categoria'] == 'Homologada'){
                      $bd = new bd();
                      $todasF = $bd->executa("SELECT * FROM licitacoes WHERE status = 'Homologada'");
                      foreach ($todasF as $tod) {
                        $licta = new licitacao();
                              $licta->setIdLicitacao($tod["idlicitacao"]);
                              $licta->setDescricao($tod["descricao"]);
                              $licta->setData($tod["data"]);
                              $licta->setEdital($tod["edital"]);
                              $licta->setStatus($tod["status"]);
                              $licta->setCaminho($tod["caminho"]);
                              $licta->setVencedor($tod["vencedor"]);
                              $licta->setIdUsuario($tod["idusuario"]);

                              $todas[] = $licta;
                      }
                  }
                  if($usuario->getCargo() == "vendedor" && $_GET['categoria'] == 'Aberta'){
                      $bd = new bd();
                      $todasF = $bd->executa("SELECT * FROM licitacoes WHERE status = 'Aberta' AND idusuario = '".$usuario->getId()."'");
                      foreach ($todasF as $tod) {
                        $licta = new licitacao();
                              $licta->setIdLicitacao($tod["idlicitacao"]);
                              $licta->setDescricao($tod["descricao"]);
                              $licta->setData($tod["data"]);
                              $licta->setEdital($tod["edital"]);
                              $licta->setStatus($tod["status"]);
                              $licta->setCaminho($tod["caminho"]);
                              $licta->setVencedor($tod["vencedor"]);
                              $licta->setIdUsuario($tod["idusuario"]);

                              $todas[] = $licta;
                      }
                  }
                  if($usuario->getCargo() == "vendedor" && $_GET['categoria'] == 'Encerrada'){
                      $bd = new bd();
                      $todasF = $bd->executa("SELECT * FROM licitacoes WHERE status = 'Encerrada' AND idusuario = '".$usuario->getId()."'");
                      foreach ($todasF as $tod) {
                        $licta = new licitacao();
                              $licta->setIdLicitacao($tod["idlicitacao"]);
                              $licta->setDescricao($tod["descricao"]);
                              $licta->setData($tod["data"]);
                              $licta->setEdital($tod["edital"]);
                              $licta->setStatus($tod["status"]);
                              $licta->setCaminho($tod["caminho"]);
                              $licta->setVencedor($tod["vencedor"]);
                              $licta->setIdUsuario($tod["idusuario"]);

                              $todas[] = $licta;
                      }
                  }
                  if($usuario->getCargo() == "vendedor" && $_GET['categoria'] == 'Homologada'){
                      $bd = new bd();
                      $todasF = $bd->executa("SELECT * FROM licitacoes WHERE status = 'Homologada' AND idusuario = '".$usuario->getId()."'");
                      foreach ($todasF as $tod) {
                        $licta = new licitacao();
                              $licta->setIdLicitacao($tod["idlicitacao"]);
                              $licta->setDescricao($tod["descricao"]);
                              $licta->setData($tod["data"]);
                              $licta->setEdital($tod["edital"]);
                              $licta->setStatus($tod["status"]);
                              $licta->setCaminho($tod["caminho"]);
                              $licta->setVencedor($tod["vencedor"]);
                              $licta->setIdUsuario($tod["idusuario"]);

                              $todas[] = $licta;
                      }
                  }
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
                      <th>Nº Edital</th>
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
                  echo "<a href='novali.php'> <div class='btn-block'>Nova Licitação</div> </a>";
              }
              ?>
          </div>
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
  <?php
  }
  ?>


  <!-- jQuery -->
  <script src="js/jquery.js"></script>

  <!-- Bootstrap Core JavaScript -->
  <script src="js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css"/>
  <script src="js/ie10-viewport-bug-workaround.js"></script>
  <script type="text/javascript" src="js/datatable.js"></script>
  <script>$(document).ready( function () {
          $('#table_id').DataTable();
      } );
      window.jQuery || document.write('<script src="js/jquery.js"><\/script>')
  </script>
  </body>
</html>