<?php
require_once '../DAO/DoacaoDAO.php';
require_once 'UtilCTRL.php';


class DoacaoCTRL {

  public static function ConsultarDoacao() {

            $dao = new DoacaoDAO();
            $dados = $dao->ConsultarDoacao();

        return $dados;
    }

}
