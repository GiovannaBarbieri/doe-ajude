<?php

//require_once $_SERVER['DOCUMENT_ROOT'] . '/Controller/UsuarioCTRL.php';
require_once '../Controller/UsuarioCTRL.php';


if (isset($_POST['email_user']) && $_POST['acao'] == 'I') {
    $email = $_POST['email_user'];
    $ctrl = new UsuarioCTRL();

    if ($ctrl->VerificarEmailDuplicadoCadastro($email) == 1) {
        echo '1'; // Existe
    } else {
        echo '0'; //Não Existe
    }
}else if(isset ($_POST['email_user']) && isset ($_POST['idUser']) && $_POST['acao'] == 'A'){
    $email = $_POST['email_user'];
    $id = $_POST['idUser'];
    
    $ctrl = new UsuarioCTRL();
    
    if($ctrl->VerificarEmailDuplicadoAlterar($email, $id) == 1){
        echo '1'; //existe
    }else{
        echo '0'; //não existe
    }
}


