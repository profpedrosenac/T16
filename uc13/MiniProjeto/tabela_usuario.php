
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Tabela de Usuários</h1>
        
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Tabela de Usuário
            </div>
            <div class="card-body">

            <?php
                include_once('conexao.php');

                // Seleciona os campos conforme seu banco.
                $sql = $conn->prepare("
                    SELECT 
                        id_usuario, 
                        nome_usuario, 
                        login_usuario, 
                        funcao_usuario, 
                        status_usuario, 
                        obs_usuario, 
                        foto_usuario, 
                        DATE_FORMAT(cad_usuario, '%d/%m/%Y %H:%i') as data_cadastro 
                    FROM usuario
                    ORDER BY id_usuario ASC
                ");
                $sql->execute();
                $usuarios = $sql->fetchAll(PDO::FETCH_ASSOC);
                ?>
                <table id="datatablesUsuario"  class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Login</th>
                            <th>Função</th>
                            <th>Status</th>
                            <th>Data de Cadastro</th>
                            <th>Observações</th>
                            <th>Foto</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Login</th>
                            <th>Função</th>
                            <th>Status</th>
                            <th>Data de Cadastro</th>
                            <th>Observações</th>
                            <th>Foto</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach ($usuarios as $usuario): ?>
                        <tr>
                            <td><?= htmlspecialchars($usuario['id_usuario']) ?></td>
                            <td><?= htmlspecialchars($usuario['nome_usuario']) ?></td>
                            <td><?= htmlspecialchars($usuario['login_usuario']) ?></td>
                            <td><?= htmlspecialchars($usuario['funcao_usuario']) ?></td>
                            <td><?= htmlspecialchars($usuario['status_usuario']) ?></td>
                            <td><?= $usuario['data_cadastro'] ?></td>
                            <td><?= htmlspecialchars($usuario['obs_usuario']) ?></td>
                            <td>
                                <?php if ($usuario['foto_usuario']): ?>
                                    <img src="<?= 'imagem/' . $usuario['id_usuario'] . '/' . $usuario['foto_usuario'] ?>" alt="Foto" style="max-width:40px;max-height:40px;border-radius:50%;">
                                <?php endif; ?>
                            </td>
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

