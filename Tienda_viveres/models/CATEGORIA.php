<?php
class Categoria extends Conectar {
    public function get_categoria() {
        try {
            $conectar = parent::Conexion();
            $sql = "SELECT * FROM ventas WHERE codigo BETWEEN 101 and 105";
            $stmt = $conectar->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Manejar el error aquí, por ejemplo, registrándolo o devolviendo un valor predeterminado.
            echo "Error en la consulta: " . $e->getMessage();
            return array();
        }
    }

    public function get_categoriax_x_id($Codigo) {
        try {
            $conectar = parent::Conexion();
            $sql = "SELECT * FROM bodega WHERE Codigo = ?";
            $stmt = $conectar->prepare($sql);
            $stmt->execute([$Codigo]);  // Cambiar $tel_usuario por $id_usuario
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Manejar el error aquí, por ejemplo, registrándolo o devolviend un valor predeterminado.
            echo "Error en la consulta: " . $e->getMessage();
            return array();
        }
    }


    public function insert_categoria($Codigo,$Nombre,$Cantidad,$precio,$fecha_de_vencimiento) {
    try {
        $conectar = parent::Conexion();
        $sql = "INSERT INTO bodega (Codigo,Nombre,Cantidad,precio,fecha_de_vencimiento) VALUES (?,?,?,?,?)";
        $stmt = $conectar->prepare($sql);
        $stmt->execute([$Codigo,$Nombre,$Canidad,$precio,$fecha_de_vencimiento]); // Cambiar $tel_usuario por $id_usuario
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // Manejar el error aquí, por ejemplo, registrándolo o devolviend un valor predeterminado.
        echo "Error en la consulta: " . $e->getMessage();
        return array();
    }
    
}

public function insert_categoria1($Codigo, $FechaPedido, $Nombre, $Cantidad) {
    try {
        $conectar = parent::Conexion();
        
        // Inicia la transacción
        $conectar->beginTransaction();

        // Inserta el nuevo pedido
        $sql_insert_pedido = "INSERT INTO pedidos (Codigo, FechaPedido, Nombre, Cantidad) VALUES (?, ?, ?, ?)";
        $stmt_insert_pedido = $conectar->prepare($sql_insert_pedido);
        $stmt_insert_pedido->execute([$Codigo, $FechaPedido, $Nombre, $Cantidad]);

        // Actualiza la cantidad en la tabla de bodega
        $sql_update_bodega = "UPDATE bodega SET Cantidad = Cantidad + ? WHERE Codigo = ?";
        $stmt_update_bodega = $conectar->prepare($sql_update_bodega);
        $stmt_update_bodega->execute([$Cantidad, $Codigo]);

        // Confirma la transacción
        $conectar->commit();

        // Puedes devolver algún mensaje o valor según tus necesidades
        return "Pedido insertado y cantidad actualizada en bodega correctamente";
    } catch (PDOException $e) {
        // Maneja el error aquí, por ejemplo, registrándolo o devolviendo un valor predeterminado.
        // También es importante realizar un rollback en caso de error para deshacer los cambios.
        $conectar->rollBack();
        echo "Error en la transacción: " . $e->getMessage();
        return "Error en la transacción: " . $e->getMessage();
    }
}


    public function update_categoria($Codigo,$Nombre,$Cantidad,$precio,$fecha_de_vencimiento) {
    try {
        $conectar = parent::Conexion();
        $sql = "UPDATE bodega SET Nombre = ?,Cantidad = ?,precio = ?,fecha_de_vencimiento = ? where Codigo = ?";
        $stmt = $conectar->prepare($sql);- 
        $stmt->execute([$Nombre, $Cantidad, $precio, $fecha_de_vencimiento,$Codigo]); // Cambiar $tel_usuario por $id_usuario
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // Manejar el error aquí, por ejemplo, registrándolo o devolviend un valor predeterminado.
        echo "Error en la consulta: " . $e->getMessage();
        return array();
    }
}

public function delete_categoria($Codigo) {
    try {
        $conectar = parent::Conexion();
        $sql = "DELETE FROM  pedidos  WHERE Codigo = ?";
        $stmt = $conectar->prepare($sql);- 
        $stmt->execute([$Codigo]); // Cambiar $tel_usuario por $id_usuario
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // Manejar el error aquí, por ejemplo, registrándolo o devolviend un valor predeterminado.
        echo "Error en la consulta: " . $e->getMessage();
        return array();
    }
}
public function insert_Ventas($Codigo, $Cantidad, $NombreProducto, $FechaDeVenta, $PrecioTotal) {
    try {
        $conectar = parent::Conexion();
        
        // Inicia la transacción
        $conectar->beginTransaction();

        // Verifica si la cantidad en la bodega es suficiente antes de realizar la venta
        $sql_select_bodega = "SELECT Cantidad FROM bodega WHERE Codigo = ?";
        $stmt_select_bodega = $conectar->prepare($sql_select_bodega);
        $stmt_select_bodega->execute([$Codigo]);
        $cantidad_en_bodega = $stmt_select_bodega->fetchColumn();

        if ($cantidad_en_bodega < $Cantidad) {
            // La cantidad en bodega no es suficiente, manejar el error según tus necesidades
            throw new Exception("Error: La cantidad en bodega no es suficiente para la venta.");
        }

        // Inserta el nuevo pedido
        $sql_insert_ventas = "INSERT INTO Ventas (Codigo, Cantidad, NombreProducto, FechaDeVenta, PrecioTotal) VALUES (?, ?, ?, ?, ?)";
        $stmt_insert_ventas = $conectar->prepare($sql_insert_ventas);
        $stmt_insert_ventas->execute([$Codigo, $Cantidad, $NombreProducto, $FechaDeVenta, $PrecioTotal]);

        // Actualiza la cantidad en la tabla de bodega permitiendo que sea negativa
        $sql_update_bodega = "UPDATE bodega SET Cantidad = Cantidad - ? WHERE Codigo = ?";
        $stmt_update_bodega = $conectar->prepare($sql_update_bodega);
        $stmt_update_bodega->execute([$Cantidad, $Codigo]);

        // Confirma la transacción
        $conectar->commit();

        // Puedes devolver algún mensaje o valor según tus necesidades
        return "Pedido insertado y cantidad actualizada en bodega correctamente";
    } catch (Exception $e) {
        // Maneja el error aquí, por ejemplo, registrándolo o devolviendo un valor predeterminado.
        // También es importante realizar un rollback en caso de error para deshacer los cambios.
        $conectar->rollBack();
        echo "Error en la transacción: " . $e->getMessage();
        return "Error en la transacción: " . $e->getMessage();
    }
}
}
?>
