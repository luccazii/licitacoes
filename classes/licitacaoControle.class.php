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

	protected function selecionarUm($obj){
		$banco = new bd();
		$demanda = $banco->consulta("SELECT * FROM demanda WHERE iddemanda='".$obj."'");
		return $demanda;
	}

	protected function selecionarTodos(){
        $bd = new bd();
        $linhas = $bd->executa ("SELECT * FROM licitacoes");
        $num = $bd->executa("SELECT COUNT(DISTINCT idlicitacao) FROM licitacoes");
        if($num->field_count == '0'){
			return 1;
			die;
		}

		else{
				foreach($linhas as $lic){
				$licitacao = new licitacao();
				$licitacao->setIdLicitacao($lic["idlicitacao"]);
				$licitacao->setDescricao($lic["descricao"]);
				$licitacao->setData($lic["data"]);
				$licitacao->setEdital($lic["edital"]);
				$licitacao->setStatus($lic["status"]);
				$licitacao->setCaminho($lic["caminho"]);
				$licitacao->setVencedor($lic["vencedor"]);
				$licitacao->setIdUsuario($lic["idusuario"]);

				$licitacoes[] = $licitacao;
			}
				return $licitacoes;
		}
	}

	protected function selecionarClassificado($obj){
        $bd = new bd();
        $linhas = $bd->executa ("SELECT * FROM licitacoes WHERE idusuario = '".$obj."' ");
        if($linhas->num_rows == '0'){
			return 1;
			die;
		}
		else{
			foreach($linhas as $lic){
				$licitacao = new licitacao();
				$licitacao->setIdLicitacao($lic["idlicitacao"]);
				$licitacao->setDescricao($lic["descricao"]);
				$licitacao->setData($lic["data"]);
				$licitacao->setEdital($lic["edital"]);
				$licitacao->setStatus($lic["status"]);
				$licitacao->setCaminho($lic["caminho"]);
				$licitacao->setVencedor($lic["vencedor"]);
				$licitacao->setIdUsuario($lic["idusuario"]);

				$licitacoes[] = $licitacao;
			}
			return $licitacoes;
		}
	}

	protected function selecionarClassificadoId($obj){
        $bd = new bd();
        $linhas = $bd->executa ("SELECT * FROM licitacoes WHERE idlicitacao = '".$obj."' ");
        if($linhas->num_rows == '0'){
			return 1;
			die;
		}
		else{
			foreach($linhas as $lic){
				$licitacao = new licitacao();
				$licitacao->setIdLicitacao($lic["idlicitacao"]);
				$licitacao->setDescricao($lic["descricao"]);
				$licitacao->setData($lic["data"]);
				$licitacao->setEdital($lic["edital"]);
				$licitacao->setStatus($lic["status"]);
				$licitacao->setCaminho($lic["caminho"]);
				$licitacao->setVencedor($lic["vencedor"]);
				$licitacao->setIdUsuario($lic["idusuario"]);

				$licitacoes[] = $licitacao;
			}
			return $licitacoes;
		}
	}

	protected function inserir($licitacao){
        $bd = new bd();
        $hc = new historicoControle();
        $time = $hc->controleAcao("timeNow");
        $id = $bd->insereId("INSERT INTO licitacoes (descricao, data, edital, status, caminho, vencedor, idusuario) VALUES ('".$licitacao->getDescricao()."','".$time."','".$licitacao->getEdital()."','".$licitacao->getStatus()."','".$licitacao->getCaminho()."','".$licitacao->getVencedor()."','".$licitacao->getIdUsuario()."'); ");
		$historico = new historico();
		$historico->setIdLicitacao($id);
		$historico->setAtualizada($time);
		$historico->setTexto("Licitação criada.");
		$hc->controleAcao("inserir", $historico);
		header("location: edicao.php");

	}

	protected function alterar($lic){
		$bd = new bd();
		$hc = new historicoControle();
		$time = $hc->controleAcao("timeNow");
        $bd->executa("UPDATE licitacoes SET descricao ='".$lic->getDescricao()."' , data = '".$lic->getData()."' , edital = '".$lic->getEdital()."' , status = '".$lic->getStatus()."' , caminho = '".$lic->getCaminho()."' , vencedor = '".$lic->getVencedor()."' WHERE idlicitacao = '".$lic->getIdLicitacao()."'");
        $historico = new historico();
		$historico->setIdLicitacao($lic->getIdLicitacao());
		$historico->setAtualizada($time);
		$historico->setTexto("Licitação atualizada.");
		$hc->controleAcao("inserir", $historico);
		session_start();
		$_SESSION['mensagem'] = "1";
		header("location: edicao.php");
    }

    protected function abrir($lic){
		$bd = new bd();
		$hc = new historicoControle();
		$time = $hc->controleAcao("timeNow");
        $bd->executa("UPDATE licitacoes SET descricao ='".$lic->getDescricao()."' , data = '".$lic->getData()."' , edital = '".$lic->getEdital()."' , status = '".$lic->getStatus()."' , caminho = '".$lic->getCaminho()."' , vencedor = '".$lic->getVencedor()."' WHERE idlicitacao = '".$lic->getIdLicitacao()."'");
        $historico = new historico();
		$historico->setIdLicitacao($lic->getIdLicitacao());
		$historico->setAtualizada($time);
		$historico->setTexto("Licitação aberta.");
		$hc->controleAcao("inserir", $historico);
		$_SESSION['mensagem'] = "2";
		header("location: edicao.php");
    }

    protected function encerrar($lic){
		$bd = new bd();
		$hc = new historicoControle();
		$time = $hc->controleAcao("timeNow");
        $bd->executa("UPDATE licitacoes SET descricao ='".$lic->getDescricao()."' , data = '".$lic->getData()."' , edital = '".$lic->getEdital()."' , status = '".$lic->getStatus()."' , caminho = '".$lic->getCaminho()."' , vencedor = '".$lic->getVencedor()."' WHERE idlicitacao = '".$lic->getIdLicitacao()."'");
        $historico = new historico();
		$historico->setIdLicitacao($lic->getIdLicitacao());
		$historico->setAtualizada($time);
		$historico->setTexto("Licitação encerrada.");
		$hc->controleAcao("inserir", $historico);
		$_SESSION['mensagem'] = "3";
		header("location: edicao.php");
    }

    protected function homologar($lic){
		$bd = new bd();
		$hc = new historicoControle();
		$time = $hc->controleAcao("timeNow");
        $bd->executa("UPDATE licitacoes SET descricao ='".$lic->getDescricao()."' , data = '".$lic->getData()."' , edital = '".$lic->getEdital()."' , status = '".$lic->getStatus()."' , caminho = '".$lic->getCaminho()."' , vencedor = '".$lic->getVencedor()."' WHERE idlicitacao = '".$lic->getIdLicitacao()."'");
        $historico = new historico();
		$historico->setIdLicitacao($lic->getIdLicitacao());
		$historico->setAtualizada($time);
		$historico->setTexto("Licitação homologada.");
		$hc->controleAcao("inserir", $historico);
		$_SESSION['mensagem'] = "4";
		header("location: edicao.php");
    }

	protected function alterarAtendida($id, $atendida){
		return "XABLAU WOLOLO";
		$bd = new bd();
        $bd->executa("UPDATE demanda SET atendida = '".$atendida."'where iddemanda = '".$id."'");
        return "XABLAU WOLOLO";
    }
}