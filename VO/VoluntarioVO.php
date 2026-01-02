<?php

require_once '../VO/UsuarioVO.php';

class VoluntarioVO extends UsuarioVO {

    private $idVoluntario;
    private $disponibilidade;
    private $setorVoluntario;
    private $sobreVoluntario;
    private $idPessoa;

    function getIdVoluntario() {
        return $this->idVoluntario;
    }

    function getDisponibilidade() {
        return $this->disponibilidade;
    }

    function getSetorVoluntario() {
        return $this->setorVoluntario;
    }

    function getSobreVoluntario() {
        return $this->sobreVoluntario;
    }

    function getIdPessoa() {
        return $this->idPessoa;
    }

    function setIdVoluntario($idVoluntario) {
        $this->idVoluntario = $idVoluntario;
    }

    function setDisponibilidade($disponibilidade) {
        $this->disponibilidade = $disponibilidade;
    }

    function setSetorVoluntario($setorVoluntario) {
        $this->setorVoluntario = $setorVoluntario;
    }

    function setSobreVoluntario($sobreVoluntario) {
        $this->sobreVoluntario = $sobreVoluntario;
    }

    function setIdPessoa($idPessoa) {
        $this->idPessoa = $idPessoa;
    }

}
