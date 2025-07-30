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

include_once('conexao.php'); // Inclua o seu arquivo de conexão PDO

// Lê os dados do POST e do FILES (para foto)
$acao = $_POST['acao'] ?? '';

$id = $_POST['txtId'] ?? '';
$nome = $_POST['txtNome'] ?? '';
$login = $_POST['txtLogin'] ?? '';
$senha = $_POST['txtSenha'] ?? '';
$funcao = $_POST['txtFuncao'] ?? '';
$status = $_POST['txtStatus'] ?? '';
$obs = $_POST['txtObs'] ?? '';
$foto = $_FILES['txtFoto'] ?? null;

$pesquisar_id = $_POST['pesquisar_id'] ?? '';

try {
    if ($acao === 'cadastrar') {
        // Verifica campos obrigatórios (pode ajustar como quiser)
        if (!$nome || !$login || !$senha || !$funcao || !$status) {
            $response['message'] = 'Campos obrigatórios não foram preenchidos.';
            echo json_encode($response);
            exit;
        }

        // Inserção do usuário
        $sql = $conn->prepare("
            INSERT INTO usuario
            (nome_usuario, login_usuario, senha_usuario, funcao_usuario, status_usuario, obs_usuario, foto_usuario)
            VALUES
            (:nome_usuario, :login_usuario, :senha_usuario, :funcao_usuario, :status_usuario, :obs_usuario, :foto_usuario)
        ");

        $nomeArquivoFoto = $foto && isset($foto['name']) ? $foto['name'] : null;

        $sql->execute([
            ':nome_usuario' => $nome,
            ':login_usuario' => $login,
            ':senha_usuario' => $senha,
            ':funcao_usuario' => $funcao,
            ':status_usuario' => $status,
            ':obs_usuario' => $obs,
            ':foto_usuario' => $nomeArquivoFoto
        ]);

        if ($sql->rowCount() > 0) {
            $idGerado = $conn->lastInsertId();

            // Salvar foto na pasta do usuário
            if ($foto && isset($foto['tmp_name']) && $nomeArquivoFoto) {
                $pasta_dir = 'imagem/' . $idGerado . '/';
                if (!file_exists($pasta_dir)) {
                    mkdir($pasta_dir, 0755, true);
                }
                move_uploaded_file($foto['tmp_name'], $pasta_dir . $nomeArquivoFoto);
            }

            // Puxar data cadastro para enviar pro frontend
            $sqlData = $conn->prepare("SELECT DATE_FORMAT(cad_usuario, '%d/%m/%Y %H:%i') as dataCadastro FROM usuario WHERE id_usuario = :id");
            $sqlData->execute([':id' => $idGerado]);
            $rowData = $sqlData->fetch(PDO::FETCH_ASSOC);
            $dataCadastro = $rowData['dataCadastro'] ?? '';

            $response = [
                'success' => true,
                'message' => 'Usuário cadastrado com sucesso.',
                'data' => [
                    'id' => $idGerado,
                    'dataCadastro' => $dataCadastro
                ]
            ];
        } else {
            $response['message'] = 'Falha ao cadastrar o usuário.';
        }
    } elseif ($acao === 'alterar') {
        if (!$id) {
            $response['message'] = 'ID do usuário não informado para alteração.';
            echo json_encode($response);
            exit;
        }

        // Tratamento da foto nova (se houver)
        $nomeArquivoFoto = null;
        if ($foto && isset($foto['name']) && $foto['name'] !== '') {
            $nomeArquivoFoto = $foto['name'];
            // Criar pasta do usuário se não existir
            $pasta_dir = 'imagem/' . $id . '/';
            if (!file_exists($pasta_dir)) {
                mkdir($pasta_dir, 0755, true);
            }
            // Mover arquivo para pasta do usuário
            move_uploaded_file($foto['tmp_name'], $pasta_dir . $nomeArquivoFoto);
        }

        // Montar SQL para atualizar a foto apenas se houver uma nova foto
        if ($nomeArquivoFoto !== null) {
            $sql = $conn->prepare("
                UPDATE usuario SET
                    nome_usuario = :nome_usuario,
                    login_usuario = :login_usuario,
                    senha_usuario = :senha_usuario,
                    funcao_usuario = :funcao_usuario,
                    status_usuario = :status_usuario,
                    obs_usuario = :obs_usuario,
                    foto_usuario = :foto_usuario
                WHERE id_usuario = :id_usuario
            ");

            $params = [
                ':nome_usuario' => $nome,
                ':login_usuario' => $login,
                ':senha_usuario' => $senha,
                ':funcao_usuario' => $funcao,
                ':status_usuario' => $status,
                ':obs_usuario' => $obs,
                ':foto_usuario' => $nomeArquivoFoto,
                ':id_usuario' => $id
            ];
        } else {
            // Sem alterar a foto_usuario na tabela
            $sql = $conn->prepare("
                UPDATE usuario SET
                    nome_usuario = :nome_usuario,
                    login_usuario = :login_usuario,
                    senha_usuario = :senha_usuario,
                    funcao_usuario = :funcao_usuario,
                    status_usuario = :status_usuario,
                    obs_usuario = :obs_usuario
                WHERE id_usuario = :id_usuario
            ");

            $params = [
                ':nome_usuario' => $nome,
                ':login_usuario' => $login,
                ':senha_usuario' => $senha,
                ':funcao_usuario' => $funcao,
                ':status_usuario' => $status,
                ':obs_usuario' => $obs,
                ':id_usuario' => $id
            ];
        }

        $sql->execute($params);

        if ($sql->rowCount() > 0) {
            $response = [
                'success' => true,
                'message' => 'Usuário alterado com sucesso.'
            ];
        } else {
            $response['message'] = 'Nenhuma alteração realizada.';
        }
    } elseif ($acao === 'excluir') {
        if (!$id) {
            $response['message'] = 'ID do usuário não informado para exclusão.';
            echo json_encode($response);
            exit;
        }
        $sql = $conn->prepare("DELETE FROM usuario WHERE id_usuario = :id_usuario");
        $sql->execute([':id_usuario' => $id]);

        if ($sql->rowCount() > 0) {
            // Opcional: remover pasta de fotos
            $pasta_dir = 'imagem/' . $id . '/';
            if (file_exists($pasta_dir) && is_dir($pasta_dir)) {
                // Remove arquivos dentro da pasta
                $files = glob($pasta_dir . '*', GLOB_MARK);
                foreach ($files as $file) {
                    if (is_file($file)) unlink($file);
                }
                rmdir($pasta_dir);
            }
            $response = [
                'success' => true,
                'message' => 'Usuário excluído com sucesso.'
            ];
        } else {
            $response['message'] = 'Nenhum usuário excluído.';
        }
    } elseif ($acao === 'pesquisar') {
        $idPesquisa = $pesquisar_id ?: $id;
        if (!$idPesquisa) {
            $response['message'] = 'ID do usuário não informado para pesquisa.';
            echo json_encode($response);
            exit;
        }
        $sql = $conn->prepare("
            SELECT id_usuario, nome_usuario, login_usuario, senha_usuario, foto_usuario, funcao_usuario, 
                   DATE_FORMAT(cad_usuario, '%d/%m/%Y %H:%i') as dataCadastro, obs_usuario, status_usuario 
            FROM usuario WHERE id_usuario = :id_usuario
        ");
        $sql->execute([':id_usuario' => $idPesquisa]);

        if ($sql->rowCount() > 0) {
            $row = $sql->fetch(PDO::FETCH_ASSOC);
            $response = [
                'success' => true,
                'message' => "Usuário encontrado.",
                'data' => [
                    'id' => $row['id_usuario'],
                    'nome' => $row['nome_usuario'],
                    'login' => $row['login_usuario'],
                    'senha' => $row['senha_usuario'],
                    'funcao' => $row['funcao_usuario'],
                    'dataCadastro' => $row['dataCadastro'],
                    'obs' => $row['obs_usuario'],
                    'status' => $row['status_usuario'],
                    'foto' => $row['foto_usuario']
                ]
            ];
        } else {
            $response['message'] = 'Nenhum usuário encontrado com esse ID.';
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