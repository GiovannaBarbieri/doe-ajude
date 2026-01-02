<?php
require_once '../Controller/UsuarioCTRL.php';
require_once '../Controller/UtilCTRL.php';

$tipo = '';
$tipo_doador = '';
if (UtilCTRL::RetornarTipoLogado() == 1) {
    $tipo = 1;
} elseif (UtilCTRL::RetornarTipoLogado() == 2) {
    $tipo = 2;
}
UtilCtrl::VerTipoPermissao($tipo);
$tipo_doador = '';

if (isset($_POST['pesquisar'])) {

    $tipo_doador = $_POST['tipo_doador'];
    $dt_inicial = $_POST['data_inicial'];
    $dt_final = $_POST['data_final'];

    $ctrl_doa = new UsuarioCTRL();

    $doacao = $ctrl_doa->RelatoriosDoacoes($tipo_doador, $dt_inicial, $dt_final);
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
                            <h2>Relatórios</h2>   
                            <h5>Faça as consultas a baixo.</h5>
                        </div>
                    </div>
                    <hr />
                    <form method="post" action="relatorios.php">

                        <div class="col-md-12">
                            <div class="form-group" id="divTipo">
                                <label>Situação</label>
                                <select class="form-control" name="tipo_doador" id="tipo_doador" >
                                    <option value="1" <?= $tipo_doador == 1 ? 'selected' : '' ?>>Doador - PF</option>
                                    <option value="2" <?= $tipo_doador == 2 ? 'selected' : '' ?>>Doador - PJ</option>
                                    <option value="3" <?= $tipo_doador == 3 ? 'selected' : '' ?>>Voluntário</option>
                                    <option value="4" <?= $tipo_doador == 4 ? 'selected' : '' ?>>Todos</option>
                                </select>
                                <label id="val_tipo" class="Validar"></label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group" id="divDinicial">
                                <label>Data Inicial</label>
                                <input type="date" class="form-control" placeholder="Digite aqui..." name="data_inicial" id="data_inicial" value="<?= $dt_inicial ?>"/>
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
                            <button type="submit" class="btn btn-info" name="pesquisar" onclick="return Validar(10)">Pesquisar</button>
                        </center>
                    </form>
                    <hr />
                    <?php
                    if (isset($doacao)) {

                        if (count($doacao) > 0) {
                            ?>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Relatório gerado
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>Tipo</th>
                                                    <th>Nome</th>
                                                    <th>Data</th>
                                                    <th>Situação</th>
                                                </tr>
                                            </thead>
                                            <tbody>  
                                                <?php for ($i = 0; $i < count($doacao); $i++) { ?>
                                                    <tr class="odd gradeX">
                                                        <td><?= $doacao[$i]['tipo_pessoa'] ?></td>
                                                        <td><?= $doacao[$i]['nome'] ?></td>
                                                        <td><?= UtilCtrl::MostrarData($doacao[$i]['data_status']) ?></td>
                                                        <td><i><?= ($doacao[$i]['situacao_status'] == 1 ? "Aprovado" : ($doacao[$i]['situacao_status'] == 2 ? "Rejeitado" : "Pendente")) ?></i></td>                                                       
                                                    </tr>                                        
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                        <center>
                                            <a target="_blank" href="imprimir_relatorio.php?tipo_doador=<?= $tipo_doador ?>&data_inicial=<?= $dt_inicial ?>&data_final=<?= $dt_final ?>" class="btn btn-warning">Imprimir</a>
                                        </center>
                                    </div>
                                </div>
                            </div>
                            <?php
                        } else {
                            ExibirMsg(3);
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>

