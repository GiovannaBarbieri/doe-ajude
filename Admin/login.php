<?php

//require_once $_SERVER['DOCUMENT_ROOT'] .  '/Controller/UsuarioCTRL.php';
require_once '../Controller/UsuarioCTRL.php';
//echo password_hash('123456', PASSWORD_DEFAULT);
if (isset($_POST['btnAcessar'])) {



    $login = $_POST['login'];

    $senha = $_POST['senha'];



    $ctrl = new UsuarioCTRL();



    $ret = $ctrl->ValidarLogin($login, $senha);
}

?>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

    <?php

    include_once '_head.php';

    ?>


</head>

<body>

    <div class="container">

        <div class="row text-center ">

            <div class="col-md-12">

                <br /><br />

                <?php

                if (isset($ret)) {

                    Exibirmsg($ret);
                }

                ?>
                <img src="/Admin/assets/img/logo.png" class="img-login" alt="">
                <h3 style="margin-top: 0px;">Casa do Caminho</h3>



                <h5>( Faça seu login )</h5>

                <br />

            </div>

        </div>

        <div class="row ">



            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">

                <div class="panel panel-default">

                    <div class="panel-heading">

                        <strong> Entre com seus dados </strong>

                    </div>

                    <div class="panel-body">

                        <form action="login.php" method="post">

                            <br />

                            <div class="form-group input-group">

                                <span class="input-group-addon"><i class="fa fa-tag"></i></span>

                                <input type="text" class="form-control" placeholder="Seu Login" name="login" id="login" />

                            </div>

                            <div class="form-group input-group">

                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>

                                <input type="password" class="form-control" placeholder="Sua senha" name="senha" id="senha" />

                            </div>

                            <div class="form-group">

                                <span class="pull-right">

                                    <a href="recuperar_senha.php">Esqueceu sua senha ? </a>

                                </span>

                            </div>



                            <button class="btn btn-primary" name="btnAcessar">Acessar</button>

                            <hr>

                            Não possui cadastro ? <a href="cadastrar_pessoa.php"> Clique aqui </a>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</body>

</html>