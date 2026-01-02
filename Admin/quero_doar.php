<?php
require_once '../VO/DoadorVO.php';
require_once '../Controller/DoadorCTRL.php';
require_once '../Controller/UtilCTRL.php';
require_once '../Controller/PessoaCTRL.php';


UtilCTRL::VerTipoPermissao(3);

$ctrl = new DoadorCTRL();
$ctrl_pes = new PessoaCTRL(); ///trazendo a cidade


$enderecoUser = $ctrl->ConsultarEnderecoPessoa();
$pessoa = $ctrl->retornarPessoa();

if (isset($_POST['btnSalvar'])) {

    $vo = new DoadorVO();
    $vo->setNomeObjeto($_POST['queroDoar']);
    $vo->setEstadoObjeto($_POST['estadoObj']);
    $vo->setDescricao($_POST['descricao']);
    $foto = $_FILES['imagem'];

    if ($foto['type'] != 'image/jpeg') {
        $ret = 5;
    } else {
        $nome_foto = md5(microtime()) . '.jpg';

        move_uploaded_file($foto['tmp_name'], 'assets/img/foto_doacao/' . $nome_foto);

        $vo->setImgObjeto($nome_foto);

        $endereco = $_POST['endereco'];
        if ($endereco == 1) {
            $vo->setIdPessoa($pessoa[0]['id_pessoa']);
            $vo->setCep($enderecoUser[0]['cep']);
            $vo->setRua($enderecoUser[0]['rua']);
            $vo->setNumero($enderecoUser[0]['numero']);
            $vo->setBairro($enderecoUser[0]['bairro']);
            $vo->setId_cidade($enderecoUser[0]['id_cidade']);
        } else {
            $vo->setIdPessoa($pessoa[0]['id_pessoa']);
            $vo->setCep($_POST['cep']);
            $vo->setRua($_POST['rua']);
            $vo->setNumero($_POST['numero']);
            $vo->setBairro($_POST['bairro']);
            $vo->setId_cidade($_POST['cidade']);
        }

        $ret = $ctrl->InserirDoacao($vo);
    }
}
$lista_cidade = $ctrl_pes->CidadePessoa();
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
                            <h2>Quero Doar</h2>   
                            <h5>Realize a sua doação aqui e acompanhe o status em <a href="consultar_doacoes.php">consultar doações.</a></h5>
                        </div>
                    </div>
                    <!-- /. ROW  -->
                    <hr />
                    <form method="post" action="quero_doar.php" enctype="multipart/form-data">
                        <div class="col-md-6">
                            <h4 style="color: red">Informações da doação:</h4>
                            <br>
                                <div class="form-group" id="divQueroDoar">
                                    <label>O que quero doar ?</label>
                                    <input class="form-control" placeholder="Digite aqui..." name="queroDoar" id="queroDoar" />
                                    <label id="val_queroDoar" class="Validar"></label>
                                </div>
                                <div class="form-group" id="divEstadoObj">
                                    <label>Conservação</label>
                                    <select class="form-control" name="estadoObj" id="estadoObj">
                                        <option value="">Selecione</option>
                                        <option value="1">Ótimo</option>
                                        <option value="2">Bom</option>
                                        <option value="3">Ruim</option>
                                    </select>
                                    <label id="val_estadoObj" class="Validar"></label>
                                </div>
                                <div class="form-group" id="divDescricao">
                                    <label>Descrição da doação</label>
                                    <textarea class="form-control" rows="3" name="descricao" id="descricao" placeholder="Descreva com detalhes o objeto que está sendo doado"></textarea>
                                    <label id="val_descricao" class="Validar"></label>
                                </div>
                                <div class="form-group" id="divImagem">
                                    <label>Anexar uma foto da doação (.JPEG)</label>
                                    <input type="file"  name="imagem" id="imagem"/>
                                    <label id="val_imagem" class="Validar"></label>
                                </div>
                        </div>
                        <div class="col-md-6">
                            <h4 style="color: red">Informações para buscarmos a doação:</h4>
                            <br>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group" id="divTipo">
                                <label>Endereço</label>
                                <select class="form-control" name="endereco" id="tipo" onchange="ExibirEndereco(this.value)">    
                                    <option value="1">Rua: <?= $enderecoUser[0]['rua'] ?> , <?= $enderecoUser[0]['numero'] ?> - <?= $enderecoUser[0]['bairro'] ?>, <?= $enderecoUser[0]['nome_cidade'] ?></option>
                                    <option value="2">Cadastrar outro endereço de entrega</option>
                                </select>
                                <label id="val_tipo" class="Validar"></label>
                            </div>
                        </div>
                        <div id="divGeral">  
                            <div class="col-md-6">
                                <div class="form-group" id="divCep">
                                    <label>CEP</label><label style="color: white;">__</label><a type="submit" href="http://www.buscacep.correios.com.br/sistemas/buscacep/"><i class="fa fa-search" aria-hidden="true"></i></a>
                                    <input class="form-control" placeholder="Digite aqui..." name="cep" id="cep" />
                                    <label id="val_cep" class="Validar"></label>
                                </div>
                            </div>
                            <div class="col-md-4">        
                                <div class="form-group" id="divRua">
                                    <label>Rua</label>
                                    <input class="form-control" placeholder="Digite aqui..." name="rua" id="rua" />
                                    <label id="val_rua" class="Validar"></label>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group" id="divNumero">
                                    <label>Número</label>
                                    <input class="form-control" placeholder="Digite aqui..." name="numero" id="numero" />
                                    <label id="val_numero" class="Validar"></label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group" id="divBairro">
                                    <label>Bairro</label>
                                    <input class="form-control" placeholder="Digite aqui..." name="bairro" id="bairro" />
                                    <label id="val_bairro" class="Validar"></label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group" id="divCidade">
                                    <label>Cidade</label>
                                    <select class="form-control" name="cidade" id="cidade">    
                                        <option value="">Selecione</option>
<?php
for ($i = 0; $i < count($lista_cidade); $i++) {
    ?>
                                            <option value="<?= $lista_cidade[$i]['id_cidade'] ?>">
                                            <?= $lista_cidade[$i]['nome_cidade'] ?>
                                            </option>
                                            <?php } ?>
                                    </select>
                                    <label id="val_cidade" class="Validar"></label>
                                </div>
                            </div>
                        </div>
                        <div id="dadosEndereco">
                        </div>
                        <div class="col-md-12">
                            <br>
                                <button type="submit" name="btnSalvar" class="btn btn-success" onclick="return Validar(1)">Salvar</button>
                        </div>
                    </form>  
                </div>
            </div>
        </div>
    </body>
</html>