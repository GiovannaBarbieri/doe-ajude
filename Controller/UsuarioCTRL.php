<?php

//require_once $_SERVER['DOCUMENT_ROOT'] . '/DAO/UsuarioDAO.php';
require_once '../DAO/UsuarioDAO.php';

require_once 'UtilCTRL.php';

class UsuarioCTRL {

//Start Usuarios    

    public static function ValidarLogin($login, $senha) {

        if (trim($login) == '' || trim($senha) == '') {

            return 0;
        }

        $dao = new UsuarioDAO();

        $user = $dao->ValidarLogin($login);

        if (count($user) > 0) {

            if (password_verify($senha, $user[0]['senha_usuario'])) {

                UtilCtrl::CriarSessao($user[0]['id_usuario'], $user[0]['tipo_usuario'], $user[0]['id_funcionario'] == '' ? '' : $user[0]['id_funcionario']);

                switch ($user[0]['tipo_usuario']) {

                    case 1:

                        header('location: dados_administrador.php');

                        break;

                    case 2:

                        header('location: dados_funcionario.php');

                        break;

                    case 3:

                        header('location: dados_pessoa.php');

                        break;

                    case 4:

                        header('location: dados_parceiro.php');

                        break;
                }
            } else {

                return -4;
            }
        } else {

            return 4;
        }
    }

    public function CarregarNomeTopo() {

        $dao = new UsuarioDAO();
        $dados = $dao->CarregarNomeTopo(UtilCTRL::RetornarTipoLogado());
        return $dados;
    }

    public function AtualizarSenhaUsuario(UsuarioVO $vo, $repetirSenha) {

        if ($vo->getSenhaUsuario() != $repetirSenha) {

            return -3;
        }

        $hash = $vo->getSenhaUsuario();

        $senha = password_hash($hash, 1);

        $vo->setSenhaUsuario($senha);

        $dao = new UsuarioDAO();

        $dados = $dao->AtualizarSenhaUsuario($vo, UtilCTRL::RetornarCodigoUser());

        return $dados;
    }

    public static function ValidarSenhaUser($senha) {

        $dao = new UsuarioDAO();
        $user = $dao->ValidarUser(UtilCTRL::RetornarCodigoUser());

        if (count($user) > 0) {

            if (password_verify($senha, $user[0]['senha_usuario'])) {

                return 1;
            }
        } else {

            return 0;
        }
    }

    public function AtualizarDadosAdministrador(UsuarioVO $vo, FuncionarioVO $func) {
        $dao = new UsuarioDAO();
        $dados = $dao->AtualizarDadosAdministrador($vo, $func, UtilCTRL::RetornarCodigoUser());
        return $dados;
    }

    public function AtualizarDadosFuncionario(UsuarioVO $vo, FuncionarioVO $func) {
        $dao = new UsuarioDAO();
        $dados = $dao->AtualizarDadosFuncionario($vo, $func, UtilCTRL::RetornarCodigoUser());
        return $dados;
    }

    //End Usuarios  
    //Start Funcionario

    /*

      public function CadastrarFuncionario(UsuarioVO $user, FuncionarioVO $func) {



      if ($user->getEmailUsuario() == '' || $func->getNomeFunc() == '' ||

      $func->getTelFunc() == '' || $func->getSobrenomeFunc() == '') {

      return 0;

      }



      $senha = strtolower(explode('@', $user->getEmailUsuario())[0]);



      $user->setSenhaUsuario(password_hash($senha, 1));



      $func->setIdUserAdm(UtilCTRL::RetornarCodigoUser());



      $dao = new UsuarioDAO();



      $ret = $dao->CadastrarFuncionario($user, $func);



      return $ret;

      }

     */



    public function CarregarDadosFuncionario() {
        $dao = new UsuarioDAO();
        $dados = $dao->CarregarDadosFuncionario(UtilCTRL::RetornarCodigoUser());
        return $dados;
    }

//End Funcionario
//Start Doador    
                                            // ESTA OCORRENDO ERRO 
    // public function CadastrarDoador(UsuarioVO $voUsuario, DoadorVO $voDoador) {

    //     if ($voUsuario->getEmailUsuario() == '' || $voUsuario->getSenhaUsuario() == '' ||
    //             $voDoador->getNomeDoador() == '' || $voDoador->getTelefone() == '' ||
    //             $voDoador->getSobrenomeDoador() == '') {

    //         return 0;
    //     }
    //     $dao = new UsuarioDAO();
    //     $ret = $dao->CadastrarDoador($voUsuario, $voDoador);
    //     return $ret;
    // }

//End Doador
//Start Administrador    

    public function CarregarDadosAdministrador() {
        $dao = new UsuarioDAO();
        $dados = $dao->CarregarDadosAdministrador(UtilCTRL::RetornarCodigoUser());
        return $dados;
    }
                                    //ESTA OCORRENDO ERRO
    // public function AlterarSenhaAdministrador($senhaNova, $repetirSenha) {
    //     if ($senhaNova != $repetirSenha) {

    //         return 3;
    //     }
    //     $dao = new UsuarioDAO();
    //     $ret = $dao->AlterarSenhaAdministrador(UtilCTRL::UsuarioLogado(), $senhaNova);
    //     return $ret;
    // }

//End Administrador    
//Start Pessoa

    public function colocarFoto(UsuarioVO $vo) {

        $dao = new UsuarioDAO();
        $dados = $dao->colocarFoto($vo, UtilCTRL::RetornarCodigoUser());
        return $dados;
    }

    public function CarregarFotoUser() {
        $dao = new UsuarioDAO();
        $dados = $dao->CarregarFotoUser(UtilCTRL::RetornarCodigoUser());
        return $dados;
    }

    public function ExcluirFoto(UsuarioVO $vo) {
        $dao = new UsuarioDAO();
        $dados = $dao->ExcluirFoto($vo, UtilCTRL::RetornarCodigoUser());
        return $dados;
    }

    public function ConsultarCidade() {

        $dao = new UsuarioDAO();
        $ret = $dao->ConsultarCidade(UtilCTRL::RetornarTipoLogado());
        return $ret;
    }

//End Pessoa    
//Start Parceiro

    public function CarregarDadosParceiro() {

        $dao = new UsuarioDAO();
        $dados = $dao->CarregarDadosParceiro(UtilCTRL::RetornarCodigoUser());
        return $dados;
    }

    public function AlterarDadosPessoaParceiro(ParceiroVO $parc, UsuarioVO $user) {

        if ($parc->getNomeParceiro() == '' || $user->getEmailUsuario() == '' ||
                $parc->getTelefoneParceiro() == '') {

            return 0;
        }

        $dao = new UsuarioDAO();
        $dados = $dao->AlterarDadosPessoaParceiro($parc, $user, UtilCTRL::RetornarCodigoUser());
        return $dados;
    }

//End Parceiro 

    public function RelatoriosDoacoes($tipo_doador, $dt_inicial, $dt_final) {
        $dao = new UsuarioDAO();
        $dados = $dao->RelatoriosDoacoes($tipo_doador, $dt_inicial, $dt_final);
        return $dados;
    }

    public function VerificarDoacoes($tipo_doador) {
        $dao = new UsuarioDAO();
        $dados = $dao->VerificarDoacoes($tipo_doador);
        return $dados;
    }

    ///relatorio pdf
                            //ESTA OCORRENDO ERRO
    // public function DetalharRelatorio($tipo) {

    //     $dao = new UsuarioDAO();
    //     return $dao->DetalharRelatorio($tipo);
    // }

    public function InserirFuncionario(FuncionarioVO $func) {


        if ($func->getTipoUsuario() == '' || $func->getEmailUsuario() == '' || $func->getNomeFunc() == '' || $func->getTelFunc() == '') {

            return 0;
        }

        $senha = strtolower(explode('@', $func->getEmailUsuario())[0]);

        $func->setSenhaUsuario(password_hash($senha, 1));

        $func->setDataCadastro(UtilCTRL::DataAtual());

        $func->setStatusUsuario(1);
        $func->setTipoUsuario(UtilCTRL::TipoUsuario(2));

        $dao = new UsuarioDAO();

        return $dao->InserirFuncionario($func);
    }
    
    public function InserirAdministrador(FuncionarioVO $func) {

        if ($func->getTipoUsuario() == '' || $func->getEmailUsuario() == '' || $func->getNomeFunc() == '' || $func->getTelFunc() == '') {

            return 0;
        }

        $senha = strtolower(explode('@', $func->getEmailUsuario())[0]);

        $func->setSenhaUsuario(password_hash($senha, 1));

        $func->setDataCadastro(UtilCTRL::DataAtual());

        $func->setStatusUsuario(1);
        $func->setTipoUsuario(UtilCTRL::TipoUsuario(1));

        $dao = new UsuarioDAO();

        return $dao->InserirAdministrador($func);
    }

    public function AlterarStatus(StatusVO $vo) {

        if ($vo->getIdStatus() == '' || $vo->getSituacao() == '') {

            return 0;
        }

        $dao = new UsuarioDAO();
        return $dao->AlterarStatus($vo);
    }

    public function VerificarEmailDuplicadoCadastro($email) {

        $dao = new UsuarioDAO();

        return $dao->VerificarEmailDuplicadoCadastro($email);
    }

    public function VerificarEmailDuplicadoAlterar($email, $id) {
        $dao = new UsuarioDAO();
        return $dao->VerificarEmailDuplicadoAlterar($email, $id);
    }

}
