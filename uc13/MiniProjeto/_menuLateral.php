<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <div class="sb-sidenav-menu-heading">Core</div>
            <a class="nav-link" href="sistema.php">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Dashboard
            </a>
            <a class="nav-link" href="sistema.php?tela=usuario">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Usuário
            </a>
            <a class="nav-link" href="sistema.php?tela=usuario2">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Usuário2
            </a>
            <a class="nav-link" href="sistema.php?tela=categoria">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Categoria
            </a>

            <a class="nav-link" href="sistema.php?tela=produto">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Produto
            </a>
            <a class="nav-link" href="sistema.php?tela=fornecedor">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Fornecedor
            </a>
            <a class="nav-link" href="sistema.php?tela=movimentacao">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Movimentacao
            </a>

            
            <div class="sb-sidenav-menu-heading">Tables</div>
            
            <a class="nav-link" href="sistema.php?tela=tabelaUsuario">
                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                Tabela Usuário
            </a>
            <a class="nav-link" href="sistema.php?tela=tabelaCategoria">
                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                Tabela Categoria
            </a>
            <a class="nav-link" href="sistema.php?tela=tabelaProduto">
                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                Tabela Produto
            </a>
            <a class="nav-link" href="sistema.php?tela=tabelaFornecedor">
                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                Tabela Fornecedor
            </a>
        </div>
    </div>
    <div class="sb-sidenav-footer">
        <div class="small">Logged in as: <b>
                <?= $NomeUsuario_Sessao; ?>
            </b></div>
        Start Bootstrap
    </div>
</nav>