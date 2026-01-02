<?php

require_once '../VO/EnderecoVO.php';

class UsuarioVO extends EnderecoVO {

    private $idUser;
    private $emailUsuario;
    private $senhaUsuario;
    private $tipoUsuario;
    private $dataCadastro;
    private $statusUsuario;
    private $imagem_user; 
    
    function getIdUser() {
        return $this->idUser;
    }

    function getEmailUsuario() {
        return $this->emailUsuario;
    }

    function getSenhaUsuario() {
        return $this->senhaUsuario;
    }

    function getTipoUsuario() {
        return $this->tipoUsuario;
    }

    function getDataCadastro() {
        return $this->dataCadastro;
    }

    function getStatusUsuario() {
        return $this->statusUsuario;
    }

    function getImagem_user() {
        return $this->imagem_user;
    }

    function setIdUser($idUser) {
        $this->idUser = $idUser;
    }

    function setEmailUsuario($emailUsuario) {
        $this->emailUsuario = trim($emailUsuario);
    }

    function setSenhaUsuario($senhaUsuario) {
        $this->senhaUsuario = trim($senhaUsuario);
    }

    function setTipoUsuario($tipoUsuario) {
        $this->tipoUsuario = $tipoUsuario;
    }

    function setDataCadastro($dataCadastro) {
        $this->dataCadastro = $dataCadastro;
    }

    function setStatusUsuario($statusUsuario) {
        $this->statusUsuario = $statusUsuario;
    }

    function setImagem_user($imagem_user) {
        $this->imagem_user = trim($imagem_user);
    }

}
