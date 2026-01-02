<?php

require_once '../VO/UsuarioVO.php';

class PessoaVO extends UsuarioVO {
    
    private $idPessoa;
    private $nomePessoa;
    private $telefonePessoa;
    private $idUserPessoa;
  
    function getIdPessoa() {
        return $this->idPessoa;
    }

    function getNomePessoa() {
        return $this->nomePessoa;
    }

    function getTelefonePessoa() {
        return $this->telefonePessoa;
    }

    function getIdUserPessoa() {
        return $this->idUserPessoa;
    }

    function setIdPessoa($idPessoa) {
        $this->idPessoa = $idPessoa;
    }

    function setNomePessoa($nomePessoa) {
        $this->nomePessoa = trim($nomePessoa);
    }

    function setTelefonePessoa($telefonePessoa) {
        $this->telefonePessoa = trim($telefonePessoa);
    }

    function setIdUserPessoa($idUserPessoa) {
        $this->idUserPessoa = $idUserPessoa;
    }

}
