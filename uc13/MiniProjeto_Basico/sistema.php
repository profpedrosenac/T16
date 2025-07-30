<!DOCTYPE html>
<html lang="pt_BR">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - SB Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <link rel="stylesheet" href="css/estilo.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
        
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>

    <?php include_once('_autenticar.php'); ?>

    <body class="sb-nav-fixed">
        
        <?php include_once('_topo.php'); ?>

        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <?php include_once('_menuLateral.php'); ?>
            </div>
            <div id="layoutSidenav_content">
                <?php

                    if (!isset($_GET['tela'])) {
                        include_once('_dashboard.php');
                    }elseif ($_GET['tela'] == "usuario"){
                        include_once('frm_usuario.php'); 
                    }elseif ($_GET['tela'] == "cliente"){
                        include_once('_cliente.php'); 
                    }elseif ($_GET['tela'] == "venda"){
                        include_once('_venda.php'); 
                    }else{
                        include_once('404.html');
                    }
                 
                 ?>
            </div>
        </div>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
