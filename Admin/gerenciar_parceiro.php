<?php
require_once '../VO/ParceiroVO.php';
require_once '../Controller/ParceiroCTRL.php';
require_once '../Controller/UsuarioCTRL.php';

$parceiro = '';
$tipo = '';
if (UtilCTRL::RetornarTipoLogado() == 1) {
    $tipo = 1;
} elseif (UtilCTRL::RetornarTipoLogado() == 2) {
    $tipo = 2;
}
UtilCtrl::VerTipoPermissao($tipo);

$ctrl2 = new UsuarioCTRL();

$ctrl = new ParceiroCTRL();


if (isset($_POST['btnSalvar'])) {

    $vo = new ParceiroVO();

    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $documento = $_POST['documento'];
    $responsavel = $_POST['responsavel'];

    $rua = $_POST['rua'];
    $bairro = $_POST['bairro'];
    $numero = $_POST['numero'];
    $cep = $_POST['cep'];
    $cidade = $_POST['cidade'];

    $vo->setNomeParceiro($nome);
    $vo->setTelefoneParceiro($telefone);
    $vo->setEmailUsuario($email);
    $vo->setDocumentoParceiro($documento);
    $vo->setResponsavelNota($responsavel);

    $vo->setRua($rua);
    $vo->setBairro($bairro);
    $vo->setNumero($numero);
    $vo->setCep($cep);
    $vo->setId_cidade($cidade);
    $ret = $ctrl->InserirParceiro($vo);
}

$parceiro = $ctrl->CarregarParceiro();
$cidades = $ctrl2->ConsultarCidade();
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
                            <h2>Gerenciar Parceiro</h2>   
                            <h5>Cadastre e consulte seus parceiros.</h5>
                        </div>
                    </div>
                    <hr />
                    <div class="panel-body">
                        <form action="gerenciar_parceiro.php" method="post">
                            <div class="form-group" id="divNome">
                                <label>Nome da Empresa</label>
                                <input class="form-control" placeholder="Digite aqui..." id="nome" name="nome"/>
                                <label id="val_nome" class="Validar"></label>
                            </div>
                            <div class="form-group" id="divTelefone">
                                <label>Telefone</label>
                                <input class="form-control tel" maxlength="11" placeholder="Digite aqui..." id="telefone" name="telefone"/>
                                <label id="val_telefone" class="Validar"></label>
                            </div>                    
                            <div class="form-group" id="divEmail">
                                <label>Email</label>
                                <input class="form-control" placeholder="Digite aqui..." id="email" name="email" onchange="ValidarEmail(1)"/>
                                <label id="val_email" class="Validar"></label>
                            <label id="val_email" class="Validar" onchange="ValidarEmail(1)"></label>
                            </div>
                            <div class="form-group" id="divDoc">
                                <label>CNPJ</label>
                                <input class="form-control cnpj" placeholder="Digite aqui..." id="documento" name="documento"/>
                                <label id="val_doc" class="Validar"></label>
                            </div>
                            <div class="form-group" id="divCep">
                                <label>CEP</label>
                                <input class="form-control cep" maxlength="8" placeholder="Digite aqui..." name="cep" id="cep"/>
                                <label id="val_cep" class="Validar"></label>
                            </div>
                            <div class="form-group" id="divEnd">
                                <label>Cidade</label>
                                <select class="form-control" id="cidade" name="cidade">
                                    <option value="">Selecione</option>
                                    <?php
                                    for ($i = 0; $i < count($cidades); $i++) {
                                        ?>
                                        <option value="<?= $cidades[$i]['id_cidade'] ?>">

                                            <?= $cidades[$i]['nome_cidade'] ?>

                                        </option>

                                    <?php } ?>
                                </select>
                                <label id="val_end" class="Validar"></label>
                            </div> 
                            <div class="form-group" id="divRua">
                                <label>Rua</label>
                                <input class="form-control" placeholder="Digite aqui..." name="rua" id="rua"/>
                                <label id="val_rua" class="Validar"></label>
                            </div>
                            <div class="form-group" id="divBairro">
                                <label>Bairro</label>
                                <input class="form-control" placeholder="Digite aqui..." name="bairro" id="bairro"/>
                                <label id="val_bairro" class="Validar"></label>
                            </div>
                            <div class="form-group" id="divNumero">
                                <label>Número</label>
                                <input class="form-control" placeholder="Digite aqui..." name="numero" id="numero"/>
                                <label id="val_numero" class="Validar"></label>
                            </div>

                            <div class="form-group" id="divResp">
                                <label>Responsável pela nota :</label>
                                <input type="text" class="form-control" placeholder="Digite o responsável pela nota" id="responsavel" name="responsavel"/>
                                <label id="val_resp" class="Validar"></label>
                            </div>
                            <button class="btn btn-success" name="btnSalvar" onclick="return Validar(4)">Salvar</button>
                        </form>  
                    </div>


                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Parceiros
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Nome</th>
                                            <th>Telefone</th>
                                            <th>E-mail</th>
                                            <th>Documento Parceiro</th>
                                            <th>Responsável</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php for ($i = 0; $i < count($parceiro); $i++) { ?>
                                            <tr class="odd gradeX">
                                                <td><?= $parceiro[$i]['nome_parceiro'] ?></td>
                                                <td><?= $parceiro[$i]['telefone_parceiro'] ?></td>
                                                <td><?= $parceiro[$i]['email_usuario'] ?></td>                                                
                                                <td><?= $parceiro[$i]['documento_parceiro'] ?></td>                                                
                                                <td><?= $parceiro[$i]['responsavel_parceiro'] ?></td>                                                
                                            </tr>
                                        <?php } ?>

                                    </tbody>
                                </table>
                            </div>

                        </div
                        <scri <script src="assets/js/jquery-1.10.2.js"></script>
                            <!-- BOOTSTRAP SCRIPTS -->
                            <script src="assets/js/bootstrap.min.js"></script>
                            <!-- METISMENU SCRIPTS -->
                            <script src="assets/js/jquery.metisMenu.js"></script>
                            <!-- DATA TABLE SCRIPTS -->
                            <script src="assets/js/dataTables/jquery.dataTables.js"></script>
                            <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
                            <script>
                                                    $(document).ready(function () {
                                                        $('#dataTables-example').dataTable();
                                                    });
                            </script>
                            <!-- CUSTOM SCRIPTS -->
                            <script src="assets/js/custom.js"></script>
                    </div>

                    </body>
                    </html>
