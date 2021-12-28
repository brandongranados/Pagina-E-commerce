<?php
    session_start();
    
    if( isset( $_POST['agregar'] ) ){
        //$actual->agregarProducto( $_GET['agregar'] );
        if( isset( $_SESSION['carrito'] ) ){
            // Ya hay carrito
            $cant = count( $_SESSION['carrito'] );
            $_SESSION['carrito'][$cant] = $_POST['agregar'];

        }else{
            $_SESSION['carrito'][0] = $_POST['agregar'];
        }
        header( 'Location: tienda.php' );
    }

    if( isset( $_POST['borrar'] ) ){
        $idx = array_search( $_POST['borrar'], $_SESSION['carrito'] );
        unset( $_SESSION['carrito'][$idx] );
        header( 'Refresh:1' );
    }

?>