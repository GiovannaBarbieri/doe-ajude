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
                            <h2>Bem vindo</h2>   
                            <h5>Casa do Caminho - Doações</h5>
                        </div>
                    </div>
                    <!-- /. ROW  -->
                    <hr />
                    <p>Utilize o menu para fazer uma doação, consultar o que você já doou ou para ser um voluntário em nossa instiutiição.</p>
                    <p>Qualquer dúvida ligue para nós: (43) 3325 4037.</p>
                    <!--ROW-->                    
                </div>
                <!-- /. PAGE INNER  -->
            </div>
            <!-- /. PAGE WRAPPER  -->
        </div>
    </body>
</html>