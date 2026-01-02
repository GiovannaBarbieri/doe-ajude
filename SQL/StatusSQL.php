<?php

class StatusSQL {

    public static function InserirStatusDoacao() {

        $sql = '';

        $sql = 'INSERT INTO tb_status (data_status, hora_status, 
                situacao_status, id_doador) VALUES (?,?,?,?)';

        return $sql;
    }

    public static function InserirStatusParceiro() {

        $sql = '';

        $sql = 'INSERT INTO tb_status (data_status, hora_status, 
                situacao_status, id_doador) VALUES (?,?,?,?)';

        return $sql;
    }

    public static function InserirStatusVoluntario() {

        $sql = '';

        $sql = 'INSERT INTO tb_status (data_status, hora_status, 
                situacao_status, id_voluntario) VALUES (?,?,?,?)';

        return $sql;
    }

}
