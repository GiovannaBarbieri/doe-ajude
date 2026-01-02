<?php
require_once '../Controller/VoluntarioCTRL.php';
require_once '../Controller/UtilCTRL.php';
require_once '../Controller/UsuarioCTRL.php';

$tipo = '';
$tipo_voluntario = '';
if (UtilCTRL::RetornarTipoLogado() == 1) {
    $tipo = 1;
} elseif (UtilCTRL::RetornarTipoLogado() == 2) {
    $tipo = 2;
}
UtilCtrl::VerTipoPermissao($tipo);

if (isset($_POST['pesquisar'])) {
    $ctrl_vol = new VoluntarioCTRL();

    $tipo_voluntario = $_POST['tipo_voluntario'];
    $dt_inicial = $_POST['data_inicial'];
    $dt_final = $_POST['data_final'];

    $voluntarios = $ctrl_vol->ConsultarVoluntario($tipo_voluntario, $dt_inicial, $dt_final);
} else if (isset($_POST['btnAlterar'])) {
    $ctrl = new UsuarioCTRL();
    $vo = new StatusVO();

    $vo->setIdStatus($_POST['cod']);
    $vo->setSituacao($_POST['situacao']);

    $ret = $ctrl->AlterarStatus($vo);
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
                            <h2>Trabalhos Voluntários</h2>   
                            <h5>Consultar abaixo as pessoas que são voluntárias.</h5>
                        </div>
                    </div>
                    <hr>
                        <form method="post" action="consultar_trabalho_voluntario.php">

                            <div class="col-md-12">
                                <div class="form-group" id="divTipo">
                                    <label>Situação</label>
                                    <select class="form-control" name="tipo_voluntario" id="tipo_voluntario" >
                                        <option value="">Selecione</option>
                                        <option value="3"<?= $tipo_doador == 3 ? 'selected' : '' ?>>Todos</option>
                                        <option value="1"<?= $tipo_doador == 1 ? 'selected' : '' ?>>Aprovados</option>
                                        <option value="0"<?= $tipo_doador == 0 ? 'selected' : '' ?>>Pendentes</option>
                                        <option value="2"<?= $tipo_doador == 2 ? 'selected' : '' ?>>Rejeitados</option>
                                    </select>
                                    <label id="val_situacao" class="Validar"></label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group" id="divDinicial">
                                    <label>Data Inicial</label>
                                    <input type="date" class="form-control" placeholder="Digite aqui..." name="data_inicial"  id="data_inicial" value="<?= $dt_inicial ?>"/>
                                    <label id="val_dinicial" class="Validar"></label>
                                </div>
                            </div>
                            <div class="col-md-6" id="divDfinal">
                                <div class="form-group">
                                    <label>Data Final</label>
                                    <input type="date" class="form-control" placeholder="Digite aqui..." name="data_final" id="data_final" value="<?= $dt_final ?>" />
                                    <label id="val_dfinal" class="Validar"></label>
                                </div>
                            </div>

                            <center>
                                <button type="submit" class="btn btn-info" name="pesquisar" onclick="return Validar(9)">Pesquisar</button>
                            </center>
                        </form>
                        <hr />
                        <?php
                        if (isset($voluntarios)) {

                            if (count($voluntarios) > 0) {
                                ?>
                                <div class="col-md-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            Voluntários ativos no momento
                                        </div>
                                        <div class="panel-body">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                                    <thead>
                                                        <tr>
                                                            <th>Nome</th>
                                                            <th>Telefone</th>
                                                            <th>Data</th>
                                                            <th>Disponibilidade</th>
                                                            <th>Setor</th>
                                                            <th>Sobre o Voluntário</th>
                                                            <th>Situação</th>
                                                            <th>Ação</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>                                        
                                                        <tr class="odd gradeX">
                                                            <?php for ($i = 0; $i < count($voluntarios); $i++) { ?>
                                                                <tr class="odd gradeX">
                                                                    <td><?= $voluntarios[$i]['nome_pessoa'] ?></td>
                                                                    <td><?= $voluntarios[$i]['telefone_pessoa'] ?></td>
                                                                    <td><?= UtilCtrl::MostrarData($voluntarios[$i]['data_status']) ?></td>
                                                                    <td><?= UtilCTRL::RetornaDisponibilidade($voluntarios[$i]['disponibilidade_voluntario']) ?></td>
                                                                    <td><?= UtilCTRL::RetornaSetorVoluntario($voluntarios[$i]['setor_voluntario']) ?></td>
                                                                    <td><?= $voluntarios[$i]['sobre_voluntario'] ?></td>
                                                                    <td><i><?= ($voluntarios[$i]['situacao_status'] == 1) ? "Aprovado" : (($voluntarios[$i]['situacao_status'] == 2) ? "Rejeitado" : "Pendente") ?></i></td>                                                       
                                                                    <?php if ($voluntarios[$i]['situacao_status'] == 0) { ?>

                                                                        <td><a href="#" class="btn btn-warning btn-sm" data-toggle="modal"  data-target="#<?= 'modalAlterar' ?>"
                                                                               onclick="return CarregarModal('<?= $voluntarios[$i]['situacao_status'] ?>', '<?= $voluntarios[$i]['id_status'] ?>')">Alterar Status</a></td>
                                                                        <?php } else if ($voluntarios[$i]['situacao_status'] == 1) { ?>
                                                                        <td><i style=color:green class="fa fa-check fa-3x"></i></td>
                                                                    <?php } else { ?>
                                                                        <td><i style=color:red class="fa fa-close fa-3x"></i></td>
                                                                    <?php } ?>

                                                                </tr>   
                                                            <?php } ?>
                                                        </tr>   
                                                    </tbody>
                                                </table>
                                            </div>


                                            <div class="modal fade" id="modalAlterar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                            <h4 class="modal-title" id="myModalLabel">Alterar Situação</h4>
                                                        </div>
                                                        <form method="post" action="consultar_trabalho_voluntario.php">

                                                            <div class="modal-body">
                                                                <input type="hidden" name="cod" id="id_status" />

                                                                <div class="form-group" id="divSetor">
                                                                    <label>Escolha a situação</label>
                                                                    <select class="form-control" name="situacao" id="situacao">
                                                                        <option value="0">Pendente</option>
                                                                        <option value="1">Aprovado</option>
                                                                        <option value="2">Rejeitados</option>
                                                                    </select>
                                                                    <label id="val_setor" class="Validar"></label>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                                                                <button class="btn btn-primary" name="btnAlterar">Salvar</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <hr>

                                </div>
                                <div class="modal fade" id="modAlterarVolun" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <?php
                                    } else {
                                        ExibirMsg(3);
                                    }
                                }
                                ?>
                            </div>
                        </div>
                </div>

                <script>
                    function CarregarModal(situacao, id) {
                        $("#situacao").val(situacao);
                        $("#id_status").val(id);
                    }
                </script>

                </body>
                </html>

