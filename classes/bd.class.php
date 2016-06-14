<?php
	class bd{
		public $conexao;
		public $id;
		public function __construct(){
			$this->conexao = new mysqli("127.0.0.1", "u832276958_nico", "aloalo", "u832276958_cript");
			$this->conexao -> set_charset("utf8");
		}

	public function consulta($select){
		$this->conexao->query($select);
		$retorno = array();
		$dados = array();
		$result = $this->conexao->query($select);
		while($retorno = $result->fetch_array(MYSQLI_NUM)) {
			$dados[] = $retorno;
		}
		return $dados;
	}

	public function executa($sql){
		$RetornoExecucao = $this->conexao->query($sql);
		$this->id = $this->conexao->insert_id;
		return $RetornoExecucao;
	}

	public function insereID($sql){
		$this->conexao->query($sql);
		return $this->conexao->insert_id;
	}

	public function __destruct(){
		$this->conexao->close();
	}
}
?>