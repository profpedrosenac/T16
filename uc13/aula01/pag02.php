<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <h1>Calculadora da Shopee</h1>
    <hr>
    <form action="" method="post">
        <p>
            <label for="txtN1">Informe N1</label>
            <input type="number" name="txtN1" id="txtN1">
        </p>
        <p>
            <label for="txtN2">Informe N2</label>
            <input type="number" name="txtN2" id="txtN2">
        </p>
        <p>
            <button formaction="pag02.php" name="btoMais">+</button>
            <button formaction="pag02.php" name="btoMenos">-</button>
            <button formaction="pag02.php" name="btoMult">*</button>
            <button formaction="pag02.php" name="btoDivisao">/</button>
        </p>
    </form>
    <hr>
        <p>Resultado:</p>
        <p>
            <?php
                //print_r($_POST);
                $total=0;
                $n1=0;
                $n2=0;

                if ($_POST) {
                    $n1=$_POST['txtN1'];
                    $n2=$_POST['txtN2'];

                    if (isset($_POST['btoMais'])) {
                        $total = $n1 + $n2;
                        echo $total;
                    }
                    if (isset($_POST['btoMenos'])) {
                        $total = $n1 - $n2;
                        echo $total;
                    }
                    if (isset($_POST['btoMult'])) {
                        $total = $n1 * $n2;
                        echo $total;
                    }
                    if (isset($_POST['btoDivisao'])) {
                        $total = $n1 / $n2;
                        echo $total;
                    }
                }
            ?>
        </p>
    <hr>
</body>
</html>