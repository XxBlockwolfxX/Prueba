<?php

require_once "../config/conexion.php";

class ModeloProductos {

    /*=============================================
    ACTUALIZAR STOCK DE PRODUCTO
    =============================================*/
    static public function mdlActualizarStockProducto($tabla, $producto_id, $cantidad) {
        $stmt = Clase_Conectar::Procedimiento_Conectar()->prepare("UPDATE $tabla SET stock = stock - :cantidad WHERE producto_id = :producto_id");

        $stmt->bindParam(":cantidad", $cantidad, PDO::PARAM_INT);
        $stmt->bindParam(":producto_id", $producto_id, PDO::PARAM_INT);

        if($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt = null;
    }

    /*=============================================
    CREAR PRODUCTO
    =============================================*/
    static public function mdlIngresarProducto($tabla, $datos) {
        $stmt = Clase_Conectar::Procedimiento_Conectar()->prepare("INSERT INTO $tabla(nombre, descripcion, precio, stock) VALUES (:nombre, :descripcion, :precio, :stock)");

        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
        $stmt->bindParam(":precio", $datos["precio"], PDO::PARAM_STR);
        $stmt->bindParam(":stock", $datos["stock"], PDO::PARAM_INT);

        if($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt = null;
    }

    /*=============================================
    MOSTRAR PRODUCTOS
    =============================================*/
    static public function mdlMostrarProductos($tabla, $item, $valor) {
        if($item != null) {
            $stmt = Clase_Conectar::Procedimiento_Conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
            $stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
            $stmt->execute();
            $resultado = $stmt->fetch();
        } else {
            $stmt = Clase_Conectar::Procedimiento_Conectar()->prepare("SELECT * FROM $tabla");
            $stmt->execute();
            $resultado = $stmt->fetchAll();
        }

        $stmt = null;
        return $resultado;
    }

    /*=============================================
    EDITAR PRODUCTO
    =============================================*/
    static public function mdlEditarProducto($tabla, $datos) {
        $stmt = Clase_Conectar::Procedimiento_Conectar()->prepare("UPDATE $tabla SET nombre = :nombre, descripcion = :descripcion, precio = :precio, stock = :stock WHERE producto_id = :id");

        $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
        $stmt->bindParam(":precio", $datos["precio"], PDO::PARAM_STR);
        $stmt->bindParam(":stock", $datos["stock"], PDO::PARAM_INT);

        if($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt = null;
    }

    /*=============================================
    ELIMINAR PRODUCTO
    =============================================*/
    static public function mdlEliminarProducto($tabla, $datos) {
        $stmt = Clase_Conectar::Procedimiento_Conectar()->prepare("DELETE FROM $tabla WHERE producto_id = :id");

        $stmt->bindParam(":id", $datos, PDO::PARAM_INT);

        if($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt = null;
    }
}
?>
