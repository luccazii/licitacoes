<?php
	include_once("usuario.class.php");
	include_once("bd.class.php");
	include_once("controle.class.php");

	class usuarioControle extends controle{
	protected function listarEncaminhar($obj){return false;}
	protected function listarResp($obj){return false;}
	protected function inserir($obj){return false;}
	protected function alterarAtendida($obj, $id){return false;}
	protected function alterar($obj){return false;}
	protected function deletar($obj){return false;}
	protected function selecionarClassificado($obj){return false;}
	protected function timeNow(){return false;}
	protected function enviarEmail($destinatario, $assunto, $mensagem){return false;}
	protected function inserirFornecedor($obj){return false;}
	protected function selecionarFornecedor($obj){return false;}
	protected function selecionarClassificadoId($obj){return false;}
	protected function abrir($obj){return false;}
	protected function encerrar($obj){return false;}
	protected function homologar($obj){return false;}

	public function verificar($usuario){
			$banco = new bd();
			$resultado = $banco->consulta("select * from usuario where email = '".$usuario->getEmail()."' and senha = '".$usuario->getSenha()."'");
			if(count($resultado) > 0){
				if($resultado[0][3] === $usuario->getEmail() && $resultado[0][2] === $usuario->getSenha());
					return $resultado;

			}
				else{
					return false;
			}
	}

	public function inserirUsuario($usuario){
			$banco = new bd();
			$id = $banco->insereID("INSERT INTO usuario(nome,senha,email,cidade,telefone, cargo) VALUES ('".$usuario->getNome()."','".$usuario->getSenha()."','".$usuario->getEmail()."','".$usuario->getCidade()."','".$usuario->getTelefone()."','vendedor')");
	}

	public function selecionarUm($obj){
		$banco = new bd();
		$demanda = $banco->consulta("SELECT * FROM usuario WHERE id ='".$obj."'");
		return $demanda;
	}

	public function selecionarTodos(){
		$banco = new bd();
		$todos = $banco->consulta("SELECT * FROM usuario");
		return $todos;
	}
}