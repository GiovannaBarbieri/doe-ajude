<?php
require_once '../Controller/UtilCTRL.php';
require_once '../VO/UsuarioVO.php';
require_once '../Controller/UsuarioCTRL.php';


//echo password_hash('123',PASSWORD_DEFAULT);
$ctrl = new UsuarioCTRL();

if (isset($_POST['btnAltSenha'])) {

    $senhaNova = $_POST['senhaNova'];
    $repetirSenha = $_POST['repetirSenha'];

    $ret = $ctrl->AlterarSenhaFuncionario($senhaNova, $repetirSenha);
}

$dadosgerente = $ctrl->CarregarDadosFuncionario();
?>
﻿<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php
        include_once '_head.php';
        ?>
    </head>
    <body>
        <div id="wrapper">
            <?php
            include_once '_topo.php';
            include_once '_menu.php';
            ?>
            <div id="page-wrapper" >
                <div id="page-inner">
                    <div class="row">
                        <div class="col-md-12">
                            <?php
                            if (isset($ret)) {
                                ExibirMsg($ret);
                            }
                            ?>
                            <h2>Meus Dados</h2>   
                            <h5>Aqui você poderá manter seus dados atualizados.</h5>
                        </div>
                    </div>
                    <!-- /. ROW  -->
                    <hr />
                    <div class="panel-body">
                        <form method="post" action="dados_gerente.php">
                            <input type="hidden" name="code">
                                <div class="form-group">
                                    <label>Nome</label>
                                    <input class="form-control" placeholder="Digite aqui..." name="nome" id="nome" value="<?= $dadosgerente[0]['nome_funcionario'] ?>"/>
                                </div>                
                                <div class="form-group">
                                    <label>Sobrenome</label>
                                    <input class="form-control" placeholder="Digite aqui..." name="sobrenome" id="sobrenome" value="<?= $dadosgerente[0]['sobrenome_funcionario'] ?>"/>
                                </div>                
                                <div class="form-group">
                                    <label>E-mail</label>
                                    <input class="form-control" placeholder="Digite aqui..." name="email" id="email" value="<?= $dadosgerente[0]['email_usuario'] ?>"/>
                                </div>
                                <div class="form-group">
                                    <label>Telefone</label>
                                    <input class="form-control" placeholder="Digite aqui..." name="telefone" id="telefone" value="<?= $dadosgerente[0]['telefone_funcionario'] ?>"/>
                                </div>   
                                <div class="form-group">
                                    <p><i class="glyphicon glyphicon-lock fa-1x"></i> Clique <a href="#" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#senha">aqui</a> para alterar sua senha</p>
                                </div> 
                                <br/>
                                <button type="submit" class="btn btn-success" name="btnSalvar">Salvar</button>
                        </form>

                        <!--start modal update password-->     
                        <form action="dados_gerente.php" method="post">
                            <div class="modal fade" id="senha" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Alterar Senha</h4>
                                        </div>
                                        <form action="dados_funcionario.php" method="post">
                                            <div class="modal-body">
                                                <label>Senha atual</label>
                                                <div class="form-group input-group">
                                                    <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
                                                    <input class="hidden" type="password" name="senhaAtual" class="form-control" placeholder="Digite a senha atual" value="<?= $dadosgerente[0]['senha_usuario'] ?>" />
                                                </div>
                                                <a class="btn btn-success btn-sm" onclick="ValidadarSenha()">VERIFICAR</a>
                                                <br/>
                                                <br/>
                                                <label>Digite a nova senha</label>
                                                <div class="form-group input-group">
                                                    <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
                                                    <input type="password" name="senhaNova" class="form-control" placeholder="Digite a nova senha" />
                                                </div>
                                                <label>Repita a nova senha</label>
                                                <div class="form-group input-group">
                                                    <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
                                                    <input type="password" name="repetirSenha" class="form-control" placeholder="Repita a nova senha" />
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                <button class="btn btn-success" name="btnAltSenha">Salvar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!--end modal update password-->
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

