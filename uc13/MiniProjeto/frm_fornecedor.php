<body class="bg-light">
<div class="container py-4">
  <div class="row justify-content-center">
    <div class="col-lg-10 col-md-12 bg-white shadow rounded p-4">
      <h2 class="mb-3"><i class="bi bi-truck me-2"></i>Cadastro de Fornecedor</h2>

      <!-- Pesquisa -->
      <form id="searchForm" novalidate class="needs-validation" onsubmit="submitSearch(event)">
        <div class="row mb-3 align-items-end">
          <div class="col-md-8">
            <label for="pesquisar_id" class="form-label"><i class="bi bi-hash me-1"></i> Pesquisar por ID</label>
            <input type="text" class="form-control" id="pesquisar_id" name="pesquisar_id" placeholder="Digite o ID para pesquisar" required>
            <div class="invalid-feedback">Informe o ID para busca.</div>
          </div>
          <div class="col-md-4">
            <button type="submit" class="btn btn-info btn-custom w-100">
              <i class="bi bi-search me-1"></i> Pesquisar
            </button>
          </div>
        </div>
      </form>

      <div id="messageBox" class="mb-3"></div>

      <!-- Formulário Fornecedor -->
      <form id="fornecedorForm" method="POST" novalidate class="needs-validation">
        <div class="row">
          <div class="col-md-4 mb-3">
            <label for="txtId" class="form-label"><i class="bi bi-hash me-1"></i> ID</label>
            <input type="text" class="form-control readonly-field" id="txtId" name="txtId" readonly placeholder="Auto gerado pelo sistema" />
          </div>
          <div class="col-md-8 mb-3">
            <label for="txtNome" class="form-label"><i class="bi bi-person me-1"></i> Nome <span class="required">*</span></label>
            <input type="text" class="form-control" id="txtNome" name="txtNome" maxlength="100" required placeholder="Nome do fornecedor" />
            <div class="invalid-feedback">Informe o nome do fornecedor.</div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-4 mb-3">
            <label for="txtCnpj" class="form-label"><i class="bi bi-123 me-1"></i> CNPJ <span class="required">*</span></label>
            <input type="text" class="form-control" id="txtCnpj" name="txtCnpj" maxlength="18" required placeholder="00.000.000/0000-00" />
            <div class="invalid-feedback">Informe o CNPJ.</div>
          </div>
          <div class="col-md-4 mb-3">
            <label for="txtEmail" class="form-label"><i class="bi bi-envelope me-1"></i> E-mail <span class="required">*</span></label>
            <input type="email" class="form-control" id="txtEmail" name="txtEmail" maxlength="100" required />
            <div class="invalid-feedback">Informe um e-mail válido.</div>
          </div>
          <div class="col-md-4 mb-3">
            <label for="txtTelefone" class="form-label"><i class="bi bi-telephone me-1"></i> Telefone <span class="required">*</span></label>
            <input type="text" class="form-control" id="txtTelefone" name="txtTelefone" maxlength="20" required placeholder="(99) 99999-9999" />
            <div class="invalid-feedback">Informe o telefone.</div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-4 mb-3">
            <label for="txtRua" class="form-label">Rua <span class="required">*</span></label>
            <input type="text" class="form-control" id="txtRua" name="txtRua" maxlength="100" required />
            <div class="invalid-feedback">Rua obrigatória.</div>
          </div>
          <div class="col-md-2 mb-3">
            <label for="txtNumero" class="form-label">Número <span class="required">*</span></label>
            <input type="text" class="form-control" id="txtNumero" name="txtNumero" maxlength="10" required />
            <div class="invalid-feedback">Número obrigatório.</div>
          </div>
          <div class="col-md-3 mb-3">
            <label for="txtComplemento" class="form-label">Complemento</label>
            <input type="text" class="form-control" id="txtComplemento" name="txtComplemento" maxlength="50" />
          </div>
          <div class="col-md-3 mb-3">
            <label for="txtBairro" class="form-label">Bairro <span class="required">*</span></label>
            <input type="text" class="form-control" id="txtBairro" name="txtBairro" maxlength="50" required />
            <div class="invalid-feedback">Bairro obrigatório.</div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-5 mb-3">
            <label for="txtCidade" class="form-label">Cidade <span class="required">*</span></label>
            <input type="text" class="form-control" id="txtCidade" name="txtCidade" maxlength="50" required />
            <div class="invalid-feedback">Cidade obrigatória.</div>
          </div>
          <div class="col-md-2 mb-3">
            <label for="txtEstado" class="form-label">Estado <span class="required">*</span></label>
            <input type="text" class="form-control" id="txtEstado" name="txtEstado" maxlength="2" required placeholder="UF" />
            <div class="invalid-feedback">Estado obrigatório.</div>
          </div>
          <div class="col-md-3 mb-3">
            <label for="txtCep" class="form-label">CEP <span class="required">*</span></label>
            <input type="text" class="form-control" id="txtCep" name="txtCep" maxlength="9" required placeholder="00000-000" />
            <div class="invalid-feedback">CEP obrigatório.</div>
          </div>
          <div class="col-md-2 mb-3">
            <label for="txtDataCadastro" class="form-label">Cadastro</label>
            <input type="text" class="form-control readonly-field" id="txtDataCadastro" name="txtDataCadastro" readonly placeholder="Preenchido aut." />
          </div>
        </div>

        <div class="mb-3">
          <label for="txtObs" class="form-label"><i class="bi bi-chat-text me-1"></i> Observações</label>
          <textarea class="form-control" id="txtObs" name="txtObs" rows="3" maxlength="255" placeholder="Observações opcionais"></textarea>
          <div class="form-text">Máximo 255 caracteres</div>
        </div>

        <div class="mb-3">
          <label for="txtStatus" class="form-label"><i class="bi bi-check-circle me-1"></i> Status <span class="required">*</span></label>
          <select class="form-select" id="txtStatus" name="txtStatus" required>
            <option value="">Selecione o status</option>
            <option value="Ativo">Ativo</option>
            <option value="Inativo">Inativo</option>
            <option value="Pendente">Pendente</option>
            <option value="Suspenso">Suspenso</option>
          </select>
          <div class="invalid-feedback">Selecione o status.</div>
        </div>

        <div class="d-flex justify-content-center gap-2 flex-wrap">
          <button type="button" class="btn btn-success btn-custom" onclick="submitForm('cadastrar')"><i class="bi bi-plus-circle me-2"></i> Cadastrar</button>
          <button type="button" class="btn btn-warning btn-custom" onclick="submitForm('alterar')"><i class="bi bi-pencil-square me-2"></i> Alterar</button>
          <button type="button" class="btn btn-danger btn-custom" onclick="submitForm('excluir')"><i class="bi bi-trash3 me-2"></i> Excluir</button>
          <button type="button" class="btn btn-outline-secondary btn-custom" id="btnLimpar"><i class="bi bi-arrow-clockwise me-2"></i> Limpar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
const form = document.getElementById('fornecedorForm');
const messageBox = document.getElementById('messageBox');
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
  document.getElementById('txtDataCadastro').value = '';
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

function submitForm(action) {
  form.classList.remove('was-validated');
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
    showMessage('Por favor, pesquise um fornecedor primeiro para ' + action + '.', 'error');
    return;
  }

  let confirmMsg = '';
  switch (action) {
    case 'cadastrar': confirmMsg = 'Deseja cadastrar este fornecedor?'; break;
    case 'alterar': confirmMsg = 'Deseja alterar este fornecedor?'; break;
    case 'excluir': confirmMsg = 'ATENÇÃO: Tem certeza que deseja EXCLUIR este fornecedor?\n\nEsta ação não pode ser desfeita!'; break;
    default: confirmMsg = '';
  }
  if (!confirmMsg || !confirm(confirmMsg)) return;

  const formData = new FormData(form);

  showMessage('Processando...', 'info');

  fetch('crud_fornecedor.php', {
    method: 'POST',
    body: formData
  })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        showMessage(data.message || 'Operação realizada com sucesso!', 'success');
        if ((action === 'cadastrar') && data.data && data.data.id) {
          document.getElementById('txtId').value = data.data.id;
          document.getElementById('txtDataCadastro').value = data.data.cadastro;
        }
        if (action === 'alterar' && data.data && data.data.cadastro) {
          document.getElementById('txtDataCadastro').value = data.data.cadastro;
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

  showMessage('Pesquisando fornecedor...', 'info');

  const formData = new FormData();
  formData.append('acao', 'pesquisar');
  formData.append('pesquisar_id', pesquisarId);

  fetch('crud_fornecedor.php', {
    method: 'POST',
    body: formData
  })
    .then(response => response.json())
    .then(data => {
      if (data.success && data.data) {
        showMessage('Fornecedor encontrado!', 'success');
        const f = data.data;
        document.getElementById('txtId').value = f.id || '';
        document.getElementById('txtNome').value = f.nome || '';
        document.getElementById('txtCnpj').value = f.cnpj || '';
        document.getElementById('txtEmail').value = f.email || '';
        document.getElementById('txtTelefone').value = f.telefone || '';
        document.getElementById('txtRua').value = f.rua || '';
        document.getElementById('txtNumero').value = f.numero || '';
        document.getElementById('txtComplemento').value = f.complemento || '';
        document.getElementById('txtBairro').value = f.bairro || '';
        document.getElementById('txtCidade').value = f.cidade || '';
        document.getElementById('txtEstado').value = f.estado || '';
        document.getElementById('txtCep').value = f.cep || '';
        document.getElementById('txtObs').value = f.obs || '';
        document.getElementById('txtStatus').value = f.status || '';
        document.getElementById('txtDataCadastro').value = f.cadastro || '';
        searchForm.classList.remove('was-validated');
        form.classList.remove('was-validated');
      } else {
        showMessage(data.message || 'Fornecedor não encontrado.', 'error');
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
