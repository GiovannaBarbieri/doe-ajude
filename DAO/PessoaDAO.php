<?php



require_once '../SQL/PessoaSQL.php';

require_once '../SQL/UsuarioSQL.php';

require_once 'Conexao.php';



class PessoaDAO extends Conexao {



    public function InserirPessoa(UsuarioVO $voUser, PessoaVO $voPessoa) {



        $conexao = parent::retornaConexao();



        $comando = PessoaSQL::InserirPessoa();



        $sql = new PDOStatement();



        $sql = $conexao->prepare($comando);



        $sql->bindValue(1, $voUser->getEmailUsuario());

        $sql->bindValue(2, $voUser->getSenhaUsuario());

        $sql->bindValue(3, $voUser->getTipoUsuario());

        $sql->bindValue(4, $voUser->getDataCadastro());

        $sql->bindValue(5, $voUser->getStatusUsuario());



        $conexao->beginTransaction();



        try {



            $sql->execute();



            $id_user_pessoa = $conexao->lastInsertId();



            $sql = $conexao->prepare(PessoaSQL::InserirDadosPessoa());



            //start pessoa

            $sql->bindValue(1, $voPessoa->getNomePessoa());

            $sql->bindValue(2, $voPessoa->getTelefonePessoa());

            $sql->bindValue(3, $id_user_pessoa);



            $sql->execute();

            //end pessoa

            //start endereco

            $sql = $conexao->prepare(PessoaSQL::InserirEnderecoPessoa());



            $sql->bindValue(1, $voPessoa->getRua());

            $sql->bindValue(2, $voPessoa->getBairro());

            $sql->bindValue(3, $voPessoa->getNumero());

            $sql->bindValue(4, $voPessoa->getCep());

            $sql->bindValue(5, $voPessoa->getId_cidade());

            $sql->bindValue(6, $id_user_pessoa);



            $sql->execute();

            //end endereco



            $conexao->commit();



            return 1;

        } catch (Exception $ex) {

            $conexao->rollBack();

            echo $ex->getMessage();

            return -1;

        }

    }



    public function CarregarDadosPessoa($idLogado) {



        $conexao = parent::retornaConexao();



        $comando = PessoaSQL::CarregarDadosPessoa();



        $sql = new PDOStatement();



        $sql = $conexao->prepare($comando);



        $sql->bindValue(1, $idLogado);



        $sql->setFetchMode(PDO::FETCH_ASSOC);



        $sql->execute();



        return $sql->fetchAll();

    }



    public function AtualizarDadosPessoa(UsuarioVO $user, PessoaVO $pes, $idLogado) {



        $conexao = parent::retornaConexao();



        $comando = PessoaSQL::AtualizarDadosPessoaEmail();



        $sql = new PDOStatement();



        $sql = $conexao->prepare($comando);



        $sql->bindValue(1, $user->getEmailUsuario());

        $sql->bindValue(2, $idLogado);



        $conexao->beginTransaction();



        try {

            $sql->execute();



            $comando = PessoaSQL::AtualizarDadosPessoaDados();

            $sql = $conexao->prepare($comando);



            $sql->bindValue(1, $pes->getNomePessoa());

            $sql->bindValue(2, $pes->getTelefonePessoa());

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



    public function CidadePessoa() {



        $conexao = parent::retornaConexao();



        $comando = PessoaSQL::CidadePessoa();



        $sql = new PDOStatement();



        $sql = $conexao->prepare($comando);



        $sql->setFetchMode(PDO::FETCH_ASSOC);



        $sql->execute();



        return $sql->fetchAll();

    }

    

    public function RecuperarSenha($email) {

        $conexao = parent::retornaConexao();

        $comando = 'SELECT 
        usu.senha_usuario, pes.nome_pessoa, par.nome_parceiro, fun.nome_funcionario
    FROM
        tb_usuario usu
    LEFT JOIN
        tb_pessoa AS pes 
    ON 
    pes.id_user_pessoa = usu.id_usuario
    LEFT JOIN
    tb_parceiro par
    ON
    usu.id_usuario = par.id_user_parceiro
    
    LEFT JOIN
    tb_funcionario fun
    ON
    usu.id_usuario = fun.id_user_adm
    
    WHERE
        email_usuario = ?';

        $sql = $conexao->prepare($comando);



        $sql->bindValue(1, $email);

        $sql->execute();



        return $sql->fetchAll();

    
    
    


    }



    public function NovaSenha($hash, $id) {

        $conexao = parent::retornaConexao();



        $comando = 'UPDATE tb_usuario SET senha_usuario = ? WHERE id_usuario = ?';

        $sql = $conexao->prepare($comando);



        $sql->bindValue(1, $hash);

        $sql->bindValue(2, $id);



        $sql->execute();



        return 1;

    }



    public function ValidaHash($hash) {

        $conexao = parent::retornaConexao();



        $comando = 'SELECT 

                        usu.id_usuario, 

                        usu.senha_usuario,

                        usu.email_usuario

                    FROM

                        tb_usuario as usu

                    WHERE

                        usu.senha_usuario = ? ';



        $sql = $conexao->prepare($comando);



        $sql->bindValue(1, $hash);



        $sql->execute();



        return $sql->fetchAll();

    }





}

