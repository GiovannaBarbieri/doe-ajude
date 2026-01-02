<?php
require_once '../Controller/UtilCTRL.php';

require_once '../VO/UsuarioVO.php';

require_once '../VO/FuncionarioVO.php';

require_once '../Controller/UsuarioCTRL.php';

UtilCtrl::VerTipoPermissao(1);



$vo = new UsuarioVO;

$vo_fun = new FuncionarioVO();

$ctrl_user = new UsuarioCTRL();

$nome_foto = '';



if (isset($_POST['btnSalvar'])) {



    $vo_fun->setNomeFunc($_POST['nome']);

    $vo->setEmailUsuario($_POST['email']);

    $vo_fun->setTelFunc($_POST['telefone']);



    $ret = $ctrl_user->AtualizarDadosAdministrador($vo, $vo_fun);
}

if (isset($_POST['btnEnviarFoto'])) {



    $foto = $_FILES['foto'];



    if ($foto['type'] == '') {

        $ret = 6;
    } else if ($foto['type'] != 'image/jpeg') {

        $ret = 5;
    } else {

        $nome_foto = md5(microtime()) . '.jpg';



        move_uploaded_file($foto['tmp_name'], 'assets/img/foto_usuario/' . $nome_foto);



        $vo->setImagem_user($nome_foto);

        $ret = $ctrl_user->colocarFoto($vo);
    }
} else if (isset($_POST['btnExcluirFoto'])) {



    unlink('assets/img/foto_usuario/' . $_POST['nome_foto']);

    $excluir = 'null';

    $vo->setImagem_user($excluir);

    $ret = $ctrl_user->ExcluirFoto($vo);
} else if (isset($_POST['btnAltSenha'])) {

    $vo->setSenhaUsuario($_POST['senhaNova']);

    $repetirSenha = $_POST['repetirSenha'];

    $senhaAtual = $_POST['senhaAtual'];



    $ret = $ctrl_user->AtualizarSenhaUsuario($vo, $repetirSenha, $senhaAtual);
}

$foto = $ctrl_user->CarregarFotoUser();

$dadosAdm = $ctrl_user->CarregarDadosAdministrador();
?>
<!DOCTYPE html>

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

                        <div class="form-group">

                            <form method="post" action="dados_administrador.php" enctype="multipart/form-data">

                                <input type="hidden" value="<?= $imagem = $foto[0]['imagem_usuario'] ?>">    

                                    <?php if ($imagem == '' || $imagem == 'null') { ?>

                                        <img src="assets/img/foto_usuario/find_user.png" class="user-image img-responsive"/>

                                    <?php } elseif ($imagem != '') { ?>

                                        <img src="assets/img/foto_usuario/<?= $imagem ?>" class="user-image img-responsive"/>

                                        <input type="hidden" name="nome_foto" value="<?= $imagem ?>"/>

                                        <button class="btn-xs btn-danger" name="btnExcluirFoto"><i class="fa fa-trash-o"></i></button>

                                    <?php } ?>

                                    <?php if ($imagem == '' || $imagem == 'null') { ?>    

                                        <input type="file" name="foto" />

                                        <button class="btn-xs btn-success carregar-foto" name="btnEnviarFoto"><i class="fa fa-refresh"></i> Carregar foto</button>  

                                    <?php } ?>    

                            </form> <br />



                            <form method="post" action="dados_administrador.php">

                                <input type="hidden" name="code">

                                    <div class="form-group" id="divNome">

                                        <label>Nome completo</label>

                                        <input class="form-control" placeholder="Digite aqui..." name="nome" id="nome" value="<?= $dadosAdm[0]['nome_funcionario'] ?>"/>

                                        <label id="val_nome" class="Validar"></label>

                                    </div>                                

                                    <div class="form-group" id="divEmail">

                                        <label>E-mail</label>

                                        <input class="form-control" placeholder="Digite aqui..." name="email" id="email" value="<?= $dadosAdm[0]['email_usuario'] ?>" onchange="ValidarEmail(1)"/>

                                        <label id="val_email" class="Validar"></label>

                                    </div>

                                    <div class="form-group" id="divTelefone">

                                        <label>Telefone</label>

                                        <input class="form-control tel" placeholder="Digite aqui..." name="telefone" id="telefone" value="<?= $dadosAdm[0]['telefone_funcionario'] ?>"/>

                                        <label id="val_telefone" class="Validar"></label>

                                    </div>   

                                    <div class="form-group">

                                        <p><i class="glyphicon glyphicon-lock fa-1x"></i> Clique <a href="#" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#senha">aqui</a> para alterar sua senha</p>

                                    </div> 

                                    <br/>

                                    <button class="btn btn-success" name="btnSalvar" onclick="return Validar(6)">Salvar</button>

                            </form>



                            <!--start modal update password-->     

                            <form action="dados_administrador.php" method="post">

                                <div class="modal fade" id="senha" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

                                    <div class="modal-dialog">

                                        <div class="modal-content">

                                            <div class="modal-header">

                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                                                <h4 class="modal-title" id="myModalLabel">Alterar Senha</h4>

                                            </div>

                                            <form action="dados_administrador.php" method="post">

                                                <div class="modal-body">

                                                    <label>Senha atual</label>
                                                    <div class="form-group">
                                                    <div class="input-group" id="divSenha">

                                                        <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>

                                                        <input type="password" id="senhaAtual" name="senhaAtual" class="form-control" placeholder="Digite a senha atual e depois clique no cadeado" autocomplete="on"/>

                                                        <label id="val_senha" class="Validar" style="color: #A94442"></label>    
                                                        </div>
                                                    </div>
                                                    <a class="btn btn-success btn-sm" onclick="ValidadarSenha()">VERIFICAR</a>
                                                    <br/>
                                                    <br/>

                                                    <div id="validaS">

                                                        <label>Digite a nova senha</label>

                                                        <div class="form-group input-group" id="divSnova">

                                                            <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>

                                                            <input type="password" name="senhaNova" id="senhaNova" class="form-control" placeholder="Digite a nova senha" autocomplete="on"/>
                                                            <label id="val_snova" class="Validar"></label>
                                                        </div>

                                                        <label>Repita a nova senha</label>

                                                        <div class="form-group input-group" id="divRepetir">

                                                            <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>

                                                            <input type="password" name="repetirSenha" id="rsenha" class="form-control" placeholder="Repita a nova senha" autocomplete="on"/>
                                                            <label id="val_repetir" class="Validar"></label>
                                                        </div>

                                                    </div>

                                                </div>

                                                <div class="modal-footer">

                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>

                                                    <button id="validaB" class="btn btn-success" name="btnAltSenha" onchange="return Validar(13)">Salvar</button>

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

        </div>

    </body>

</html>



