<?php
	include_once("fornecedor.class.php");
	include_once("bd.class.php");
	include_once("controle.class.php");

	class fornecedorControle extends controle{
	protected function selecionarUm($obj){return false;}
	protected function listarEncaminhar($obj){return false;}
	protected function selecionarTodos(){return false;}
	protected function listarResp($obj){return false;}
	protected function inserir($obj){return false;}
	protected function alterarAtendida($obj, $id){return false;}
	protected function alterar($obj){return false;}
	protected function deletar($obj){return false;}
	protected function selecionarClassificado($obj){return false;}
	protected function timeNow(){return false;}
	protected function enviarEmail($destinatario, $assunto, $mensagem){return false;}
	protected function verificar($usuario){return false;}
	protected function inserirUsuario($obj){return false;}
	protected function selecionarClassificadoId($obj){return false;}
	protected function abrir($obj){return false;}
	protected function encerrar($obj){return false;}
	protected function homologar($obj){return false;}

		public function inserirFornecedor($fornecedor){
			$banco = new bd();
			$id = $banco->insereID("INSERT INTO usuario(nome,senha,email,cidade,telefone, CPF, cargo) VALUES ('".$fornecedor->getNomeEmpresa()."','".$fornecedor->getSenha()."','".$fornecedor->getEmail()."','".$fornecedor->getCidade()."','".$fornecedor->getTelefone()."','NULL','fornecedor')");
			$banco->executa("INSERT INTO fornecedor(CNPJ, responsavel, endereco, idusuario) VALUES ('".$fornecedor->getCNPJ()."','".$fornecedor->getNomeResponsavel()."','".$fornecedor->getEndereco()."','".$id."')");
		}
		public function selecionarFornecedor($id){
			$banco = new bd();
			$ele = $banco->consulta("SELECT * FROM usuario WHERE id = '".$id."'");
			$ele2 = $banco->consulta("SELECT * FROM fornecedor WHERE idusuario = '".$id."'");
			$tudo = [$ele, $ele2];
			return $tudo;
		}
	}
