<?php

require_once "../config/conexion.php";

class ModeloClientes {

    /*=============================================
    CREAR CLIENTE
    =============================================*/
    static public function mdlIngresarCliente($tabla, $datos) {
        $stmt = Clase_Conectar::Procedimiento_Conectar()->prepare("INSERT INTO $tabla(nombre, apellido, email, telefono) VALUES (:nombre, :apellido, :email, :telefono)");

        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":apellido", $datos["apellido"], PDO::PARAM_STR);
        $stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
        $stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);

        if($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt = null;
    }

    /*=============================================
    MOSTRAR CLIENTES
    =============================================*/
    static public function mdlMostrarClientes($tabla, $item, $valor) {
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
    EDITAR CLIENTE
    =============================================*/
    static public function mdlEditarCliente($tabla, $datos) {
        $stmt = Clase_Conectar::Procedimiento_Conectar()->prepare("UPDATE $tabla SET nombre = :nombre, apellido = :apellido, email = :email, telefono = :telefono WHERE cliente_id = :id");

        $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":apellido", $datos["apellido"], PDO::PARAM_STR);
        $stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
        $stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);

        if($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt = null;
    }

    /*=============================================
    ELIMINAR CLIENTE
    =============================================*/
    static public function mdlEliminarCliente($tabla, $datos) {
        $stmt = Clase_Conectar::Procedimiento_Conectar()->prepare("DELETE FROM $tabla WHERE cliente_id = :id");

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
