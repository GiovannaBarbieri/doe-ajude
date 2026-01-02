<?php
require_once '../Controller/PessoaCTRL.php';
require_once '_msg.php';


$hash = '';

$email = '';

$id = '';

$bdsenha = '';

$bdcod = '';

$ret = '';

$ns = '';



if (isset($_GET['nova_senha'])) {

    $hash = $_GET['nova_senha'];

    $ctrl = new PessoaCTRL();

    $dados = $ctrl->ValidaHash($hash);

    //print_r($dados); 

    if ($dados[0]['id_usuario'] != '') {

        $email = $dados[0]['email_usuario'];

        $bdsenha = $dados[0]['senha_usuario'];

        if ($bdsenha == $hash) {

            $bdcod = $dados[0]['id_usuario'];
        } else {

            //Não foi possivel redefinir sua senha

            header("Location: https://doeajude.com.br/Admin/nova_senha.php?ret=-7");
        }
    } else {                                    //Não foi possivel redefinir senha
        header("Location: https://doeajude.com.br/Admin/acesso.php?ret=-7");
    }
} else if (isset($_POST['btn_salvar'])) {

    $id = $_POST['id_usuario'];

    $senha = $_POST['senha'];

    $rsenha = $_POST['rsenha'];

    $ctrl = new PessoaCTRL();

    $ret = $ctrl->NovaSenha($senha, $rsenha, $id);

    if ($ret < 0) {
        
    } else {                                                //sucesso
        header("Location: https://doeajude.com.br/Admin/login.php?ret=10");
    }
} else if (isset($_POST['hash'])) {

    $ctrl = new PessoaCTRL();

    $dados = $ctrl->ValidaHash($_POST['hash']);

    //print_r($dados);

    if (count($dados) > 0) {

        $bdsenha = $dados[0]['senha_usuario'];

        if ($bdsenha == $_POST['hash']) {

            $bdcod = $dados[0]['id_pessoa'];
        } else {

            //Não foi possivel redefinir senha

            header("Location: https://doeajude.com.br/Admin/nova_senha.php?ret=-7");
        }
    }
} else {                                                    //Não foi possivel redefinir senha
    header("Location: https://doeajude.com.br/Admin/nova_senha.php?ret=-7");
}
?>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">

    <?php include '_head.php'; ?>

    <body>

        <div class="container">

            <div class="row text-center ">

                <div class="col-md-12">

                    <?php
                    if (isset($ret)) {

                        Exibirmsg($ret);
                    }
                    ?>

                    <br /><br />

                    <h2> Doe & Ajude</h2>

                    <h5>Atenção! Esta é a tela para redefinir sua senha, informe abaixo a nova senha a ser utilizada.</h5>

                    <br />

                </div>

            </div>

            <div class="row ">

                <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">

                    <div class="panel panel-default">

                        <div class="panel-heading">

                            <strong>   Digite sua nova senha </strong>  

                        </div>

                        <div class="panel-body">

                            <form role="form" method="POST" action="nova_senha.php">

                                <input type="hidden" value="<?= isset($_POST['id_usuario']) ? $_POST['id_usuario'] : $bdcod; ?>" name="id_usuario" />

                                <input type="hidden" value="<?= isset($_POST['hash']) ? $_POST['hash'] : $hash; ?>" name="hash" />

                                <input type="hidden" value="<?= isset($_POST['email']) ? $_POST['email'] : $email; ?>" name="email" />


                                <b>E-mail:</b> <?= isset($_POST['email']) ? $_POST['email'] : $email; ?>
                                <br>
                                    <b>ID:</b> <?= isset($_POST['id_usuario']) ? $_POST['id_usuario'] : $id; ?>

                                    <br/>      

                                    <br />
                                    <div class="form-group">
                                        <div class="input-group" id="divSenha">

                                            <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>

                                            <input type="password" class="form-control" placeholder="Dígite uma senha acima de 6 caracteres" name="senha" id="senha" />

                                        </div>
                                        <label id="val_senha" class="Validar"></label>
                                    </div>
                                    <div class="form-group">
                                        <div class=" input-group" id="divRepetir">

                                            <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>

                                            <input type="password" class="form-control"  placeholder="Dígite uma senha acima de 6 caracteres" name="rsenha" id="rsenha"/>


                                        </div>
                                        <label id="val_repetir" class="Validar"></label>
                                    </div>

                                    <div class="form-group">

                                    </div>

                                    <button class="btn btn-primary" name="btn_salvar" id="btn_salvar" onclick="return Validar(11)">Salvar</button>

                                    <hr />

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </body>

</html>

