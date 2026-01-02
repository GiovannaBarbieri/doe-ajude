<?php

class VoluntarioSQL {

    public static function CadastrarVoluntario() {

        $sql = '';

        $sql = 'insert into tb_voluntario (disponibilidade_voluntario,
                setor_voluntario, sobre_voluntario, id_pessoa) values (?,?,?,?)';

        return $sql;
    }

    public static function CadastrarStatusVol() {

        $sql = '';

        $sql = 'insert into tb_voluntario (
                    disponibilidade_voluntario,
                    outro_voluntario,
                    setor_voluntario,
                    outra_funcao,
                    outra_instituicao,
                    qual_instituicao,
                    sobre_voluntario,
                    id_doador) 
                values (?, ?, ?, ?, ?, ?, ?, ?)';

        return $sql;
    }

    public static function ConsultarVoluntario() {
        $sql = 'select 
            
                tb_doador.nome_usuario,
                tb_doador.sobrenome_usuario,
		tb_doador.id_usuario,
                tb_doador.telefone_usuario,
		tb_doador.tipo_doador,
                tb_status.data_status,
                tb_status.situacao_status

                from tb_status tb_status
                inner join tb_doador tb_doador
                on tb_doador.id_doador = tb_status.id_status
                
                where tipo_doador = 2
                                
                            ';

        return $sql;
    }
    
    public static function retornarPessoa(){
        
        $sql = '';
        
        $sql = 'select pes.id_pessoa 
                from tb_pessoa pes
                inner join tb_usuario usu
                    on usu.id_usuario = pes.id_user_pessoa
                where usu.id_usuario = ?';
        
        return $sql;
        
    }

}
