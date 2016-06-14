<?php

class Mail{
    private $destinatario;
    private $assunto;
    private $mensagem;
    private $headers;
    
    function getDestinatario() {
        return $this->destinatario;
    }

    function setDestinatario($destinatario) {
        $this->destinatario = $destinatario;
    }

    function getAssunto() {
        return $this->assunto;
    }

    function setAssunto($assunto) {
        $this->assunto = $assunto;
    }

    function getMensagem() {
        return $this->mensagem;
    }

    function setMensagem($mensagem) {
        $this->mensagem = $mensagem;
    }

    function getHeaders() {
        return $this->headers;
    }

    function setHeaders() {
        return $this->headers;
    }
}