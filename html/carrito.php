<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/Escommerce/class/Vendedor.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/Escommerce/class/Cliente.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/Escommerce/class/Producto.php';
    session_start();

    if( isset( $_SESSION['user'] ) ){
        //$db = new database();
        $actual = unserialize( $_SESSION['user'] );
    }

    if( isset( $_SESSION['carrito'] ) ){
        $productos = array();
        $msg = $_SESSION['carrito'];
        $db = new database();
        $added = array();
        foreach( $_SESSION['carrito'] as $id ){
            if( !in_array( $id, $added ) ){
                $res = $db->buscarProducto( "*", $id ); // Hay que iterar
                $producto = new Producto( $res['idProducto'], $res['marca'] . " " . $res['modelo'], $res['precio'], $res['caracteristicas'], $res['idCategoria'], $res['urlImg'] );
                $productos []= $producto;
                $added []= $id;
            }
        }
        /*if( isset( $res ) ){
            $msg = $res;
            $producto = new Producto( $res['idProducto'], $res['marca'] . " " . $res['modelo'], $res['precio'], $res['caracteristicas'], $res['idCategoria'], $res['urlImg'] );
        }else{
            //$msg = "Algo salió mal en la consulta";
            $msg = $_SESSION['carrito'];
        }*/
    }else{
        $msg = "No hay carrito";
    }
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ashion Template">
    <meta name="keywords" content="Ashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Carrito de compras</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cookie&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../sass/main.css">
    <link rel="stylesheet" href="../css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="../css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="../css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="../css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="../css/ashion.css" type="text/css">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/notifications.css">
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!--Inicio de barra de navegacion-->
    <?php
        require_once "./cabeza.php";
    ?>
    <!--Fin de barra de navegacion-->

    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="./index.php" id="indexBread"><img
                                        src="https://img.icons8.com/material-sharp/24/000000/home.png" />Inicio</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Carrito</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <?php //print_r( $_SESSION['carrito'] ) ?>
    <!-- Shop Cart Section Begin -->
    <section class="shop-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shop__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>Precio</th>
                                    <th>Cantidad</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <?php
                                    $total = 0;
                                    if( isset( $productos ) ){
                                        $precio = $producto -> getPrecio();
                                    foreach( $productos as $producto ){
                                        $total+=$precio;
                                ?>
                                        <tr>
                                            <td class="cart__product__item">
                                                <img src=<?php echo '"' . $producto->getImg() . '"' ?> alt="" width="150" height="150">
                                                <div class="cart__product__item__title">
                                                    <h6><?php echo $producto->Nombre; ?></h6>
                                                </div>
                                            </td>
                                            
                                           <td class="cart__price">$ <?php echo $precio; ?></td>
                                            <td class="cart__quantity">
                                                <div class="pro-qty">
                                                    <input type="text" value="1">
                                                </div>
                                            <td class="cart__total">$ <?php echo $total; ?></td>
                                            <td class="cart__close"><a href="#" onclick="borrarCarrito( <?php echo $producto->id_producto; ?> )"><img src="https://img.icons8.com/ios-glyphs/20/000000/delete-sign.png"/></a></td>
                                        </tr>
                                <?php
                                    }}
                                ?>

                                <!-- <tr>
                                    <td class="cart__product__item">
                                        <img src="../assets/images/categorias/display-categorias/f-1.jpg" alt="">
                                        <div class="cart__product__item__title">
                                            <h6>Zip-pockets pebbled tote briefcase</h6>
                                        </div>
                                    </td>
                                    <td class="cart__price">$ 170.0</td>
                                    <td class="cart__quantity">
                                        <div class="pro-qty">
                                            <input type="text" value="1">
                                        </div>
                                    </td>
                                    <td class="cart__total">$ 170.0</td>
                                    <td class="cart__close"><img src="https://img.icons8.com/ios-glyphs/20/000000/delete-sign.png"/></td>
                                </tr>
                                <tr>
                                    <td class="cart__product__item">
                                        <img src="../assets/images/categorias/display-categorias/bs-2.jpg" alt="">
                                        <div class="cart__product__item__title">
                                            <h6>Black jean</h6>
                                        </div>
                                    </td>
                                    <td class="cart__price">$ 85.0</td>
                                    <td class="cart__quantity">
                                        <div class="pro-qty">
                                            <input type="text" value="1">
                                        </div>
                                    </td>
                                    <td class="cart__total">$ 170.0</td>
                                    <td class="cart__close"><img src="https://img.icons8.com/ios-glyphs/20/000000/delete-sign.png"/></td>
                                </tr>
                                <tr>
                                    <td class="cart__product__item">
                                        <img src="../assets/images/categorias/display-categorias/bs-1.jpg" alt="">
                                        <div class="cart__product__item__title">
                                            <h6>Cotton Shirt</h6>
                                        </div>
                                    </td>
                                    <td class="cart__price">$ 55.0</td>
                                    <td class="cart__quantity">
                                        <div class="pro-qty">
                                            <input type="text" value="1">
                                        </div>
                                    </td>
                                    <td class="cart__total">$ 110.0</td>
                                    <td class="cart__close"><img src="https://img.icons8.com/ios-glyphs/20/000000/delete-sign.png"/></td>
                                </tr> -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="cart__btn">
                        <a href="./tienda.php">Continuar comprando</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 offset-lg-8">
                    <div class="cart__total__procced">
                        <h6>Total:</h6>
                        <ul>
                            <li>Subtotal <span><?php echo $total/2; ?></span></li>
                            <li>Envio <span> Free! </span><li>
                            <li>Total <span><?php echo $total/2;?></span></li>
                        </ul>
                        <a href="./checkout.php" class="primary-btn">Proceder al pago</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Cart Section End -->

    <!-- Categorias Banner Inicio -->
    <div class="instagram">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                    <div class="instagram__item set-bg"
                        data-setbg="../assets/images/categorias/banner-categorias/banner-makeup.jpg">
                        <div class="instagram__text">
                            <a href="#">Maquillaje</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                    <div class="instagram__item set-bg"
                        data-setbg="../assets/images/categorias/banner-categorias/banner-skincare.jpg">
                        <div class="instagram__text">
                            <a href="#">Skin Care</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                    <div class="instagram__item set-bg"
                        data-setbg="../assets/images/categorias/banner-categorias/banner-ninos.jpg">
                        <div class="instagram__text">
                            <a href="#">Moda para ni&ntilde;os</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                    <div class="instagram__item set-bg"
                        data-setbg="../assets/images/categorias/banner-categorias/banner-moda.jpg">
                        <div class="instagram__text">
                            <a href="#">Moda para todos</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                    <div class="instagram__item set-bg"
                        data-setbg="../assets/images/categorias/banner-categorias/banner-mascotas.jpg">
                        <div class="instagram__text">
                            <a href="#">Para tu mascota</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                    <div class="instagram__item set-bg"
                        data-setbg="../assets/images/categorias/banner-categorias/banner-hogar.jpg">
                        <div class="instagram__text">
                            <a href="#">Decoraci&oacute;n para el hogar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Categorias Banner Fin -->

    <!-- Footer Section Begin -->
    <?php
        require_once "./pie.php";
    ?>
    <!-- Footer Section End -->

    <!-- Js Plugins -->

    <script>
        function borrarCarrito( id ){
            //alert( typeof id );
            $.ajax({
               method: "POST",
               url: "wrap.php",
               data: { borrar: String( id ) }
           })
           location.reload();
        }
    </script>

    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery.magnific-popup.min.js"></script>
    <script src="../js/jquery-ui.min.js"></script>
    <script src="../js/mixitup.min.js"></script>
    <script src="../js/jquery.countdown.min.js"></script>
    <script src="../js/jquery.slicknav.js"></script>
    <script src="../js/owl.carousel.min.js"></script>
    <script src="../js/jquery.nicescroll.min.js"></script>
    <script src="../js/bootstrap.js"></script>

    <script src="../js/main.js"></script>
    <script src="../js/app.js"></script>
    <script src="../js/notifications.js"></script>
</body>

</html>