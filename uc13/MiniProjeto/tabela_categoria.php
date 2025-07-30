
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Tabela de Categorias</h1>
        
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Tabela de Categoria
            </div>
            <div class="card-body">

            <?php
                include_once('conexao.php'); // ajuste o caminho da conexão conforme seu projeto

                $sql = $conn->prepare("
                    SELECT 
                        id_categoria,
                        nome_categoria,
                        descricao_categoria,
                        obs_categoria,
                        status_categoria
                    FROM categoria
                    ORDER BY nome_categoria ASC
                ");
                $sql->execute();
                $categorias = $sql->fetchAll(PDO::FETCH_ASSOC);
                ?>

                <table id="datatablesCategoria" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Descrição</th>
                            <th>Observações</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Descrição</th>
                            <th>Observações</th>
                            <th>Status</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach ($categorias as $categoria): ?>
                        <tr>
                            <td><?= htmlspecialchars($categoria['id_categoria']) ?></td>
                            <td><?= htmlspecialchars($categoria['nome_categoria']) ?></td>
                            <td><?= htmlspecialchars($categoria['descricao_categoria']) ?></td>
                            <td><?= htmlspecialchars($categoria['obs_categoria']) ?></td>
                            <td><?= htmlspecialchars($categoria['status_categoria']) ?></td>
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

