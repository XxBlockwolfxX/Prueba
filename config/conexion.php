<?php
class Clase_Conectar {
    public static function Procedimiento_Conectar() {
        try {
            $con = new PDO("mysql:host=localhost;dbname=ventas", "root", "");
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $con;
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }
}
?>
