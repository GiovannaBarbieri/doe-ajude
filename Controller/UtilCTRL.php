<?php

class UtilCTRL {

    private static function IniciarSessao() {
        if (!isset($_SESSION)) {
            session_start();
        }
    }

    public static function CriarSessao($idUser, $tipo, $idFunc) {

        self::IniciarSessao();
        $_SESSION['tipo'] = $tipo;
        $_SESSION['idUser'] = $idUser;
        if ($idFunc != '') {
            $_SESSION['idfunc'] = $idFunc;
        }
    }

    public static function DevolverCriptografia($senha) {
        return password_hash($senha, PASSWORD_DEFAULT);
    }

    public static function RetornarIdFunc() {
        self::IniciarSessao();
        return $_SESSION['idfunc'];
    }

    public static function Deslogar() {
        self::IniciarSessao();
        unset($_SESSION['tipo']);
        unset($_SESSION['idUser']);

        if (isset($_SESSION['idsetor'])) {
            unset($_SESSION['idsetor']);
        }
        if (isset($_SESSION['idfunc'])) {
            unset($_SESSION['idfunc']);
        }

        header('location: login.php');
    }

    public static function VerificarLogado() {
        self::IniciarSessao();

        if (!(isset($_SESSION['idUser'])) && !(isset($_SESSION['tipo']))) {
            header('location: login.php');
        }
    }

    public static function VerTipoPermissao($tipo) {

        if ($tipo != self::RetornarTipoLogado()) {
            self::Deslogar();
        }
    }

    public static function RetornarCodigoUser() {
        self::IniciarSessao();
        return $_SESSION['idUser'];
        //return 1; // simular o número do id do usuario adm logado
    }

    public static function RetornarTipoLogado() {
        self::IniciarSessao();
        return $_SESSION['tipo']; // Simula o numero do id do usuário adm logado
    }

    // Mexido no dia 07/09/2020 na função IniciarSessao até a função RetornarTipoLogado

    private static function SetarFusoHoario() {

        return date_default_timezone_set('America/Sao_Paulo');
    }

    public static function DataAtual() {
        self::SetarFusoHoario();
        return date('Y-m-d');
    }

    public static function HoraAtual() {
        self::SetarFusoHoario();
        return date('H:i:s');
    }

    public static function MostrarData($data) {

        return explode('-', $data)[2] . '/' . explode('-', $data)[1] . '/' . explode('-', $data)[0];
    }

    public static function MostrarHora($hora) {

        return explode(':', $hora)[0] . ':' . explode(':', $hora)[1];
    }

    public static function TipoUsuario($user) {

        $tipo = '';

        switch ($user) {

            case 1:
                $tipo = 1; //Administrador
                break;

            case 2:
                $tipo = 2; //Funcionario
                ;

                break;
            case 3:
                $tipo = 3; //Pessoa: Doador ou Voluntário
                ;

                break;
            case 4:
                $tipo = 4; //Parceiro
                break;
        }

        return $tipo;
    }
    public static function TipoFuncionario($tipo) {

        $tipo = '';

        switch ($tipo) {

            case 1:
                $tipo = 1; //Administrador
                break;

            case 2:
                $tipo = 2; //Funcionario
                ;

                break;
   
        }

        return $tipo;
    }

    public static function RetornarStatus($status) {

        $tipo = '';

        switch ($status) {

            case 0:
                $tipo = '<div class="progress progress-striped active"><div class="progress-bar progress-bar-warning" style="width: 50%">Pendente</div></div>';

                break;

            case 1:
                $tipo = '<div class="progress progress-striped active"><div class="progress-bar progress-bar-success" style="width: 100%">Aprovado </div></div>';
                ;

                break;
            case 2:
                $tipo = '<div class="progress progress-striped active"><div class="progress-bar progress-bar-danger" style="width: 100%">Rejeitado </div></div>';
                ;

                break;
        }

        return $tipo;
    }

    public static function RetornaDisponibilidade($periodo) {

        $tipo = '';

        switch ($periodo) {

            case 1:
                $tipo = 'Manhã'; //Manhã
                break;

            case 2:
                $tipo = 'Tarde'; //Tarde
                ;

                break;
            case 3:
                $tipo = 'Noite'; //Noite
                ;

                break;
        }

        return $tipo;
    }

    public static function RetornaSetorVoluntario($setor) {

        $tipo = '';

        switch ($setor) {

            case 1:
                $tipo = 'Educação'; //Manhã
                break;

            case 2:
                $tipo = 'Abrigo'; //Tarde
                ;

                break;
            case 3:
                $tipo = 'Equipe de Apoio'; //Noite
                ;

                break;
        }

        return $tipo;
    }

    public static function TipoDoador($doacao) {

        $tipo = '';

        switch ($doacao) {

            case 1:
                $tipo = 'Doador'; //Manhã
                break;

            case 2:
                $tipo = 'Voluntário'; //Tarde
                ;

                break;
        }

        return $tipo;
    }

}
