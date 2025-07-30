<body class="bg-light">
  <div class="container py-4">
    <div class="row justify-content-center">
      <div class="col-lg-12 col-md-12">
        <div class="form-container bg-white shadow rounded p-4">

          <div class="form-header mb-4">
            <h2 class="mb-1"><i class="bi bi-person-plus-fill me-2"></i>Cadastro de Usuário 2</h2>
            <p class="mb-0 mt-2">Gerenciar dados dos usuários do sistema</p>
          </div>

          <!-- Formulário de Pesquisa por ID -->
          <form id="searchForm" novalidate class="needs-validation" onsubmit="submitSearch(event)">
            <div class="row mb-3 align-items-end">
              <div class="col-md-8">
                <label for="pesquisar_id" class="form-label">
                  <i class="bi bi-hash me-1"></i> Pesquisar por ID
                </label>
                <input type="text" class="form-control" id="pesquisar_id" name="pesquisar_id" placeholder="Digite o ID para pesquisar" required>
                <div class="invalid-feedback">Por favor, informe o ID para pesquisar.</div>
              </div>
              <div class="col-md-4">
                <button type="submit" class="btn btn-info btn-custom w-100">
                  <i class="bi bi-search me-1"></i> Pesquisar
                </button>
              </div>
            </div>
          </form>

          <!-- Mensagens de feedback -->
          <div id="messageBox" style="margin-bottom:1rem;"></div>

          <!-- Formulário Principal -->
          <form id="userForm" method="POST" enctype="multipart/form-data" novalidate class="needs-validation">
            <div class="row mb-4">
              <div class="col-md-6 mb-3">
                <label for="txtId" class="form-label">
                  <i class="bi bi-hash me-1"></i> ID do Usuário
                </label>
                <input type="text" class="form-control readonly-field" id="txtId" name="txtId"
                  placeholder="Auto gerado pelo sistema" readonly value="">
              </div>
              <div class="col-md-6 mb-3">
                <label for="txtDataCadastro" class="form-label">
                  <i class="bi bi-calendar-check me-1"></i> Data de Cadastro
                </label>
                <input type="text" class="form-control readonly-field" id="txtDataCadastro" name="txtDataCadastro"
                  placeholder="Data será preenchida automaticamente" readonly value="">
              </div>
            </div>
            <div class="row">
              <!-- Nome do Usuário -->
              <div class="col-md-12 mb-3">
                <label for="txtNome" class="form-label">
                  <i class="bi bi-person me-1"></i>
                  Nome Completo <span class="required">*</span>
                </label>
                <input type="text" class="form-control" id="txtNome" name="txtNome" placeholder="Digite o nome completo"
                  maxlength="50" required value="">
                <div class="invalid-feedback">Por favor, informe o nome do usuário.</div>
              </div>
            </div>
            <div class="row">
              <!-- Login do Usuário -->
              <div class="col-md-3 mb-3">
                <label for="txtLogin" class="form-label">
                  <i class="bi bi-at me-1"></i>
                  Login <span class="required">*</span>
                </label>
                <input type="text" class="form-control" id="txtLogin" name="txtLogin" placeholder="Digite o login"
                  maxlength="30" required value="">
                <div class="invalid-feedback">Por favor, informe o login do usuário.</div>
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
                <div class="invalid-feedback">Por favor, informe a senha do usuário.</div>
              </div>
              <!-- Função do Usuário -->
              <div class="col-md-3 mb-3">
                <label for="txtFuncao" class="form-label"><i class="bi bi-briefcase me-1"></i>
                  Função <span class="required">*</span>
                </label>
                <select class="form-select" id="txtFuncao" name="txtFuncao" required>
                  <option value="">Selecione a função</option>
                  <option value="Administrador">Administrador</option>
                  <option value="Gerente">Gerente</option>
                  <option value="Operador">Operador</option>
                  <option value="Usuário">Usuário</option>
                  <option value="Suporte">Suporte</option>
                </select>
                <div class="invalid-feedback">Por favor, selecione a função do usuário.</div>
              </div>
              <!-- Status do Usuário -->
              <div class="col-md-3 mb-3">
                <label for="txtStatus" class="form-label"><i class="bi bi-check-circle me-1"></i>
                  Status <span class="required">*</span>
                </label>
                <select class="form-select" id="txtStatus" name="txtStatus" required>
                  <option value="">Selecione o status</option>
                  <option value="Ativo">Ativo</option>
                  <option value="Inativo">Inativo</option>
                  <option value="Suspenso">Suspenso</option>
                  <option value="Pendente">Pendente</option>
                </select>
                <div class="invalid-feedback">Por favor, selecione o status do usuário.</div>
              </div>
            </div>
            <div class="row">
              <!-- Foto do Usuário -->
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
                  <img id="photo-preview-img" style="display:none; max-width: 100%; height:auto;" alt="Preview Foto">
                </div>
                <input type="file" class="form-control d-none" id="txtFoto" name="txtFoto" accept="image/*"
                  onchange="previewPhoto(this)">
                <small class="text-muted">Formatos aceitos: JPG, PNG, GIF (Max: 2MB)</small>
              </div>
              <!-- Observações -->
              <div class="col-md-8 mb-3">
                <label for="txtObs" class="form-label">
                  <i class="bi bi-chat-text me-1"></i>
                  Observações
                </label>
                <textarea class="form-control" id="txtObs" name="txtObs" rows="6"
                  placeholder="Digite observações sobre o usuário..." maxlength="255"></textarea>
                <div class="form-text"><span id="char-count">0</span>/255 caracteres</div>
              </div>
            </div>
            <!-- Botões de ação -->
            <div class="action-buttons">
              <div class="row">
                <div class="col-12">
                  <div class="d-flex justify-content-center flex-wrap gap-2">
                    <button type="button" class="btn btn-success btn-custom" onclick="submitForm('cadastrar')">
                      <i class="bi bi-plus-circle me-2"></i> Cadastrar
                    </button>
                    <button type="button" class="btn btn-warning btn-custom" onclick="submitForm('alterar')">
                      <i class="bi bi-pencil-square me-2"></i> Alterar
                    </button>
                    <button type="button" class="btn btn-danger btn-custom" onclick="submitForm('excluir')">
                      <i class="bi bi-trash3 me-2"></i> Excluir
                    </button>
                    <button type="button" class="btn btn-outline-warning btn-custom" id="btnLimpar">
                      <i class="bi bi-arrow-clockwise me-2"></i> Limpar
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
  // Atualiza contador de caracteres das observações
  const obsField = document.getElementById('txtObs');
  const charCount = document.getElementById('char-count');
  obsField.addEventListener('input', () => {
    charCount.textContent = obsField.value.length;
  });

  // Preview da foto selecionada
  function previewPhoto(input) {
    const placeholder = document.getElementById('photo-placeholder');
    const preview = document.getElementById('photo-preview-img');

    if (input.files && input.files[0]) {
      const file = input.files[0];
      if (file.size > 2 * 1024 * 1024) { // 2MB
        alert('A foto deve ter no máximo 2MB.');
        input.value = '';
        return;
      }
      const reader = new FileReader();
      reader.onload = function (e) {
        preview.src = e.target.result;
        preview.style.display = 'block';
        if (placeholder) placeholder.style.display = 'none';
      }
      reader.readAsDataURL(file);
    }
  }

  // Toggle senha
  document.getElementById('togglePassword').addEventListener('click', () => {
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

  // Limpar o formulário
  document.getElementById('btnLimpar').addEventListener('click', () => {
    if (confirm('Deseja limpar todos os campos do formulário?')) {
      limparFormulario();
    }
  });

  function limparFormulario() {
    const form = document.getElementById('userForm');
    form.reset();

    // Limpar preview da foto
    const preview = document.getElementById('photo-preview-img');
    const placeholder = document.getElementById('photo-placeholder');
    if (preview) preview.style.display = 'none';
    if (placeholder) placeholder.style.display = 'block';

    // Reset contador caracteres observações
    charCount.textContent = '0';

    // Reset validações
    form.classList.remove('was-validated');

    // Limpar campos específicos
    document.getElementById('txtId').value = '';
    document.getElementById('txtDataCadastro').value = '';

    // Limpar mensagens
    showMessage('', '');
  }

  // Mostrar mensagens no div messageBox
  function showMessage(message, type) {
    // type: 'success', 'error', 'info'
    const box = document.getElementById('messageBox');
    box.innerHTML = '';
    if (!message) return;

    const alertDiv = document.createElement('div');
    alertDiv.textContent = message;

    alertDiv.style.padding = '0.75rem 1.25rem';
    alertDiv.style.marginBottom = '1rem';
    alertDiv.style.borderRadius = '0.25rem';
    alertDiv.style.fontWeight = '500';

    switch (type) {
      case 'success':
        alertDiv.style.color = '#155724';
        alertDiv.style.backgroundColor = '#d4edda';
        alertDiv.style.border = '1px solid #c3e6cb';
        break;
      case 'error':
        alertDiv.style.color = '#721c24';
        alertDiv.style.backgroundColor = '#f8d7da';
        alertDiv.style.border = '1px solid #f5c6cb';
        break;
      default:
        alertDiv.style.color = '#0c5460';
        alertDiv.style.backgroundColor = '#d1ecf1';
        alertDiv.style.border = '1px solid #bee5eb';
    }

    box.appendChild(alertDiv);
  }

  // Função para enviar o formulário via AJAX nativo com fetch para crud_usuario2.php
  function submitForm(action) {
    const form = document.getElementById('userForm');
    form.classList.remove('was-validated');

    // Define o input escondido para 'acao'
    let inputAcao = form.querySelector('input[name="acao"]');
    if (!inputAcao) {
      inputAcao = document.createElement('input');
      inputAcao.type = 'hidden';
      inputAcao.name = 'acao';
      form.appendChild(inputAcao);
    }
    inputAcao.value = action;

    // Validação HTML5 do formulário
    if (!form.checkValidity()) {
      form.classList.add('was-validated');
      showMessage('Por favor, preencha todos os campos obrigatórios corretamente.', 'error');
      return;
    }
    if ((action === 'alterar' || action === 'excluir') && !document.getElementById('txtId').value.trim()) {
      showMessage('Por favor, pesquise um usuário primeiro para ' + action + '.', 'error');
      return;
    }
    let confirmMsg = '';
    switch (action) {
      case 'cadastrar': confirmMsg = 'Deseja cadastrar este usuário?'; break;
      case 'alterar': confirmMsg = 'Deseja alterar este usuário?'; break;
      case 'excluir': confirmMsg = 'ATENÇÃO: Tem certeza que deseja EXCLUIR este usuário?\n\nEsta ação não pode ser desfeita!'; break;
    }
    if (!confirmMsg || !confirm(confirmMsg)) return;

    const formData = new FormData(form);

    showMessage('Processando...', 'info');

    fetch('crud_usuario2.php', {
      method: 'POST',
      body: formData
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        showMessage(data.message || 'Operação realizada com sucesso!', 'success');
        if (action === 'cadastrar' || action === 'alterar') {
          if (data.data && data.data.id) document.getElementById('txtId').value = data.data.id;
          if (data.data && data.data.dataCadastro) document.getElementById('txtDataCadastro').value = data.data.dataCadastro;
        }
        if (action === 'excluir') limparFormulario();
      } else {
        showMessage(data.message || 'Erro ao realizar a operação.', 'error');
      }
    })
    .catch(error => {
      console.error('Erro na requisição:', error);
      showMessage('Erro na comunicação com o servidor.', 'error');
    });
  }

  // Pesquisa de usuário por ID, preenche todo o formulário
  function submitSearch(event) {
    event.preventDefault();

    const form = event.target;
    if (!form.checkValidity()) {
      form.classList.add('was-validated');
      showMessage('Por favor, informe um ID válido para pesquisa.', 'error');
      return;
    }
    const pesquisarId = document.getElementById('pesquisar_id').value.trim();
    if (!pesquisarId) {
      showMessage('Por favor, informe um ID para pesquisa.', 'error');
      return;
    }
    showMessage('Pesquisando usuário...', 'info');
    const formData = new FormData();
    formData.append('acao', 'pesquisar');
    formData.append('pesquisar_id', pesquisarId);

    fetch('crud_usuario2.php', {
      method: 'POST',
      body: formData
    })
    .then(response => response.json())
    .then(data => {
      if (data.success && data.data) {
        showMessage('Usuário encontrado!', 'success');
        const user = data.data;
        document.getElementById('txtId').value = user.id || '';
        document.getElementById('txtNome').value = user.nome || '';
        document.getElementById('txtLogin').value = user.login || '';
        document.getElementById('txtSenha').value = user.senha || '';
        document.getElementById('txtFuncao').value = user.funcao || '';
        document.getElementById('txtStatus').value = user.status || '';
        document.getElementById('txtObs').value = user.obs || '';
        document.getElementById('txtDataCadastro').value = user.dataCadastro || '';
        const preview = document.getElementById('photo-preview-img');
        const placeholder = document.getElementById('photo-placeholder');
        if (user.foto) {
          preview.src = 'imagem/' + user.id + '/' + user.foto;
          preview.style.display = 'block';
          if (placeholder) placeholder.style.display = 'none';
        } else {
          preview.style.display = 'none';
          if (placeholder) placeholder.style.display = 'block';
        }
        charCount.textContent = user.obs ? user.obs.length : '0';
      } else {
        showMessage(data.message || "Usuário não encontrado.", 'error');
        limparFormulario();
      }
    })
    .catch(error => {
      console.error('Erro na pesquisa:', error);
      showMessage('Erro na comunicação com o servidor.', 'error');
    });
  }
</script>
</body>
