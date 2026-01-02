<?php
require_once '/home2/doeaju78/public_html/PHPMailer/src/PHPMailer.php';

require_once '/home2/doeaju78/public_html/PHPMailer/src/SMTP.php';

require_once '/home2/doeaju78/public_html/PHPMailer/src/Exception.php';

require_once '/home2/doeaju78/public_html/Controller/PessoaCTRL.php';

require_once '_msg.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

$email = '';

$nome = '';



if (isset($_POST['btnSolicitar'])) {

    $email = $_POST['email_usuario'];



    $ctrl = new PessoaCTRL();

    $dados = $ctrl->RecuperarSenha($email);


    if (count($dados) > 0) {

        //inicida a instancia da classe

        $mail = new PHPMailer(TRUE);



        $nome = $dados[0]['nome_pessoa']; //tb_pessoa

        $senha = $dados[0]['senha_usuario']; //tb_usuario



        try {

            //Server settings

            $mail->SMTPDebug = 2;

            //$mail->isSMTP();                               

            $mail->Host = 'mail.doeajude.com.br';

            $mail->SMTPAuth = true;

            $mail->Username = 'suporte@doeajude.com.br';

            $mail->Password = '-Hg^Z~,RUNrE';

            $mail->SMTPSecure = 'tsl';

            $mail->Port = 465;

            $mail->CharSet = 'UTF-8';



            $mail->setFrom('suporte@doeajude.com.br', 'DoeAjude');

            $mail->addAddress($email, $nome);



            $mail->Subject = "Email de recuperação de senha Doe Ajude - Doação de objetos";



            $mail->Body = ("<html>Validamos o seu e-mail e vimos que se trata de um e-mail existente!</br>"
                    . " Por gentileza clique no link abaixo para ser direcionado para a tela onde poderá inserir sua nova senha.</br>"
                    . "Link para nova senha: <a href='https://doeajude.com.br/Admin/nova_senha.php?nova_senha=" . $senha . "'>Clique aqui.</a></html>");

            $mail->AltBody = "de: {$nome}\nemail:{$email}\nmensagem: {$mensagem}";



            $mail->send();

            $ret = 10;

        } catch (Exception $ex) {

            $ret = -7;

            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }
    } else {

        $ret = -1;
    }
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



                    <h2>Casa do Caminho</h2>   



                    <h5></h5>

                    <br />

                </div>

            </div>

            <div class="row ">



                <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">

                    <div class="panel panel-default">

                        <div class="panel-heading">

                            <center><strong>   Recuperação de senha: </strong></center>  

                        </div>

                        <div class="panel-body">
                        <?php
                    if (isset($ret)) {

                        ExibirMsg($ret);
                        echo '<center><a href="https://doeajude.com.br">Voltar</a></center>';
                    }else{

                    
                    ?>
                            <form role="form" action="recuperar_senha.php" method="post">

                                <br />
                                <div class="form-group">
                                    <div class=" input-group" id="divEmail">

                                        <span class="input-group-addon">@</span>

                                        <input type="text" class="form-control" placeholder="Informe seu e-mail cadastrado." name="email_usuario" id="email_usuario" value="<?= $email ?>" onclick="return ValidarEmail(1)" />        
                                    </div> 
                                     <label id="val_email" class="Validar"></label>
                                </div> 
                                <div class="form-group">

                                    <center><button class="btn btn-success" name="btnSolicitar" onclick="return Validar(12)">Solicitar</button></center>

                                </div>

                                <hr />

                                <a href="login.php">Voltar</a>

                            </form>
                        <?php
                        }
                        ?>
                        </div> 

                    </div>

                </div>      

            </div>

        </div>   

    </body>

</html>

