<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1>Atividade 00</h1>
                <h2>Sistema de compra de produtos</h2>
                <hr>
            </div>
        </div>
        <form action="" method="post" class="form-control">
            <div class="row">
                <div class="col-sm-4">
                    <label for="txtProduto">Produto</label>
                    <input type="text" name="txtProduto" class="form-control">
                </div>
                <div class="col-sm-4">
                    <label for="txtValor">Valor Unitário</label>
                    <input type="number" name="txtValor" class="form-control" step="0.01">
                </div>
                <div class="col-sm-4">
                    <label for="txtQtde">Quantidade</label>
                    <input type="number" name="txtQtde" class="form-control">
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-12 text-end">
                    <button formaction="Atividade00.php" name="btoCredito" class="btn btn-primary">Crédito</button>
                    <button formaction="Atividade00.php" name="btoDebito" class="btn btn-success">Débito</button>
                    <button formaction="Atividade00.php" name="btoPix" class="btn btn-info">PIX</button>
                </div>
            </div>
        </form>
        <div class="row">
            <div class="col-sm-12 card mt-2">
                <h3>Resumo da compra</h3>
                <hr>
                <?php

                //echo "R$ ".number_format(10, 2, ',', '.')."<br>";
                

                if ($_POST) {
                    $produto = $_POST['txtProduto'];
                    $valor = $_POST['txtValor'];
                    $qtde = $_POST['txtQtde'];

                    $total = $valor * $qtde;

                    echo '<p>Produto Comprado: <b>'.$produto.'</b></p>';
                    echo '<p>Quantidade Comprada: <b>'.$qtde.'</b></p>';
                    echo '<p>Total da Compra R$ '.number_format($total,2,',','.').'</p>';

                    if (isset($_POST['btoCredito'])) {
                        echo '<p>Pagamento no Crédito</p>';                        
                        $totalFinal = $total * 1.25;
                        echo '<p>Total a pagar com juros: R$ '.number_format($totalFinal,2,',','.').'</p>';
                    }
                    if (isset($_POST['btoDebito'])) {
                        echo '<p>Pagamento no Débito</p>';
                        echo '<p>Total a pagar: R$ '.number_format($total,2,',','.').'</p>';
                    }
                    if (isset($_POST['btoPix'])) {
                        echo '<p>Pagamento no PIX</p>';
                        $totalFinal = $total * 0.95;
                        echo '<p>Total a pagar com Desconto: R$ '.number_format($totalFinal,2,',','.').'</p>';
                    }
                }
                ?>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>
</html>