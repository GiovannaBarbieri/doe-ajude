<?php
require_once '../VO/UsuarioVO.php';
require_once '../Controller/PessoaCTRL.php';
require_once '../Controller/ParceiroCTRL.php';
require_once '../VO/PessoaVO.php';
require_once '../VO/ParceiroVO.php';

$ctrl = new PessoaCTRL();
$ctrl_parc = new ParceiroCTRL();
$tipo = '';

if (isset($_POST['btnRegistrar'])) {

    $tipo = $_POST['tipo'];

    if ($tipo == 3) {

        $voUser = new UsuarioVO();
        $voUser->setEmailUsuario($_POST['email']);
        $voUser->setSenhaUsuario($_POST['senha']);
        $redigiteSenha = $_POST['redigiteSenha'];
        $voUser->setTipoUsuario($tipo);
        $voPessoa = new PessoaVO();
        $voPessoa->setNomePessoa($_POST['nome']);
        $telefone = $_POST['telefone'];
        $enviar_db = str_replace("(", "", str_replace(")", "", str_replace(" ", "", str_replace("-", "", $telefone))));
        $voPessoa->setTelefonePessoa($enviar_db);
        $voPessoa->setCep($_POST['cep']);
        $voPessoa->setRua($_POST['rua']);
        $voPessoa->setBairro($_POST['bairro']);
        $voPessoa->setNumero($_POST['numero']);
        $voPessoa->setId_cidade($_POST['cidade']);
        $ret = $ctrl->InserirPessoa($voUser, $voPessoa, $redigiteSenha);
    } elseif ($tipo == 4) {

        $vo = new ParceiroVO();
        $vo->setNomeParceiro($_POST['nome']);
        $telefone = $_POST['telefone'];
        $enviar_db = str_replace("(", "", str_replace(")", "", str_replace(" ", "", str_replace("-", "", $telefone))));
        $vo->setTelefoneParceiro($enviar_db);
        $vo->setResponsavelNota($_POST['resp']);
        $vo->setDocumentoParceiro($_POST['doc']);
        $vo->setEmailUsuario($_POST['email']);
        $vo->setSenhaUsuario($_POST['senha']);
        $redigiteSenha = $_POST['redigiteSenha'];
        $vo->setTipoUsuario($_POST['tipo']);
        $vo->setCep($_POST['cep']);
        $vo->setRua($_POST['rua']);
        $vo->setBairro($_POST['bairro']);
        $vo->setNumero($_POST['numero']);
        $vo->setId_cidade($_POST['cidade']);
        $ret = $ctrl_parc->InserirPessoaParceiro($vo, $redigiteSenha);
    }
}
$cidade = $ctrl->CidadePessoa();
?>
﻿<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php
        include_once '_head.php';
        ?>
        <?php
        include_once '_cep.php';
        ?>
    </head>
    <body>
        <div class="container">
            <div class="row text-center  ">
                <div class="col-md-12">
                    <br /><br />
                    <?php
                    if (isset($ret)) {
                        Exibirmsg($ret);
                    }
                    ?>
                    <h2> Cadastro - Casa do Caminho </h2>

                    <h5>( Registre-se para obter acesso )</h5>
                    <br />
                </div>
            </div>
            <div class="row">

                <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <strong>  Novo usuário ? Cadastre-se </strong>  
                        </div>
                        <div class="panel-body">
                            <form action="cadastrar_pessoa.php" method="post">
                                <br/> 
                                <div class="form-group">
                                    <div class="input-group" id="divTipo">
                                        <span class="input-group-addon"><i class="fa fa-child"  ></i></span>
                                        <select class="form-control" name="tipo" id="tipo" onchange="CadastrarPessoa(this.value)">
                                            <option value="">Selecione o tipo</option>
                                            <option value="3" <?= isset($tipo) ? ($tipo = 3 ?: 'selected') : '' ?>>Pessoa Física</option>
                                            <option value="4" <?= isset($tipo) ? ($tipo = 4 ?: 'selected') : '' ?>>Pessoa Jurídica</option>
                                        </select>
                                    </div>
                                    <label id="val_tipo" class="Validar"></label>
                                </div>
                                <div id="divNomeFunc">
                                    <div class="form-group">
                                        <div class="input-group" id="divNome">
                                            <span class="input-group-addon"><i class="fa fa-user"  ></i></span>
                                            <input class="form-control" placeholder="Digite o nome completo..." name="nome" id="nome"/>
                                        </div> 
                                        <label id="val_nome" class="Validar"></label>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group" id="divEmail">
                                            <span class="input-group-addon">@</span>
                                            <input type="text" class="form-control" placeholder="Digite o e-mail..." name="email" id="email" onchange="ValidarEmail(1)"/>
                                        </div>
                                        <label id="val_email" class="Validar" onchange="ValidarEmail(1)"></label>
                                    </div>
                                    <div id="divGeral">
                                        <div class="form-group">
                                            <div class=" input-group" id="divDoc">
                                                <span class="input-group-addon"><i class="fa fa-suitcase"></i></span> <!--melhorar figurinha-->
                                                <input class="form-control cnpj" placeholder="Digite seu cnpj" name="doc" id="doc"/>

                                            </div>
                                            <label id="val_doc" class="Validar"></label>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group" id="divResp">
                                                <span class="input-group-addon"><i class="fa fa-user"  ></i></span>
                                                <input class="form-control" placeholder="Digite o nome do responsável" name="resp" id="resp"/>

                                            </div>
                                            <label id="val_resp" class="Validar"></label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group" id="divTelefone">
                                            <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                            <input class="form-control tel" placeholder="Digite o telefone..." name="telefone" id="telefone"/>

                                        </div>
                                        <label id="val_telefone" class="Validar"></label>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group" id="divCep">
                                            <span class="input-group-addon"><i class="fa fa-globe"></i></span>
                                            <input class="form-control cep" placeholder="Digite o cep..." name="cep" id="cep"/>

                                        </div>
                                        <label id="val_cep" class="Validar"></label>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group" id="divRua">
                                            <span class="input-group-addon"><i class="fa fa-road"></i></span>
                                            <input class="form-control" placeholder="Digite a rua..." name="rua" id="rua"/>

                                        </div>
                                        <label id="val_rua" class="Validar"></label>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group" id="divBairro">
                                            <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                            <input class="form-control" placeholder="Digite o bairro..." name="bairro" id="bairro"/>

                                        </div>
                                        <label id="val_bairro" class="Validar"></label>
                                    </div>
                                    <div class="form-group">
                                        <div class=" input-group" id="divCidade">
                                            <span class="input-group-addon"><i class="fa fa-thumb-tack"></i></span>
                                            <select class="form-control" name="cidade" id="cidade">
                                                <option value="">Escolha uma Cidade</option>
                                                <?php for ($i = 0; $i < count($cidade); $i++) { ?>
                                                    <option value="<?= $cidade[$i]['id_cidade'] ?>"><?= $cidade[$i]['nome_cidade'] ?></option>
                                                <?php } ?>
                                            </select>

                                        </div>
                                        <label id="val_cidade" class="Validar"></label>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group" id="divNumero">
                                            <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
                                            <input class="form-control" placeholder="Digite o número..." name="numero" id="numero"/>

                                        </div>
                                        <label id="val_numero" class="Validar"></label>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group" id="divSenha">
                                            <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
                                            <input type="password" class="form-control" placeholder="Digite a senha (acima de 6 caracteres)" id="senha" maxlength="8" name="senha"/>

                                        </div>
                                        <label id="val_senha" class="Validar"></label>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-group input-group" id="divRepetir">
                                            <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
                                            <input type="password" class="form-control" placeholder="Redigite a senha..." id="redigiteSenha" name="redigiteSenha" maxlength="8"/>

                                        </div>
                                        <label id="val_repetir" class="Validar"></label>
                                    </div>
                                    <button name="btnRegistrar" class="btn btn-success" onclick="return Validar(5)">Registre-me</button>
                                </div>    


                                <hr />
                                Já registrado ?  <a href="login.php" >Entre aqui</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>


