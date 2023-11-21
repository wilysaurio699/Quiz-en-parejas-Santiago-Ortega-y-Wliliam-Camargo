<?php
header('Content-Type: application/json');

require_once("../config/conexion.php");
require_once("../models/CATEGORIA.php");
$categoria = new categoria();

$body = json_decode(file_get_contents("php://input"), true);


switch ($_GET["op"]){
    case "GetAll":
        $datos=$categoria->get_categoria();
        echo json_encode($datos);
    break;

    case "GetId":
        $datos=$categoria->get_categoriax_x_id($body["Codigo"]);
      
        echo json_encode($datos);
        break;

        case "insert":
            $datos=$categoria->insert_categoria($body["Codigo"],$body["Nombre"],$body["Cantidad"],$body["precio"], $body["fecha_de_vencimiento"]);

            echo json_encode("insert correcto");
            break;
            case "insert1":
                $datos=$categoria->insert_categoria1($body["Codigo"],$body["FechaPedido"],$body["Nombre"],$body["Cantidad"]);
                
    
                echo json_encode("insert correcto");
                break;
                

        case "update":
        $datos=$categoria->update_categoria($body["Codigo"],$body["Nombre"],$body["Cantidad"],$body["precio"], $body["fecha_de_vencimiento"]);
              
        echo json_encode("update correcto");
        break;


        case "delete":
            $datos=$categoria->delete_categoria($body["Codigo"]);
                  
            echo "delete correcto";
        
            case "insertventas":
                $datos=$categoria->insert_Ventas($body["Codigo"],$body["Cantidad"],$body["NombreProducto"],$body["FechaDeVenta"],$body["PrecioTotal"]);
                echo json_encode("insert correcto");
                break;

    
}

?>