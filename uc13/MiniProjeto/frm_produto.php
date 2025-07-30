<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <title>Cadastro de Produto</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <!-- Bootstrap CSS e Bootstrap Icons (se usar) -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet" />
  <style>
    .btn-custom { min-width: 120px; }
    .readonly-field { background: #e9ecef; }
    .required { color: #c00; }
  </style>
</head>
<body class="bg-light">
  <div class="container py-4">
    <div class="row justify-content-center">
      <div class="col-lg-10 col-md-12 bg-white shadow rounded p-4">

        <h2 class="mb-3"><i class="bi bi-box-seam me-2"></i>Cadastro de Produto</h2>

        <!-- Pesquisa -->
        <form id="searchForm" novalidate class="needs-validation" onsubmit="submitSearch(event)">
          <div class="row mb-3 align-items-end">
            <div class="col-md-8">
              <label for="pesquisar_id" class="form-label">
                <i class="bi bi-hash me-1"></i> Pesquisar por ID do Produto
              </label>
              <input type="text" class="form-control" id="pesquisar_id" name="pesquisar_id" placeholder="Digite o ID para pesquisar" required />
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

        <!-- Formulário Produto -->
        <form id="produtoForm" method="POST" novalidate class="needs-validation">

          <div class="mb-3">
            <label for="txtId" class="form-label">
              <i class="bi bi-hash me-1"></i> ID do Produto
            </label>
            <input type="text" class="form-control readonly-field" id="txtId" name="txtId" readonly placeholder="Auto gerado pelo sistema" />
          </div>

          <div class="mb-3">
            <label for="txtCategoria" class="form-label">
              <i class="bi bi-tags me-1"></i> Categoria <span class="required">*</span>
            </label>
            <select class="form-select" id="txtCategoria" name="txtCategoria" required>
              <option value="">Selecione a categoria</option>
              <?php include_once('categoria_list.php')?>
            </select>
            <div class="invalid-feedback">Por favor, selecione a categoria.</div>
          </div>

          <div class="mb-3">
            <label for="txtNome" class="form-label">
              <i class="bi bi-box me-1"></i> Nome do Produto <span class="required">*</span>
            </label>
            <input type="text" class="form-control" id="txtNome" name="txtNome" maxlength="100" placeholder="Digite o nome do produto" required />
            <div class="invalid-feedback">Por favor, informe o nome do produto.</div>
          </div>

          <div class="row">
            <div class="col-md-4 mb-3">
              <label for="txtValorCusto" class="form-label">
                <i class="bi bi-cash-stack me-1"></i> Valor de Custo <span class="required">*</span>
              </label>
              <input type="number" class="form-control" id="txtValorCusto" name="txtValorCusto" step="0.01" min="0" placeholder="0.00" required />
              <div class="invalid-feedback">Informe o valor de custo.</div>
            </div>

            <div class="col-md-4 mb-3">
              <label for="txtValorVenda" class="form-label">
                <i class="bi bi-cash me-1"></i> Valor de Venda <span class="required">*</span>
              </label>
              <input type="number" class="form-control" id="txtValorVenda" name="txtValorVenda" step="0.01" min="0" placeholder="0.00" required />
              <div class="invalid-feedback">Informe o valor de venda.</div>
            </div>

            <div class="col-md-4 mb-3">
              <label for="txtQuantidade" class="form-label">
                <i class="bi bi-stack me-1"></i> Quantidade <span class="required">*</span>
              </label>
              <input type="number" class="form-control" id="txtQuantidade" name="txtQuantidade" min="0" required />
              <div class="invalid-feedback">Informe a quantidade.</div>
            </div>
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
              <option value="Suspenso">Suspenso</option>
              <option value="Pendente">Pendente</option>
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
  const form = document.getElementById('produtoForm');
  const messageBox = document.getElementById('messageBox');

  // async function carregarCategorias() {
  //   try {
  //     // Aqui você deve ter um endpoint para listar categorias, filtrando por status ativo
  //     const response = await fetch('categoria_list.php'); 
  //     const data = await response.json();
  //     const select = document.getElementById('txtCategoria');
  //     select.innerHTML = '<option value="">Selecione a categoria</option>';

  //     if (data.success && Array.isArray(data.data)) {
  //       data.data.forEach(cat => {
  //         const option = document.createElement('option');
  //         option.value = cat.id;
  //         option.textContent = cat.nome;
  //         select.appendChild(option);
  //       });
  //     } else {
  //       select.innerHTML = '<option value="">Nenhuma categoria disponível</option>';
  //       showMessage('Falha ao carregar categorias.', 'error');
  //     }
  //   } catch (error) {
  //     showMessage('Erro ao carregar categorias.', 'error');
  //     console.error('Erro ao carregar categorias:', error);
  //   }
  // }

  window.addEventListener('DOMContentLoaded', () => {
    carregarCategorias();
  });

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
      showMessage('Por favor, pesquise um produto primeiro para ' + action + '.', 'error');
      return;
    }

    let confirmMsg = '';
    switch (action) {
      case 'cadastrar': confirmMsg = 'Deseja cadastrar este produto?'; break;
      case 'alterar': confirmMsg = 'Deseja alterar este produto?'; break;
      case 'excluir': confirmMsg = 'ATENÇÃO: Tem certeza que deseja EXCLUIR este produto?\n\nEsta ação não pode ser desfeita!'; break;
      default: confirmMsg = '';
    }
    if (!confirmMsg || !confirm(confirmMsg)) return;

    const formData = new FormData(form);

    showMessage('Processando...', 'info');

    fetch('crud_produto.php', {
      method: 'POST',
      body: formData
    })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          showMessage(data.message || 'Operação realizada com sucesso!', 'success');

          if ((action === 'cadastrar') && data.data && data.data.id) {
            document.getElementById('txtId').value = data.data.id;
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

    showMessage('Pesquisando produto...', 'info');

    const formData = new FormData();
    formData.append('acao', 'pesquisar');
    formData.append('pesquisar_id', pesquisarId);

    fetch('crud_produto.php', {
      method: 'POST',
      body: formData
    })
      .then(response => response.json())
      .then(data => {
        if (data.success && data.data) {
          showMessage('Produto encontrado!', 'success');

          const p = data.data;
          document.getElementById('txtId').value = p.id || '';
          document.getElementById('txtCategoria').value = p.id_categoria || '';
          document.getElementById('txtNome').value = p.nome || '';
          document.getElementById('txtValorCusto').value = p.valor_custo || '';
          document.getElementById('txtValorVenda').value = p.valor_venda || '';
          document.getElementById('txtQuantidade').value = p.qtde || '';
          document.getElementById('txtObs').value = p.obs || '';
          document.getElementById('txtStatus').value = p.status || '';

          searchForm.classList.remove('was-validated');
          form.classList.remove('was-validated');
        } else {
          showMessage(data.message || 'Produto não encontrado.', 'error');
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
</html>
