<?php

require_once '../VO/UsuarioVO.php';

require_once '../DAO/PessoaDAO.php';

require_once 'UtilCTRL.php';

class PessoaCTRL {

    public function InserirPessoa(UsuarioVO $voUser, PessoaVO $voPessoa, $redigiteSenha) {

        if ($voUser->getEmailUsuario() == '' || $voUser->getSenhaUsuario() == '' || $redigiteSenha == '' ||
                $voUser->getTipoUsuario() == '' ||
                $voPessoa->getNomePessoa() == '' || $voPessoa->getTelefonePessoa() == '' || $voPessoa->getRua() == '' ||
                $voPessoa->getBairro() == '' || $voPessoa->getNumero() == '' || $voPessoa->getId_cidade() == '') {

            return 0;
        }

//        Verificar esse if

        if ($voUser->getSenhaUsuario() != $redigiteSenha) {

            return -3;
        } elseif ($voUser->getTipoUsuario() == 3) {



            $hash = $voUser->getSenhaUsuario();

            $senha = password_hash($hash, 1);

            $voUser->setSenhaUsuario($senha);



            $dao = new PessoaDAO();



            $voUser->setDataCadastro(UtilCTRL::DataAtual());

            $voUser->setStatusUsuario(1);



            $ret = $dao->InserirPessoa($voUser, $voPessoa);



            return $ret;
        }





        //Fazer a logica para inserir na tabela de parceiro = Giovanna

        return 0;
    }

    public function CarregarDadosPessoa() {



        $dao = new PessoaDAO();



        $dados = $dao->CarregarDadosPessoa(UtilCTRL::RetornarCodigoUser());



        return $dados;
    }

    public function AtualizarDadosPessoa(UsuarioVO $user, PessoaVO $pes) {



        if ($pes->getNomePessoa() == '' || $user->getEmailUsuario() == '' || $pes->getTelefonePessoa() == '') {

            return 0;
        }



        $dao = new PessoaDAO();



        $dados = $dao->AtualizarDadosPessoa($user, $pes, UtilCTRL::RetornarCodigoUser());



        return $dados;
    }

    public function CidadePessoa() {



        $dao = new PessoaDAO();



        $dados = $dao->CidadePessoa();



        return $dados;
    }

    public function RecuperarSenha($email) {

        if (trim($email) == '') {

            return 0;
        }try {

            $dao = new PessoaDAO();

            return $dao->RecuperarSenha($email);
        } catch (Exception $ex) {
            echo $ex->getMessage();

            return -1;
        }
    }

    public function ValidaHash($hash) {

        if ($hash == '') {

            return 0;
        }try {

            $dao = new PessoaDAO();

            $ret = $dao->ValidaHash($hash);

            return $ret;



            if (count($ret) == 0) {

                header('location: index.php');
            }
        } catch (Exception $ex) {

            return -1;
        }
    }

    public function NovaSenha($senha, $rsenha, $id) {

        if ($id == '') {

            return 0;
        }

        if (trim(strlen($senha)) < 6) {

            return -8;
        }

        if (trim($senha) != trim($rsenha)) {

            return -9;
        }

        //criptografia

        $hash = UtilCTRL::DevolverCriptografia($senha);
        try {
            $objDao = new PessoaDAO();
            $ret = $objDao->NovaSenha($hash, $id);
            return 10;
        } catch (Exception $ex) {

            return -1;
        }
    }

}
