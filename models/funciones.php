<?php
    class Funciones extends Conectar{
        public function getProductos(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM `productos`";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }
        public function postInsert($idProducto, $nombreProducto, $precio, $cantidad) {
            $conectar = parent::Conexion();
            parent::set_names();
        
            $comparacion = "SELECT FK_id_producto from Ingreso where FK_id_producto= ?";
            $comparacion = $conectar->prepare($comparacion);
            $comparacion->bindValue(1, $idProducto);
            $comparacion->execute();
            $resultado = $comparacion->fetchAll(PDO::FETCH_ASSOC);
        
            if (empty($resultado)) {
                $sql = "INSERT INTO productos(nombreProducto, precio, cantidad, fechaRegistro) VALUES(?,?,?,NOW())";
                $sql = $conectar->prepare($sql);
                $sql->bindValue(1, $nombreProducto);
                $sql->bindValue(2, $precio);
                $sql->bindValue(3, $cantidad);
                $sql->execute();
        
                $sql2 = "INSERT INTO ingreso (FK_id_producto, nombreProducto, precio, cantidad, fechaIngreso)
                         VALUES (?, ?, ?, ?, NOW())";
                $sql2 = $conectar->prepare($sql2);
                $sql2->bindValue(1, $idProducto);
                $sql2->bindValue(2, $nombreProducto);
                $sql2->bindValue(3, $precio);
                $sql2->bindValue(4, $cantidad);
                $sql2->execute();
            } else {
                $sql = "INSERT INTO ingreso (FK_id_producto, nombreProducto, precio, cantidad, fechaIngreso)
                        VALUES (?, ?, ?, ?, NOW())";
                $sql = $conectar->prepare($sql);
                $sql->bindValue(1, $idProducto);
                $sql->bindValue(2, $nombreProducto);
                $sql->bindValue(3, $precio);
                $sql->bindValue(4, $cantidad);
                $sql->execute();
        
                $sql2 = "UPDATE productos SET cantidad = cantidad + ? WHERE id_producto = ?";
                $sql2 = $conectar->prepare($sql2);
                $sql2->bindValue(1, $cantidad);
                $sql2->bindValue(2, $idProducto);
                $sql2->execute();
            }
        }
            public function postVenta($idProducto, $cantidad) {
                $conectar = parent::Conexion();
                parent::set_names();
                $VerificarCantidad = "SELECT cantidad FROM productos WHERE id_producto = ?";
                $VerificarCantidad = $conectar->prepare($VerificarCantidad);
                $VerificarCantidad->bindValue(1, $idProducto);
                $VerificarCantidad->execute();
                $cantidadDisponible = $VerificarCantidad->fetchColumn();

    if ($cantidadDisponible < $cantidad || $cantidadDisponible <= 0) {
       
        echo "Error: No hay suficiente cantidad disponible para la venta.";
    }else{
                $sql = "INSERT into ventas(fk_id_producto, cantidad, fecha_venta) values (?,?,NOW())";
                $sql = $conectar->prepare($sql);
                $sql->bindValue(1, $idProducto);
                $sql->bindValue(2, $cantidad);
                $sql->execute();

                $sql2 = "UPDATE productos SET cantidad = cantidad - ? WHERE id_producto = ?";
                $sql2 = $conectar->prepare($sql2);
                $sql2->bindValue(1, $cantidad);
                $sql2->bindValue(2, $idProducto);
                $sql2->execute();
        }
    }
    public function delete($idProducto){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="DELETE FROM productos WHERE id_producto = ?";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1, $idProducto);
        $sql->execute();
        return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
    }
    }

?>

