<?php

require_once '../DAO/ParceiroDAO.php';
include_once 'UtilCTRL.php';

class ParceiroCTRL {
            ////Parceiro Wendell////
    public function InserirParceiro(ParceiroVO $vo) {

        if ($vo->getNomeParceiro() == '' || $vo->getTelefoneParceiro() == '' ||
             $vo->getResponsavelNota() == '' ||
                $vo->getDocumentoParceiro() == '' || $vo->getEmailUsuario() == ''
        ) {

            return 0;
        }
  
        $senha = strtolower(explode('@', $vo->getEmailUsuario())[0]);

        $vo->setSenhaUsuario(password_hash($senha, 1));

      ////  $vo->setIdUserAdm(UtilCTRL::RetornarCodigoUser());
        $vo->setDataCadastro(UtilCTRL::DataAtual());
        $vo->setStatusUsuario(1);
        $vo->setTipoUsuario(UtilCTRL::TipoUsuario(4));

        $dao = new ParceiroDAO();

        $ret = $dao->InserirParceiro($vo);

        return $ret;
    }

    public function CarregarParceiro() {

        $dao = new ParceiroDAO();

        return $dao->CarregarParceiro();
    }
    
                ////PARCEIRO GIOVANNA////
    public function InserirPessoaParceiro(ParceiroVO $vo, $redigiteSenha) {

        if ($vo->getNomeParceiro()  == '' ||$vo->getTelefoneParceiro() == ''   ||
            $vo->getEmailUsuario() == '' || $vo->getResponsavelNota()  == ''    ||
            $vo->getRua() == ''  ||         $vo->getBairro() == '' || $vo->getTipoUsuario() == '' ||
            $vo->getNumero() == ''       || $vo->getId_cidade() == ''           ||
            $vo->getSenhaUsuario() == '' || $redigiteSenha == '') {
            
            return 0;
        }
        
        if($vo->getSenhaUsuario() != $redigiteSenha){
            return -3;
            
        }else if ($vo->getTipoUsuario() == 4) {
            
            $hash = $vo->getSenhaUsuario();
            $senha = password_hash($hash, 1);
            $vo->setSenhaUsuario($senha);

            $dao = new ParceiroDAO();

            $vo->setDataCadastro(UtilCTRL::DataAtual());
            $vo->setStatusUsuario(1);

            $ret = $dao->InserirPessoaParceiro($vo);
            
            return $ret;
        }
        return 0;
    }

}
