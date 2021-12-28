<?php

// Aquí van a estar los querys para todas las consultas, updates, deletes y conexiones
/*
            TODOS LOS MÉTODOS (a excepción de conectar y desconectar) DEBEN SEGUIR ESTA ESTRUCTURA

        $cnx = new database();  // Instancia de db
        $connect = $cnx->conectar();    // Nos conectamos a la base de datos y guardamos el objeto mysqli retornado en connect.
        if($connect != false)   // if para cachar el caso de error de conexión.
        {
            //
            // CÓDIGO
            //
    
            $cnx->desconectar($connect);    // Desconectamos de la base de datos.
            //Si van a seguir haciendo algo, pero ya no necesitan consultas, va a partir de aquí.
        }


        PARA EJECUTAR LAS CONSULTAS SE USA EL MISMO $connect :

            $exec = mysqli_query($connect, $query); // Ejecución del query
            
*/

class database
{
    //private $server = "127.0.0.1:49511";
    //private $user = "azure";
    //private $pass = "6#vWHD_$";
    private $server = "localhost";
    private $user = "root";
    private $pass = "";
    private $dbName = "escommerce";
    
    private function conectar()
    {  
        $conexion = mysqli_connect($this->server, $this->user, $this->pass, $this->dbName);
        if(mysqli_connect_errno())
        {
            return false; // Fallo la conexion
        }

        return $conexion;
    }

    private function desconectar($conexion)
    {
        $conexion->close();
    }

    public function getUserName($userId)
    {
        $cnx = new database();
        $connect = $cnx->conectar();

        $query = "SELECT nombreUsuario FROM usuario WHERE rfc = " . $userId . ";";
        $exec = mysqli_query($connect, $query);
        $cnx->desconectar($connect);
    }

    public function confirmarProducto($id_producto) // Verifica si un id_producto ya está registrado en la base de datos. 
    {
        $cnx = new database();
        $connect = $cnx->conectar();
        if($connect != false)
        {           
            $query = "SELECT nombreProducto FROM producto WHERE idProducto = " . $id_producto . ";";
            $exec = mysqli_query($connect, $query);

            $cnx->desconectar($connect);
            return $exec;
        }
    }

    public function buscarProducto($campo, $id_producto)
    {
        $cnx = new database();  // Conexión con DB
        $connect = $cnx->conectar();
        if($connect != false)
        {
            $query = "SELECT " . $campo . " FROM producto WHERE idProducto = '" . $id_producto . "';";
            $exec = mysqli_query($connect, $query); // Ejecución del query
            $row = mysqli_fetch_array( $exec, MYSQLI_ASSOC ); // Obtenemos las columnas resultantes de la consulta

            $cnx->desconectar($connect);   // Desconexión de DB
            return $row; // Regresamos la primer colúmna de la busqueda (debería ser solo una, pero por precaución se especifica)
        }
    }

    public function buscadorProductos( $valor ){ // Para la barra de búsqueda
        $cnx = new database();
        $connect = $cnx->conectar();
        if( $connect != false ){
            $query = "SELECT * FROM producto WHERE marca LIKE '" . $valor . "' OR modelo LIKE '" . $valor . "';";
            $exec = mysqli_query( $connect, $query );
            //$row = mysqli_fetch_array( $exec, MYSQLI_ASSOC );
            $cnx->desconectar( $connect );
            return $exec;
        }
    }

    public function buscadorProductosCategoria( $valor ){ // Para la barra de búsqueda
        $cnx = new database();
        $connect = $cnx->conectar();
        if( $connect != false ){
            $query = "SELECT * FROM producto WHERE idCategoria = '" . $valor . "';";
            $exec = mysqli_query( $connect, $query );
            //$row = mysqli_fetch_array( $exec, MYSQLI_ASSOC );
            $cnx->desconectar( $connect );
            return $exec;
        }
    }

    public function buscarPorPrecio($min, $max) // Filtro SLIDER en tienda.php
    {
        $cnx = new database();
        $connect = $cnx->conectar();
        if( $connect != false ){
            $query = "SELECT * FROM producto WHERE precio > '" . $min . "' AND precio < '" . $max . "';";
            $exec = mysqli_query( $connect, $query );
            $row = mysqli_fetch_array( $exec, MYSQLI_ASSOC );
            $cnx->desconectar( $connect );
            return $row;
        }
    }

    public function ultimosProductos( $num ){ // Para la barra de búsqueda
        $cnx = new database();
        $connect = $cnx->conectar();
        if( $connect != false ){
            $query = "SELECT * FROM producto LIMIT " . $num . ";";
            $exec = mysqli_query( $connect, $query );
            //$row = mysqli_fetch_array( $exec, MYSQLI_ASSOC );
            $cnx->desconectar( $connect );
            return $exec;
        }
    }

    public function galeriaProducto($campo, $id_producto)
    {
        $cnx = new database();  // Conexión con DB
        $connect = $cnx->conectar();
        if($connect != false)
        {
            $query = "SELECT * FROM producto WHERE ".$campo." = '" . $id_producto . "' ;";
            $exec = mysqli_query($connect, $query); // Ejecución del query
            $row = mysqli_fetch_array($exec); // Obtenemos las columnas resultantes de la consulta

            $cnx->desconectar($connect);   // Desconexión de DB
            return $row;
        }
    }

    public function eliminarProducto($id_producto)
    {
        $cnx = new database();
        $connect = $cnx->conectar();

        $query = "DELETE * FROM producto WHERE idProducto = " + $id_producto + ";";
        $exec = mysqli_query($connect, $query);
        $cnx->desconectar($connect);
    }

    public function agregarProducto($rfc, $idCategoria, $precio, $marca, $modelo, $caracteristicas, $urlImg, $oferta)
    {
        $cnx = new database();  // Conexión con DB
        $connect = $cnx->conectar();
        if($connect != false)
        {
            $query = "INSERT INTO producto(rfc, idCategoria, precio, marca, modelo, caracteristicas, urlImg, oferta) VALUES ('".$rfc."','".$idCategoria."','".$precio."','".$marca."','".$modelo."','".$caracteristicas."','".

$urlImg."','".$oferta."');";
            $exec = mysqli_query($connect, $query); // Ejecución del query
	    if( $exec ){
                $msg = "Creado con éxito";
            }else{
                $msg = "Error al crear";
            }
            

            $cnx->desconectar($connect);   // Desconexión de DB
            return $msg; // Regresamos Row. Es false si no se pudo ejecutar
        }
    }

    public function editarProducto($id_producto, $idCategoria, $precio, $marca, $modelo, $caract)
    {
        $cnx = new database();  // Instancia de db
        $connect = $cnx->conectar();    // Nos conectamos a la base de datos y guardamos el objeto mysqli retornado en connect.
        if($connect != false)   // if para cachar el caso de error de conexión.
        {
            $query = "UPDATE producto SET idCategoria = '".$idCategoria."', precio = '".$precio."', marca = '".$marca."', modelo = '".$modelo."', caracteristicas = '".$caract."' WHERE idProducto = ".$id_producto.";";
            $exec = mysqli_query($connect, $query); // Ejecución del query

            $cnx->desconectar($connect);   // Desconexión de DB
            return $exec;
        }
    }

    public function obtenerIDventa()    //Genera un nuevo idVenta y lo regresa
    {
        $cnx = new database();  // Instancia de db
        $connect = $cnx->conectar();    // Nos conectamos a la base de datos y guardamos el objeto mysqli retornado en connect.
        if($connect != false)   // if para cachar el caso de error de conexión.
        {
            //
            // CÓDIGO
            //
    
            $cnx->desconectar($connect);    // Desconectamos de la base de datos.
            //Si van a seguir haciendo algo, pero ya no necesitan consultas, va a partir de aquí.
        }
    }

    public function comprarProducto($id_producto, $idVenta)
    {
        $cnx = new database();  // Instancia de db
        $connect = $cnx->conectar();    // Nos conectamos a la base de datos y guardamos el objeto mysqli retornado en connect.
        if($connect != false)   // if para cachar el caso de error de conexión.
        {
            $query = "INSERT INTO venta (idVenta, idProducto) VALUES (".$idVenta.", ".$id_producto.");";
            $exec = mysqli_query($connect, $query);
            $cnx->desconectar($connect);    // Desconectamos de la base de datos.
            if($exec)
            {
                return "Comprado";
            }
            else
            {
                return "Error";
            }
        }
    }

    public function verCompra($idVenta) // Obtener los productos vendidos en una sola venta
    {
        $cnx = new database();  // Conexión con DB
        $connect = $cnx->conectar();
        if($connect != false)
        {
            $query = "SELECT idProducto FROM vendido WHERE idVenta = ".$idVenta.";";
            $exec = mysqli_query($connect, $query); // Ejecución del query
            $row = mysqli_fetch_array($exec); // Obtenemos las columnas resultantes de la consulta

            $cnx->desconectar($connect);   // Desconexión de DB
            return $row; // Regresamos el resultado de la consulta
        }
    }

    public function confirmarUsuario($id_usuario)   // Verifica que haya un Usuario registrado con el id_usuario
    {
        $cnx = new database();
        $connect = $cnx->conectar();
        if($connect != false)
        {           
            $query = "SELECT nombreUsuario FROM usuario WHERE rfc = " . $id_usuario . ";";
            $exec = mysqli_query($connect, $query);

            $cnx->desconectar($connect);
            return $exec;
        }
    }

    public function buscarUsuario($campo, $id_usuario)
    {
        $cnx = new database();  // Conexión con DB
        $connect = $cnx->conectar();
        if($connect != false)
        {
            $query = "SELECT " . $campo . " FROM usuario WHERE rfc = '" . $id_usuario . "';";
            $exec = mysqli_query($connect, $query); // Ejecución del query
            $row = mysqli_fetch_array($exec, MYSQLI_ASSOC); // Obtenemos las columnas resultantes de la consulta

            $cnx->desconectar($connect);   // Desconexión de DB
            if( !empty( $row ) ){
                return $row; // Regresamos la primer colúmna de la busqueda (debería ser solo una, pero por precaución se especifica)
            }else{
                return "Error";
            }
        }
    }

    public function login( $email_usuario )
    {
        $cnx = new database();
        $connect = $cnx->conectar();
        if($connect != false)
        {
            $query = "SELECT * FROM usuario WHERE correo = '" . $email_usuario . "';";
            $exec = mysqli_query( $connect, $query );
            $row = mysqli_fetch_array($exec, MYSQLI_ASSOC); // Obtenemos las columnas resultantes de la consulta
    
            $cnx->desconectar($connect);
            return $row;
        }else{
            return 0;
        }
    }

    public function signup( $id_usuario, $nombre_usuario, $email_usuario, $contra_usuario, $tipo_usuario ) // Tambien puede ser llamada "crearUsuario"
    {
        $cnx = new database();
        $connect = $cnx->conectar();
        if($connect != false)   // if para cachar el caso de error de conexión.
        {
            $query = "INSERT INTO usuario ( rfc, nombreUsuario, contraUsuario, correo, tipoUser) VALUES ( '" . $id_usuario . "', '" . $nombre_usuario . "', '" . $contra_usuario . "', '"  . $email_usuario . "', '" . $tipo_usuario . "');";
            $exec = mysqli_query($connect, $query);
            // $exec es true si la consulta fue exitosa, se evalúa en el siguiente if
            if( $exec ){
                $msg = "Creado con éxito";
            }else{
                $msg = "Error al crear";
            }
    
            $cnx->desconectar($connect);
            return $msg;
        }
    }

    public function editarPerfil($rfc, $nombreUsuario, $correo) // No se puede cambiar RFC, Contraseña ni tipo
    {
        $cnx = new database();  // Instancia de db
        $connect = $cnx->conectar();    // Nos conectamos a la base de datos y guardamos el objeto mysqli retornado en connect.
        if($connect != false)   // if para cachar el caso de error de conexión.
        {
            $query = "UPDATE usuario SET nombreUsuario = '".$nombreUsuario."', correo = '".$correo."' WHERE rfc = ".$rfc.";";
            $exec = mysqli_query($connect, $query); // Ejecución del query

            $cnx->desconectar($connect);   // Desconexión de DB
            return $exec;
        }
    }

    public function cambiarTipo($rfc, $tipo)
    {
        $cnx = new database();  // Instancia de db
        $connect = $cnx->conectar();    // Nos conectamos a la base de datos y guardamos el objeto mysqli retornado en connect.
        if($connect != false)   // if para cachar el caso de error de conexión.
        {
            $query = "UPDATE usuario SET tipoUser = '".$tipo."' WHERE rfc = '".$rfc."';";
            $exec = mysqli_query($connect, $query); // Ejecución del query

            $cnx->desconectar($connect);   // Desconexión de DB
            return $exec;
        }
    }
	
    public function cambiarContrasena($rfc, $pass)
    {
        $cnx = new database();  // Instancia de db
        $connect = $cnx->conectar();    // Nos conectamos a la base de datos y guardamos el objeto mysqli retornado en connect.
        if($connect != false)   // if para cachar el caso de error de conexión.
        {
            $query = "UPDATE usuario SET contraUsuario = '".$pass."' WHERE rfc = '".$rfc."';";
            $exec = mysqli_query($connect, $query); // Ejecución del query

            $cnx->desconectar($connect);   // Desconexión de DB
            return $exec;
        }
    }

    public function categorias()    // Obtener el listado de categorías registradas
    {
        $cnx = new database();  // Conexión con DB
        $connect = $cnx->conectar();
        if($connect != false)
        {
            $query = "SELECT nomCategoria FROM categoria;";
            $exec = mysqli_query($connect, $query); // Ejecución del query
            $row = mysqli_fetch_array($exec); // Obtenemos las columnas resultantes de la consulta

            $cnx->desconectar($connect);   // Desconexión de DB
            return $row; // Regresamos el resultado de la consulta
        }
    }

    public function filtro($idCategoria)    // Busca todos los productos de una categoría
    {
        $cnx = new database();  // Conexión con DB
        $connect = $cnx->conectar();
        if($connect != false)
        {
            $query = "SELECT * FROM producto WHERE idCategoria = '" . $idCategoria . "';";
            $exec = mysqli_query($connect, $query); // Ejecución del query
            //$row = mysqli_fetch_array($exec, MYSQLI_ASSOC); // Obtenemos las columnas resultantes de la consulta

            $cnx->desconectar($connect);   // Desconexión de DB
            return $exec; // Regresamos el resultado de la consulta
        }
    }

    public function idCategoria( $nombre ){
        $cnx = new database();  // Conexión con DB
        $connect = $cnx->conectar();
        if($connect != false)
        {
            $query = "SELECT idCategoria FROM categoria WHERE nomCategoria = '".$nombre."';";
            $exec = mysqli_query($connect, $query); // Ejecución del query
            $row = mysqli_fetch_array($exec); // Obtenemos las columnas resultantes de la consulta

            $cnx->desconectar($connect);   // Desconexión de DB
            return $row; // Regresamos el resultado de la consulta
        }
    }

    public function buscarSimilar($palabra) //  Herramienta de barra de búsqueda
    {
        $cnx = new database();  // Conexión con DB
        $connect = $cnx->conectar();
        if($connect != false)
        {
            $query = "SELECT idProducto FROM producto WHERE caracteristicas LIKE '%".$palabra."%';";    // Busca coincidencias en la descripción del producto
                                                                                                        // de acuerdo al texto ingresado en la barra de búsqueda
            $exec = mysqli_query($connect, $query); // Ejecución del query
            if($exec)   // Si la búsqueda obtiene resultados
            {
                $row = mysqli_fetch_array($exec); // Obtenemos las columnas resultantes de la consulta

                $cnx->desconectar($connect);   // Desconexión de DB
                return $row; // Regresamos el resultado de la consulta
            }

            return false;   // Si la búsqueda regresa vacía
        }
    }
            
    public function buscarRFC($rfc) //  Funcion para ver si ya existe un rfc
    {
        $cnx = new database();  // Conexión con DB
        $connect = $cnx->conectar();
        if($connect != false)
        {
            $query = "SELECT * FROM usuario WHERE rfc = '".$rfc."';";    // Busca coincidencias de rfc                                                                                 
            $exec = mysqli_query($connect, $query); // Ejecución del query
            		
            $row = mysqli_fetch_array($exec); // Obtenemos las columnas resultantes de la consulta
	$count = mysqli_num_rows($exec); //Contamos los resultados (con 1 basta, no deberia haber mas de 1)
            $cnx->desconectar($connect);   // Desconexión de DB
            return $count; // Regresamos el resultado de la consulta
            		

            		
        }
    }



    public function buscarCorreo($correo) //  Funcion para ver si ya existe un correo electronico
    {
        	$cnx = new database();  // Conexión con DB
        	$connect = $cnx->conectar();
        	if($connect != false)
        	{
                        $query = "SELECT * FROM usuario WHERE correo = '".$correo."';";    // Busca coincidencias del correo                                                                                
            	$exec = mysqli_query($connect, $query); // Ejecución del query
            		
                	$row = mysqli_fetch_array($exec); // Obtenemos las columnas resultantes de la consulta
		$count = mysqli_num_rows($exec); //Contamos los resultados (con 1 basta, no deberia haber mas de 1)
                	$cnx->desconectar($connect);   // Desconexión de DB
                	return $count; // Regresamos el resultado de la consulta
            		

            		
        	}
    }       
            
            
}

?>
