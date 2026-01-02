<?php

require_once 'Conexao.php';
require_once '../SQL/DoadorSQL.php';
require_once '../SQL/StatusSQL.php';

class DoadorDAO extends Conexao {
     
    public function InserirDoacao(DoadorVO $voDo, StatusVO $voSt) {

        $conexao = parent::retornaConexao();

        $comando = DoadorSQL::InserirDoacao();

        $sql = new PDOStatement();

        $sql = $conexao->prepare($comando);

        //start doacao
        $sql->bindValue(1, $voDo->getNomeObjeto());
        $sql->bindValue(2, $voDo->getImgObjeto());
        $sql->bindValue(3, $voDo->getEstadoObjeto());
        $sql->bindValue(4, $voDo->getDescricao());
        $sql->bindValue(5, $voDo->getIdPessoa());
        //end doacao
        $conexao->beginTransaction();

        try {

            $sql->execute();

            $id_doador = $conexao->lastInsertId();

            //start endereco
            $sql = $conexao->prepare(DoadorSQL::InserirCidadeDoador());

            $sql->bindValue(1, $voDo->getRua());
            $sql->bindValue(2, $voDo->getBairro());
            $sql->bindValue(3, $voDo->getNumero());
            $sql->bindValue(4, $voDo->getCep());
            $sql->bindValue(5, $voDo->getId_cidade());
            $sql->bindValue(6, $voDo->getId_usuario());
            $sql->bindValue(7, $id_doador);

            $sql->execute();
            //end endereco
            //start status
            $sql = $conexao->prepare(StatusSQL::InserirStatusDoacao());

            $sql->bindValue(1, $voSt->getDataStatus());
            $sql->bindValue(2, $voSt->getHoraStatus());
            $sql->bindValue(3, $voSt->getSituacao());
            $sql->bindValue(4, $id_doador);

            $sql->execute();
            //end status

            $conexao->commit();

            return 13;
        } catch (Exception $ex) {
            $conexao->rollBack();
            echo $ex->getMessage();
            return -1;
        }
    }

    public function ConsultarEnderecoPessoa($idLogado) {

        $conexao = parent::retornaConexao();

        $comando = DoadorSQL::ConsultarEnderecoPessoa();

        $sql = new PDOStatement();

        $sql = $conexao->prepare($comando);

        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->bindValue(1, $idLogado);

        $sql->execute();

        return $sql->fetchAll();
    }

    public function ConsultarDoacao_Pessoa($idPessoa) {

        $conexao = parent::retornaConexao();

        $comando = DoadorSQL::ConsultarDoacao_Pessoa();

        $sql = new PDOStatement();

        $sql = $conexao->prepare($comando);

        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->bindValue(1, $idPessoa);

        $sql->execute();

        return $sql->fetchAll();

        //retorna todas as listas de consulta 
    }

    public function retornarPessoa($logado) {

        $conexao = parent::retornaConexao();

        $comando = DoadorSQL::retornarPessoa();

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando);

        $sql->bindValue(1, $logado);

        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->execute();

        return $sql->fetchAll();
    }

    public function InserirDoacaoParceiro(DoadorVO $voDo, StatusVO $voSt) {

        $conexao = parent::retornaConexao();
        ///inicio doação parceiro
        $comando = DoadorSQL::InserirDoacaoParceiro();

        $sql = new PDOStatement();

        $sql = $conexao->prepare($comando);


        $sql->bindValue(1, $voDo->getNomeObjeto());
        $sql->bindValue(2, $voDo->getImgObjeto());
        $sql->bindValue(3, $voDo->getEstadoObjeto());
        $sql->bindValue(4, $voDo->getDescricao());
        $sql->bindValue(5, $voDo->getIdParceiro());

        $conexao->beginTransaction();

        try {

            $sql->execute();

            $idDoador = $conexao->lastInsertId();

            //inicio tb_endereco -> tb_doador
            $sql = $conexao->prepare(DoadorSQL::InserirCidadeParceiro());

            $sql->bindValue(1, $voDo->getRua());
            $sql->bindValue(2, $voDo->getBairro());
            $sql->bindValue(3, $voDo->getNumero());
            $sql->bindValue(4, $voDo->getCep());
            $sql->bindValue(5, $voDo->getId_cidade());
            $sql->bindValue(6, $voDo->getId_usuario());
            $sql->bindValue(7, $idDoador);

            $sql->execute();


            //inicio status da doacao
            $sql = $conexao->prepare(StatusSQL::InserirStatusParceiro());

            $sql->bindValue(1, $voSt->getDataStatus());
            $sql->bindValue(2, $voSt->getHoraStatus());
            $sql->bindValue(3, $voSt->getSituacao());
            $sql->bindValue(4, $idDoador);

            $sql->execute();
            //end status

            $conexao->commit();

            return 14;
        } catch (Exception $ex) {
            $conexao->rollBack();
            echo $ex->getMessage();
            return -1;
        }
    }

    public function ConsultarEnderecoParceiro($idLogado) {

        $conexao = parent::retornaConexao();

        $comando = DoadorSQL::ConsultarEnderecoParceiro();

        $sql = new PDOStatement();

        $sql = $conexao->prepare($comando);

        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->bindValue(1, $idLogado);

        $sql->execute();

        return $sql->fetchAll();
    }

    public function ConsultarDoacaoParceiro($idPessoa) {

        $conexao = parent::retornaConexao();

        $comando = DoadorSQL::ConsultarDoacaoParceiro();

        $sql = new PDOStatement();

        $sql = $conexao->prepare($comando);

        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->bindValue(1, $idPessoa);

        $sql->execute();

        return $sql->fetchAll();
    }

    public function retornarParceiro($logado) {
        
        $conexao = parent::retornaConexao();

        $comando = DoadorSQL::retornarParceiro();

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando);

        $sql->bindValue(1, $logado);

        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->execute();

        return $sql->fetchAll();
    }
    
    

    public function ConsultarDoacao($tipo_doador, $dt_inicial, $dt_final) {
        
        $conexao = parent::retornaConexao();
        $comando = '
                select 
		tb_status.data_status,
                tb_parceiro.nome_parceiro ,
                tb_pessoa.nome_pessoa,
                tb_doador.nome_objeto,  
                tb_doador.imagem_objeto,
                tb_doador.estado_objeto,
                tb_doador.descricao_objeto,
                tb_status.situacao_status,
                tb_status.id_status
                
                from tb_doador tb_doador
                
		inner join tb_status tb_status
                on tb_status.id_doador = tb_doador.id_doador
		left join tb_parceiro tb_parceiro
                on tb_parceiro.id_parceiro = tb_doador.id_parceiro  
		left join tb_pessoa tb_pessoa
		on tb_pessoa.id_pessoa = tb_doador.id_pessoa  
	
                where tb_status.data_status between ? and ?';
        if ($tipo_doador != 3) {
            $comando = $comando . ' and tb_status.situacao_status = ? ';
        }

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando);

        $sql->bindValue(1, $dt_inicial);
        $sql->bindValue(2, $dt_final);
        
        if ($tipo_doador != 3) {
            $sql->bindValue(3, $tipo_doador);
        }

        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();
        
        return $sql->fetchAll();
    }

    public function CarregarDadosDoador($idLogado) {

        $conexao = parent::retornaConexao();

        $comando = DoadorSQL::CarregarDadosDoador();

        $sql = new PDOStatement();

        $sql = $conexao->prepare($comando);

        $sql->bindValue(1, $idLogado);

        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->execute();

        return $sql->fetchAll();
    }

}
