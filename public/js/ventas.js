$(document).ready(function() {
    // Inicializar Select2
    $('#cliente_id').select2();
    $('#producto_id').select2();

    // Limpiar campos del formulario al abrir el modal
    $('#ventaModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Botón que abre el modal
        var modal = $(this);

        // Si es un nuevo registro
        if (!button.data('id')) {
            modal.find('.modal-title').text('Agregar Venta');
            modal.find('#idVenta').val('');
            modal.find('#cliente_id').val('').trigger('change');
            modal.find('#producto_id').val('').trigger('change');
            modal.find('#cantidad').val('');
            modal.find('#precio_total').val('');
        }
    });

    // Calcular el precio total cuando se cambia la cantidad o el producto
    $('#cantidad, #producto_id').on('change', function() {
        verificarCantidad();
    });

    function verificarCantidad() {
        var precio = $('#producto_id').find(':selected').data('precio');
        var stock = $('#producto_id').find(':selected').data('stock');
        var cantidad = $('#cantidad').val();
        var total = precio * cantidad;

        if (cantidad > stock) {
            Swal.fire({
                icon: 'warning',
                title: 'Advertencia',
                text: 'La cantidad seleccionada excede el stock disponible. Stock actual: ' + stock,
            });
            $('#cantidad').val(stock);
            total = precio * stock;
        }

        $('#precio_total').val(total.toFixed(2));
    }

    // Enviar formulario para agregar o editar venta
    $('#ventaForm').on('submit', function(e) {
        e.preventDefault();
        var action = $('#idVenta').val() ? 'edit' : 'add';
        var formData = $(this).serialize();

        $.ajax({
            url: '../controller/ventas.controller.php?action=' + action,
            type: 'POST',
            data: formData,
            success: function(response) {
                if (response === 'ok') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Venta guardada correctamente',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    setTimeout(function() {
                        location.reload();
                    }, 1500);
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error al guardar la venta',
                        text: response
                    });
                }
            }
        });
    });

    // Rellenar el formulario al editar una venta
    $('.btnEditarVenta').on('click', function() {
        var id = $(this).data('id');

        $.ajax({
            url: '../controller/ventas.controller.php?action=get&id=' + id,
            type: 'GET',
            success: function(response) {
                var venta = JSON.parse(response);
                $('#idVenta').val(venta.venta_id);
                $('#cliente_id').val(venta.cliente_id).trigger('change');
                $('#producto_id').val(venta.producto_id).trigger('change');
                $('#cantidad').val(venta.cantidad);
                $('#precio_total').val(venta.precio_total);
            }
        });
    });

    // Eliminar venta
    $('.btnEliminarVenta').on('click', function() {
        var id = $(this).data('id');

        Swal.fire({
            title: '¿Estás seguro?',
            text: "No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '../controller/ventas.controller.php?action=delete',
                    type: 'POST',
                    data: { idVenta: id },
                    success: function(response) {
                        if (response === 'ok') {
                            Swal.fire(
                                'Eliminado!',
                                'La venta ha sido eliminada.',
                                'success'
                            );
                            setTimeout(function() {
                                location.reload();
                            }, 1500);
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error al eliminar la venta',
                                text: response
                            });
                        }
                    }
                });
            }
        });
    });
});
