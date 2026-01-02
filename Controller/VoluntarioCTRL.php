<?php

require_once '../VO/StatusVO.php';
require_once '../Controller/UtilCTRL.php';
require_once '../DAO/VoluntarioDAO.php';

class VoluntarioCTRL {

    public function CadastrarVoluntario(VoluntarioVO $voVol) {

        //Dados do Status
        $voSt = new StatusVO();
        $voSt->setDataStatus(UtilCTRL::DataAtual());
        $voSt->setHoraStatus(UtilCTRL::HoraAtual());
        $voSt->setSituacao(UtilCTRL::RetornarStatus(0));

        $dao = new VoluntarioDAO();

        $ret = $dao->CadastrarVoluntario($voVol, $voSt);

        return $ret;
    }

    public function ConsultarVoluntario_Pessoa() {

        $dao = new VoluntarioDAO();
        $dados = $dao->ConsultarVoluntario();

        return $dados;
    }

       public function ConsultarVoluntario($tipo_voluntario, $dt_inicial, $dt_final) {

        $dao = new VoluntarioDAO();

        $dados = $dao->ConsultarVoluntario($tipo_voluntario, $dt_inicial, $dt_final);

        return $dados;
    }
    
    
    
    public function retornarPessoa() {

        $dao = new VoluntarioDAO();
        $dados = $dao->retornarPessoa(UtilCTRL::RetornarCodigoUser());

        return $dados;
    }

}
