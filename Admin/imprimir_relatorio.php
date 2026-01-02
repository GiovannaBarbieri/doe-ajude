<?php

require_once '../Controller/UsuarioCTRL.php';
require_once '../Controller/UtilCTRL.php';

use Dompdf\Dompdf;

require_once 'dompdf/autoload.inc.php';
$tipo = '';
$tipo_doador = '';
if (UtilCTRL::RetornarTipoLogado() == 1) {
    $tipo = 1;
} elseif (UtilCTRL::RetornarTipoLogado() == 2) {
    $tipo = 2;
}
UtilCtrl::VerTipoPermissao($tipo);


if (isset($_GET['tipo_doador'])) {

    $tipo_doador = $_GET['tipo_doador'];
    $dt_inicial = $_GET['data_inicial'];
    $dt_final = $_GET['data_final'];

    $ctrl_doa = new UsuarioCTRL();

    $doacao = $ctrl_doa->RelatoriosDoacoes($tipo_doador, $dt_inicial, $dt_final);

    if (count($doacao) == 0) {
        header('location: relatorios.php');
        exit;
    }

    $inicio_table = '
        
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>Invoice - #123</title>

        <style type="text/css">
            @page {
                margin: 0px;
            }

            body {
                margin: 0px;
            }

            * {
                font-family: Verdana, Arial, sans-serif;
            }

            a {
                color: #020202;
                text-decoration: none;
            }

            table {
                font-size: x-small;
            }

            tfoot tr td {
                font-weight: bold;
                font-size: x-small;
            }

            .invoice table {
                margin: 15px;
            }

            .invoice h3 {
                margin-left: 15px;
            }

            .information {
                background-color:#d8d8d8;;
                color: #020202;
            }

            .information .logo {
                margin: 4px;
            }

            .information table {
                padding: 10px;
            }
        </style>

    </head>
    <body>

        <div class="information">
            <table width="100%">
                <tr>
                    <td align="left" style="width: 40%;">
                        <pre>
                        
casadocaminho@sercomtel.com.br
(43) 3325-4037

<b>Tipo Documento: Relátorios<\b>
<br /><br />
                        </pre>

                    </td>
                    <td align="center" >
                    <center><img src="assets/img/logo.png" alt="Logo" width="150" class="logo"/></center>
                    </td>
                    <td align="right" style="width: 40%;">
                        <h3>Casa do Caminho</h3>
                        <pre>
                    https://doeajude.com.br
                  Av. Paul Harris 1481, 
                  Londrina, PR, 
                  86039-260
                        </pre>
                    </td>
                </tr>

            </table>
        </div>
        <br/>
        <div class="invoice">
            <h3>RELÁTORIOS</h3>
                 <table width="100%">
                <thead>
                    <tr>
                        <th>Tipo</th>
                        <th>Nome</th>
                        <th>Data</th>
                        <th>Situação</th>
                    </tr>
                </thead>
                <tbody>
            </tr>
        </thead>
        <tbody>';

    $linha = '';

    for ($i = 0; $i < count($doacao); $i++) {
        $linha .= '<tr class="odd gradeX">
                                <td>' . ($doacao[$i]['tipo_pessoa']) . '</td>
                                <td>' . ($doacao[$i]['nome_parceiro']) . '</td>
                                <td>' . (UtilCtrl::MostrarData($doacao[$i]['data_status'])) . '</td>
                                <td>' . ($doacao[$i]['situacao_status'] == 1 ? "Aprovado" : ($doacao[$i]['situacao_status'] == 2 ? "Rejeitado" : "Pendente")) . '</td>
                            </tr>';
    }
    $final_table = '</tbody>           
          
                </table> 
                </div>
            <div class="information" style="position: absolute; bottom: 0;">
            <table width="100%">
                <tr>
                    <td align="left" style="width: 50%;">
                       DoeAjude - All rights reserved.
                    </td>
                    <td align="right" style="width: 50%;">
                        Casa do Caminho
                    </td>
                </tr>

            </table>
        </div>        
</html>

';

    $tabela_finalizada = $inicio_table . $linha . $final_table;

    $domPdf = new Dompdf();
    $domPdf->loadHtml($tabela_finalizada);
    $domPdf->render();
    $domPdf->stream('historico_relatorio.pdf', array('Attachment' => false));
}




