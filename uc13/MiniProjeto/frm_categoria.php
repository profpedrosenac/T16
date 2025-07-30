<body class="bg-light">
  <div class="container py-4">
    <div class="row justify-content-center">
      <div class="col-lg-8 col-md-10 bg-white shadow rounded p-4">

        <h2 class="mb-3"><i class="bi bi-tags me-2"></i>Cadastro de Categoria</h2>

        <!-- Formulário de pesquisa -->
        <form id="searchForm" novalidate class="needs-validation" onsubmit="submitSearch(event)">
          <div class="row mb-3 align-items-end">
            <div class="col-md-8">
              <label for="pesquisar_id" class="form-label">
                <i class="bi bi-hash me-1"></i> Pesquisar por ID
              </label>
              <input type="text" class="form-control" id="pesquisar_id" name="pesquisar_id" placeholder="Digite o ID para pesquisar" required />
              <div class="invalid-feedback">Informe o ID para pesquisa.</div>
            </div>
            <div class="col-md-4">
              <button type="submit" class="btn btn-info btn-custom w-100">
                <i class="bi bi-search me-1"></i> Pesquisar
              </button>
            </div>
          </div>
        </form>

        <!-- Mensagens -->
        <div id="messageBox" class="mb-3"></div>

        <!-- Formulário principal -->
        <form id="categoriaForm" method="POST" novalidate class="needs-validation">

          <div class="mb-3">
            <label for="txtId" class="form-label">
              <i class="bi bi-hash me-1"></i> ID da Categoria
            </label>
            <input type="text" class="form-control readonly-field" id="txtId" name="txtId" placeholder="Auto gerado pelo sistema" readonly />
          </div>

          <div class="mb-3">
            <label for="txtNome" class="form-label">
              <i class="bi bi-tag me-1"></i> Nome <span class="required">*</span>
            </label>
            <input type="text" class="form-control" id="txtNome" name="txtNome" maxlength="50" placeholder="Digite o nome da categoria" required />
            <div class="invalid-feedback">Por favor, informe o nome da categoria.</div>
          </div>

          <div class="mb-3">
            <label for="txtDescricao" class="form-label">
              <i class="bi bi-card-text me-1"></i> Descrição <span class="required">*</span>
            </label>
            <textarea class="form-control" id="txtDescricao" name="txtDescricao" rows="3" maxlength="255" placeholder="Descrição detalhada da categoria" required></textarea>
            <div class="invalid-feedback">Por favor, informe a descrição.</div>
          </div>

          <div class="mb-3">
            <label for="txtObs" class="form-label">
              <i class="bi bi-chat-text me-1"></i> Observações
            </label>
            <textarea class="form-control" id="txtObs" name="txtObs" rows="3" maxlength="255" placeholder="Observações opcionais"></textarea>
            <div class="form-text">Máximo 255 caracteres</div>
          </div>

          <div class="mb-3">
            <label for="txtStatus" class="form-label">
              <i class="bi bi-check-circle me-1"></i> Status <span class="required">*</span>
            </label>
            <select class="form-select" id="txtStatus" name="txtStatus" required>
              <option value="">Selecione o status</option>
              <option value="Ativo">Ativo</option>
              <option value="Inativo">Inativo</option>
              <option value="Pendente">Pendente</option>
              <option value="Suspenso">Suspenso</option>
            </select>
            <div class="invalid-feedback">Por favor, selecione o status.</div>
          </div>

          <div class="d-flex justify-content-center gap-2 flex-wrap">
            <button type="button" class="btn btn-success btn-custom" onclick="submitForm('cadastrar')">
              <i class="bi bi-plus-circle me-2"></i> Cadastrar
            </button>
            <button type="button" class="btn btn-warning btn-custom" onclick="submitForm('alterar')">
              <i class="bi bi-pencil-square me-2"></i> Alterar
            </button>
            <button type="button" class="btn btn-danger btn-custom" onclick="submitForm('excluir')">
              <i class="bi bi-trash3 me-2"></i> Excluir
            </button>
            <button type="button" class="btn btn-outline-secondary btn-custom" id="btnLimpar">
              <i class="bi bi-arrow-clockwise me-2"></i> Limpar
            </button>
          </div>

        </form>

      </div>
    </div>
  </div>

  <script>
    const messageBox = document.getElementById('messageBox');
    const form = document.getElementById('categoriaForm');

    // Limpar o formulário
    document.getElementById('btnLimpar').addEventListener('click', () => {
      if (confirm('Deseja limpar todos os campos do formulário?')) {
        limparFormulario();
      }
    });

    function limparFormulario() {
      form.reset();
      form.classList.remove('was-validated');
      showMessage('');
      document.getElementById('txtId').value = '';
    }

    function showMessage(message = '', type = '') {
      messageBox.innerHTML = '';
      if (!message) return;
      const div = document.createElement('div');
      div.textContent = message;
      div.style.padding = '0.75rem 1.25rem';
      div.style.marginBottom = '1rem';
      div.style.borderRadius = '0.25rem';
      div.style.fontWeight = '500';
      if (type === 'success') {
        div.style.color = '#155724';
        div.style.backgroundColor = '#d4edda';
        div.style.border = '1px solid #c3e6cb';
      } else if (type === 'error') {
        div.style.color = '#721c24';
        div.style.backgroundColor = '#f8d7da';
        div.style.border = '1px solid #f5c6cb';
      } else {
        div.style.color = '#0c5460';
        div.style.backgroundColor = '#d1ecf1';
        div.style.border = '1px solid #bee5eb';
      }
      messageBox.appendChild(div);
    }

    // Função para enviar formulário via fetch
    function submitForm(action) {
      form.classList.remove('was-validated');

      // Cria ou atualiza um input hidden 'acao' para enviar
      let inputAcao = form.querySelector('input[name="acao"]');
      if (!inputAcao) {
        inputAcao = document.createElement('input');
        inputAcao.type = 'hidden';
        inputAcao.name = 'acao';
        form.appendChild(inputAcao);
      }
      inputAcao.value = action;

      if (!form.checkValidity()) {
        form.classList.add('was-validated');
        showMessage('Por favor, preencha todos os campos obrigatórios corretamente.', 'error');
        return;
      }

      if ((action === 'alterar' || action === 'excluir') && !document.getElementById('txtId').value.trim()) {
        showMessage('Por favor, pesquise uma categoria primeiro para ' + action + '.', 'error');
        return;
      }

      let confirmMsg = '';
      switch (action) {
        case 'cadastrar': confirmMsg = 'Deseja cadastrar esta categoria?'; break;
        case 'alterar': confirmMsg = 'Deseja alterar esta categoria?'; break;
        case 'excluir': confirmMsg = 'ATENÇÃO: Tem certeza que deseja EXCLUIR esta categoria?\n\nEsta ação não pode ser desfeita!'; break;
        default: confirmMsg = '';
      }
      if (!confirmMsg || !confirm(confirmMsg)) return;

      const formData = new FormData(form);

      showMessage('Processando...', 'info');

      fetch('crud_categoria.php', {
        method: 'POST',
        body: formData
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          showMessage(data.message || 'Operação realizada com sucesso!', 'success');

          if (action === 'cadastrar' && data.data && data.data.id) {
            document.getElementById('txtId').value = data.data.id;
          }
          if (action === 'alterar') {
            // Não atualizamos o ID, mas pode tratar se precisar
          }
          if (action === 'excluir') {
            limparFormulario();
          }
        } else {
          showMessage(data.message || 'Erro ao realizar a operação.', 'error');
        }
      })
      .catch(err => {
        console.error('Erro na requisição:', err);
        showMessage('Erro na comunicação com o servidor.', 'error');
      });
    }

    // Função para pesquisar categoria por ID e preencher o formulário
    function submitSearch(event) {
      event.preventDefault();

      const searchForm = event.target;
      if (!searchForm.checkValidity()) {
        searchForm.classList.add('was-validated');
        showMessage('Por favor, informe um ID válido para pesquisa.', 'error');
        return;
      }

      const pesquisarId = document.getElementById('pesquisar_id').value.trim();
      if (!pesquisarId) {
        showMessage('Por favor, informe um ID para pesquisa.', 'error');
        return;
      }

      showMessage('Pesquisando categoria...', 'info');
      const formData = new FormData();
      formData.append('acao', 'pesquisar');
      formData.append('pesquisar_id', pesquisarId);

      fetch('crud_categoria.php', {
        method: 'POST',
        body: formData
      })
      .then(response => response.json())
      .then(data => {
        if (data.success && data.data) {
          showMessage('Categoria encontrada!', 'success');
          const cat = data.data;
          document.getElementById('txtId').value = cat.id || '';
          document.getElementById('txtNome').value = cat.nome || '';
          document.getElementById('txtDescricao').value = cat.descricao || '';
          document.getElementById('txtObs').value = cat.obs || '';
          document.getElementById('txtStatus').value = cat.status || '';
          searchForm.classList.remove('was-validated');
          form.classList.remove('was-validated');
        } else {
          showMessage(data.message || 'Categoria não encontrada.', 'error');
          limparFormulario();
        }
      })
      .catch(err => {
        console.error('Erro na pesquisa:', err);
        showMessage('Erro na comunicação com o servidor.', 'error');
      });
    }
  </script>
</body>

