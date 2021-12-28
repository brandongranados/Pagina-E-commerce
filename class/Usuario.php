<?php
require_once("db.php");
require_once("Producto.php");

class Usuario
{
    public $usuario;
    public $rfc;
    private $correo;
    private $tipo;

    public function __construct($usuario, $rfc, $correo, $tipo)
    {
        $this->usuario = $usuario;
        $this->rfc = $rfc;
        $this->correo = $correo;
        $this->tipo = $tipo; // Agregue tipo porque se pregunta en el registro si quiere vender
    }

    public function getCorreo(){
        return $this->correo;
    }

    public function getTipo(){
        return $this->tipo;
    }

    public function verProducto($id_producto)   // Consultar los datos de un producto de acuerdo a su id
    {
        $db = new database();
        if($db->confirmarProducto($id_producto))   // Confirma la existencia del ID
        {
            $nombre = $db->buscarProducto("nombreProducto", $id_producto); // nombre tiene el valor del campo solicitado en String
            $precio = $db->buscarProducto("precio", $id_producto); 
            $marca = $db->buscarProducto("marca", $id_producto);
            $modelo = $db->buscarProducto("modelo", $id_producto); 
            $caract = $db->buscarProducto("caracteristicas", $id_producto); 
            $categoria = $db->buscarProducto("idCategoria", $id_producto); // Regresa el idCategoria
            //$calificacion = $db->buscarProducto("nombreProducto", $id_producto); // Dónde quedó la calificacion?

            $producto = new Producto($id_producto, $nombre, $precio, $caract, $categoria);

            return json_encode($producto);  // Regresa el objeto producto en formato JSON
        }
    }
    
    public function verPerfil($rfc)     // Consultar los datos de otro usuario de acuerdo a su RFC
    {
        $db = new database();
        if($db->confirmarUsuario($rfc))   // Confirma la existencia del ID
        {
            $nombre = $db->buscarUsuario("nombreUsuario", $rfc); // nombre tiene el valor del campo solicitado en String
            $correo = $db->buscarUsuario("correo", $rfc); 
            $tipo = $db->buscarUsuario("tipo", $rfc);
            //$calificacion = $db->buscarProducto("nombreProducto", $id_producto); // Dónde quedó la calificacion?

            $usuario = new Usuario($nombre, $rfc, $correo, $tipo);
            //$usuario->tipo = $tipo;

            return json_encode($usuario);  // Regresa el objeto producto en formato JSON
        }
    }

    public function verPedido($id_venta)    // Consultar los productos comprados anteriormente
    {
        $db = new database();
        $productos = $db->verCompra($id_venta); // Obtenemos la tabla de id's de los productos comprados en una sola venta
        
        return json_encode($productos); // Regresamos la lista de id's de productos en formato JSON
    }

    public function editarPerfil($usuario)  // Editar los datos del perfil personal
    {
        $producto = json_decode($usuario);
        $db = new database();
        $db->editarPerfil($usuario->rfc, $usuario->nombreUsuario, $usuario->correo);
    }

    public function cambiarTipo($rfc, $tipo)    // Cambiar el tipo de perfil (Cliente/Vendedor)
    {
        $db = new database();
        $db->cambiarTipo($rfc, $tipo);
    }

    public function cambiarContrasena($rfc, $pass)
    {
        $db = new database();
        $db->cambiarContrasena($rfc, $pass);
    }

    public function barraBusqueda($palabra) // Buscar productos de acuerdo a palabra(s) clave en la descripción
    {
        $db = new database();
        $resultado = $db->buscarSimilar($palabra);
        if($resultado != false) // Si se encontraron resultados
        {
            return json_encode($resultado); // Se regresa la lista de id_producto en formato JSON
        }
    }
}

?>