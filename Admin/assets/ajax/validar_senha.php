<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/casa_do_caminho/Controller/UsuarioCTRL.php';

if (isset($_POST['senha_user'])) {
    $senha = $_POST['senha_user'];
    $ctrl = new UsuarioCTRL();

    if ($ctrl->ValidarSenhaUser($senha) == 1) {
        echo '1'; // Existe
    } else {
        echo '0'; // Nao Existe
    }
}


