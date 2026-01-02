<?php

require_once 'Conexao.php';
require_once '../SQL/DoacaoSQL.php';

class DoacaoDAO extends Conexao{

public function ConsultarDoacao() {

    $conexao = parent::retornaConexao();

    $comando = Doacao_sql::ConsultarDoacao();

    $sql = new PDOStatement();
    $sql = $conexao->prepare($comando);

    //Elimina o indicine das colunas ,deixandos  o que indices que foram citados.
    $sql->setFetchMode(PDO::FETCH_ASSOC);

    $sql->execute();

    return $sql->fetchAll();
    
    //retorna todas as listas de consulta 
}

}