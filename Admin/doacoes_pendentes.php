<?php
require_once '../Controller/DoadorCTRL.php';
require_once '../Controller/UtilCTRL.php';

$tipo = '';

if (UtilCTRL::RetornarTipoLogado() == 1) {
    $tipo = 1;
} elseif (UtilCTRL::RetornarTipoLogado() == 2) {
    $tipo = 2;
}

UtilCtrl::VerTipoPermissao($tipo);

if (isset($_POST['pesquisar'])) {
    $ctrl_doa = new DoadorCTRL();

    $tipo_doador = $_POST['tipo_doador'];
    $dt_inicial = $_POST['data_inicial'];
    $dt_final = $_POST['data_final'];

    $doacao = $ctrl_doa->ConsultarDoacao($tipo_doador, $dt_inicial, $dt_final);
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
            include_once '_imagem.php';
            include_once '_menu.php';
            ?>
            <div id="page-wrapper" >
                <div id="page-inner">
                    <div class="row">
                        <div class="col-md-12">
                            <h2>Doações</h2>   
                            <?php
                            if (isset($ret)) {
                                ExibirMsg($ret);
                            }
                            ?>
                            <h5>Consulte abaixo as doações.</h5>
                        </div>
                    </div>
                    <hr />
                    <form method="post" action="doacoes_pendentes.php">

                        <div class="col-md-12">
                            <div class="form-group" id="divTipo">
                                <label>Situação</label>
                                <select class="form-control" name="tipo_doador" id="tipo_doador" >
                                    <option value="">Selecione</option>
                                    <option value="2">Todos</option>
                                    <option value="0">Pendentes</option>
                                    <option value="1">Aprovados</option>
                                </select>
                                <label id="val_tipo" class="Validar"></label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group" id="divDinicial">
                                <label>Data Inicial</label>
                                <input type="date" class="form-control" placeholder="Digite aqui..." name="data_inicial"  value="<?= $dt_inicial ?>"/>
                                <label id="val_dinicial" class="Validar"></label>
                            </div>
                        </div>
                        <div class="col-md-6" id="divDfinal">
                            <div class="form-group">
                                <label>Data Final</label>
                                <input type="date" class="form-control" placeholder="Digite aqui..." name="data_final" value="<?= $dt_final ?>" />
                                <label id="val_dfinal" class="Validar"></label>
                            </div>
                        </div>

                        <center>
                            <button type="submit" class="btn btn-info" name="pesquisar">Pesquisar</button>
                        </center>
                    </form>
                    <hr>
                        <?php
                        if (isset($doacao)) {

                            if (count($doacao) > 0) {
                                ?>

                                <div class="col-md-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <b>Doações</b>
                                        </div>
                                        <div class="panel-body">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                                    <thead>
                                                        <tr>
                                                            <th>Situação</th>
                                                            <th>Doador</th>
                                                            <th>Objeto</th>
                                                            <th>Estado</th>
                                                            <th>Descrição</th>
                                                            <th>Foto</th> 
                                                        </tr>
                                                    </thead>
                                                    <tbody>                                        
                                                        <?php for ($i = 0; $i < count($doacao); $i++) { ?>
                                                            <tr class="odd gradeX">
                                                                <td><i><?= $doacao[$i]['situacao_status'] == 0 ? 'Pendente' : 'Aprovado' ?><i></td>
                                                                            <td><?= $doacao[$i]['nome_pessoa'] ?></td>
                                                                            <td><?= $doacao[$i]['nome_objeto'] ?></td>
                                                                            <td><?= ($doacao[$i]['estado_objeto'] == 1) ? "Ótimo" : (($doacao[$i]['estado_objeto'] == 2) ? "Bom" : "Ruim") ?></td>
                                                                            <td><?= $doacao[$i]['descricao_objeto'] ?></td>
                                                                            <td><img src="assets/img/foto_doacao/<?= $doacao[$i]['imagem_objeto'] ?>" class="user-image img-responsive"/></td>
                                                                            </tr>   
                                                                        <?php } ?>
                                                                        </tbody>
                                                                        </table>
                                                                        </div>
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

