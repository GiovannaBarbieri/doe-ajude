<?php

require_once 'Conexao.php';
require_once '../SQL/VoluntarioSQL.php';
require_once '../SQL/StatusSQL.php';

class VoluntarioDAO extends Conexao {

    public function CadastrarVoluntario(VoluntarioVO $voVol, $voSt) {

        $conexao = parent::retornaConexao();

        $comando = VoluntarioSQL::CadastrarVoluntario();

        $sql = new PDOStatement();

        $sql = $conexao->prepare($comando);

        $sql->bindValue(1, $voVol->getDisponibilidade());
        $sql->bindValue(2, $voVol->getSetorVoluntario());
        $sql->bindValue(3, $voVol->getSobreVoluntario());
        $sql->bindValue(4, $voVol->getIdPessoa());

        $conexao->beginTransaction();

        try {
            $sql->execute();

            $id_voluntario = $conexao->lastInsertId();

            //start status
            $sql = $conexao->prepare(StatusSQL::InserirStatusVoluntario());

            $sql->bindValue(1, $voSt->getDataStatus());
            $sql->bindValue(2, $voSt->getHoraStatus());
            $sql->bindValue(3, $voSt->getSituacao());
            $sql->bindValue(4, $id_voluntario);

            $sql->execute();
            //end status

            $conexao->commit();

            return 1;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            return -1;
        }
    }

    public function ConsultarVoluntario_Pessoa() {

        $conexao = parent::retornaConexao();

        $comando = VoluntarioSQL::ConsultarVoluntario();

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando);

        //Elimina o indicine das colunas ,deixandos  o que indices que foram citados.
        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->execute();

        return $sql->fetchAll();

        //retorna todas as listas de consulta 
    }

    public function ConsultarVoluntario($tipo_voluntario, $dt_inicial, $dt_final) {
        $conexao = parent::retornaConexao();

        $comando = '
                select 
                tb_status.data_status,
		tb_pessoa.nome_pessoa,
                tb_pessoa.telefone_pessoa,
		tb_voluntario.disponibilidade_voluntario,
		tb_voluntario.setor_voluntario,
		tb_voluntario.sobre_voluntario,
                tb_status.id_status,
                tb_status.situacao_status

                from tb_voluntario tb_voluntario
                inner join tb_status tb_status
                on tb_status.id_voluntario = tb_voluntario.id_voluntario
                left join tb_pessoa tb_pessoa
                on tb_pessoa.id_pessoa = tb_voluntario.id_pessoa
                where tb_status.data_status between ? and ?';

        if ($tipo_voluntario != 3) {
            $comando = $comando . ' and tb_status.situacao_status = ? ';
        }

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando);

        $sql->bindValue(1, $dt_inicial);
        $sql->bindValue(2, $dt_final);
        if ($tipo_voluntario != 3) {
            $sql->bindValue(3, $tipo_voluntario);
        }

        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();
        return $sql->fetchAll();
    }

    public function retornarPessoa($logado) {

        $conexao = parent::retornaConexao();

        $comando = VoluntarioSQL::retornarPessoa();

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando);

        $sql->bindValue(1, $logado);

        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->execute();

        return $sql->fetchAll();
    }

}
