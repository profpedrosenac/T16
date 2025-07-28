<main>
    <div class="container-fluid px-4">
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
                    <button formaction="sistema.php?tela=venda" name="btoCredito" class="btn btn-primary">Crédito</button>
                    <button formaction="sistema.php?tela=venda" name="btoDebito" class="btn btn-success">Débito</button>
                    <button formaction="sistema.php?tela=venda" name="btoPix" class="btn btn-info">PIX</button>
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
</main>
<footer class="py-4 bg-light mt-auto">
    <div class="container-fluid px-4">
        <div class="d-flex align-items-center justify-content-between small">
            <div class="text-muted">Copyright &copy; Your Website 2023</div>
            <div>
                <a href="#">Privacy Policy</a>
                &middot;
                <a href="#">Terms &amp; Conditions</a>
            </div>
        </div>
    </div>
</footer>
