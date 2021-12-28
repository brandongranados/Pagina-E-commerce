<?php
require_once("db.php");
require_once("Usuario.php");

class Vendedor extends Usuario
{
    private $calificacion;

    /*public function __construct()
    {
        $this->tipo = "Vendedor";
    }*/

    private function publicarProducto($productoJson) // Registrar nuevo producto
    {
        $producto = json_decode($productoJson);
        $db =  new database();
        if( $db->agregarProducto($producto->idCategoria, $producto->precio, $producto->marca, $producto->modelo, $producto->caracteristicas) != false)
        {
            return "Registrado";
        }
    }

    private function editarProducto($productoJSON)    // recibe objeto producto en formato JSON
    {
        $producto = json_decode($productoJSON);
        $db = new database();

        if($db->confirmarProducto($producto->id_producto))  // Verificar que existe
        {
            if($db->editarProducto($producto->id_producto, $producto->idCateogria, $producto->precio, $producto->marca, $producto->modelo, $producto->caracteristicas))
            {
                return "Actualizado";
            }
            return "Error";
        }
        return "Producto no existe";
    }

    private function eliminarProducto($id_producto)
    {
        $db = new database();
        if($db->confirmarProducto($id_producto))  // Verificar que existe
        {
            //Existe. Seguro quieres eliminar?

            if($db->eliminarProducto($id_producto))
            {
                //Eliminado
                return "Eliminado";
            }
            return "Error";
        }
        return "No existe";
    }

    private function responderProducto($id_producto)
    {
        
    }
}
?>