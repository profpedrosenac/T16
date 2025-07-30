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

include_once('conexao.php');

$acao = $_POST['acao'] ?? '';

$id = $_POST['txtId'] ?? '';
$id_categoria = $_POST['txtCategoria'] ?? '';
$nome = trim($_POST['txtNome'] ?? '');
$valor_custo = $_POST['txtValorCusto'] ?? '';
$valor_venda = $_POST['txtValorVenda'] ?? '';
$qtde = $_POST['txtQuantidade'] ?? '';
$obs = trim($_POST['txtObs'] ?? '');
$status = $_POST['txtStatus'] ?? '';

try {
    if ($acao === 'cadastrar') {
        if (!$id_categoria || !$nome || $valor_custo === '' || $valor_venda === '' || $qtde === '' || !$status) {
            $response['message'] = 'Por favor, preencha todos os campos obrigatórios.';
            echo json_encode($response);
            exit;
        }

        $sql = $conn->prepare("
            INSERT INTO produto 
            (id_categoria_produto, nome_produto, valor_custo, valor_venda, qtde_produto, obs_produto, status_produto)
            VALUES (:id_categoria, :nome, :valor_custo, :valor_venda, :qtde, :obs, :status)
        ");

        $sql->execute([
            ':id_categoria' => $id_categoria,
            ':nome' => $nome,
            ':valor_custo' => $valor_custo,
            ':valor_venda' => $valor_venda,
            ':qtde' => $qtde,
            ':obs' => $obs,
            ':status' => $status,
        ]);

        if ($sql->rowCount() > 0) {
            $idGerado = $conn->lastInsertId();
            $response = [
                'success' => true,
                'message' => 'Produto cadastrado com sucesso.',
                'data' => ['id' => $idGerado]
            ];
        } else {
            $response['message'] = 'Falha ao cadastrar produto.';
        }
    } elseif ($acao === 'alterar') {
        if (!$id) {
            $response['message'] = 'ID do produto não informado para alteração.';
            echo json_encode($response);
            exit;
        }
        if (!$id_categoria || !$nome || $valor_custo === '' || $valor_venda === '' || $qtde === '' || !$status) {
            $response['message'] = 'Por favor, preencha todos os campos obrigatórios.';
            echo json_encode($response);
            exit;
        }

        $sql = $conn->prepare("
            UPDATE produto SET
                id_categoria_produto = :id_categoria,
                nome_produto = :nome,
                valor_custo = :valor_custo,
                valor_venda = :valor_venda,
                qtde_produto = :qtde,
                obs_produto = :obs,
                status_produto = :status
            WHERE id_produto = :id
        ");

        $sql->execute([
            ':id_categoria' => $id_categoria,
            ':nome' => $nome,
            ':valor_custo' => $valor_custo,
            ':valor_venda' => $valor_venda,
            ':qtde' => $qtde,
            ':obs' => $obs,
            ':status' => $status,
            ':id' => $id,
        ]);

        if ($sql->rowCount() > 0) {
            $response = [
                'success' => true,
                'message' => 'Produto alterado com sucesso.'
            ];
        } else {
            $response['message'] = 'Nenhuma alteração realizada.';
        }
    } elseif ($acao === 'excluir') {
        if (!$id) {
            $response['message'] = 'ID do produto não informado para exclusão.';
            echo json_encode($response);
            exit;
        }

        $sql = $conn->prepare("DELETE FROM produto WHERE id_produto = :id");
        $sql->execute([':id' => $id]);

        if ($sql->rowCount() > 0) {
            $response = [
                'success' => true,
                'message' => 'Produto excluído com sucesso.'
            ];
        } else {
            $response['message'] = 'Nenhum produto excluído.';
        }
    } elseif ($acao === 'pesquisar') {
        $pesquisar_id = $_POST['pesquisar_id'] ?? '';

        if (!$pesquisar_id) {
            $response['message'] = 'ID do produto não informado para pesquisa.';
            echo json_encode($response);
            exit;
        }

        $sql = $conn->prepare("
            SELECT p.*, c.nome_categoria 
            FROM produto p
            JOIN categoria c ON p.id_categoria_produto = c.id_categoria
            WHERE p.id_produto = :id
        ");
        $sql->execute([':id' => $pesquisar_id]);

        if ($sql->rowCount() > 0) {
            $row = $sql->fetch(PDO::FETCH_ASSOC);
            $response = [
                'success' => true,
                'message' => 'Produto encontrado.',
                'data' => [
                    'id' => $row['id_produto'],
                    'id_categoria' => $row['id_categoria_produto'],
                    'nome' => $row['nome_produto'],
                    'valor_custo' => $row['valor_custo'],
                    'valor_venda' => $row['valor_venda'],
                    'qtde' => $row['qtde_produto'],
                    'obs' => $row['obs_produto'],
                    'status' => $row['status_produto']
                ]
            ];
        } else {
            $response['message'] = 'Nenhum produto encontrado com esse ID.';
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