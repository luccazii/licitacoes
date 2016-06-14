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


if($todas[0]->getStatus() == 'Criada'){

	$h = $bd->executa("SELECT * FROM historico WHERE idlicitacoes = '".$idlix."'");
	foreach ($h as $hs){
		?>
		<table id="table_id" class="display">
        	<thead>
            	<tr>
                <th>Atualização</th>
                <th>Data</th>
            	</tr>
            </thead>
            <tbody>
		<?php
		echo "<tr>";
               echo "<td width='150px'>".$hs['texto']."</td>";         
               echo "<td width='90px'>".$hs['data']."</td>";
        echo "</tr>";
	}
	?>
	</tbody>
	</table>
	<?php

$h = $bd->executa("SELECT * FROM historico WHERE idlicitacoes = '".$idlix."'");

echo '<form action="salvarliceditada.php" method="post" enctype="multipart/form-data">
<input type="text" name="descricao" value="'.$todas[0]->getDescricao().'" required="required"></input><br>
<input type="text" name="edital" value="'.$todas[0]->getEdital().'" required="required"></input><br>
<input type="file" name="pdf"></input><br>
<input type="submit" value="Salvar"><br>
</form>';

echo '<a href="altstatus.php?abrir=abrir">Abrir Licitação</a>';
}

if($todas[0]->getStatus() == 'Aberta'){

	$h = $bd->executa("SELECT * FROM historico WHERE idlicitacoes = '".$idlix."'");
	foreach ($h as $hs){
		?>
		<table id="table_id" class="display">
        	<thead>
            	<tr>
                <th>Atualização</th>
                <th>Data</th>
            	</tr>
            </thead>
            <tbody>
		<?php
		echo "<tr>";
               echo "<td width='150px'>".$hs['texto']."</td>";         
               echo "<td width='90px'>".$hs['data']."</td>";
        echo "</tr>";
	}
	?>
	</tbody>
	</table>
	<?php

echo '<input type="text" name="descricao" value="'.$todas[0]->getDescricao().'" required="required" disabled="disabled"></input><br>
<input type="text" name="edital" value="'.$todas[0]->getEdital().'" required="required" disabled="disabled"></input><br>
<a href="'.$todas[0]->getCaminho().'">Edital</a><br>';

	if($usuario->getCargo() != "fornecedor"){
		echo '<a href="altstatus.php?abrir=fechar">Encerrar Licitação</a>';
	}

	if($usuario->getCargo() == "fornecedor"){
		echo '<form action="salvarproposta.php" method="post" enctype="multipart/form-data">
		<input type="file" name="proposta"><br>
		<input type="submit" value="Enviar"></form>';
	}
}

if($todas[0]->getStatus() == 'Encerrada'){

	$h = $bd->executa("SELECT * FROM historico WHERE idlicitacoes = '".$idlix."'");
	foreach ($h as $hs){
		?>
		<table id="table_id" class="display">
        	<thead>
            	<tr>
                <th>Atualização</th>
                <th>Data</th>
            	</tr>
            </thead>
            <tbody>
		<?php
		echo "<tr>";
               echo "<td width='150px'>".$hs['texto']."</td>";         
               echo "<td width='90px'>".$hs['data']."</td>";
        echo "</tr>";
	}
	?>
	</tbody>
	</table>
	<?php

echo '<input type="text" name="descricao" value="'.$todas[0]->getDescricao().'" required="required" disabled="disabled"></input><br>
<input type="text" name="edital" value="'.$todas[0]->getEdital().'" required="required" disabled="disabled"></input><br>
<a href="'.$todas[0]->getCaminho().'">Edital</a><br>';

	if($usuario->getCargo() == "fornecedor"){
		echo '<p> Aguarde a conclusão da licitação</p>';
	}

	if($usuario->getCargo() != "fornecedor"){

		$bd = new bd();
		$ts = $bd->executa("SELECT * FROM proposta WHERE idlicitacao = '".$_GET['id']."'");
		$oi = $ts->fetch_assoc();
		if($oi == ''){
			echo "<p> Ainda não há propostas cadastradas</p>";
			die;
		}
		else{
		foreach($ts as $ta){	
        ?>
        <table id="table_id" class="display">
        	<thead>
            	<tr>
                <th>Fornecedor</th>
                <th>Edital</th>
                <th>Data</th>
                <th>Ação</th>
            	</tr>
            </thead>
            <tbody>
            <?php
			$idkrl = $ta["idfornecedor"];			
			$us = $bd->executa("SELECT nome FROM usuario WHERE id = '".$idkrl."'");
			foreach($us as $as){
				echo "<tr>";
               echo "<td width='150px'>".$as['nome']."</td>";
               echo "<td width='90px'><a href=".$ta['caminho'].">Proposta</a></td>";
               echo "<td width='90px'>".$ta['data']."</td>";
               echo "<td><a href='altstatus.php?abrir=homologar&idprop=".$ta['idproposta']."'>Aprovar</td>";
            echo "</tr>";
			}
    }
        ?>
            </tbody>
          </table>
          <?php
}
}
}

if($todas[0]->getStatus() == 'Homologada'){

echo '<input type="text" name="descricao" value="'.$todas[0]->getDescricao().'" required="required" disabled="disabled"></input><br>
<input type="text" name="edital" value="'.$todas[0]->getEdital().'" required="required" disabled="disabled"></input><br>
<a href="'.$todas[0]->getCaminho().'">Edital</a><br>';

	if($usuario->getCargo() != "fornecedor"){
		echo 'O vencedor da licitação é '.$todas[0]->getVencedor().'!';
	}
}