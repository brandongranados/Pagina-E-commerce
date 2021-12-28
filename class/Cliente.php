<?php

require_once("db.php");
require_once("Usuario.php");
// hola
//modificación de Somebody

class Cliente extends Usuario
{
    //private $dataBase = new database();

    /*public function __construct()
    {
        $this->tipo = "Cliente";
    }*/

    private function agregarProducto($id_producto)  // Agregar AL CARRITO
    {
        $flag = false;
        /*$db = new database();
        if($db->confirmarProducto($id_producto))  // Verificar que existe
        {
            //Existe. Seguro quieres eliminar?
            
        }*/

        

        return $flag;
    }
    private function eliminarProducto($id_producto) // Eliminar DEL CARRITO
    {
        $flag = false;
        $db = new database();
        if($db->confirmarProducto($id_producto))  // Verificar que existe
        {
            //Existe. Seguro quieres eliminar?

        }

        return $flag;
    }
    private function hacerComentario($id_producto)
    {
        $flag = false;

        return $flag;
    }
    
    private function hacerPregunta($id_producto)
    {
        $flag = false;

        return $flag;
    }

    private function asignarCalificacion($id_producto)
    {
        
    }

    private function comprarProducto($carrito)  // Recibe lista de id_producto en formato JSON
    {
        $productos = json_decode($carrito);
        $db =  new database();
        $idVenta = $db->obtenerIDventa();
        $i = 0;
        while($i < count($productos)) // Mientras haya más id's en la lista productos
        {
            $id_producto = $productos[$i];  // Obtenemos el siguiente id_producto
            $db->comprarProducto($id_producto, $idVenta);   // Registramos la compra
            $i++;
        }

        return "comprado";
    }
}

// Ejemplo de instanciación de un objeto con herencia. 
// Esta clase no tiene atributos, pero necesita los de Usuario.
//$userOne = new Cliente('Oscar', '2015070715', 'OCabagne@outlook.com');

?>