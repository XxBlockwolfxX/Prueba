document.addEventListener('DOMContentLoaded', function () {
    var productoModal = new bootstrap.Modal(document.getElementById('productoModal'), {});

    // Editar producto
    document.querySelectorAll('.btnEditarProducto').forEach(function (button) {
        button.addEventListener('click', function () {
            var id = this.getAttribute('data-id');
            fetch(`../controller/productos.controller.php?action=get&id=${id}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('idProducto').value = data.producto_id;
                    document.getElementById('nombre').value = data.nombre;
                    document.getElementById('descripcion').value = data.descripcion;
                    document.getElementById('precio').value = data.precio;
                    document.getElementById('stock').value = data.stock;
                    document.getElementById('productoForm').action = '../controller/productos.controller.php?action=edit';
                    document.getElementById('productoModalLabel').textContent = 'Editar Producto';
                    productoModal.show();
                });
        });
    });

    // Nuevo producto
    document.querySelector('[data-bs-target="#productoModal"]').addEventListener('click', function () {
        document.getElementById('idProducto').value = '';
        document.getElementById('nombre').value = '';
        document.getElementById('descripcion').value = '';
        document.getElementById('precio').value = '';
        document.getElementById('stock').value = '';
        document.getElementById('productoForm').action = '../controller/productos.controller.php?action=add';
        document.getElementById('productoModalLabel').textContent = 'Agregar Producto';
    });

    // Guardar producto (Agregar o Editar)
    document.getElementById('productoForm').addEventListener('submit', function (event) {
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

    // Eliminar producto
    document.querySelectorAll('.btnEliminarProducto').forEach(function (button) {
        button.addEventListener('click', function () {
            var id = this.getAttribute('data-id');

            if (confirm('¿Está seguro de que desea eliminar este producto?')) {
                fetch(`../controller/productos.controller.php?action=delete`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `idProducto=${id}`
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
