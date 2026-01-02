<?php

class UsuarioSQL {

    public static function InserirUsuario() {

        $sql = 'insert into tb_usuario (email_usuario, senha_usuario, tipo_usuario,data_cadastro,status_usuario) values(?,?,?,?,?)';
        return $sql;
    }

    public static function InserirFuncionario() {
        $sql = '';

        $sql = 'insert into tb_funcionario (nome_funcionario,telefone_funcionario,id_user_func,id_user_adm) values (?,?,?,?)';

        return $sql;
    }

    public static function InserirEndereco() {
        $sql = '';

        $sql = 'insert into tb_endereco (rua,bairro,numero,cep,id_cidade,id_usuario,id_doador)values(?,?,?,?,?,?,?)';

        return $sql;
    }

    public static function ValidarLogin() {

        $sql = '';

        $sql = 'select us.senha_usuario, 
                       us.id_usuario, 
                       us.tipo_usuario,
                       fu_adm.id_user_adm,                      
                       fu_func.id_user_func,
                       ps_doador.id_user_pessoa,
                       ps_parceiro.id_user_parceiro
                 from 
                       tb_usuario as us
                 left join
                       tb_funcionario as fu_adm
                     on
                       us.id_usuario = fu_adm.id_user_adm
                 left join
                       tb_funcionario as fu_func
                     on
                       us.id_usuario = fu_func.id_user_func                       
                left join
                       tb_pessoa as ps_doador
                     on
                       us.id_usuario = ps_doador.id_user_pessoa   
	        left join
                       tb_parceiro as ps_parceiro
                     on
                       us.id_usuario = ps_parceiro.id_user_parceiro
		  where
                        us.email_usuario = ?';

        //                       
        return $sql;
    }

    public static function ValidarUser() {

        $sql = '';

        $sql = 'select us.senha_usuario, 
                       us.id_usuario, 
                       us.tipo_usuario,
                       fu_adm.id_user_adm,                      
                       fu_func.id_user_func,
                       ps_doador.id_user_pessoa,
                       ps_parceiro.id_user_parceiro
                 from 
                       tb_usuario as us
                 left join
                       tb_funcionario as fu_adm
                     on
                       us.id_usuario = fu_adm.id_user_adm
                 left join
                       tb_funcionario as fu_func
                     on
                       us.id_usuario = fu_func.id_user_func                       
                left join
                       tb_pessoa as ps_doador
                     on
                       us.id_usuario = ps_doador.id_user_pessoa   
	        left join
                       tb_parceiro as ps_parceiro
                     on
                       us.id_usuario = ps_parceiro.id_user_parceiro
		  where
                        us.id_usuario = ?';

        //                       
        return $sql;
    }

    public static function InserirComoUsuario() {
        $sql = '';

        $sql = 'insert into tb_usuario (email_usuario, senha_usuario, tipo_usuario) values (?, ?, ?)';

        return $sql;
    }

    public static function CarregarDadosAdministrador() {
        $sql = '';

        $sql = 'select fun.nome_funcionario,
                       fun.telefone_funcionario,
                       usu.email_usuario,
                       usu.senha_usuario
                from tb_usuario usu
                    inner join tb_funcionario fun 
                on fun.id_user_adm = usu.id_usuario 
                where fun.id_user_adm = ?';

        return $sql;
    }

    public static function CarregarDadosFuncionario() {
        $sql = '';

        $sql = 'select fun.nome_funcionario,
                       fun.telefone_funcionario,
                       usu.email_usuario,
                       usu.senha_usuario,
                       fun.id_user_func
                from tb_usuario usu
                    inner join tb_funcionario fun 
                on fun.id_user_func = usu.id_usuario 
                where fun.id_user_func = ?';

        return $sql;
    }

    public static function InserirComoFuncionario() {
        $sql = '';

        $sql = 'insert into tb_funcionario (nome_funcionario,telefone_funcionario, id_user_func, id_user_adm) values (?, ?, ?, ?, ?)';

        return $sql;
    }

    public static function InserirComoDoador() {
        $sql = '';

        $sql = 'insert into tb_doador
                        (nome_usuario, sobrenome_usuario, telefone_usuario, id_usuario)
                    values (?, ?, ?, ?)';
        return $sql;
    }

    public static function ValidarSenhaUser() {
        $sql = '';

        $sql = 'select senha_usuario as contar
                from tb_usuario
                where senha_usuario = ?';

        return $sql;
    }

    public static function CarregarNomeTopo() {
        $sql = '';

        $sql = 'select fun.nome_funcionario
                from tb_usuario usu
                inner join tb_funcionario fun
                on fun.id_funcionario = usu.id_usuario
                inner join tb_funcionario adm
                on adm.id_funcionario = usu.id_usuario
                where usu.tipo_usuario = ?';

        return $sql;
    }

    public static function AtualizarSenhaUsuario() {
        $sql = '';

        $sql = 'update tb_usuario set senha_usuario = ?
                    where id_usuario = ?';

        return $sql;
    }

    public static function AlterarSenhaAdministrador() {
        $sql = '';

        $sql = 'update tb_usuario set senha_usuario = ? 
                    where id_usuario = ?';

        return $sql;
    }

    public static function colocarFoto() {
        $sql = '';

        $sql = 'update tb_usuario set imagem_usuario = ?
                    where id_usuario = ?';

        return $sql;
    }

    public static function CarregarFotoUser() {
        $sql = '';

        $sql = 'select imagem_usuario from tb_usuario
                    where id_usuario = ?';

        return $sql;
    }

    public static function ExcluirFoto() {
        $sql = '';

        $sql = 'update tb_usuario set imagem_usuario = ?
                    where id_usuario = ?';

        return $sql;
    }

    public static function SelecionarCidade() {

        $sql = 'select id_cidade, nome_cidade from tb_cidade  order by nome_cidade';

        return $sql;
    }

    public static function AtualizarDadosAdminitradorEmail() {
        $sql = '';

        $sql = 'update tb_usuario set email_usuario = ?
                where id_usuario = ?';

        return $sql;
    }

    public static function AtualizarDadosFuncionarios_Adm() {
        $sql = '';

        $sql = 'update tb_funcionario set nome_funcionario = ?,
                telefone_funcionario = ?
                where id_user_adm = ?';

        return $sql;
    }
    public static function AtualizarDadosFuncionarios() {
        $sql = '';

        $sql = 'update tb_funcionario set nome_funcionario = ?,
                telefone_funcionario = ?
                where id_user_func = ?';

        return $sql;
    }


    ///PARCEIRO///
    public static function CarregarDadosParceiro() {
        $sql = '';

        $sql = 'select parc.nome_parceiro, 
                       parc.telefone_parceiro,
                       usu.senha_usuario,
                       usu.email_usuario
                  from tb_usuario usu
                 inner join tb_parceiro parc
                    on parc.id_user_parceiro = usu.id_usuario
                 where usu.id_usuario = ?';

        return $sql;
    }

    public static function AlterarDadosPessoaParceiro() {
        $sql = '';

        $sql = ' update tb_parceiro set nome_parceiro = ?, 
                telefone_parceiro = ?
                where id_user_parceiro = ?';
        return $sql;
    }

    public static function AlterarEmailPessoaParceiro() {
        $sql = '';

        $sql = ' update tb_usuario set email_usuario = ?
                where id_usuario = ?';
        return $sql;
    }
    
   public static function AlterarStatus() {
        $sql = '';

        $sql = 'update tb_status set situacao_status = ?
                    where id_status = ?';

        return $sql;
    }
    public static function VerificarEmailDuplicadoCadastro() {
        $sql = '';

        $sql = 'select 
                    count(*) as contar
                from
                    tb_usuario
                where
                    email_usuario = ?';
        return $sql;
    }
    
    public static function VerificarEmailDuplicadoAlterar(){
        $sql = '';
        
        $sql = 'select count(*) as contar
                from 
                    tb_usuario 
                where 
                    email_usuario = ? and id_usuario <> ?';
        
        return $sql;
    }
}
