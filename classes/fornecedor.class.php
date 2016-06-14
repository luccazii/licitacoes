<?php
	class Fornecedor {
		private $idUsuario;
		private $nomeEmpresa;
		private $CNPJ;
		private $nomeResponsavel;
		private $cidade;
		private $email;
		private $senha;
		private $cargo;

		public function getId(){
			return $this->idUsuario;
		}
		public function setIdUsuario($id){
			$this->idUsuario = $id;
		}
		public function getNomeEmpresa(){
			return $this->nomeEmpresa;
		}
		public function setNomeEmpresa($nomeEmpresa){
			$nomeEmpresaC = filter_var ( $nomeEmpresa, FILTER_SANITIZE_STRING);
			$this->nomeEmpresa = $nomeEmpresaC;
		}
		public function getCNPJ(){
			return $this->CNPJ;
		}
		public function setCNPJ($CNPJ){
			$CNPJC = filter_var ( $CNPJ, FILTER_SANITIZE_STRING);
			$this->CNPJ = $CNPJC;
		}
		public function getNomeResponsavel(){
			return $this->nomeResponsavel;
		}
		public function setNomeResponsavel($nomeResponsavel){
			$nomeResponsavelC = filter_var ( $nomeResponsavel, FILTER_SANITIZE_STRING);
			$this->nomeResponsavel = $nomeResponsavelC;
		}
		public function getCidade(){
			return $this->cidade;
		}
		public function setCidade($cidade){
			$cidadeC = filter_var ( $cidade, FILTER_SANITIZE_STRING);
			$this->cidade = $cidadeC;
		}
		public function getEndereco(){
			return $this->endereco;
		}
		public function setEndereco($endereco){
			$enderecoC = filter_var ( $endereco, FILTER_SANITIZE_STRING);
			$this->endereco = $enderecoC;
		}
		public function getEmail(){
			return $this->email;
		}
		public function setEmail($email){
			$emailC = filter_var ( $email, FILTER_SANITIZE_EMAIL);
			$this->email = $emailC;
		}
		public function getSenha(){
			return $this->senha;
		}
		public function setSenha($senha){
			$senhaC =  filter_var ( $senha, FILTER_SANITIZE_STRING);
			$this->senha = $senhaC;
		}
		public function getCargo(){
			return $this->cargo;
		}
		public function setCargo($cargo){
			$this->cargo = $cargo;
		}
		public function getTelefone(){
			return $this->telefone;
		}
		public function setTelefone($telefone){
			$telefoneC = filter_var ( $telefone, FILTER_SANITIZE_NUMBER_INT);
			$this->telefone = $telefoneC;
		}
	}
?>