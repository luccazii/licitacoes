<?php

  include_once("classes/licitacaoControle.class.php");
  include_once("classes/historicoControle.class.php");

session_start();
  if(!isset($_SESSION['id'])){
    header('location: index.php?erro=2');
  }
    $usuario = unserialize($_SESSION['user']);
 ?>
<form action="salvarlic.php" method="post" enctype="multipart/form-data">
<input type="text" name="descricao" placeholder="Descrição"></input><br>
<input type="text" name="edital" placeholder="Edital"></input><br>
<input type="file" name="pdf"></input><br>
<input type="submit" value="Salvar">
</form>