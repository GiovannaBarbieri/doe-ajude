<?php

class EnderecoVO {
    
    private $idEndereco;
    private $rua;
    private $bairro;
    private $numero;
    private $cep;
    private $id_cidade;
    private $id_usuario;
    private $id_doador;

    function getIdEndereco() {
        return $this->idEndereco;
    }

    function getRua() {
        return $this->rua;
    }

    function getBairro() {
        return $this->bairro;
    }

    function getNumero() {
        return $this->numero;
    }

    function getCep() {
        return $this->cep;
    }

    function getId_cidade() {
        return $this->id_cidade;
    }

    function getId_usuario() {
        return $this->id_usuario;
    }

    function getId_doador() {
        return $this->id_doador;
    }

    function setIdEndereco($idEndereco) {
        $this->idEndereco = $idEndereco;
    }

    function setRua($rua) {
        $this->rua = trim($rua);
    }

    function setBairro($bairro) {
        $this->bairro = trim($bairro);
    }

    function setNumero($numero) {
        $this->numero = trim($numero);
    }

    function setCep($cep) {
        $this->cep = trim($cep);
    }

    function setId_cidade($id_cidade) {
        $this->id_cidade = $id_cidade;
    }

    function setId_usuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }

    function setId_doador($id_doador) {
        $this->id_doador = $id_doador;
    }    
    
}
