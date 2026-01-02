<?php

include_once 'Conexao.php';
///require_once $_SERVER['DOCUMENT_ROOT'] . '/SQL/UsuarioSQL.php';

require_once '../SQL/UsuarioSQL.php';


class UsuarioDAO extends Conexao {

    public function InserirFuncionario(FuncionarioVO $func) {

        $conexao = parent::retornaConexao();

        $comando = UsuarioSQL::InserirUsuario();

        $sql = new PDOStatement();

        $sql = $conexao->prepare($comando);

        $sql->bindValue(1, $func->getEmailUsuario());
        $sql->bindValue(2, $func->getSenhaUsuario());
        $sql->bindValue(3, $func->getTipoUsuario());
        $sql->bindValue(4, $func->getDataCadastro());
        $sql->bindValue(5, $func->getStatusUsuario());

        $conexao->beginTransaction();

        try {
            //Grava na tb_usuario
            $sql->execute();

            $id_funcionario = $conexao->lastInsertId();
            $id_email = $conexao->lastInsertId();

            $comando = UsuarioSQL::InserirFuncionario();
            $sql = $conexao->prepare($comando);

            $sql->bindValue(1, $func->getNomeFunc());
            $sql->bindValue(2, $func->getTelFunc());
            $sql->bindValue(3, $id_funcionario);
            $sql->bindValue(4, $id_email);
            //Grava na tb_funcionario
            $sql->execute();

            $comando = UsuarioSQL::InserirEndereco();
            $sql = $conexao->prepare($comando);

            $sql->bindValue(1, $func->getRua());
            $sql->bindValue(2, $func->getBairro());
            $sql->bindValue(3, $func->getNumero());
            $sql->bindValue(4, $func->getCep());
            $sql->bindValue(5, $func->getId_cidade());
            $sql->bindValue(6, $id_funcionario);
            $sql->bindValue(7, null);

            //Grava na tb_endereco
            $sql->execute();
            $conexao->commit();

            return 1;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            $conexao->rollBack();
            return -1;
        }
    }
    public function InserirAdministrador(FuncionarioVO $func) {

        $conexao = parent::retornaConexao();

        $comando = UsuarioSQL::InserirUsuario();

        $sql = new PDOStatement();

        $sql = $conexao->prepare($comando);

        $sql->bindValue(1, $func->getEmailUsuario());
        $sql->bindValue(2, $func->getSenhaUsuario());
        $sql->bindValue(3, $func->getTipoUsuario());
        $sql->bindValue(4, $func->getDataCadastro());
        $sql->bindValue(5, $func->getStatusUsuario());

        $conexao->beginTransaction();

        try {
            //Grava na tb_usuario
            $sql->execute();

            $id_funcionario = $conexao->lastInsertId();
            $id_email = $conexao->lastInsertId();

            $comando = UsuarioSQL::InserirFuncionario();
            $sql = $conexao->prepare($comando);

            $sql->bindValue(1, $func->getNomeFunc());
            $sql->bindValue(2, $func->getTelFunc());
            $sql->bindValue(3, $id_funcionario);
            $sql->bindValue(4, $id_email);
            //Grava na tb_funcionario
            $sql->execute();

            $comando = UsuarioSQL::InserirEndereco();
            $sql = $conexao->prepare($comando);

            $sql->bindValue(1, $func->getRua());
            $sql->bindValue(2, $func->getBairro());
            $sql->bindValue(3, $func->getNumero());
            $sql->bindValue(4, $func->getCep());
            $sql->bindValue(5, $func->getId_cidade());
            $sql->bindValue(6, $id_funcionario);
            $sql->bindValue(7, null);

            //Grava na tb_endereco
            $sql->execute();
            $conexao->commit();

            return 1;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            $conexao->rollBack();
            return -1;
        }
    }

//Start Usuarios    
    public static function ValidarLogin($login) {

        $conexao = parent::retornaConexao();
        $comando = UsuarioSQL::ValidarLogin();
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando);
        $sql->bindValue(1, $login);
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();
        return $sql->fetchAll();
    }

    public static function ValidarUser($user) {

        $conexao = parent::retornaConexao();
        $comando = UsuarioSQL::ValidarUser();
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando);
        $sql->bindValue(1, $user);
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();
        return $sql->fetchAll();
    }

    public function CarregarNomeTopo($idLogado) {

        $conexao = parent::retornaConexao();

        $comando = UsuarioSQL::CarregarNomeTopo();

        $sql = $conexao->prepare($comando);

        $sql->bindValue(1, $idLogado);
        //Remove os indeces retornando somente a coluna com seus valor
        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->execute();

        return $sql->fetchAll();
    }

    public function AtualizarSenhaUsuario(UsuarioVO $vo, $idUsuario) {

        $conexao = parent::retornaConexao();

        $comando = UsuarioSQL::AtualizarSenhaUsuario();

        $sql = new PDOException();
        $sql = $conexao->prepare($comando);

        $sql->bindValue(1, $vo->getSenhaUsuario());
        $sql->bindValue(2, $idUsuario);

        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            return -1;
        }
    }

    public function ValidarSenhaUser($senha) {

        $conexao = parent::retornaConexao();

        $comando = UsuarioSQL::ValidarSenhaUser();

        $sql = $conexao->prepare($comando);

        $sql->bindValue(1, $senha);

        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->execute();

        return $sql->fetchAll();

        //return $ret[0]['contar'];
    }

//End Usuarios
//Start Administrador
    public function CarregarDadosAdministrador($idLogado) {

        $conexao = parent::retornaConexao();

        $comando = UsuarioSQL::CarregarDadosAdministrador();

        $sql = new PDOStatement();

        $sql = $conexao->prepare($comando);

        $sql->bindValue(1, $idLogado);

        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->execute();

        return $sql->fetchAll();
    }

    public function AlterarSenhaAdministrador(UsuarioVO $vo, $idUsuario) {

        $conexao = parent::retornaConexao();

        $comando = UsuarioSQL::AlterarSenhaAdministrador();
        $sql = new PDOException();
        $sql = $conexao->prepare($comando);

        $sql->bindValue(1, $vo->getSenhaUsuario());
        $sql->bindValue(2, $idUsuario());

        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            return -1;
        }
    }

//End Administrador
// Start Funcionario
    public function CadastrarFuncionario(UsuarioVO $user, FuncionarioVO $func) {

        $conexao = parent::retornaConexao();

        $comando = UsuarioSQL::InserirComoUsuario();

        $sql = new PDOStatement();

        $sql = $conexao->prepare($comando);

        $sql->bindValue(1, $user->getEmailUsuario());
        $sql->bindValue(2, $user->getSenhaUsuario());
        $sql->bindValue(3, $user->getTipoUsuario());

        $conexao->beginTransaction();

        try {

            $sql->execute();

            $id_funcionario = $conexao->lastInsertId();

            $comando = UsuarioSQL::InserirComoFuncionario();
            $sql = $conexao->prepare($comando);

            $sql->bindValue(1, $func->getNomeFunc());
            $sql->bindValue(2, $func->getTelFunc());
            $sql->bindValue(3, $id_funcionario);
            $sql->bindValue(4, $func->getIdUserAdm());

            $sql->execute();

            $conexao->commit();

            return 1;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            $conexao->rollBack();
            return -1;
        }
    }

    public function AtualizarDadosAdministrador(UsuarioVO $vo, FuncionarioVO $func, $idLogado) {

        $conexao = parent::retornaConexao();

        $comando = UsuarioSQL::AtualizarDadosAdminitradorEmail();

        $sql = new PDOStatement();

        $sql = $conexao->prepare($comando);

        $sql->bindValue(1, $vo->getEmailUsuario());
        $sql->bindValue(2, $idLogado);

        $conexao->beginTransaction();

        try {
            $sql->execute();

            $comando = UsuarioSQL::AtualizarDadosFuncionarios_Adm();
            $sql = $conexao->prepare($comando);

            $sql->bindValue(1, $func->getNomeFunc());
            $sql->bindValue(2, $func->getTelFunc());
            $sql->bindValue(3, $idLogado);

            $sql->execute();

            $conexao->commit();

            return 1;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            $conexao->rollBack();
            return -1;
        }
    }

    public function AtualizarDadosFuncionario(UsuarioVO $vo, FuncionarioVO $func, $idLogado) {

        $conexao = parent::retornaConexao();

        $comando = UsuarioSQL::AtualizarDadosAdminitradorEmail();

        $sql = new PDOStatement();

        $sql = $conexao->prepare($comando);

        $sql->bindValue(1, $vo->getEmailUsuario());
        $sql->bindValue(2, $idLogado);

        $conexao->beginTransaction();

        try {
            $sql->execute();

            $comando = UsuarioSQL::AtualizarDadosFuncionarios();
            $sql = $conexao->prepare($comando);

            $sql->bindValue(1, $func->getNomeFunc());
            $sql->bindValue(2, $func->getTelFunc());
            $sql->bindValue(3, $idLogado);

            $sql->execute();

            $conexao->commit();

            return 1;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            $conexao->rollBack();
            return -1;
        }
    }

    public function CarregarDadosFuncionario($idLogado) {

        $conexao = parent::retornaConexao();

        $comando = UsuarioSQL::CarregarDadosFuncionario();

        $sql = new PDOStatement();

        $sql = $conexao->prepare($comando);

        $sql->bindValue(1, $idLogado);

        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->execute();

        return $sql->fetchAll();
    }

// End Funcionario 
//Start Pessoa
    public function colocarFoto(UsuarioVO $vo, $idUsuario) {

        $conexao = parent::retornaConexao();

        $comando = UsuarioSQL::colocarFoto();

        $sql = new PDOException();
        $sql = $conexao->prepare($comando);

        $sql->bindValue(1, $vo->getImagem_user());
        $sql->bindValue(2, $idUsuario);

        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            return -1;
        }
    }

    public function CarregarFotoUser($idUsuario) {

        $conexao = parent::retornaConexao();

        $comando = UsuarioSQL::CarregarFotoUser();

        $sql = $conexao->prepare($comando);

        $sql->bindValue(1, $idUsuario);

        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->execute();

        return $sql->fetchAll();
    }

    public function ExcluirFoto(UsuarioVO $vo, $idUsuario) {

        $conexao = parent::retornaConexao();

        $comando = UsuarioSQL::ExcluirFoto();

        $sql = new PDOException();
        $sql = $conexao->prepare($comando);

        $sql->bindValue(1, $vo->getImagem_user());
        $sql->bindValue(2, $idUsuario);

        try {
            $sql->execute();
            return 2;
        } catch (Exception $ex) {
            return -1;
        }
    }

//End Pessoa
//Start Parceiro

    public function CarregarDadosParceiro($idLogado) {

        $conexao = parent::retornaConexao();

        $comando = UsuarioSQL::CarregarDadosParceiro();

        $sql = new PDOStatement();

        $sql = $conexao->prepare($comando);

        $sql->bindValue(1, $idLogado);

        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->execute();

        return $sql->fetchAll();
    }

    public function AlterarDadosPessoaParceiro(ParceiroVO $parc, UsuarioVO $user, $idLogado) {

        $conexao = parent::retornaConexao();

        $comando = UsuarioSQL::AlterarDadosPessoaParceiro();

        $sql = new PDOStatement();

        $sql = $conexao->prepare($comando);

        $sql->bindValue(1, $parc->getNomeParceiro());
        $sql->bindValue(2, $parc->getTelefoneParceiro());
        $sql->bindValue(3, $idLogado);

        $conexao->beginTransaction();

        try {
            $sql->execute();

            $comando = UsuarioSQL::AlterarEmailPessoaParceiro();
            $sql = $conexao->prepare($comando);

            $sql->bindValue(1, $user->getEmailUsuario());
            $sql->bindValue(2, $idLogado);

            $sql->execute();
            $conexao->commit();

            return 1;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            $conexao->rollBack();
            return -1;
        }
    }

//End Parceiro 
    public function ConsultarCidade() {

        $conexao = parent::retornaConexao();

        $comando = UsuarioSQL::SelecionarCidade();

        $sql = new PDOStatement();

        $sql = $conexao->prepare($comando);

        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->execute();

        return $sql->fetchAll();
    }

    public function RelatoriosDoacoes($tipo_doador, $dt_inicial, $dt_final) {

        $conexao = parent::retornaConexao();
        if ($tipo_doador == 1) {
            $comando = 'select "Doador - PF" as tipo_pessoa,
                                pes.nome_pessoa as nome, 
                                sta.data_status, 
                                sta.situacao_status
                        from tb_doador as doa
                            inner join tb_pessoa as pes
                            on pes.id_pessoa = doa.id_pessoa
                            inner join tb_status as sta
                            on sta.id_doador = doa.id_doador
                        where sta.data_status between ? and ?';
        } elseif ($tipo_doador == 2) {
            $comando = 'select "Doador - PJ" as tipo_pessoa,
                                parc.nome_parceiro as nome,
                                sta.data_status, 
                                sta.situacao_status
                                from tb_doador as doa
                            inner join tb_parceiro parc
			on doa.id_parceiro = parc.id_parceiro
                            inner join tb_status as sta
                            on sta.id_doador = doa.id_doador
                        where sta.data_status between ? and ?';
        } elseif ($tipo_doador == 3) {
            $comando = 'select "Voluntário" as tipo_pessoa,
                                pes.nome_pessoa as nome, 
                                sta.data_status, 
                                sta.situacao_status
                        from tb_voluntario as vol
                            inner join tb_pessoa as pes
                            on pes.id_pessoa = vol.id_pessoa
                            inner join tb_status as sta
                            on sta.id_voluntario = vol.id_voluntario
                        where sta.data_status between ? and ?';
        } elseif ($tipo_doador == 4) {
            $comando = 'select  tipo_pessoa 
                               ,nome
                               ,data_status 
                               ,situacao_status
                          from (select "Doador - PJ" as tipo_pessoa,
                                parc.nome_parceiro as nome,
                                sta.data_status, 
                                sta.situacao_status
                                from tb_doador as doa
                            inner join tb_parceiro parc
			on doa.id_parceiro = parc.id_parceiro
                            inner join tb_status as sta
                            on sta.id_doador = doa.id_doador
                         union  
		        select "Doador - PF" as tipo_pessoa,
                                pes.nome_pessoa as nome, 
                                sta.data_status, 
                                sta.situacao_status
                        from tb_doador as doa
                            inner join tb_pessoa as pes
                            on pes.id_pessoa = doa.id_pessoa
                            inner join tb_status as sta
                            on sta.id_doador = doa.id_doador
                           union  
                        select  
				"Voluntário" as tipo_pessoa,
				pes.nome_pessoa as nome, 
                                sta.data_status, 
                                sta.situacao_status
                                from tb_voluntario as vol
                                inner join tb_pessoa as pes
                                on pes.id_pessoa = vol.id_pessoa
                                inner join tb_status as sta
                                on sta.id_voluntario = vol.id_voluntario
                                ) todos
                                where todos.data_status between ? and ?';
        }
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando);

        $sql->bindValue(1, $dt_inicial);
        $sql->bindValue(2, $dt_final);

        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();
        return $sql->fetchAll();
    }

    public function VerificarDoacoes($tipo_doador) {
        $conexao = parent::retornaConexao();

        $comando = '
                select 

		tb_status.data_status,
                tb_pessoa.nome_pessoa,
                tb_status.situacao_status,
		tb_status.id_doador,
		tb_status.id_voluntario,
		tb_status.id_status,
		tb_status.tipo
                
          from tb_status tb_status
          
	 left join tb_doador tb_doador
         on tb_doador.id_doador = tb_status.id_status 
         left join tb_pessoa tb_pessoa
         on tb_pessoa.id_pessoa = tb_pessoa.id_user_pessoa
	 left join tb_voluntario tb_voluntario
         on tb_voluntario.id_voluntario = tb_pessoa.id_user_pessoa
         where tb_status.tipo = ?
         order by tb_status.situacao_status';



        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando);
        $sql->bindValue(1, $tipo_doador);
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();
        return $sql->fetchAll();
    }

    public function AlterarStatus(StatusVO $vo) {

        $conexao = parent::retornaConexao();

        $comando = UsuarioSQL::AlterarStatus();
        $sql = new PDOException();
        $sql = $conexao->prepare($comando);

        $sql->bindValue(1, $vo->getSituacao());
        $sql->bindValue(2, $vo->getIdStatus());
        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            return -1;
        }
    }

     public function VerificarEmailDuplicadoCadastro($email) {
        
        $conexao = parent::retornaConexao();
        $comando = UsuarioSQL::VerificarEmailDuplicadoCadastro();

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando);

        $sql->bindValue(1, $email);

        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();

        $ret =  $sql->fetchAll();

        return $ret[0]['contar'];
    }
    
    public function VerificarEmailDuplicadoAlterar($email, $id){
        $conexao = parent::retornaConexao();
        $comando = $sql = UsuarioSQL::VerificarEmailDuplicadoAlterar();
        
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando);
        
        $sql->bindValue(1, $email);
        $sql->bindValue(2, $id);
        
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();
        
        $ret = $sql->fetchAll();
        
        return $ret[0]['contar'];
    }
}
