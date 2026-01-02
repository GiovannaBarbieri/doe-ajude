<?php
require_once '../Controller/VoluntarioCTRL.php';
require_once '../VO/VoluntarioVO.php';
require_once '../Controller/UtilCTRL.php';

UtilCtrl::VerTipoPermissao(3);

$ctrl = new VoluntarioCTRL();

if (isset($_POST['btnSalvar'])) {

    $voVol = new VoluntarioVO();

    $pessoa = $ctrl->retornarPessoa();

    $voVol->setDisponibilidade($_POST['disponibilidade']);
    $voVol->setSetorVoluntario($_POST['setor']);
    $voVol->setSobreVoluntario($_POST['sobre']);
    $voVol->setIdPessoa($pessoa[0]['id_pessoa']);

    $ret = $ctrl->CadastrarVoluntario($voVol);
}
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
                            <?php
                            if (isset($ret)) {
                                ExibirMsg($ret);
                            }
                            ?>
                            <h2>Trabalho Voluntário</h2>   
                            <h5>Para ser vonluntário, preencha os campos abaixo.</h5>
                        </div>
                    </div>
                    <hr/>
                    <form method="post" action="trabalho_voluntario.php">
                        <div class="col-md-12">
                            <div class="form-group" id="divDisp">
                                <label>Disponibilidade</label>
                                <select class="form-control" name="disponibilidade" id="disp">
                                    <option value="">Selecione</option>
                                    <option value="1">Manhã</option>
                                    <option value="2">Tarde</option>
                                    <option value="3">Noite</option>
                                </select>
                                <label id="val_disp" class="Validar"></label>
                            </div>
                            <div class="form-group" id="divSetor">
                                <label>Setor</label><label style="color:white;">_</label><a data-toggle="modal" data-target="#mdlInformacao1"><i class="fa fa-question-circle estilo_question"></i></a>
                                <select class="form-control" id="setor" name="setor">
                                    <option value="">Selecione</option>
                                    <option value="1">Educação</option>
                                    <option value="2">Abrigo</option>
                                    <option value="3">Equipe de Apoio</option>   
                                </select>
                                <label id="val_setor" class="Validar"></label>
                                <div class="modal fade" id="mdlInformacao1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <center><h4 class="modal-title" id="myModalLabel"><b>Informação</b></h4></center>
                                            </div>
                                            <div class="modal-body">
                                                <p>Nossa instituição se divide em 3 setores.<br />
                                                    Caso não se encaixe em nenhum setor, preencha o próximo campo e digite que função gostaria
                                                    de exercer.
                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" id="divSobre">
                                <label>Sobre você</label>
                                <textarea class="form-control" rows="3" name="sobre" id="sobre" placeholder="Descreva mais sobre você e suas habilidades"></textarea>
                                <label id="val_sobre" class="Validar">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button class="btn btn-success" name="btnSalvar" onclick="return Validar(2)">Salvar</button>
                        </div>
                    </form>                        
                </div>
            </div>
        </div>
    </body>
</html>