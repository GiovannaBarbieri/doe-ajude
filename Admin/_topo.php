<?php
include_once '../Controller/UtilCTRL.php';
require_once '../Controller/UsuarioCTRL.php';
require_once '../Controller/PessoaCTRL.php';



$ctrl_user = new UsuarioCTRL();
$ctrl_ps = new PessoaCTRL();

$dadosAdm = $ctrl_user->CarregarDadosAdministrador();
$dadosFunc = $ctrl_user->CarregarDadosFuncionario();
$dados = $ctrl_ps->CarregarDadosPessoa();
$dadosParc = $ctrl_user->CarregarDadosParceiro();



$tipo = UtilCtrl::RetornarTipoLogado();
?>

<nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">

    <div class="navbar-header">

        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">

            <span class="sr-only">Toggle navigation</span>

            <span class="icon-bar"></span>

            <span class="icon-bar"></span>

            <span class="icon-bar"></span>

        </button>

<?php if ($tipo == 1) { ?>
            <img src="/Admin/assets/img/logo-horizontal.png" alt="" class="logo-doe"> 
            <p class="nome-ong"><strong>Casa do caminho - Administrador</strong></p> 

<?php } else if ($tipo == 2) { ?>
            <img src="/Admin/assets/img/logo-horizontal.png" alt="" class="logo-doe"> 
            <p class="nome-ong"><strong>Casa do caminho - Colaborador</strong></p> 

<?php } else if ($tipo == 3) { ?>
            <img src="/Admin/assets/img/logo-horizontal.png" alt="" class="logo-doe"> 
            <p class="nome-ong"><strong>Casa do caminho - PF</strong></p> 

<?php } else { ?>
            <img src="/Admin/assets/img/logo-horizontal.png" alt="" class="logo-doe"> 
            <p class="nome-ong"><strong>Casa do caminho - PJ</strong></p> 

<?php } ?>

    </div>
    
<?php if ($tipo == 1) { ?>

        <div class="nome-topo">Bem Vindo, <?= substr($dadosAdm[0]['nome_funcionario'], 0,50) ?> <b></b> &nbsp;</div>
<?php }else if ($tipo == 2) { ?>

        <div class="nome-topo">Bem Vindo, <?= substr($dadosFunc[0]['nome_funcionario'], 0,50) ?> <b></b> &nbsp;</div>
<?php }else if ($tipo == 3) { ?>

        <div class="nome-topo">Bem Vindo, <?= substr($dados[0]['nome_pessoa'], 0,50) ?> <b></b> &nbsp;</div>
<?php }else if ($tipo == 4) { ?>

        <div class="nome-topo">Bem Vindo, <?= substr($dadosParc[0]['nome_parceiro'], 0, 50) ?> <b></b> &nbsp;</div>
<?php } ?>

</nav>   



<!--VERIFICAR OS NOMES, POIS ESTÁ FILTRANDO SOMENTE O NOME DOS FUNIONARIOS E NÃO ESTÁ APARECENDO O NOME DO DOADOR-->