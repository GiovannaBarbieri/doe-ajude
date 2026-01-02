<?php

include_once '../Controller/UtilCTRL.php';

require_once '../Controller/UsuarioCTRL.php';

require_once '../VO/UsuarioVO.php';



if (isset($_GET['close']) && $_GET['close'] == '1') {

    UtilCtrl::Deslogar();

    exit();

}

//1 - Administrador

//2 - Funcionario

//3 - Pessoa Física

//4 - Pessoa Jurídica



$tipo = UtilCtrl::RetornarTipoLogado();

?>

<nav class="navbar-default navbar-side" role="navigatlion">

    <div class="sidebar-collapse">

        <ul class="nav" id="main-menu">          

            <?php if ($tipo == 1) { ?>

                <li>

                    <a href="dados_administrador.php"><i class="fa fa-user fa-2x"></i>Meus Dados</a>

                </li>    

                <li>

                    <a href="#"><i class="fa fa-search fa-2x"></i>Gerenciar Trabalhos<span class="fa arrow"></span></a>

                    <ul class="nav nav-second-level">

                        <li>

                            <a href="gerenciar_doacoes.php">Doações</a>

                        </li>

                        <li>

                            <a href="consultar_trabalho_voluntario.php">Voluntários</a>

                        </li>

                    </ul>

                </li>       

                <li>

                    <a href="cadastrar_funcionario.php"><i class="fa fa-plus-circle fa-2x"></i>Cadastrar Funcionario</a>

                </li> 

                <li>

                    <a href="gerenciar_parceiro.php"><i class="fa fa-users fa-2x"></i>Parceiros</a>

                </li>

                <li>

                    <a href="relatorios.php"><i class="fa fa-file-text-o fa-2x"></i>Relatórios</a>

                </li>

            <?php } else if ($tipo == 2) { ?>

                <li>

                    <a href="dados_funcionario.php"><i class="fa fa-user fa-2x"></i>Meus Dados</a>

                </li>

                <li>

                    <a href="gerenciar_parceiro.php"><i class="fa fa-users fa-2x"></i>Parceiros</a>

                </li> 

                <li>

                    <a href="gerenciar_doacoes.php"><i class="fa fa-plus-circle fa-2x"></i>Doações</a>

                </li> 

                <li>

                    <a href="consultar_trabalho_voluntario.php"><i class="fa fa-child fa-2x"></i>Voluntários</a>

                </li> 

                <li>

                    <a href="relatorios.php"><i class="fa fa-file-text-o fa-2x"></i>Relatórios</a>

                </li> 

            <?php } else if ($tipo == 3) { ?>

                <li>

                    <a href="dados_pessoa.php"><i class="fa fa-user fa-2x"></i>Meus Dados</a>

                </li>     

                <li>

                    <a href="quero_doar.php"><i class="fa fa-plus-circle fa-2x"></i>Quero Doar</a>

                </li>

                <li>

                    <a href="consultar_doacoes.php"><i class="fa fa-search fa-2x"></i></i>Consultar Doações</a>

                </li>                                 

                <li>

                    <a href="trabalho_voluntario.php"><i class="fa fa-child fa-2x"></i></i>Quero ser voluntário</a>

                </li> 

            <?php } else if ($tipo == 4) { ?>   

                <li>

                    <a href="dados_parceiro.php"><i class="fa fa-user fa-2x"></i>Meus Dados</a>

                </li>     

                <li>

                    <a href="quero_doar_parceiro.php"><i class="fa fa-plus-circle fa-2x"></i>Quero Doar</a>

                </li>

                <li>

                    <a href="consultar_doacoes_parceiro.php"><i class="fa fa-search fa-2x"></i></i>Consultar Doações</a>

                </li>                                 

            <?php } ?>

            <li>

                <a class="active-menu"  href="_menu.php?close=1"><i class="fa fa-close fa-2x"></i> Sair</a>

            </li>

        </ul>

    </div>

</nav>  