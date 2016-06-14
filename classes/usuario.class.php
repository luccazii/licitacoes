<?php
	class Usuario {
		private $idUsuario;
		private $nome;
		private $email;
		private $senha;
		private $cidade;
		private $cargo;
		private $telefone;

		public function getId(){
			return $this->idUsuario;
		}
		public function setIdUsuario($id){
			$this->idUsuario = $id;
		}
		public function getNome(){
			return $this->nome;
		}
		public function setNome($nome){
			$this->nome = $nome;
		}
		public function getEmail(){
			return $this->email;
		}
		public function setEmail($email){
			$this->email = $email;
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
		public function getCidade(){
			return $this->cidade;
		}
		public function setCidade($cidade){
			$cidadeC =  filter_var ( $cidade, FILTER_SANITIZE_STRING);
			$this->cidade = $cidadeC;
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