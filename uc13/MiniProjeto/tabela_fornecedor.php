
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Tabela de Fornecedores</h1>
        
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Tabela de Fornecedor
            </div>
            <div class="card-body">

            <?php
                include_once('conexao.php'); // ajuste o caminho conforme seu projeto

                $sql = $conn->prepare("
                    SELECT 
                        id_fornecedor,
                        nome_fornecedor,
                        cnpj_fornecedor,
                        email_fornecedor,
                        telefone_fornecedor,
                        endereco_cidade,
                        endereco_estado,
                        DATE_FORMAT(cad_fornecedor, '%d/%m/%Y %H:%i') AS data_cadastro,
                        status_fornecedor
                    FROM Fornecedor
                    ORDER BY nome_fornecedor ASC
                ");
                $sql->execute();
                $fornecedores = $sql->fetchAll(PDO::FETCH_ASSOC);
                ?>

                <table id="datatablesFornecedor" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>CNPJ</th>
                            <th>E-mail</th>
                            <th>Telefone</th>
                            <th>Cidade</th>
                            <th>UF</th>
                            <th>Cadastro</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>CNPJ</th>
                            <th>E-mail</th>
                            <th>Telefone</th>
                            <th>Cidade</th>
                            <th>UF</th>
                            <th>Cadastro</th>
                            <th>Status</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach ($fornecedores as $f): ?>
                        <tr>
                            <td><?= htmlspecialchars($f['id_fornecedor']) ?></td>
                            <td><?= htmlspecialchars($f['nome_fornecedor']) ?></td>
                            <td><?= htmlspecialchars($f['cnpj_fornecedor']) ?></td>
                            <td><?= htmlspecialchars($f['email_fornecedor']) ?></td>
                            <td><?= htmlspecialchars($f['telefone_fornecedor']) ?></td>
                            <td><?= htmlspecialchars($f['endereco_cidade']) ?></td>
                            <td><?= htmlspecialchars($f['endereco_estado']) ?></td>
                            <td><?= $f['data_cadastro'] ?></td>
                            <td><?= htmlspecialchars($f['status_fornecedor']) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                
                <hr>

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

