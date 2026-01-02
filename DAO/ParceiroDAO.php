<?php

include_once 'Conexao.php';
include_once '../SQL/ParceiroSQL.php';

class ParceiroDAO extends Conexao {

    ////parceiro wendell////
    public function InserirParceiro(ParceiroVO $vo) {
        $conexao = parent::retornaConexao();

        $comando = UsuarioSQL::InserirUsuario();

        $sql = new PDOStatement();

        $sql = $conexao->prepare($comando);

        $sql->bindValue(1, $vo->getEmailUsuario());
        $sql->bindValue(2, $vo->getSenhaUsuario());
        $sql->bindValue(3, $vo->getTipoUsuario());
        $sql->bindValue(4, $vo->getDataCadastro());
        $sql->bindValue(5, $vo->getStatusUsuario());


        $conexao->beginTransaction();

        try {
            //Grava na tb_usuario
            $sql->execute();
            $id_funcionario = $conexao->lastInsertId();

            $comando = ParceiroSQL::InserirParceiro();
            $sql = $conexao->prepare($comando);

            $sql->bindValue(1, $vo->getNomeParceiro());
            $sql->bindValue(2, $vo->getTelefoneParceiro());
            $sql->bindValue(3, $vo->getDocumentoParceiro());
            $sql->bindValue(4, $vo->getResponsavelNota());
            $sql->bindValue(5, $id_funcionario);
            $sql->bindValue(6, null);

            $sql->execute();

            $comando = UsuarioSQL::InserirEndereco();
            $sql = $conexao->prepare($comando);

            $sql->bindValue(1, $vo->getRua());
            $sql->bindValue(2, $vo->getBairro());
            $sql->bindValue(3, $vo->getNumero());
            $sql->bindValue(4, $vo->getCep());
            $sql->bindValue(5, $vo->getId_cidade());
            $sql->bindValue(6, $id_funcionario);
            $sql->bindValue(7, null);

            $sql->execute();
            $conexao->commit();

            return 1;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            $conexao->rollBack();
            return -1;
        }
    }

    public function CarregarParceiro() {

        $conexao = parent::retornaConexao();


        $sql = new PDOStatement();

        $sql = $conexao->prepare(ParceiroSQL::CarregarParceiro());

        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->execute();

        return $sql->fetchAll();
    }

    ////PARCEIRO GIOVANNA////
    public function InserirPessoaParceiro(ParceiroVO $vo) {
        //inicio tb_pessoa
        $conexao = parent::retornaConexao();
        $comando = PessoaSQL::InserirPessoa();

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando);

        $sql->bindValue(1, $vo->getEmailUsuario());
        $sql->bindValue(2, $vo->getSenhaUsuario());
        $sql->bindValue(3, $vo->getTipoUsuario());
        $sql->bindValue(4, $vo->getDataCadastro());
        $sql->bindValue(5, $vo->getStatusUsuario());

        $conexao->beginTransaction();

        try {
            ///inicio tb_parceiro
            $sql->execute();

            $id_user_parceiro = $conexao->lastInsertId();
            $comando = ParceiroSQL::InserirPessoaParceiro();
            $sql = $conexao->prepare($comando);

            $sql->bindValue(1, $vo->getNomeParceiro());
            $sql->bindValue(2, $vo->getTelefoneParceiro());
            $sql->bindValue(3, $vo->getDocumentoParceiro());
            $sql->bindValue(4, $vo->getResponsavelNota());
            $sql->bindValue(5, null); //id_user_func
            $sql->bindValue(6, $id_user_parceiro);

            $sql->execute(); //////JUDAS/////
            //tb_endereco
            $comando = PessoaSQL::InserirEnderecoPessoa();
            $sql = $conexao->prepare($comando);

            $sql->bindValue(1, $vo->getRua());
            $sql->bindValue(2, $vo->getBairro());
            $sql->bindValue(3, $vo->getNumero());
            $sql->bindValue(4, $vo->getCep());
            $sql->bindValue(5, $vo->getId_cidade());
            $sql->bindValue(6, $id_user_parceiro);

            $sql->execute();
            $conexao->commit();

            return 1;
        } catch (Exception $ex) {
            $conexao->rollBack();
            echo $ex->getMessage();
            return -1;
        }
    }

}
