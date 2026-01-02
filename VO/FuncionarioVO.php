<?php

require_once '../VO/UsuarioVO.php';

class FuncionarioVO extends UsuarioVO {

    private $idFunc;
    private $nomeFunc;
    private $sobrenomeFunc;
    private $telFunc;
    private $idUserFunc;
    private $idUserAdm;

    function getIdFunc() {
        return $this->idFunc;
    }

    function getNomeFunc() {
        return $this->nomeFunc;
    }

    function getSobrenomeFunc() {
        return $this->sobrenomeFunc;
    }

    function getTelFunc() {
        return $this->telFunc;
    }

    function getIdUserFunc() {
        return $this->idUserFunc;
    }

    function getIdUserAdm() {
        return $this->idUserAdm;
    }

    function setIdFunc($idFunc) {
        $this->idFunc = $idFunc;
    }

    function setNomeFunc($nomeFunc) {
        $this->nomeFunc = $nomeFunc;
    }

    function setSobrenomeFunc($sobrenomeFunc) {
        $this->sobrenomeFunc = $sobrenomeFunc;
    }

    function setTelFunc($telFunc) {
        $this->telFunc = $telFunc;
    }

    function setIdUserFunc($idUserFunc) {
        $this->idUserFunc = $idUserFunc;
    }

    function setIdUserAdm($idUserAdm) {
        $this->idUserAdm = $idUserAdm;
    }

}
