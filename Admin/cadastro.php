<?php
require_once '../VO/UsuarioVO.php';
require_once '../VO/DoadorVO.php';
require_once '../Controller/UsuarioCTRL.php';

$ctrl = new UsuarioCTRL();

if (isset($_POST['btnCadastrar'])) {

    $voUsuario = new UsuarioVO();

    $voUsuario->setEmailUsuario($_POST['email']);
    $voUsuario->setSenhaUsuario($_POST['senha']);
    $voUsuario->setTipoUsuario($_POST['tipo']);

    $voDoador = new DoadorVO();

    $voDoador->setNome_usuario($_POST['nome']);
    $voDoador->setSobrenome_usuario($_POST['sobrenome']);
    $voDoador->setTelefone_usuario($_POST['celular']);

    $ret = $ctrl->CadastrarDoador($voUsuario, $voDoador);

    if ($ret == 31) {        
        header('location: login.php?cadastro=sucesso');
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
            <div class="row text-center  ">
                <div class="col-md-12">
                    <br /><br />
                    <h2> Casa do Caminho : Doações</h2>  
                    <h5>[ Faça seu cadastro para ter acesso à plataforma ]</h5>
                    <br />
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <center><strong>Novo usuário? Cadastre-se agora mesmo!</strong></center>
                        </div>
                        <div class="panel-body">
                            <form action="cadastro.php" method="post">
                                <?php
                                if (isset($ret)) {
                                    ExibirMsg($ret);
                                }
                                ?>
                                <input type="hidden" id="tipo" name="tipo" value="3" />
                                <label id="val_nome" class="Validar"></label>
                                <div class="form-group input-group" id="divNome">
                                    <span class="input-group-addon"><i class="fa fa-user"  ></i></span>
                                    <input type="text" class="form-control" placeholder="Nome" id="nome" name="nome" onBlur="Validar(nome)" onkeypress="return Letras()"/>                                     
                                </div>
                                <label id="val_sobrenome" class="Validar"></label>
                                <div class="form-group input-group" id="divSobrenome">
                                    <span class="input-group-addon"><i class="fa fa-user"  ></i></span>
                                    <input type="text" class="form-control" placeholder="Sobrenome" id="sobrenome" name="sobrenome" onBlur="Validar(sobrenome)" onkeypress="return Letras()"/>                                     
                                </div>
                                <label id="val_email" class="Validar"></label>
                                <div class="form-group input-group" id="divEmail">
                                    <span class="input-group-addon"><b>@</b></span>
                                    <input type="email" class="form-control" placeholder="E-mail" id="email" name="email" onBlur="Validar(email)"/>                                     
                                </div>
                                <label id="val_celular" class="Validar"></label>
                                <div class="form-group input-group" id="divCelular">
                                    <span class="input-group-addon"><i class="fa fa-tag"  ></i></span>
                                    <input type="text" class="form-control cel num telcel" placeholder="Celular" id="telcel" name="celular" onBlur="Validar(celular)"/>                                    
                                </div>
                                <label id="val_senha" class="Validar"></label>
                                <div class="form-group input-group" id="divSenha">
                                    <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
                                    <input type="password" class="form-control" placeholder="Senha" id="senha" name="senha" onBlur="Validar(senha)"/>                                    
                                </div>
                                <label id="val_rsenha" class="Validar"></label>
                                <div class="form-group input-group" id="divRsenha">
                                    <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
                                    <input type="password" class="form-control" placeholder="Repetir senha" id="rsenha" name="rsenha" onBlur="Validar(rsenha)"/>                                    
                                </div>
                                <center><button class="btn btn-success" name="btnCadastrar" onclick="return Validar(31)">Cadastrar</button></center>
                                <hr />
                                Já tem um cadastro? <a href="login.php" >Faça login</a>
                            </form>                            
                        </div>
                    </div>
                    <br /><br /><br /><br />
                </div>
            </div>
        </div>   
    </body>
</html>