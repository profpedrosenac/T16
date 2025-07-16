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
                <h1>
                    Sistema de média Escolar
                </h1>
            </div>
        </div>
        <form class="form-control" method="post">
            <div class="row">
                <div class="col-sm-3">
                    <label for="txtN1">N1</label>
                    <input type="number" name="txtN1" id="txtN1" class="form-control" max="10" min="0" step="0.25">
                </div>
                <div class="col-sm-3">
                    <label for="txtN2">N2</label>
                    <input type="number" name="txtN2" id="txtN2" class="form-control" max="10" min="0" step="0.25">
                </div>
                <div class="col-sm-3">
                    <label for="txtN3">N3</label>
                    <input type="number" name="txtN3" id="txtN3" class="form-control" max="10" min="0" step="0.25">
                </div>
                <div class="col-sm-3">
                    <label for="txtN4">N4</label>
                    <input type="number" name="txtN4" id="txtN4" class="form-control" max="10" min="0" step="0.25">
                </div>
                <div class="col-sm 12 text-end mt-2">
                    <button class="btn btn-primary" formaction="pag01.php">OK</button>
                </div>
            </div>
        </form>
        <div class="row m-0 mt-3">
            <div class="col-sm-12 card">
                <p>Resultado</p>
                
                <?php
                if ($_POST) {
                    $n1 = $_POST['txtN1'];
                    $n2 = $_POST['txtN2'];
                    $n3 = $_POST['txtN3'];
                    $n4 = $_POST['txtN4'];
                    $media = ($n1+$n2+$n3+$n4)/4;

                    if ($n1 <0 || $n1 >10) {
                        echo "<p>N1 deve ser entre 0 a 10</p>";
                        return;
                    }
                    if ($n2 <0 || $n2 >10) {
                        echo "<p>N2 deve ser entre 0 a 10</p>";
                        return;
                    }
                    if ($n3 <0 || $n3 >10) {
                        echo "<p>N3 deve ser entre 0 a 10</p>";
                        return;
                    }
                    if ($n4 <0 || $n4 >10) {
                        echo "<p>N4 deve ser entre 0 a 10</p>";
                        return;
                    }
                    
                    echo "<p>".$media."</p>";

                    if ($media >= 7) {
                        echo "<p class='azul'>APROVADO</p>";
                    }elseif ($media <= 5){
                        echo "<p class='vermelho'>REPROVADO</p>";
                    }else{
                        echo "<p class='laranja'>EXAME</p>";
                    }
                }
                ?>
                
            </div>
        </div>  

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>
</html>