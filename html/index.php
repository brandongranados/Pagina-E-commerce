<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/Escommerce/class/db.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/Escommerce/class/Cliente.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/Escommerce/class/Vendedor.php';
    session_start();
    $actual = '';
    $db = new database();
    if( isset( $_SESSION['user'] ) ){
        $actual = unserialize( $_SESSION['user'] );
    }
    $productos = $db->ultimosProductos( 6 );

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-scommerce</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cookie&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="../sass/main.css">
    <link rel="stylesheet" href="../css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="../css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="../css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="../css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="../css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="../css/ashion.css" type="text/css">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
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

    <!-- Categories Section Begin -->
    <section class="categories">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 p-0">
                    <div class="categories__item categories__large__item set-bg"
                        data-setbg="../assets/images/categorias/categoria-mujeres.jpg">
                        <div class="categories__text">
                            <h1>Ropa para mujeres</h1>
                            <p>Sitamet, consectetur adipiscing elit, sed do eiusmod tempor incidid-unt labore
                                edolore magna aliquapendisse ultrices gravida.</p>
                            <a href="tienda.php?buscarCategoria=ropaMujer">Comprar ahora</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                            <div class="categories__item set-bg"
                                data-setbg="../assets/images/categorias/categoria-hombres.jpg">
                                <div class="categories__text">
                                    <h4>Ropa para hombres</h4>
                                    <a href="tienda.php?buscarCategoria=ropaHombre">Comprar ahora</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                            <div class="categories__item set-bg"
                                data-setbg="../assets/images/categorias/categoria-niños.jpg">
                                <div class="categories__text">
                                    <h4>Ropa para ni&ntilde;os</h4>
                                    <a href="tienda.php?buscarCategoria=ropaNino">Comprar ahora</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                            <div class="categories__item set-bg"
                                data-setbg="../assets/images/categorias/categoria-cosmeticos.jpg">
                                <div class="categories__text">
                                    <h4>Cosmeticos</h4>
                                    <a href="tienda.php?buscarCategoria=cosmeticos">Comprar ahora</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                            <div class="categories__item set-bg"
                                data-setbg="../assets/images/categorias/categoria-mascotas.jpg">
                                <div class="categories__text">
                                    <h4>Mascotas</h4>
                                    <a href="#">Comprar ahora</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section End -->

    <!-- Product Section Begin -->
    <section class="product spad" id="lista-productos">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4">
                    <div class="section-title">
                        <h4>Nuevos productos</h4>
                    </div>
                </div>
            </div>
            <div class="row property__gallery">
                
                
                <?php
                    if( mysqli_num_rows( $productos ) > 0 ){
                        while( $row = mysqli_fetch_array( $productos, MYSQLI_ASSOC ) ){
                ?>
                <div class="col-lg-3 col-md-4 col-sm-6 mix accessories">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="../assets/images/productos/product-3.jpg">
                            <img src="<?php echo $row['urlImg'] ?>" class="product__item__pic set-bg">
                            <div class="label stockout">VENTA</div>
                            <ul class="product__hover">
                                <li><a href="#" class="agregar-carrito"><img class="agregar-carrito"
                                            src="https://img.icons8.com/windows/32/000000/add-shopping-cart.png" /></a>
                                </li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6><a class="cargaDetallesProducto" href="detalles-producto.html"><?php echo $row['marca'] . " " . $row['modelo'] ?></a></h6>
                            <div class="rating">
                                <img src="https://img.icons8.com/office/16/000000/filled-star--v1.png" />
                                <img src="https://img.icons8.com/office/16/000000/filled-star--v1.png" />
                                <img src="https://img.icons8.com/office/16/000000/filled-star--v1.png" />
                                <img src="https://img.icons8.com/office/16/000000/filled-star--v1.png" />
                                <img src="https://img.icons8.com/office/16/000000/filled-star--v1.png" />
                            </div>
                            <div class="product__price"><?php echo "$ " . $row['precio'] ?></div>
                        </div>
                    </div>
                </div>

                <?php
                        }
                    }
                ?>

                
            </div>
        </div>
    </section>
    <!-- Product Section End -->

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

    <!-- Inicio de Categorias Display -->
    <section class="trend spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="trend__content">
                        <div class="section-title">
                            <h4>Del Hogar</h4>
                        </div>

                        <?php
                            $id = $db->idCategoria( "hogar" );
                            if( $id ){
                                $ids = $id['idCategoria'];
                                $prods = $db->filtro( $ids );
                                //print_r( $prods );
                                if( mysqli_num_rows( $prods ) > 0 ){
                                    while( $row = mysqli_fetch_array( $prods, MYSQLI_ASSOC ) ){
                        ?>
                            <div class="trend__item">
                                <div class="trend__item__pic">
                                    <img src="<?php echo $prods['urlImg'] ?>" alt="" width="90" height="90">
                                </div>
                                <div class="trend__item__text">
                                    <h6><?php echo $prods['marca'] . " " . $prods['modelo'] ?></h6>
                                    <div class="rating">
                                        <img src="https://img.icons8.com/office/16/000000/filled-star--v1.png" />
                                        <img src="https://img.icons8.com/office/16/000000/filled-star--v1.png" />
                                        <img src="https://img.icons8.com/office/16/000000/filled-star--v1.png" />
                                        <img src="https://img.icons8.com/office/16/000000/filled-star--v1.png" />
                                        <img src="https://img.icons8.com/office/16/000000/filled-star--v1.png" />
                                    </div>
                                    <div class="product__price">$ <?php echo $prods['precio'] ?></div>
                                </div>
                            </div>
                        <?php
                                    }
                                }
                            }
                        ?>

                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="trend__content">
                        <div class="section-title">
                            <h4>Electronica</h4>
                        </div>
                        <?php
                            $id = $db->idCategoria( "electronica" );
                            if( $id ){
                                $ids = $id['idCategoria'];
                                $prods = $db->filtro( $ids );
                                //print_r( $prods );
                                if( mysqli_num_rows( $prods ) > 0 ){
                                    while( $row = mysqli_fetch_array( $prods, MYSQLI_ASSOC ) ){
                        ?>
                            <div class="trend__item">
                                <div class="trend__item__pic">
                                    <img src=<?php echo '"' . $prods['urlImg'] . '"' ?> alt="" width="90" height="90">
                                </div>
                                <div class="trend__item__text">
                                    <h6><?php echo $prods['marca'] . " " . $prods['modelo'] ?></h6>
                                    <div class="rating">
                                        <img src="https://img.icons8.com/office/16/000000/filled-star--v1.png" />
                                        <img src="https://img.icons8.com/office/16/000000/filled-star--v1.png" />
                                        <img src="https://img.icons8.com/office/16/000000/filled-star--v1.png" />
                                        <img src="https://img.icons8.com/office/16/000000/filled-star--v1.png" />
                                        <img src="https://img.icons8.com/office/16/000000/filled-star--v1.png" />
                                    </div>
                                    <div class="product__price">$ <?php echo $prods['precio'] ?></div>
                                </div>
                            </div>
                        <?php
                                    }
                                }
                            }
                        ?>
                        
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="trend__content">
                        <div class="section-title">
                            <h4>Moda</h4>
                        </div>
                        <?php
                            $id = $db->idCategoria( "ropaMujer" );
                            $ids = $id['idCategoria'];
                            $prods = $db->filtro( $ids );
                            //print_r( $prods );
                            if( mysqli_num_rows( $prods ) > 0 ){
                                while( $row = mysqli_fetch_array( $prods, MYSQLI_ASSOC ) ){
                            //while( $prods ){
                        ?>
                            <div class="trend__item">
                                <div class="trend__item__pic">
                                    <img src="<?php echo $row['urlImg'] ?>" alt="" width="90" height="90">
                                </div>
                                <div class="trend__item__text">
                                    <h6><?php echo $row['marca'] . " " . $row['modelo'] ?></h6>
                                    <div class="rating">
                                        <img src="https://img.icons8.com/office/16/000000/filled-star--v1.png" />
                                        <img src="https://img.icons8.com/office/16/000000/filled-star--v1.png" />
                                        <img src="https://img.icons8.com/office/16/000000/filled-star--v1.png" />
                                        <img src="https://img.icons8.com/office/16/000000/filled-star--v1.png" />
                                        <img src="https://img.icons8.com/office/16/000000/filled-star--v1.png" />
                                    </div>
                                    <div class="product__price">$ <?php echo $row['precio'] ?></div>
                                </div>
                            </div>
                        <?php
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Fin de Categorias Display -->

    <!-- Discount Section Begin -->
    <section class="discount">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 p-0 descuento-img">
                    <div class="discount__pic">
                        <img src="../assets/images/discount.jpg" alt="">
                    </div>
                </div>
                <div class="col-lg-6 p-0 descuento">
                    <div class="discount__text">
                        <div class="discount__text__title">
                            <span>Descuentos</span>
                            <h2>Invierno 2021</h2>
                        </div>
                        <div class="discount__countdown" id="countdown-time">
                            <div class="countdown__item">
                                <span>22</span>
                                <p>D&iacute;as</p>
                            </div>
                            <div class="countdown__item">
                                <span>18</span>
                                <p>Horas</p>
                            </div>
                            <div class="countdown__item">
                                <span>46</span>
                                <p>Min</p>
                            </div>
                            <div class="countdown__item">
                                <span>05</span>
                                <p>Seg</p>
                            </div>
                        </div>
                        <a href="#">Comprar ahora</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Discount Section End -->

    <!-- Services Section Begin -->
    <section class="services spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="services__item">
                        <img src="https://img.icons8.com/color/48/000000/in-transit--v1.png" />
                        <h6>Envio Gratis</h6>
                        <p>Para todos los pedidos arriba de $499</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="services__item">
                        <img src="https://img.icons8.com/color/48/000000/purchase-for-euro.png" />
                        <h6>Reembolso garantizado!</h6>
                        <p>Si el producto tiene problemas, se lo cambiamos!</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="services__item">
                        <img src="https://img.icons8.com/color/48/000000/last-24-hours--v1.png" />
                        <h6>Soporte en linea 24/7</h6>
                        <p>Soporte personalizado</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="services__item">
                        <img src="https://img.icons8.com/color/48/000000/card-security.png" />
                        <h6>Pago seguro</h6>
                        <p>100% pago seguro</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Services Section End -->

    <!-- Footer Section Begin -->
    <?php
        require_once "./pie.php";
    ?>
    <!-- Footer Section End -->

    <!-- Js Plugins -->
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
    <script src="../js/index.js"></script>
</body>

</html>