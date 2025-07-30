<?php

include_once('conexao.php'); // ajuste para o caminho correto do seu arquivo de conexão

try {
    $sql = $conn->prepare("SELECT id_categoria, nome_categoria FROM categoria WHERE status_categoria = 'Ativo' ORDER BY nome_categoria");

    $sql->execute();

    if ($sql->rowCount() > 0) {
        foreach ($sql as $row) {
            echo "<option value='$row[0]'>$row[1]</option>";
        }
    } else {
        echo '<p>Nenhum usuário encontrado com esse nome.</p>';
    }
} catch (PDOException $erro) {
echo $erro->getMessage();
}
?>