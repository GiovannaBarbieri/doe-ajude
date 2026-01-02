<?php

require_once '../VO/StatusVO.php';
require_once '../DAO/DoadorDAO.php';
require_once 'UtilCTRL.php';

class DoadorCTRL {

    public function InserirDoacao(DoadorVO $voDo) {

        //Dados do Status
        $voSt = new StatusVO();
        $voSt->setDataStatus(UtilCTRL::DataAtual());
        $voSt->setHoraStatus(UtilCTRL::HoraAtual());
        $voSt->setSituacao(UtilCTRL::RetornarStatus(0));

        $dao = new DoadorDAO();

        $ret = $dao->InserirDoacao($voDo, $voSt);

        return $ret;
    }

    public static function ConsultarEnderecoPessoa() {

        $dao = new DoadorDAO();
        $dados = $dao->ConsultarEnderecoPessoa(UtilCTRL::RetornarCodigoUser());

        return $dados;
    }

    public static function ConsultarDoacao_Pessoa() {

        $dao = new DoadorDAO();
        $dados = $dao->ConsultarDoacao_Pessoa(UtilCTRL::RetornarCodigoUser());

        return $dados;
    }

    public function retornarPessoa() {

        $dao = new DoadorDAO();
        $dados = $dao->retornarPessoa(UtilCTRL::RetornarCodigoUser());

        return $dados;
    }

    public function InserirDoacaoParceiro(DoadorVO $voDo) {

       if ($voDo->getNomeObjeto() == '' || $voDo->getImgObjeto() == '' || $voDo->getEstadoObjeto() == '' ||
               $voDo->getDescricao() == '' || $voDo->getRua() == '' || $voDo->getBairro() == '' ||
               $voDo->getNumero() == '' || $voDo->getCep() == '' || $voDo->getId_cidade() == '') {
           return 0;
       }

        //Dados do Status
        $voSt = new StatusVO();
        $voSt->setDataStatus(UtilCTRL::DataAtual());
        $voSt->setHoraStatus(UtilCTRL::HoraAtual());
        $voSt->setSituacao(UtilCTRL::RetornarStatus(0));
        
        $dao = new DoadorDAO();

        $ret = $dao->InserirDoacaoParceiro($voDo, $voSt);

        return $ret;
    }

    public static function ConsultarEnderecoParceiro() {

        $dao = new DoadorDAO();
        $dados = $dao->ConsultarEnderecoParceiro(UtilCTRL::RetornarCodigoUser());

        return $dados;
    }

    public static function ConsultarDoacaoParceiro() {

        $dao = new DoadorDAO();
        $dados = $dao->ConsultarDoacaoParceiro(UtilCTRL::RetornarCodigoUser());

        return $dados;
    }

    public function retornarParceiro() {

        $dao = new DoadorDAO();
        $dados = $dao->retornarParceiro(UtilCTRL::RetornarCodigoUser());

        return $dados;
    }
  
        public function ConsultarDoacao($tipo_doador, $dt_inicial, $dt_final) {

        $dao = new DoadorDAO();

        $dados = $dao->ConsultarDoacao($tipo_doador, $dt_inicial, $dt_final);

        return $dados;
    }

    public function CarregarDadosDoador() {

        $dao = new DoadorDAO();

        $dados = $dao->CarregarDadosDoador(UtilCTRL::RetornarCodigoUser());

        return $dados;
    }
}
