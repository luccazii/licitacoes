<?php
	include_once ('historico.class.php');
	include_once ('bd.class.php');
	include_once ('controle.class.php');

	class historicoControle extends controle{

		protected function selecionarClassificado($obj){return false;}
		protected function deletar($obj){return false;}
		protected function alterarAtendida($obj, $id){return false;}
		protected function enviarEmail($destinatario, $assunto, $mensagem){return false;}
		protected function inserirFornecedor($obj){return false;}
		protected function inserirUsuario($obj){return false;}
		protected function selecionarFornecedor($obj){return false;}
		protected function selecionarClassificadoId($obj){return false;}
		protected function abrir($obj){return false;}
		protected function encerrar($obj){return false;}
		protected function homologar($obj){return false;}

		protected function selecionarUm($estado){
				$banco = new bd();
				$est = $banco->consulta("SELECT estado FROM historico WHERE iddemanda='".$estado."' ORDER BY idhistorico DESC LIMIT 1");
				foreach($est as $uma){
					$estado = $uma[0];
					return $estado;
				}
			}

		protected function selecionarTodos(){
				$banco = new bd();
				return $banco->consulta("SELECT * FROM historico WHERE iddemanda = '".$id."'");
			}

		protected function inserir($historico){
				$banco = new bd();
				$banco->executa("INSERT INTO historico (idlicitacoes, data, texto) VALUES ('".$historico->getIdLicitacao()."', '".$historico->getAtualizada()."', '".$historico->getTexto()."')");
			}
		//classe inutilizada V
		protected function alterar($historico){
				$banco = new bd();
				return $banco->executa("UPDATE `sistemaif`.`historico` SET `atualizada` = '".$atualizada."', `estado` = '".$estado."', `encaminhar` = '".$encaminhar."',`contato` = '".$contato."' WHERE `historico`.`idhistorico` = '".$historico->getIdHistorico."'");
			}

		protected function listarEncaminhar($estado){
				$banco = new bd();
				$todas = $banco->consulta("SELECT encaminhar FROM historico WHERE iddemanda='".$estado."' ORDER BY idhistorico DESC LIMIT 1");
				foreach($todas as $uma){
					$tipo = $uma[0];
					return $tipo;
				}
			}

		protected function listarResp($id){
				$banco = new bd();
				$todas = $banco->consulta("SELECT contato FROM historico WHERE iddemanda='".$id."' ORDER BY idhistorico DESC LIMIT 1");
				foreach($todas as $uma){
					$tipo = $uma[0];
					return $tipo;
				}
			}

		public function timeNow(){
			setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
			date_default_timezone_set('America/Sao_Paulo');
			return $time= date("Y-m-d H:i:s", strtotime("now"));
		}
	}