<?php

require_once '../VO/UsuarioVO.php';

class DoadorVO extends UsuarioVO{

    private $idDoador;
    private $nomeObjeto;
    private $imgObjeto;
    private $estadoObjeto;
    private $descricao;
    private $idPessoa;
    private $idParceiro;
       
    function getIdDoador() {
        return $this->idDoador;
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

    function getIdPessoa() {
        return $this->idPessoa;
    }

    function getIdParceiro() {
        return $this->idParceiro;
    }

    function setIdDoador($idDoador) {
        $this->idDoador = $idDoador;
    }

    function setNomeObjeto($nomeObjeto) {
        $this->nomeObjeto = trim($nomeObjeto);
    }

    function setImgObjeto($imgObjeto) {
        $this->imgObjeto = trim($imgObjeto);
    }

    function setEstadoObjeto($estadoObjeto) {
        $this->estadoObjeto = trim($estadoObjeto);
    }

    function setDescricao($descricao) {
        $this->descricao = trim($descricao);
    }

    function setIdPessoa($idPessoa) {
        $this->idPessoa = $idPessoa;
    }

    function setIdParceiro($idParceiro) {
        $this->idParceiro = $idParceiro;
    }

}
