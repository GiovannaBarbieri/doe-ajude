
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
                            <h2>Verificar Doação</h2>   
                            <h5>Verifique ou Altere os status das doações.</h5>
                        </div>
                    </div>
                    <hr />
                    <form method="post" action="verificar_doacoes.php">

                        <div class="col-md-12">
                            <div class="form-group" id="divTipo">
                                <label>Doações</label>
                                <select class="form-control" name="tipo_doador" id="tipo_doador" >
                                    <option value="">Selecione</option>
                                    <option value="1">Doação</option>
                                    <option value="2">Voluntário</option>
                                </select>
                                <label id="val_tipo" class="Validar"></label>
                            </div>
                        </div>

                        <center>
                            <button type="submit" class="btn btn-info" name="pesquisar">Pesquisar</button>
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
                                                    <th>Situação</th>
                                                    <th>Data</th>
                                                    <th>Nome</th>
                                                    <th>Ação<th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>  
                                                                <?php for ($i = 0; $i < count($doacao); $i++) { ?>
                                                                    <tr class="odd gradeX">
                                                                        <td><?= UtilCtrl::TipoDoador($doacao[$i]['tipo']) ?></td>
                                                                        <td><?= UtilCtrl::RetornarStatus($doacao[$i]['situacao_status']) ?></td>
                                                                        <td><?= UtilCtrl::MostrarData($doacao[$i]['data_status']) ?></td>
                                                                        <td><?= $doacao[$i]['nome_pessoa'] ?: 'nome_voluntario' ?></td> 
                                                                        <td><a href="#" class="btn btn-warning btn-xs" data-toggle="modal"  data-target="#<?= 'modalAlterar' ?>"
                                                                               onclick="return CarregarModal('<?= $doacao[$i]['situacao_status'] ?>','<?= $doacao[$i]['id_status'] ?>')">Alterar</a></td>
                                                                    </tr>                                        
                                                                <?php } ?>
                                                            </tbody>
                                                            </table>
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
                                                    <div class="modal fade" id="modalAlterar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                    <h4 class="modal-title" id="myModalLabel">Alterar Situação</h4>
                                                                </div>
                                                                <form method="post" action="verificar_doacoes.php">

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
                                                    <script>

                                                        function CarregarModal(situacao,id) {

                                                            $("#situacao").val(situacao);
                                                            $("#id_status").val(id);
                                                        }

                                                    </script>  
                                                    </body>
                                                    </html>

