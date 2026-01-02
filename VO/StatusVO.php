<?php


class StatusVO {
    
    private $idStatus;
    private $dataStatus;
    private $horaStatus;
    private $situacao;
    private $tipo;
    private $idFunc;
    private $idDoador;
    private $idVoluntario;
    
    function getIdStatus() {
        return $this->idStatus;
    }

    function getDataStatus() {
        return $this->dataStatus;
    }

    function getHoraStatus() {
        return $this->horaStatus;
    }

    function getSituacao() {
        return $this->situacao;
    }
    function getTipo() {
        return $this->tipo;
    }

    function getIdFunc() {
        return $this->idFunc;
    }

    function getIdDoador() {
        return $this->idDoador;
    }

    function getIdVoluntario() {
        return $this->idVoluntario;
    }

    function setIdStatus($idStatus) {
        $this->idStatus = $idStatus;
    }

    function setDataStatus($dataStatus) {
        $this->dataStatus = $dataStatus;
    }

    function setHoraStatus($horaStatus) {
        $this->horaStatus = $horaStatus;
    }

    function setSituacao($situacao) {
        $this->situacao = $situacao;
    }
    function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    function setIdFunc($idFunc) {
        $this->idFunc = $idFunc;
    }

    function setIdDoador($idDoador) {
        $this->idDoador = $idDoador;
    }

    function setIdVoluntario($idVoluntario) {
        $this->idVoluntario = $idVoluntario;
    }

}
