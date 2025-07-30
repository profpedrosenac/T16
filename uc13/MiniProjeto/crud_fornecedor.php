<?php
header('Content-Type: application/json; charset=utf-8');

$response = [
    'success' => false,
    'message' => 'Ação não especificada.',
    'data'    => null
];

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode($response);
    exit;
}

include_once('conexao.php');

$acao = $_POST['acao'] ?? '';
$id = $_POST['txtId'] ?? '';
$pesquisar_id = $_POST['pesquisar_id'] ?? '';
$nome = trim($_POST['txtNome'] ?? '');
$cnpj = $_POST['txtCnpj'] ?? '';
$email = $_POST['txtEmail'] ?? '';
$telefone = $_POST['txtTelefone'] ?? '';
$rua = $_POST['txtRua'] ?? '';
$numero = $_POST['txtNumero'] ?? '';
$complemento = $_POST['txtComplemento'] ?? '';
$bairro = $_POST['txtBairro'] ?? '';
$cidade = $_POST['txtCidade'] ?? '';
$estado = $_POST['txtEstado'] ?? '';
$cep = $_POST['txtCep'] ?? '';
$obs = $_POST['txtObs'] ?? '';
$status = $_POST['txtStatus'] ?? '';

try {
    if ($acao === 'cadastrar') {
        if (!$nome || !$cnpj || !$email || !$telefone || !$rua || !$numero || !$bairro || !$cidade || !$estado || !$cep || !$status) {
            $response['message'] = 'Por favor, preencha todos os campos obrigatórios.';
            echo json_encode($response); exit;
        }

        $sql = $conn->prepare("
            INSERT INTO Fornecedor
            (nome_fornecedor, cnpj_fornecedor, email_fornecedor, telefone_fornecedor, endereco_rua, endereco_numero, endereco_complemento, 
             endereco_bairro, endereco_cidade, endereco_estado, endereco_cep, cad_fornecedor, obs_fornecedor, status_fornecedor)
            VALUES
            (:nome, :cnpj, :email, :telefone, :rua, :numero, :complemento, :bairro, :cidade, :estado, :cep, NOW(), :obs, :status)
        ");
        $sql->execute([
            ':nome' => $nome,
            ':cnpj' => $cnpj,
            ':email' => $email,
            ':telefone' => $telefone,
            ':rua' => $rua,
            ':numero' => $numero,
            ':complemento' => $complemento,
            ':bairro' => $bairro,
            ':cidade' => $cidade,
            ':estado' => $estado,
            ':cep' => $cep,
            ':obs' => $obs,
            ':status' => $status
        ]);
        if ($sql->rowCount() > 0) {
            $idGerado = $conn->lastInsertId();
            // Buscar a data de cadastro formatada
            $rs = $conn->prepare("SELECT DATE_FORMAT(cad_fornecedor, '%d/%m/%Y %H:%i') as cadastro FROM Fornecedor WHERE id_fornecedor = :id");
            $rs->execute([':id' => $idGerado]);
            $row = $rs->fetch(PDO::FETCH_ASSOC);
            $response = [
                'success' => true,
                'message' => 'Fornecedor cadastrado com sucesso.',
                'data' => [
                    'id' => $idGerado,
                    'cadastro' => $row['cadastro'] ?? ''
                ]
            ];
        } else {
            $response['message'] = 'Falha ao cadastrar fornecedor.';
        }

    } elseif ($acao === 'alterar') {
        if (!$id) {
            $response['message'] = 'ID do fornecedor não informado para alteração.';
            echo json_encode($response); exit;
        }
        if (!$nome || !$cnpj || !$email || !$telefone || !$rua || !$numero || !$bairro || !$cidade || !$estado || !$cep || !$status) {
            $response['message'] = 'Por favor, preencha todos os campos obrigatórios.';
            echo json_encode($response); exit;
        }

        $sql = $conn->prepare("
          UPDATE Fornecedor SET
            nome_fornecedor = :nome,
            cnpj_fornecedor = :cnpj,
            email_fornecedor = :email,
            telefone_fornecedor = :telefone,
            endereco_rua = :rua,
            endereco_numero = :numero,
            endereco_complemento = :complemento,
            endereco_bairro = :bairro,
            endereco_cidade = :cidade,
            endereco_estado = :estado,
            endereco_cep = :cep,
            obs_fornecedor = :obs,
            status_fornecedor = :status
          WHERE id_fornecedor = :id
        ");
        $sql->execute([
          ':nome' => $nome,
          ':cnpj' => $cnpj,
          ':email' => $email,
          ':telefone' => $telefone,
          ':rua' => $rua,
          ':numero' => $numero,
          ':complemento' => $complemento,
          ':bairro' => $bairro,
          ':cidade' => $cidade,
          ':estado' => $estado,
          ':cep' => $cep,
          ':obs' => $obs,
          ':status' => $status,
          ':id' => $id
        ]);
        if ($sql->rowCount() > 0) {
          // Obter data de cadastro novamente
          $rs = $conn->prepare("SELECT DATE_FORMAT(cad_fornecedor, '%d/%m/%Y %H:%i') as cadastro FROM Fornecedor WHERE id_fornecedor = :id");
          $rs->execute([':id' => $id]);
          $row = $rs->fetch(PDO::FETCH_ASSOC);
          $response = [
              'success' => true,
              'message' => 'Fornecedor alterado com sucesso.',
              'data' => ['cadastro' => $row['cadastro'] ?? '']
          ];
        } else {
          $response['message'] = 'Nenhuma alteração realizada.';
        }

    } elseif ($acao === 'excluir') {
        if (!$id) {
            $response['message'] = 'ID do fornecedor não informado para exclusão.';
            echo json_encode($response); exit;
        }
        $sql = $conn->prepare("DELETE FROM Fornecedor WHERE id_fornecedor = :id");
        $sql->execute([':id' => $id]);
        if ($sql->rowCount() > 0) {
            $response = [
                'success' => true,
                'message' => 'Fornecedor excluído com sucesso.'
            ];
        } else {
            $response['message'] = 'Nenhum fornecedor excluído.';
        }

    } elseif ($acao === 'pesquisar') {
        $id_pesq = $pesquisar_id ?: $id;
        if (!$id_pesq) {
            $response['message'] = 'ID do fornecedor não informado para pesquisa.';
            echo json_encode($response); exit;
        }
        $sql = $conn->prepare("SELECT *, DATE_FORMAT(cad_fornecedor, '%d/%m/%Y %H:%i') as cadastro FROM Fornecedor WHERE id_fornecedor = :id");
        $sql->execute([':id' => $id_pesq]);
        if ($sql->rowCount() > 0) {
            $row = $sql->fetch(PDO::FETCH_ASSOC);
            $response = [
                'success' => true,
                'message' => 'Fornecedor encontrado.',
                'data' => [
                    'id' => $row['id_fornecedor'],
                    'nome' => $row['nome_fornecedor'],
                    'cnpj' => $row['cnpj_fornecedor'],
                    'email' => $row['email_fornecedor'],
                    'telefone' => $row['telefone_fornecedor'],
                    'rua' => $row['endereco_rua'],
                    'numero' => $row['endereco_numero'],
                    'complemento' => $row['endereco_complemento'],
                    'bairro' => $row['endereco_bairro'],
                    'cidade' => $row['endereco_cidade'],
                    'estado' => $row['endereco_estado'],
                    'cep' => $row['endereco_cep'],
                    'obs' => $row['obs_fornecedor'],
                    'status' => $row['status_fornecedor'],
                    'cadastro' => $row['cadastro']
                ]
            ];
        } else {
            $response['message'] = 'Nenhum fornecedor encontrado com esse ID.';
        }

    } else {
        $response['message'] = 'Ação inválida.';
    }
} catch (PDOException $e) {
    $response['message'] = 'Erro no banco de dados: ' . $e->getMessage();
}
echo json_encode($response);
exit;
