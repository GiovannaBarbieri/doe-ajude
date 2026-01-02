<?php

require_once '../VO/EnderecoVO.php';

class DoacaoVO extends EnderecoVO{

    private $idPessoa;
    private $nomeObjeto;
    private $imgObjeto;
    private $estadoObjeto;
    private $descricao;
    private $idStatus;
    private $rua;
    private $bairro;           
    private $numero;           
    private $cep;           
    private $id_cidade;           
    private $idLogado;
    private $idDoador;    
            
    function getIdPessoa() {
        return $this->idPessoa;
    }

    function getNomeObjeto() {
        return $this->nomeObjeto;
    }

    function getImgObjeto() {
        return $this->imgObjeto;
    }

    function getEstadoObjeto() {
        return $this->estadoObjeto;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getIdStatus() {
        return $this->idStatus;
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

    function getIdLogado() {
        return $this->idLogado;
    }

    function getIdDoador() {
        return $this->idDoador;
    }

    function setIdPessoa($idPessoa) {
        $this->idPessoa = $idPessoa;
    }

    function setNomeObjeto($nomeObjeto) {
        $this->nomeObjeto = $nomeObjeto;
    }

    function setImgObjeto($imgObjeto) {
        $this->imgObjeto = $imgObjeto;
    }

    function setEstadoObjeto($estadoObjeto) {
        $this->estadoObjeto = trim($estadoObjeto);
    }

    function setDescricao($descricao) {
        $this->descricao = trim($descricao);
    }

    function setIdStatus($idStatus) {
        $this->idStatus = $idStatus;
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

    function setIdLogado($idLogado) {
        $this->idLogado = $idLogado;
    }

    function setIdDoador($idDoador) {
        $this->idDoador = $idDoador;
    }

}
