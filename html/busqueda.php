<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/Escommerce/class/db.php';
    if( $_GET ){
        $db = new database();
        $resultados = $db->buscadorProductos( $_GET['busqueda'] );
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        if( mysqli_num_rows( $resultados ) > 0 ){
            while( $row = mysqli_fetch_array( $resultados, MYSQLI_ASSOC ) ){
                print_r( $row );
                echo "<br />";
    ?>
                <!-- Aquí va el HTML para mostrar los resultados de la busqueda -->
    <?php
            }
        }

    ?>
</body>
</html>