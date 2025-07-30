<?php include_once("crud_usuario.php"); ?>

<body class="bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12 col-md-12">
                <div class="form-container">
                    <div class="form-header">
                        <h2 class="mb-0">
                            <i class="bi bi-person-plus-fill me-2"></i>
                            Cadastro de Usuário
                        </h2>
                        <p class="mb-0 mt-2">Gerenciar dados dos usuários do sistema</p>
                    </div>

                    <!-- Formulário de Pesquisa -->
                    <form action="sistema.php?tela=usuario" method="POST" class="mb-3">
                        <div class="search-section">
                            <div class="row">
                                <div class="col-md-8 mb-3">
                                    <label for="pesquisar_id" class="form-label">
                                        <i class="bi bi-hash me-1"></i>
                                        Pesquisar por ID
                                    </label>
                                    <input type="text" class="form-control" id="pesquisar_id" name="pesquisar_id" 
                                           placeholder="Digite o ID para pesquisar">
                                </div>
                                <div class="col-md-4 mb-3 d-flex align-items-end">
                                    <button class="btn btn-info-custom btn-custom w-100" type="submit" name="acao" value="pesquisar">
                                        <i class="bi bi-search me-1"></i>
                                        Pesquisar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <!-- Formulário Principal -->
                    <form id="userForm" action="sistema.php?tela=usuario" method="POST" enctype="multipart/form-data">
                        
                        <!-- Campos de Informação -->
                        <div class="row mb-4">
                            <div class="col-md-6 mb-3">
                                <label for="txtId" class="form-label">
                                    <i class="bi bi-hash me-1"></i>
                                    ID do Usuário
                                </label>
                                <input type="text" class="form-control readonly-field" id="txtId" name="txtId" 
                                       placeholder="Auto gerado pelo sistema" readonly 
                                       value="<?=$id ?>">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="txtDataCadastro" class="form-label">
                                    <i class="bi bi-calendar-check me-1"></i>
                                    Data de Cadastro
                                </label>
                                <input type="text" class="form-control readonly-field" id="txtDataCadastro" name="txtDataCadastro" 
                                       placeholder="Data será preenchida automaticamente" readonly
                                       value="<?=$data ?>">
                            </div>
                        </div>
                        
                        <div class="row">
                            <!-- Nome do Usuário -->
                            <div class="col-md-12 mb-3">
                                <label for="txtNome" class="form-label">
                                    <i class="bi bi-person me-1"></i>
                                    Nome Completo <span class="required">*</span>
                                </label>
                                <input type="text" class="form-control" id="txtNome" name="txtNome" 
                                       placeholder="Digite o nome completo" maxlength="50" required
                                       value="<?=$nome ?>">
                                <div class="invalid-feedback">
                                    Por favor, informe o nome do usuário.
                                </div>
                            </div>

                            
                        </div>

                        <div class="row">
                            <!-- Login do Usuário -->
                            <div class="col-md-3 mb-3">
                                <label for="txtLogin" class="form-label">
                                    <i class="bi bi-at me-1"></i>
                                    Login <span class="required">*</span>
                                </label>
                                <input type="text" class="form-control" id="txtLogin" name="txtLogin" 
                                       placeholder="Digite o login" maxlength="30" required 
                                       value="<?=$login ?>">
                                <div class="invalid-feedback">
                                    Por favor, informe o login do usuário.
                                </div>
                            </div>

                            <!-- Senha do Usuário -->
                            <div class="col-md-3 mb-3">
                                <label for="txtSenha" class="form-label">
                                    <i class="bi bi-lock me-1"></i>
                                    Senha <span class="required">*</span>
                                </label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="txtSenha" name="txtSenha" 
                                           placeholder="Digite a senha" maxlength="30" required>
                                    <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                        <i class="bi bi-eye" id="eyeIcon"></i>
                                    </button>
                                </div>
                                <div class="invalid-feedback">
                                    Por favor, informe a senha do usuário.
                                </div>
                            </div>

                            <!-- Função do Usuário -->
                            <div class="col-md-3 mb-3">
                                <label for="txtFuncao" class="form-label">
                                    <i class="bi bi-briefcase me-1"></i>
                                    Função <span class="required">*</span>
                                </label>
                                <select class="form-select" id="txtFuncao" name="txtFuncao" required>
                                    <option value="">Selecione a função</option>
                                    <option value="Administrador" <?=($funcao=="Administrador")?'selected':'' ?>>Administrador</option>
                                    <option value="Gerente" <?=($funcao=="Gerente")?'selected':'' ?>>Gerente</option>
                                    <option value="Operador" <?=($funcao=="Operador")?'selected':'' ?>>Operador</option>
                                    <option value="Usuário" <?=($funcao=="Usuário")?'selected':'' ?>>Usuário</option>
                                    <option value="Suporte" <?=($funcao=="Suporte")?'selected':'' ?>>Suporte</option>
                                </select>
                                <div class="invalid-feedback">
                                    Por favor, selecione a função do usuário.
                                </div>
                            </div>
                        

                            <!-- Status do Usuário -->
                            <div class="col-md-3 mb-3">
                                <label for="txtStatus" class="form-label">
                                    <i class="bi bi-check-circle me-1"></i>
                                    Status <span class="required">*</span>
                                </label>
                                <select class="form-select" id="txtStatus" name="txtStatus" required>
                                    <option value="">Selecione o status</option>
                                    <option value="Ativo" <?=($status=="Ativo")?'selected':'' ?>>Ativo</option>
                                    <option value="Inativo" <?=($status=="Inativo")?'selected':'' ?>>Inativo</option>
                                    <option value="Suspenso" <?=($status=="Suspenso")?'selected':'' ?>>Suspenso</option>
                                    <option value="Pendente" <?=($status=="Pendente")?'selected':'' ?>>Pendente</option>
                                </select>
                                <div class="invalid-feedback">
                                    Por favor, selecione o status do usuário.
                                </div>
                            </div>
                        </div>
                        <!-- Foto do Usuário -->
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">
                                    <i class="bi bi-camera me-1"></i>
                                    Foto do Usuário
                                </label>
                                <div class="photo-preview text-center" onclick="document.getElementById('txtFoto').click()">
                                        <div id="photo-placeholder">
                                            <i class="bi bi-camera fs-1 text-muted"></i>
                                            <p class="text-muted mt-2">Clique para adicionar foto</p>
                                        </div>
                                        <img id="photo-preview-img" style="display: none;">
                                        <img id="" src="<?='imagem/'.$id.'/'.$foto ?>">
                                </div>
                                <input type="file" class="form-control d-none" id="txtFoto" name="txtFoto" 
                                       accept="image/*" onchange="previewPhoto(this)">
                                <small class="text-muted">Formatos aceitos: JPG, PNG, GIF (Max: 2MB)</small>
                            </div>

                            <!-- Observações -->
                            <div class="col-md-8 mb-3">
                                <label for="txtObs" class="form-label">
                                    <i class="bi bi-chat-text me-1"></i>
                                    Observações
                                </label>
                                <textarea class="form-control" id="txtObs" name="txtObs" 
                                          rows="6" placeholder="Digite observações sobre o usuário..." 
                                          maxlength="255"><?=$obs ?></textarea>
                                <div class="form-text">
                                    <span id="char-count"></span>/255 caracteres
                                </div>
                            </div>
                        </div>

                        <!-- Botões de Ação -->
                        <div class="action-buttons">
                            <div class="row">
                                <div class="col-12">
                                    <div class="d-flex justify-content-center flex-wrap gap-2">
                                        <button type="submit" class="btn btn-success-custom btn-custom" name="acao" value="cadastrar" onclick="return confirmAction('cadastrar')">
                                            <i class="bi bi-plus-circle me-2"></i>
                                            Cadastrar
                                        </button>
                                        <button type="submit" class="btn btn-warning-custom btn-custom" name="acao" value="alterar" onclick="return confirmAction('alterar')">
                                            <i class="bi bi-pencil-square me-2"></i>
                                            Alterar
                                        </button>
                                        <button type="submit" class="btn btn-danger-custom btn-custom" name="acao" value="excluir" onclick="return confirmAction('excluir')">
                                            <i class="bi bi-trash3 me-2"></i>
                                            Excluir
                                        </button>
                                        <button type="button" class="btn btn-outline-warning btn-custom" id="btnLimpar">
                                            <i class="bi bi-arrow-clockwise me-2"></i>
                                            Limpar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
  
    <script>
        // Função para confirmar ações
        function confirmAction(acao) {
            switch(acao) {
                case 'cadastrar':
                    return confirm('Deseja cadastrar este usuário?');
                case 'alterar':
                    const id = document.getElementById('txtId').value;
                    if (!id) {
                        alert('Por favor, pesquise um usuário primeiro para alterar.');
                        return false;
                    }
                    return confirm('Deseja alterar este usuário?');
                case 'excluir':
                    const idExcluir = document.getElementById('txtId').value;
                    if (!idExcluir) {
                        alert('Por favor, pesquise um usuário primeiro para excluir.');
                        return false;
                    }
                    return confirm('ATENÇÃO: Tem certeza que deseja EXCLUIR este usuário?\n\nEsta ação não pode ser desfeita!');
                default:
                    return true;
            }
        }

        // Botão Limpar
        document.getElementById('btnLimpar').addEventListener('click', function() {
            if (confirm('Deseja limpar todos os campos do formulário?')) {
                limparFormulario();
            }
        });

        // Função para limpar formulário
        function limparFormulario() {
            document.getElementById('userForm').reset();
            document.getElementById('txtId').value = '';
            document.getElementById('txtDataCadastro').value = '';
            
            // Limpar preview da foto
            document.getElementById('photo-preview-img').style.display = 'none';
            const placeholder = document.getElementById('photo-placeholder');
            if (placeholder) {
                placeholder.style.display = 'block';
            }
            
            // Resetar contador de caracteres
            document.getElementById('char-count').textContent = '0';
            document.getElementById('char-count').className = '';
            
            // Remover classes de validação
            document.getElementById('userForm').classList.remove('was-validated');
        }

        // Preview da foto
        function previewPhoto(input) {
            const placeholder = document.getElementById('photo-placeholder');
            const preview = document.getElementById('photo-preview-img');
            
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                    if (placeholder) {
                        placeholder.style.display = 'none';
                    }
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Toggle da senha
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordField = document.getElementById('txtSenha');
            const eyeIcon = document.getElementById('eyeIcon');
            
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                eyeIcon.className = 'bi bi-eye-slash';
            } else {
                passwordField.type = 'password';
                eyeIcon.className = 'bi bi-eye';
            }
        });

        // Validação Bootstrap
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                const forms = document.getElementsByClassName('needs-validation');
                Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
</body>
</html>
