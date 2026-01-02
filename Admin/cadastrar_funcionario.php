<?php
require_once '../VO/FuncionarioVO.php';
require_once '../Controller/UsuarioCTRL.php';
require_once '../Controller/UtilCTRL.php';

UtilCtrl::VerTipoPermissao(1);

$ctrl = new UsuarioCTRL();
$tipo = '';
$cidades = '';

if (isset($_POST['btnSalvar'])) {

    $tipo = $_POST['tipo'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $cep = $_POST['cep'];
    $cidade = $_POST['cidade'];
    $rua = $_POST['rua'];
    $bairro = $_POST['bairro'];
    $numero = $_POST['numero'];

    $func = new FuncionarioVO();
    if ($tipo == 1) {

    $func->setEmailUsuario($email);
    $func->setTipoUsuario($tipo);
    $func->setNomeFunc($nome);
    $func->setTelFunc($telefone);
    $func->setNomeFunc($nome);
    $func->setTelFunc($telefone);
    $func->setCep($cep);
    $func->setId_cidade($cidade);
    $func->setRua($rua);
    $func->setBairro($bairro);
    $func->setNumero($numero);
   $ret = $ctrl->InserirAdministrador($func);
    
    }else if($tipo == 2) {
      $func->setEmailUsuario($email);
    $func->setTipoUsuario($tipo);
    $func->setNomeFunc($nome);
    $func->setTelFunc($telefone);
    $func->setNomeFunc($nome);
    $func->setTelFunc($telefone);
    $func->setCep($cep);
    $func->setId_cidade($cidade);
    $func->setRua($rua);
    $func->setBairro($bairro);
    $func->setNumero($numero);   
  $ret = $ctrl->InserirFuncionario($func);
     
    }
}
$cidades = $ctrl->ConsultarCidade();
?>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <?php include_once '_head.php';
        include_once '_cep.php';
        ?>
    </head>

    <body>

        <div id="wrapper">

            <?php include_once '_topo.php';
            include_once '_menu.php';
            ?>

            <div id="page-wrapper" >
                <div id="page-inner">
                    <div class="row">
                        <div class="col-md-12">
                            <?php
                            if (isset($ret)) {

                                Exibirmsg($ret);
                            }
                            ?>
                            <h2>Novo Usuário</h2>   
                            <h5>Cadastre um novo funcionario nesta página</h5>
                        </div>
                    </div>
                    <!-- /. ROW  -->
                    <hr/>
                    <form  method="post" action="cadastrar_funcionario.php">
                        <div class="form-group">
                            <label>Tipo</label>
                            <select class="form-control" name="tipo" id="tipo" onchange="ExibirTipo(this.value)">
                                <option value="" selected>Selecione</option>
                                <option value="1" >Administrador</option>
                                <option value="2" >Funcionário</option>
                            </select>
                            <label id="val_tipo" class="validar"></label>
                        </div>
                        <div id="divGeral"style="display: none">
                            <div class="form-group" id="divNome">
                                <label>Nome completo</label>
                                <input class="form-control" placeholder="Digite aqui..." name="nome" id="nome"/>
                                <label id="val_nome" class="Validar"></label>
                            </div> 
                            <div class="form-group" id="divEmail">
                                <label>E-mail</label>
                                <input class="form-control" placeholder="Digite aqui..." name="email" id="email" onchange="ValidarEmail(1)" />
                                <label id="val_email" class="Validar"></label>
                            </div>
                            <div class="form-group" id="divTelefone">
                                <label>Telefone</label>
                                <input class="form-control tel" maxlength="11" placeholder="Digite aqui..." name="telefone" id="telefone"/>
                                <label id="val_telefone" class="Validar"></label>
                            </div>
                            <div class="form-group" id="divCep">
                                <label>CEP</label>
                                <input class="form-control cep" maxlength="8" placeholder="Digite aqui..." name="cep" id="cep"/>
                                <label id="val_cep" class="Validar"></label>
                            </div>
                            <div class="form-group" id="divCidade">
                                <label for="cidade">Cidade</label>
                                <select class="form-control" id="cidade" name="cidade" >
                                    <option value="">Selecione</option>
                                    <?php
                                    for ($i = 0; $i < count($cidades); $i++) { ?>
                                        <option id="cidade" value="<?= $cidades[$i]['id_cidade'] ?>">
                                        <?= $cidades[$i]['nome_cidade'] ?>
                                        </option>
                                            <?php } ?>
                                </select>
                                <label id="val_cidade" class="Validar"></label>
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
                           <button type="submit" class="btn btn-success" name="btnSalvar" onclick="return Validar(3)" >Salvar</button>
                        </div> 
                   </form>
                </div> 
            </div>
        </div>
    </body>
</html>