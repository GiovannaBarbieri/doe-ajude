<?php

require_once '../VO/UsuarioVO.php';

class ParceiroVO extends UsuarioVO{

    private $nomeParceiro;
    private $telefoneParceiro;
    private $documentoParceiro;
    private $responsavelNota;
    private $idUserAdm;
    private $idUserFunc;
    
    function getNomeParceiro() {
        return $this->nomeParceiro;
    }

    function getTelefoneParceiro() {
        return $this->telefoneParceiro;
    }

    function getDocumentoParceiro() {
        return $this->documentoParceiro;
    }

    function getResponsavelNota() {
        return $this->responsavelNota;
    }

    function getIdUserAdm() {
        return $this->idUserAdm;
    }

    function getIdUserFunc() {
        return $this->idUserFunc;
    }

    function setNomeParceiro($nomeParceiro) {
        $this->nomeParceiro = $nomeParceiro;
    }

    function setTelefoneParceiro($telefoneParceiro) {
        $this->telefoneParceiro = $telefoneParceiro;
    }

    function setDocumentoParceiro($documentoParceiro) {
        $this->documentoParceiro = $documentoParceiro;
    }

    function setResponsavelNota($responsavelNota) {
        $this->responsavelNota = $responsavelNota;
    }

    function setIdUserAdm($idUserAdm) {
        $this->idUserAdm = $idUserAdm;
    }

    function setIdUserFunc($idUserFunc) {
        $this->idUserFunc = $idUserFunc;
    }


    
}