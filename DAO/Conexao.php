<?php

// Configurações do site
define('HOST', 'localhost'); //IP
define('USER', 'root'); //usuario
define('PASS', ''); //Senha
define('DB', 'db_doacao'); //Banco
/**
 * Conexao.class TIPO [Conexão]
 * Descricao: Estabelece conexões com o banco usando SingleTon
 * @copyright (c) year, Wladimir M. Barros
 */

class Conexao {

    /** @var PDO */
    private static $Connect;

    private static function Conectar() {
        try {

            //Verifica se a conexão não existe
            if (self::$Connect == null):
                //se for mudar o banco de dados, muda somente o 'mysql:host' = 'É o banco de dados'
                $dsn = 'mysql:host=' . HOST . ';dbname=' . DB;
                self::$Connect = new PDO($dsn, USER, PASS, null);
                //PDO é o metodo e MySQLI outra forma
            endif;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
       
        //Seta os atributos para que seja retornado as excessões do banco
        self::$Connect->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
       
        return  self::$Connect;
    }

    public static function retornaConexao() {
        return  self::Conectar();
    }
    
    
}