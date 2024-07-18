<?php
require_once "../models/clientes.model.php";

class ControladorClientes {

    /*=============================================
    CREAR CLIENTE
    =============================================*/
    static public function ctrCrearCliente() {
        if(isset($_POST["nombre"])) {
            $tabla = "clientes";
            $datos = array("nombre" => $_POST["nombre"],
                           "apellido" => $_POST["apellido"],
                           "email" => $_POST["email"],
                           "telefono" => $_POST["telefono"]);

            $respuesta = ModeloClientes::mdlIngresarCliente($tabla, $datos);
            return $respuesta;
        }
    }

    /*=============================================
    MOSTRAR CLIENTES
    =============================================*/
    static public function ctrMostrarClientes($item, $valor) {
        $tabla = "clientes";
        $respuesta = ModeloClientes::mdlMostrarClientes($tabla, $item, $valor);
        return $respuesta;
    }

    /*=============================================
    EDITAR CLIENTE
    =============================================*/
    static public function ctrEditarCliente() {
        if(isset($_POST["idCliente"])) {
            $tabla = "clientes";
            $datos = array("id" => $_POST["idCliente"],
                           "nombre" => $_POST["nombre"],
                           "apellido" => $_POST["apellido"],
                           "email" => $_POST["email"],
                           "telefono" => $_POST["telefono"]);

            $respuesta = ModeloClientes::mdlEditarCliente($tabla, $datos);
            return $respuesta;
        }
    }

    /*=============================================
    ELIMINAR CLIENTE
    =============================================*/
    static public function ctrEliminarCliente() {
        if(isset($_POST["idCliente"])) {
            $tabla = "clientes";
            $datos = $_POST["idCliente"];
            $respuesta = ModeloClientes::mdlEliminarCliente($tabla, $datos);
            return $respuesta;
        }
    }
}

if (isset($_GET['action'])) {
    $action = $_GET['action'];

    switch ($action) {
        case 'get':
            if (isset($_GET['id'])) {
                $item = "cliente_id";
                $valor = $_GET['id'];
                $cliente = ControladorClientes::ctrMostrarClientes($item, $valor);
                echo json_encode($cliente);
            }
            break;
        case 'add':
            $respuesta = ControladorClientes::ctrCrearCliente();
            echo $respuesta;
            break;
        case 'edit':
            $respuesta = ControladorClientes::ctrEditarCliente();
            echo $respuesta;
            break;
        case 'delete':
            $respuesta = ControladorClientes::ctrEliminarCliente();
            echo $respuesta;
            break;
    }
}
?>
