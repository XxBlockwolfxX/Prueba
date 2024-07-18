<?php
require_once "../models/ventas.model.php";
require_once "../models/productos.model.php";

class ControladorVentas {

    static public function ctrCrearVenta() {
        if(isset($_POST["cliente_id"]) && isset($_POST["producto_id"]) && isset($_POST["cantidad"]) && isset($_POST["precio_total"])) {
            $tablaVentas = "ventas";
            $tablaProductos = "productos";
            $fecha = date('Y-m-d H:i:s'); 
            $datos = array(
                "cliente_id" => $_POST["cliente_id"],
                "producto_id" => $_POST["producto_id"],
                "cantidad" => $_POST["cantidad"],
                "precio_total" => $_POST["precio_total"],
                "fecha" => $fecha
            );

            $respuesta = ModeloVentas::mdlIngresarVenta($tablaVentas, $datos);

            if ($respuesta == "ok") {
                // Actualizar el stock del producto
                $respuestaStock = ModeloProductos::mdlActualizarStockProducto($tablaProductos, $_POST["producto_id"], $_POST["cantidad"]);
                return $respuestaStock;
            } else {
                return "error";
            }
        }
    }

    static public function ctrMostrarVentas($item, $valor) {
        $tabla = "ventas";
        $respuesta = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);
        return $respuesta;
    }

    static public function ctrEditarVenta() {
        if(isset($_POST["idVenta"]) && isset($_POST["cliente_id"]) && isset($_POST["producto_id"]) && isset($_POST["cantidad"]) && isset($_POST["precio_total"])) {
            $tabla = "ventas";
            $fecha = date('Y-m-d H:i:s');
            $datos = array(
                "id" => $_POST["idVenta"],
                "cliente_id" => $_POST["cliente_id"],
                "producto_id" => $_POST["producto_id"],
                "cantidad" => $_POST["cantidad"],
                "precio_total" => $_POST["precio_total"],
                "fecha" => $fecha
            );

            $respuesta = ModeloVentas::mdlEditarVenta($tabla, $datos);
            return $respuesta;
        }
    }

    static public function ctrEliminarVenta() {
        if(isset($_POST["idVenta"])) {
            $tabla = "ventas";
            $datos = $_POST["idVenta"];
            $respuesta = ModeloVentas::mdlEliminarVenta($tabla, $datos);
            return $respuesta;
        }
    }
}

if(isset($_GET['action'])) {
    switch($_GET['action']) {
        case 'add':
            echo ControladorVentas::ctrCrearVenta();
            break;
        case 'edit':
            echo ControladorVentas::ctrEditarVenta();
            break;
        case 'delete':
            echo ControladorVentas::ctrEliminarVenta();
            break;
        case 'get':
            if(isset($_GET['id'])) {
                $venta = ControladorVentas::ctrMostrarVentas('venta_id', $_GET['id']);
                echo json_encode($venta);
            }
            break;
    }
}
?>
