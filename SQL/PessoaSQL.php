<?php

class PessoaSQL {

    public static function InserirPessoa() {

        $sql = '';

        $sql = 'insert into tb_usuario (email_usuario, senha_usuario, tipo_usuario, data_cadastro, status_usuario) values(?,?,?,?,?)';

        return $sql;
    }

    public static function InserirDadosPessoa() {

        $sql = '';

        $sql = 'insert into tb_pessoa (nome_pessoa, telefone_pessoa, id_user_pessoa) values(?,?,?)';

        return $sql;
    }

    public static function InserirEnderecoPessoa() {
        $sql = '';

        $sql = 'insert into tb_endereco 
               (rua, bairro, numero, cep, id_cidade, id_usuario)
               values (?, ?, ?, ?, ?, ?)';
       

        return $sql;
    }

    public static function CarregarDadosPessoa() {

        $sql = '';

        $sql = 'select ps.nome_pessoa, 
                       ps.telefone_pessoa,
                       usu.senha_usuario,
                       usu.email_usuario
                  from tb_usuario usu
                 inner join tb_pessoa ps
                    on ps.id_user_pessoa = usu.id_usuario
                 where usu.id_usuario = ?';

        return $sql;
    }

    public static function AtualizarDadosPessoaEmail() {

        $sql = '';

        $sql = 'update tb_usuario set email_usuario = ?
                where id_usuario = ?';

        return $sql;
    }

    public static function AtualizarDadosPessoaDados() {

        $sql = '';

        $sql = 'update tb_pessoa set nome_pessoa = ?, 
                telefone_pessoa = ?
                where id_user_pessoa = ?';

        return $sql;
    }

    public static function CidadePessoa() {
        $sql = '';

        $sql = 'select id_cidade, nome_cidade from tb_cidade';

        return $sql;
    }

}
