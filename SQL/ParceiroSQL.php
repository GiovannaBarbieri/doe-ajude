<?php

class ParceiroSQL {

/////parceiro Wendell////
    public static function InserirParceiro() {

        $sql = 'insert into tb_parceiro (nome_parceiro, telefone_parceiro
               ,documento_parceiro, responsavel_parceiro
               ,id_user_parceiro,id_user_func) values(?,?,?,?,?,?)';
        return $sql;
    }

    public static function CarregarParceiro() {

        $sql = 'select nome_parceiro
                ,telefone_parceiro
                ,documento_parceiro
                ,responsavel_parceiro
                ,email_usuario
                from tb_parceiro tb_parceiro
                inner join tb_usuario tb_usuario
		on tb_usuario.id_usuario = tb_parceiro.id_user_parceiro';

        return $sql;
    }

    ///PARCEIRO GIOVANNA////
    public static function InserirPessoaParceiro() {

        $sql = 'insert into tb_parceiro 
                                (nome_parceiro, 
                                telefone_parceiro,
                                documento_parceiro,
                                responsavel_parceiro,
                                id_user_func,
                                id_user_parceiro) 
                            values(?,?,?,?,?,?)';
        return $sql;
    }

}
