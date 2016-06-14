<?php

abstract class Controle{
	
	abstract protected function selecionarUm($obj);
	abstract protected function selecionarTodos();
	abstract protected function inserir($obj);
	abstract protected function alterar($obj);
	abstract protected function deletar($obj);
	abstract protected function listarEncaminhar($obj);
	abstract protected function listarResp($obj);
	abstract protected function timeNow();
	abstract protected function alterarAtendida($obj, $id);
	abstract protected function selecionarClassificado($obj);
	abstract protected function selecionarClassificadoId($obj);
	abstract protected function enviarEmail($destinatario, $assunto, $mensagem);
	abstract protected function inserirFornecedor($obj);
	abstract protected function inserirUsuario($obj);
	abstract protected function selecionarFornecedor($obj);
	abstract protected function abrir($obj);
	abstract protected function encerrar($obj);
	abstract protected function homologar($obj);
	
	public function controleAcao($acao, $obj = false, $id = false){
		switch($acao){
			case "inserir":
				return $this->inserir($obj);
				break;
			case "alterar":
				return $this->alterar($obj);
				break;
			case "deletar":
				return $this->deletar($obj);
				break;
			case "selecionarUm":
				return $this->selecionarUm($obj);
				break;
			case "selecionarTodos":
				return $this->selecionarTodos();
				break;
			case "listarEncaminhar":
				return $this->listarEncaminhar($obj);
				break;
			case "listarResp":
				return $this->listarResp($obj);
				break;
			case "abrir":
				return $this->abrir($obj);
				break;
			case "encerrar":
				return $this->encerrar($obj);
				break;
			case "homologar":
				return $this->homologar($obj);
				break;
			case "timeNow":
				return $this->timeNow();
				break;
			case "alterarAtendida":
				return $this->alterarAtendida($obj, $id);
				break;
			case "selecionarClassificado":
				return $this->selecionarClassificado($obj);
				break;
			case "selecionarClassificadoId":
				return $this->selecionarClassificadoId($obj);
				break;
			case "inserirFornecedor":
				return $this->inserirFornecedor($obj);
				break;
			case "selecionarFornecedor":
				return $this->selecionarFornecedor($obj);
				break;
			case "inserirUsuario":
				return $this->inserirUsuario($obj);
				break;
			case "enviarEmail":
				return $this->enviarEmail($destinatario, $assunto, $mensagem);
				break;
			default:
				return "Ação indefinida";
		}
	}
}
?>