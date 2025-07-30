
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Tabela de Produto</h1>
        
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Tabela de Produto
            </div>
            <div class="card-body">
            <?php
            include_once('conexao.php'); // ajuste o caminho conforme sua estrutura

            // Consulta com INNER JOIN para trazer dados da categoria junto com o produto
            $sql = $conn->prepare("
                SELECT 
                    p.id_produto,
                    p.nome_produto,
                    c.nome_categoria,
                    p.valor_custo,
                    p.valor_venda,
                    p.qtde_produto,
                    p.obs_produto,
                    p.status_produto
                FROM produto p
                INNER JOIN categoria c ON p.id_categoria_produto = c.id_categoria
                ORDER BY p.nome_produto ASC
            ");
            $sql->execute();
            $produtos = $sql->fetchAll(PDO::FETCH_ASSOC);
            ?>

            <table id="datatablesProduto" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Produto</th>
                        <th>Categoria</th>
                        <th>Valor Custo</th>
                        <th>Valor Venda</th>
                        <th>Quantidade</th>
                        <th>Observações</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Produto</th>
                        <th>Categoria</th>
                        <th>Valor Custo</th>
                        <th>Valor Venda</th>
                        <th>Quantidade</th>
                        <th>Observações</th>
                        <th>Status</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php foreach ($produtos as $produto): ?>
                    <tr>
                        <td><?= htmlspecialchars($produto['id_produto']) ?></td>
                        <td><?= htmlspecialchars($produto['nome_produto']) ?></td>
                        <td><?= htmlspecialchars($produto['nome_categoria']) ?></td>
                        <td>R$ <?= number_format($produto['valor_custo'], 2, ',', '.') ?></td>
                        <td>R$ <?= number_format($produto['valor_venda'], 2, ',', '.') ?></td>
                        <td><?= htmlspecialchars($produto['qtde_produto']) ?></td>
                        <td><?= htmlspecialchars($produto['obs_produto']) ?></td>
                        <td><?= htmlspecialchars($produto['status_produto']) ?></td>
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

