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

    function setIdLicitacao($idLicitacao) {
        $idLicitacaoC = filter_var ( $idLicitacao, FILTER_SANITIZE_STRING);
        $this->idLicitacao = $idLicitacaoC;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function setDescricao($descricao) {
        $descricaoC = filter_var ( $descricao, FILTER_SANITIZE_STRING);
        $this->descricao = $descricaoC;
    }

    function getData() {
        return $this->data;
    }
    function setData($data) {
        $dataC = filter_var ( $data, FILTER_SANITIZE_STRING);
        $this->data = $dataC;
    }

    function getEdital() {
        return $this->edital;
    }

    function setEdital($edital) {
        $editalC = filter_var ( $edital, FILTER_SANITIZE_STRING);
        $this->edital = $editalC;
    }

    function getStatus() {
        return $this->status;
    }

    function setStatus($status) {
        $statusC = filter_var ( $status, FILTER_SANITIZE_STRING);
        $this->status = $statusC;
    }

    function getCaminho() {
        return $this->caminho;
    }

    function setCaminho($caminho) {
        $caminhoC = filter_var ( $caminho, FILTER_SANITIZE_STRING);
        $this->caminho = $caminhoC;
    }

    function getVencedor() {
        return $this->vencedor;
    }

    function setVencedor($vencedor) {
        $vencedorC = filter_var ( $vencedor, FILTER_SANITIZE_STRING);
        $this->vencedor = $vencedorC;
    }

    function getIdUsuario() {
        return $this->idusuario;
    }

    function setIdUsuario($idUsuario) {
        $idUsuarioC = filter_var ( $idUsuario, FILTER_SANITIZE_STRING);
        $this->idusuario = $idUsuarioC;
    }

}