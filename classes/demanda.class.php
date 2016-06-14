<?php

class Licitacao{
    
    private $idLicitacao;
    private $descricao;
    private $data;
    private $edital;
    private $status;
    private $caminho;
    private $vencedor;
    private $idusuario;
    
    function getIdLicitacao() {
        return $this->idLicitacao;
    }

    function setIdDemanda($idDemanda) {
        $this->idDemanda = $idDemanda;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function getData() {
        return $this->data;
    }
    function setData($data) {
        $this->data = $data;
    }

    function getEdital() {
        return $this->edital;
    }

    function setEdital($edital) {
        $this->edital = $edital;
    }

    function getStatus() {
        return $this->status;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function getCaminho() {
        return $this->caminho;
    }

    function setCaminho($caminho) {
        $this->caminho = $caminho;
    }

    function getVencedor() {
        return $this->vencedor;
    }

    function setVencedor($vencedor) {
        $this->vencedor = $vencedor;
    }

    function getIdUsuario() {
        return $this->Idusuario;
    }

    function setIdUsuario($Idusuario) {
        $this->Idusuario = $Idusuario;
    }

}