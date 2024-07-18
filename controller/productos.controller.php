<?php
require_once "../models/productos.model.php";

class ControladorProductos {

    /*=============================================
    CREAR PRODUCTO
    =============================================*/
    static public function ctrCrearProducto() {
        if(isset($_POST["nombre"])) {
            $tabla = "productos";
            $datos = array("nombre" => $_POST["nombre"],
                           "descripcion" => $_POST["descripcion"],
                           "precio" => $_POST["precio"],
                           "stock" => $_POST["stock"]);

            $respuesta = ModeloProductos::mdlIngresarProducto($tabla, $datos);
            return $respuesta;
        }
    }

    /*=============================================
    MOSTRAR PRODUCTOS
    =============================================*/
    static public function ctrMostrarProductos($item, $valor) {
        $tabla = "productos";
        $respuesta = ModeloProductos::mdlMostrarProductos($tabla, $item, $valor);
        return $respuesta;
    }

    /*=============================================
    EDITAR PRODUCTO
    =============================================*/
    static public function ctrEditarProducto() {
        if(isset($_POST["idProducto"])) {
            $tabla = "productos";
            $datos = array("id" => $_POST["idProducto"],
                           "nombre" => $_POST["nombre"],
                           "descripcion" => $_POST["descripcion"],
                           "precio" => $_POST["precio"],
                           "stock" => $_POST["stock"]);

            $respuesta = ModeloProductos::mdlEditarProducto($tabla, $datos);
            return $respuesta;
        }
    }

    /*=============================================
    ELIMINAR PRODUCTO
    =============================================*/
    static public function ctrEliminarProducto() {
        if(isset($_POST["idProducto"])) {
            $tabla = "productos";
            $datos = $_POST["idProducto"];
            $respuesta = ModeloProductos::mdlEliminarProducto($tabla, $datos);
            return $respuesta;
        }
    }
}

if (isset($_GET['action'])) {
    $action = $_GET['action'];

    switch ($action) {
        case 'get':
            if (isset($_GET['id'])) {
                $item = "producto_id";
                $valor = $_GET['id'];
                $producto = ControladorProductos::ctrMostrarProductos($item, $valor);
                echo json_encode($producto);
            }
            break;
        case 'add':
            $respuesta = ControladorProductos::ctrCrearProducto();
            echo $respuesta;
            break;
        case 'edit':
            $respuesta = ControladorProductos::ctrEditarProducto();
            echo $respuesta;
            break;
        case 'delete':
            $respuesta = ControladorProductos::ctrEliminarProducto();
            echo $respuesta;
            break;
    }
}
?>
