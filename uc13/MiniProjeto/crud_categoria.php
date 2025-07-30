<?php
header('Content-Type: application/json; charset=utf-8');

$response = [
    'success' => false,
    'message' => 'Ação não especificada.',
    'data' => null
];

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode($response);
    exit;
}

include_once('conexao.php'); // seu arquivo de conexão PDO

$acao = $_POST['acao'] ?? '';

$id = $_POST['txtId'] ?? '';
$nome = trim($_POST['txtNome'] ?? '');
$descricao = trim($_POST['txtDescricao'] ?? '');
$obs = trim($_POST['txtObs'] ?? '');
$status = $_POST['txtStatus'] ?? '';

try {
    if ($acao === 'cadastrar') {
        if (!$nome || !$descricao || !$status) {
            $response['message'] = 'Campos obrigatórios não preenchidos.';
            echo json_encode($response);
            exit;
        }

        // Verifica se já existe categoria com o mesmo nome
        $check = $conn->prepare("SELECT COUNT(*) FROM categoria WHERE nome_categoria = :nome");
        $check->execute([':nome' => $nome]);
        if ($check->fetchColumn() > 0) {
            $response['message'] = 'Já existe uma categoria com este nome.';
            echo json_encode($response);
            exit;
        }

        $sql = $conn->prepare("
            INSERT INTO categoria
            (nome_categoria, descricao_categoria, obs_categoria, status_categoria)
            VALUES (:nome_categoria, :descricao_categoria, :obs_categoria, :status_categoria)
        ");

        $sql->execute([
            ':nome_categoria' => $nome,
            ':descricao_categoria' => $descricao,
            ':obs_categoria' => $obs,
            ':status_categoria' => $status,
        ]);

        if ($sql->rowCount() > 0) {
            $idGerado = $conn->lastInsertId();
            $response = [
                'success' => true,
                'message' => 'Categoria cadastrada com sucesso.',
                'data' => [
                    'id' => $idGerado
                ]
            ];
        } else {
            $response['message'] = 'Falha ao cadastrar categoria.';
        }
    } elseif ($acao === 'alterar') {
        if (!$id) {
            $response['message'] = 'ID da categoria não informado para alteração.';
            echo json_encode($response);
            exit;
        }
        if (!$nome || !$descricao || !$status) {
            $response['message'] = 'Campos obrigatórios não preenchidos.';
            echo json_encode($response);
            exit;
        }

        // Verifica se existe outra categoria com mesmo nome
        $check = $conn->prepare("SELECT COUNT(*) FROM categoria WHERE nome_categoria = :nome AND id_categoria != :id");
        $check->execute([':nome' => $nome, ':id' => $id]);
        if ($check->fetchColumn() > 0) {
            $response['message'] = 'Já existe outra categoria com este nome.';
            echo json_encode($response);
            exit;
        }

        $sql = $conn->prepare("
            UPDATE categoria SET
                nome_categoria = :nome_categoria,
                descricao_categoria = :descricao_categoria,
                obs_categoria = :obs_categoria,
                status_categoria = :status_categoria
            WHERE id_categoria = :id_categoria
        ");

        $sql->execute([
            ':nome_categoria' => $nome,
            ':descricao_categoria' => $descricao,
            ':obs_categoria' => $obs,
            ':status_categoria' => $status,
            ':id_categoria' => $id
        ]);

        if ($sql->rowCount() > 0) {
            $response = [
                'success' => true,
                'message' => 'Categoria alterada com sucesso.'
            ];
        } else {
            $response['message'] = 'Nenhuma alteração realizada.';
        }
    } elseif ($acao === 'excluir') {
        if (!$id) {
            $response['message'] = 'ID da categoria não informado para exclusão.';
            echo json_encode($response);
            exit;
        }

        $sql = $conn->prepare("DELETE FROM categoria WHERE id_categoria = :id_categoria");
        $sql->execute([':id_categoria' => $id]);

        if ($sql->rowCount() > 0) {
            $response = [
                'success' => true,
                'message' => 'Categoria excluída com sucesso.'
            ];
        } else {
            $response['message'] = 'Nenhuma categoria excluída.';
        }
    } elseif ($acao === 'pesquisar') {
        $idPesquisa = $_POST['pesquisar_id'] ?? $id;
        if (!$idPesquisa) {
            $response['message'] = 'ID da categoria não informado para pesquisa.';
            echo json_encode($response);
            exit;
        }

        $sql = $conn->prepare("SELECT * FROM categoria WHERE id_categoria = :id_categoria");
        $sql->execute([':id_categoria' => $idPesquisa]);

        if ($sql->rowCount() > 0) {
            $row = $sql->fetch(PDO::FETCH_ASSOC);
            $response = [
                'success' => true,
                'message' => 'Categoria encontrada.',
                'data' => [
                    'id' => $row['id_categoria'],
                    'nome' => $row['nome_categoria'],
                    'descricao' => $row['descricao_categoria'],
                    'obs' => $row['obs_categoria'],
                    'status' => $row['status_categoria']
                ]
            ];
        } else {
            $response['message'] = 'Nenhuma categoria encontrada com esse ID.';
        }
    } else {
        $response['message'] = 'Ação inválida.';
    }
} catch (PDOException $e) {
    $response['message'] = 'Erro no banco de dados: ' . $e->getMessage();
}

echo json_encode($response);
exit;
?>