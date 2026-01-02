<?php

require_once '../Controller/DoadorCTRL.php';

require_once '../Controller/UtilCTRL.php';

require_once '../Controller/UsuarioCTRL.php';



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

                            <h5>Realize o gerenciamento das doações.</h5>

                        </div>

                    </div>

                    <hr />

                    <form method="post" action="gerenciar_doacoes.php">



                        <div class="col-md-12">

                            <div class="form-group" id="divSituacao">

                                <label>Situação</label>

                                <select class="form-control" name="tipo_doador" id="tipo_doador" >

                                    <option value="">Selecione</option>

                                    <option value="3"<?= $tipo_doador == 3 ? 'selected' : '' ?>>Todos</option>

                                    <option value="0"<?= $tipo_doador == 0 ? 'selected' : '' ?>>Pendentes</option>

                                    <option value="1"<?=  $tipo_doador == 1 ? 'selected' : '' ?>>Aprovados</option>

                                    <option value="2"<?= $tipo_doador == 2 ? 'selected' : '' ?>>Rejeitados</option>

                                </select>

                                <label id="val_situacao" class="Validar"></label>

                            </div>

                        </div>



                        <div class="col-md-6">

                            <div class="form-group" id="divDataInicial">

                                <label>Data Inicial</label>

                                <input type="date" class="form-control" placeholder="Digite aqui..." name="data_inicial" id="data_inicial" value="<?= $dt_inicial ?>"/>

                                <label id="val_data_inicial" class="Validar"></label>

                            </div>

                        </div>

                        <div class="col-md-6" id="divDataFinal">

                            <div class="form-group">

                                <label>Data Final</label>

                                <input type="date" class="form-control" placeholder="Digite aqui..." name="data_final" id="data_final" value="<?= $dt_final ?>" />

                                <label id="val_data_final" class="Validar"></label>

                            </div>

                        </div>



                        <center>

                            <button type="submit" class="btn btn-info" onclick="return Validar(8)" name="pesquisar">Pesquisar</button>

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

                                                            <th>Doador</th>

                                                            <th>Objeto</th>

                                                            <th>Estado</th>

                                                            <th>Descrição</th>

                                                            <th>Foto</th> 

                                                            <th>Situação</th>

                                                            <th>Ação</th> 

                                                        </tr>

                                                    </thead>

                                                    <tbody>                                        

                                                        <?php for ($i = 0; $i < count($doacao); $i++) { ?>

                                                            <tr class="odd gradeX">

                                                                <td><?= $doacao[$i]['nome_parceiro']?:$doacao[$i]['nome_pessoa'] ?></td>

                                                                <td><?= $doacao[$i]['nome_objeto'] ?></td>

                                                                <td><?= ($doacao[$i]['estado_objeto'] == 1) ? "Ótimo" : (($doacao[$i]['estado_objeto'] == 2) ? "Bom" : "Ruim") ?></td>

                                                                <td><?= $doacao[$i]['descricao_objeto'] ?></td>

                                                                <td><a href="#<?= substr($doacao[$i]['imagem_objeto'], 0, -4); ?>" data-toggle="modal"><img src="assets/img/foto_doacao/<?= $doacao[$i]['imagem_objeto'] ?>" class="user-image img-responsive"/></a>                                         <!-- Button trigger modal -->
                                                                    <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#<?= substr($doacao[$i]['imagem_objeto'], 0, -4); ?>">
                                                                    <i class="fa fa-search-plus" aria-hidden="true"></i> Ampliar
                                                                    </button>
                                                                <!-- Modal -->
                                                                <div class="modal fade" id="<?= substr($doacao[$i]['imagem_objeto'], 0, -4); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                    <div class="modal-body">
                                                                    <img src="assets/img/foto_doacao/<?= $doacao[$i]['imagem_objeto'] ?>" class="img-responsive" style="margin: 0 auto;"/>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                                                                    </div>
                                                                    </div>
                                                                </div>
                                                                </div></td>
                                                                <td><i><?= ($doacao[$i]['situacao_status'] == 1) ? "Aprovado" : (($doacao[$i]['situacao_status'] == 2) ? "Rejeitado" : "Pendente") ?></i></td>                                                       

                                                                <?php if ($doacao[$i]['situacao_status'] == 0) { ?>



                                                                    <td><a href="#" class="btn btn-warning btn-sm" data-toggle="modal"  data-target="#<?= 'modalAlterar' ?>"

                                                                           onclick="return CarregarModal('<?= $doacao[$i]['situacao_status'] ?>', '<?= $doacao[$i]['id_status'] ?>')">Alterar Status</a></td>

                                                                    <?php } else if($doacao[$i]['situacao_status'] == 1) { ?>

                                                                    <td><i style=color:green class="fa fa-check fa-3x"></i></td>

                                                                    <?php } else { ?>

                                                                    <td><i style=color:red class="fa fa-close fa-3x"></i></td>

                                                                <?php } ?>

                                                            </tr>   

                                                        <?php } ?> 

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

                                                        <form method="post" action="gerenciar_doacoes.php">



                                                            <div class="modal-body">

                                                                <input type="hidden" name="cod" id="id_status" />



                                                                <div class="form-group" id="divSetor">

                                                                    <label>Escolha a situação</label>

                                                                    <select class="form-control" name="situacao" id="situacao">



                                                                        <option value="1" selected >Aprovado</option>

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



        <script>

            function CarregarModal(situacao, id) {

                $("#situacao").val(situacao);

                $("#id_status").val(id);

            }

        </script>

    </body>

</html>



