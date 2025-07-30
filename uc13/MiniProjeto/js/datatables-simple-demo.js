window.addEventListener('DOMContentLoaded', event => {
    // Simple-DataTables
    // https://github.com/fiduswriter/Simple-DataTables/wiki

    const datatablesSimple = document.getElementById('datatablesSimple');
    if (datatablesSimple) {
        new simpleDatatables.DataTable(datatablesSimple);
    }
    const datatablesUsuario = document.getElementById('datatablesUsuario');
    if (datatablesUsuario) {
        new simpleDatatables.DataTable(datatablesUsuario);
    }
    const datatablesFornecedor = document.getElementById('datatablesFornecedor');
    if (datatablesFornecedor) {
        new simpleDatatables.DataTable(datatablesFornecedor);
    }
    const datatablesProduto = document.getElementById('datatablesProduto');
    if (datatablesProduto) {
        new simpleDatatables.DataTable(datatablesProduto);
    }
    const datatablesCategoria = document.getElementById('datatablesCategoria');
    if (datatablesCategoria) {
        new simpleDatatables.DataTable(datatablesCategoria);
    }
});
