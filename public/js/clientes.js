document.addEventListener('DOMContentLoaded', function () {
    var clienteModal = new bootstrap.Modal(document.getElementById('clienteModal'), {});

    // Editar cliente
    document.querySelectorAll('.btnEditarCliente').forEach(function (button) {
        button.addEventListener('click', function () {
            var id = this.getAttribute('data-id');
            fetch(`../controller/clientes.controller.php?action=get&id=${id}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('idCliente').value = data.cliente_id;
                    document.getElementById('nombre').value = data.nombre;
                    document.getElementById('apellido').value = data.apellido;
                    document.getElementById('email').value = data.email;
                    document.getElementById('telefono').value = data.telefono;
                    document.getElementById('clienteForm').action = '../controller/clientes.controller.php?action=edit';
                    document.getElementById('clienteModalLabel').textContent = 'Editar Cliente';
                    clienteModal.show();
                });
        });
    });

    // Nuevo cliente
    document.querySelector('[data-bs-target="#clienteModal"]').addEventListener('click', function () {
        document.getElementById('idCliente').value = '';
        document.getElementById('nombre').value = '';
        document.getElementById('apellido').value = '';
        document.getElementById('email').value = '';
        document.getElementById('telefono').value = '';
        document.getElementById('clienteForm').action = '../controller/clientes.controller.php?action=add';
        document.getElementById('clienteModalLabel').textContent = 'Agregar Cliente';
    });

    // Guardar cliente (Agregar o Editar)
    document.getElementById('clienteForm').addEventListener('submit', function (event) {
        event.preventDefault();
        var formData = new FormData(this);
        var action = this.action;

        fetch(action, {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(result => {
            console.log(result);
            window.location.reload();
        })
        .catch(error => console.error('Error:', error));
    });

    // Eliminar cliente
    document.querySelectorAll('.btnEliminarCliente').forEach(function (button) {
        button.addEventListener('click', function () {
            var id = this.getAttribute('data-id');

            if (confirm('¿Está seguro de que desea eliminar este cliente?')) {
                fetch(`../controller/clientes.controller.php?action=delete`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `idCliente=${id}`
                })
                .then(response => response.text())
                .then(result => {
                    console.log(result);
                    window.location.reload();
                })
                .catch(error => console.error('Error:', error));
            }
        });
    });
});
