<?php
	class Historico{

		private $idHistorico;
		private $idLicitacao;
		private $atualizada;
		private $texto;

		public function getIdHistorico(){
			return $this ->idHistorico;
		}
		public function setIdHistorico($idHistorico){
			$idHistoricoC = filter_var ( $idHistorico, FILTER_SANITIZE_STRING);
			$this ->idHistorico = $idHistoricoC;
		}
		public function getIdLicitacao(){
			return $this ->idLicitacao;
		}
		public function setIdLicitacao($idlicitacao){
			$idlicitacaoC = filter_var ( $idlicitacao, FILTER_SANITIZE_STRING);
			$this ->idLicitacao = $idlicitacaoC;
		}
		public function getAtualizada(){
			return $this ->atualizada;
		}
		public function setAtualizada($atualizada){
			$this ->atualizada = $atualizada;
		}
		public function getTexto(){
			return $this ->texto;
		}
		public function setTexto($texto){
			$textoC = filter_var ( $texto, FILTER_SANITIZE_STRING);
			$this ->texto = $textoC;
		}

	}