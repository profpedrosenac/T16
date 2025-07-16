<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=h1, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <h1>Trabalhando com PHP</h1>
    <hr>
    <?php
        $nome = "Pedro Legal";

        echo "<p>Olá mundo! Pessoa $nome</p>";
        echo '<p>Olá mundo! Pessoa $nome</p>';
        echo "<p>Olá mundo! Pessoa ".$nome."</p>";
        echo '<p>Olá mundo! Pessoa '.$nome.'</p>';
    ?>
    <hr>
    <form action="" method="post">

        <label for="txtNome">Informe seu nome</label><br>
        <input type="text" name="txtNome" id="txtNome"><br>

        <label for="txtSobrenome">Informe seu sobrnome</label><br>
        <input type="text" name="txtSobrenome" id="txtNome"><br>

        <button formaction="pag01.php">Nome Completo</button>
    </form>
    <hr>

    <?php

        if ($_POST) {
            echo "Nome Completo: ".$_POST['txtNome']." ".$_POST['txtSobrenome'];
        }

    ?>

    <hr>
</body>
</html>