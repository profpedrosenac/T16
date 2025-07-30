<?php

    include_once('conexao.php');

    try {
        $sql = $conn->query('select * from usuario');

        foreach ($sql as $row) {
            echo '<pre>';
            print_r($row);
            echo '</pre>';
            echo '<p>Nome:'.$row['nome_usuario'].'</p>';
            echo '<p>Nome:'.$row[1].'</p>';
        }


    } catch (PDOException $erro) {
        echo $erro->getMessage();
    }

?>