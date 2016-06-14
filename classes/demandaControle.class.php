<?php
include_once ('licitacao.class.php');
include_once ('bd.class.php');
include_once ('controle.class.php');
include_once ('historicoControle.class.php');

class LicitacaoControle extends controle{

	protected function listarEncaminhar($obj){return false;}
	protected function listarResp($obj){return false;}
	protected function deletar($obj){return false;}
	protected function timeNow(){return false;}
	protected function enviarEmail($destinatario, $assunto, $mensagem){return false;}
	protected function inserirFornecedor($obj){return false;}
	protected function inserirUsuario($obj){return false;}
	protected function selecionarFornecedor($obj){return false;}
	protected function selecionarClassificadoId($obj){return false;}
	protected function abrir($obj){return false;}
	protected function encerrar($obj){return false;}
	protected function homologar($obj){return false;}

	protected function selecionarUm($obj){
		$banco = new bd();
		$demanda = $banco->consulta("SELECT * FROM demanda WHERE iddemanda='".$obj."'");
		return $demanda;
	}

	protected function selecionarTodos(){
        $bd = new bd();
        $linhas = $bd->executa ("SELECT * FROM demanda");
        $num = $bd->executa("SELECT COUNT(DISTINCT iddemanda) FROM demanda");
        if($num->field_count == '0'){
			return 1;
			die;
		}

		else{
	        foreach($linhas as $dem){
				$demanda = new demanda();
				$demanda->setIdDemanda($dem["iddemanda"]);
				$demanda->setNome($dem["nome"]);
				$demanda->setEmpresa($dem["empresa"]);
				$demanda->setTelefone($dem["telefone"]);
				$demanda->setEmail($dem["email"]);
				$demanda->setDescricao($dem["descricao"]);
				$demanda->setEnvio($dem["envio"]);
				$demanda->setFinalizada($dem["finalizada"]);
				$demanda->setAtendida($dem["atendida"]);
				$demanda->setEspecialista($dem["especialista"]);

				$demandas[] = $demanda;
			}
				return $demandas;
		}	
	}

	protected function selecionarClassificado($obj){
        $bd = new bd();
        $linhas = $bd->executa ("SELECT *
               FROM demanda d, historico h, (
               SELECT h2.iddemanda, MAX( h2.idhistorico ) mid
               FROM historico h2
               GROUP BY h2.iddemanda
                )h3
               WHERE d.iddemanda = h.iddemanda
               AND h.iddemanda = h3.iddemanda
               AND h.idhistorico = h3.mid
				AND h.encaminhar = '".$obj->getClasse()."'
               GROUP BY d.iddemanda
               ORDER BY d.iddemanda DESC");
        if($linhas->num_rows == '0'){
			return 1;
			die;
		}
		else{
	        foreach($linhas as $dem){
				$demanda = new demanda();
				$demanda->setIdDemanda($dem["iddemanda"]);
				$demanda->setNome($dem["nome"]);
				$demanda->setEmpresa($dem["empresa"]);
				$demanda->setTelefone($dem["telefone"]);
				$demanda->setEmail($dem["email"]);
				$demanda->setDescricao($dem["descricao"]);
				$demanda->setEnvio($dem["envio"]);
				$demanda->setFinalizada($dem["finalizada"]);
				$demanda->setAtendida($dem["atendida"]);
				$demanda->setEspecialista($dem["especialista"]);

				$demandas[] = $demanda;
			}
			return $demandas;
		}
	}

	protected function inserir($demanda){
        $bd = new bd();
        $hc = new historicoControle();
        $time=$hc->controleAcao("timeNow");
        $id= $bd->insereId("INSERT INTO demanda (nome, empresa, telefone, email, descricao, envio, finalizada, atendida, especialista) VALUES ('".$demanda->getNome()."','".$demanda->getEmpresa()."','".$demanda->getTelefone()."','".$demanda->getEmail()."','".$demanda->getDescricao()."','".$demanda->getEnvio()."', NULL,'".$demanda->getAtendida()."','".$demanda->getEspecialista()."'); ");
		$demanda = new demanda();
		$demanda->setIdDemanda($id);
		$historico = new historico();
		$historico->setIdDemanda($id);
		$historico->setAtualizada($time);
		$historico->setEstado("Demandante submeteu.");
		$historico->setEncaminhar(NULL);
		$historico->setContato(NULL);
		$hc->controleAcao("inserir", $historico);
		header("location: thnx.php");

	}

	protected function alterar($demanda){
		$bd = new bd();
        return $bd->executa("UPDATE demanda SET nome ='".$demanda->getNome()."' , empresa = '".$demanda->getEmpresa()."' , telefone = '".$demanda->getTelefone()."' , email = '".$demanda->getEmail()."' , descricao = '".$demanda->getDescricao()."' , envio = '".$demanda->getEnvio()."' , finalizada = '".$demanda->getFinalizada()."' , atendida = '".$demanda->getAtendida()."' , especialista = '".$demanda->getEspecialista()."'");
    }

	protected function alterarAtendida($id, $atendida){
		return "XABLAU WOLOLO";
		$bd = new bd();
        $bd->executa("UPDATE demanda SET atendida = '".$atendida."'where iddemanda = '".$id."'");
        return "XABLAU WOLOLO";
    }
}