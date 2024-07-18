<?php

require_once "../config/conexion.php";

class ModeloVentas {

    static public function mdlIngresarVenta($tabla, $datos) {
        $stmt = Clase_Conectar::Procedimiento_Conectar()->prepare("INSERT INTO $tabla(cliente_id, producto_id, cantidad, precio_total, fecha) VALUES (:cliente_id, :producto_id, :cantidad, :precio_total, :fecha)");

        $stmt->bindParam(":cliente_id", $datos["cliente_id"], PDO::PARAM_INT);
        $stmt->bindParam(":producto_id", $datos["producto_id"], PDO::PARAM_INT);
        $stmt->bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_INT);
        $stmt->bindParam(":precio_total", $datos["precio_total"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);

        if($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt = null;
    }

    static public function mdlMostrarVentas($tabla, $item, $valor) {
        if($item != null) {
            $stmt = Clase_Conectar::Procedimiento_Conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
            $stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
        } else {
            $stmt = Clase_Conectar::Procedimiento_Conectar()->prepare("SELECT * FROM $tabla");
            $stmt->execute();
            return $stmt->fetchAll();
        }

        $stmt = null;
    }

    static public function mdlEditarVenta($tabla, $datos) {
        $stmt = Clase_Conectar::Procedimiento_Conectar()->prepare("UPDATE $tabla SET cliente_id = :cliente_id, producto_id = :producto_id, cantidad = :cantidad, precio_total = :precio_total, fecha = :fecha WHERE venta_id = :id");

        $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
        $stmt->bindParam(":cliente_id", $datos["cliente_id"], PDO::PARAM_INT);
        $stmt->bindParam(":producto_id", $datos["producto_id"], PDO::PARAM_INT);
        $stmt->bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_INT);
        $stmt->bindParam(":precio_total", $datos["precio_total"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);

        if($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt = null;
    }

    static public function mdlEliminarVenta($tabla, $datos) {
        $stmt = Clase_Conectar::Procedimiento_Conectar()->prepare("DELETE FROM $tabla WHERE venta_id = :id");

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
