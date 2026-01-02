<?php

class DoadorSQL {

    public static function InserirDoacao() {
        $sql = '';

        $sql = 'insert into tb_doador (nome_objeto, imagem_objeto, 
                estado_objeto, descricao_objeto, id_pessoa) 
                values (?, ?, ?, ?, ?)';

        return $sql;
    }

    public static function InserirCidadeDoador() {
        $sql = '';

        $sql = 'insert into tb_endereco 
               (rua, bairro, numero, cep, id_cidade, id_usuario, id_doador)
               values (?, ?, ?, ?, ?, ?, ?)';

        return $sql;
    }

    public static function ConsultarEnderecoPessoa() {

        $sql = '';

        $sql = 'select ende.id_endereco,
                       ende.cep,                       
                       ende.rua, 
             	       ende.bairro, 
                       ende.numero,
                       cida.id_cidade,
                       cida.nome_cidade
                from tb_endereco as ende
                    inner join tb_cidade as cida
                on cida.id_cidade = ende.id_cidade
                    inner join tb_usuario usua
                on usua.id_usuario = ende.id_usuario
                where usua.id_usuario = ?';

        return $sql;
    }

    public static function ConsultarDoacao_Pessoa() {

        $sql = '';

        $sql = 'select doa.nome_objeto,
	        doa.estado_objeto,
                sta.data_status,
                sta.situacao_status
            from tb_usuario usu 
            inner join tb_pessoa as pes
            on pes.id_user_pessoa = usu.id_usuario
            inner join tb_doador as doa 
            on doa.id_pessoa = pes.id_pessoa
            inner join tb_status as sta
             on sta.id_doador = doa.id_doador
            where usu.id_usuario = ?';

        return $sql;
    }

    public static function retornarPessoa() {

        $sql = '';

        $sql = 'select pes.id_pessoa 
                from tb_pessoa pes
                inner join tb_usuario usu
                    on usu.id_usuario = pes.id_user_pessoa
                where usu.id_usuario = ?';

        return $sql;
    }
     
  public static function retornarParceiro() {

        $sql = '';

        $sql = 'select par.id_parceiro
                from tb_parceiro par
                inner join tb_usuario usu
                    on usu.id_usuario = par.id_user_parceiro
                where usu.id_usuario = ?';
        
        return $sql;
    }

    ///PARCEIRO///
    public static function InserirDoacaoParceiro() {
        $sql = '';

        $sql = 'insert into tb_doador (nome_objeto, imagem_objeto, 
                estado_objeto, descricao_objeto, id_parceiro) 
                values (?, ?, ?, ?, ?)';

        return $sql;
    }

    public static function InserirCidadeParceiro() {
        $sql = '';

        $sql = 'insert into tb_endereco 
               (rua, bairro, numero, cep, id_cidade, id_usuario, id_doador)
               values (?, ?, ?, ?, ?, ?, ?)';

        return $sql;
    }

    public static function ConsultarEnderecoParceiro() {

        $sql = '';

        $sql = 'select end.id_endereco,
                       end.cep,                       
                       end.rua, 
             	       end.bairro, 
                       end.numero,
                       cid.id_cidade,
                       cid.nome_cidade
                from tb_endereco as end
                    inner join tb_cidade as cid
                on cid.id_cidade = end.id_cidade
                    inner join tb_usuario usu
                on usu.id_usuario = end.id_usuario
                where usu.id_usuario = ?';

        return $sql;
    }

    public static function ConsultarDoacaoParceiro() {

        $sql = '';

        $sql = 'select doa.nome_objeto,
	        doa.estado_objeto,
                sta.data_status,
                sta.situacao_status
            from tb_usuario usu 
            inner join tb_parceiro as par
            on par.id_user_parceiro = usu.id_usuario
            inner join tb_doador as doa 
            on doa.id_parceiro = par.id_parceiro
            inner join tb_status as sta
             on sta.id_doador = doa.id_doador
            where usu.id_usuario = ?';
        
        return $sql;
    }
 

    public static function RelatoriosDoacoes() {

        $sql = 'select 
            
		tb_status.data_status,
                tb_pessoa.nome_pessoa,
                tb_status.situacao_status,
		tb_status.tipo
        
                from tb_status tb_status
                inner join tb_doador tb_doador
                on tb_doador.id_doador = tb_status.id_status = ?
                inner join tb_pessoa tb_pessoa
                on tb_doador.id_doador = tb_pessoa.id_pessoa
                and tb_status.data_status between ? and ? 
               
                ';

        return $sql;
    }

    public static function CarregarDadosDoador() {

        $sql = '';

        $sql = 'select ps.nome_pessoa, 
                       ps.sobrenome_pessoa,
                       ps.telefone_pessoa,
                       usu.senha_usuario,
                       usu.email_usuario
                  from tb_usuario usu
                 inner join tb_pessoa ps
                    on ps.id_user_pessoa = usu.id_usuario
                 where usu.id_usuario = ?';

        return $sql;
    }

}
