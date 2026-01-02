<?php
require_once '../Controller/DoadorCTRL.php';
require_once '../Controller/UtilCTRL.php';

UtilCtrl::VerTipoPermissao(4);

$ctrl = new DoadorCTRL();

$doador = $ctrl->ConsultarDoacaoParceiro();
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
                            <h2>Consultar Doações</h2>   
                            <h5>Acompanhe o status da sua doação aqui.</h5>
                        </div>
                    </div>
                    <hr />
                    <?php
                    if (isset($doador)) {
                        if (count($doador) > 0) {
                            ?>          
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Doações pendentes
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>Nome</th>
                                                <th>Conservação</th>
                                                <th>Data</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                       <tbody>
                                            <?php for ($i = 0; $i < count($doador); $i++) { ?>
                                                <tr class="odd gradeX">
                                                    <td><?= $doador == $doador[$i]['nome_objeto'] ? '---' : $doador[$i]['nome_objeto'] ?></td>
                                                    <?php if ($doador[$i]['estado_objeto'] == 1) { ?>
                                                        <td>Ótimo</td>
                                                    <?php } else if ($doador[$i]['estado_objeto'] == 2) { ?>   
                                                        <td>Bom</td>
                                                        <?php } else if ($doador[$i]['estado_objeto'] == 3) { ?>
                                                        <td>Ruim</td>
                                                    <?php } else { ?>
                                                        <td>---</td>
                                                    <?php } ?>
                                                    <td><?= $doador == $doador[$i]['data_status'] ? '---' : UtilCTRL::MostrarData($doador[$i]['data_status']) ?></td>
                                                    <td>                                                
                                                        <div class="progress progress-striped active">
                                                            <?php if ($doador[$i]['situacao_status'] == 0) { ?>
                                                                <div class="progress-bar progress-bar-warning" style="width: 40%">
                                                                    <b><i>Pendente</i></b>
                                                                </div>      
                                                            <?php } else if ($doador[$i]['situacao_status'] == 1) { ?>
                                                                <div class="progress-bar progress-bar-success" style="width: 100%">
                                                                    <b><i>Aprovado</i></b>
                                                                </div>       
                                                            <?php } else if ($doador[$i]['situacao_status'] == 2) { ?>
                                                                <div class="progress-bar progress-bar-danger" style="width: 100%">
                                                                    <b><i>Rejeitado</i></b>
                                                                </div>        
                                                            <?php } else { ?>    
                                                                    ---
                                                            <?php } ?>
                                                        </div>
                                                    </td>
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
                        ?>
                    <?php } ?>
                </div>
            </div>
        </div>
    </body>
</html>