<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Livraria</title>

  <!-- Bootstrap Core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom CSS -->
  <link href="css/3-col-portfolio.css" rel="stylesheet">
  <link href="css/entrar.css" rel="stylesheet">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->

</head>

<body>
<div id="fullscreen_bg" class="fullscreen_bg"/>
<div class="container">
  <form class="form-signin" action="verifica.php" method="post">
    <div id="logo"></div><?php
	if(isset($_GET['erro'])){
	if($_GET['erro']==1){
	echo '<hr>Email ou senha não está correto, digite novamente.';
	}
	if($_GET['erro']==2){
	echo '<hr>Para acessar essa página você precisa estar logado.';
	}
	if($_GET['erro']==3){
	echo '<hr>Digite um email válido!';
	}
	}?>
    <hr>
    <input type="email" name="email" class="form-control" placeholder="Seu e-mail" required="" autofocus="">
    <input type="password" name="senha" class="form-control" placeholder="Sua Senha" required="">
    <button class="btn btn-lg btn-primary btn-block" type="submit">
      Entre no Sistema
    </button>
  </form>
</div>
</div>
</body>

</html>
