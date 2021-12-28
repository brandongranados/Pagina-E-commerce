<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/Escommerce/class/db.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/Escommerce/class/Vendedor.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/Escommerce/class/Cliente.php';
    session_start();
    $db = new database();

    if( isset( $_SESSION['user'] ) ){
        $actual = unserialize( $_SESSION['user'] );
    }

    if( isset( $_GET['busqueda'] ) ){
        $productos = $db->buscadorProductos( $_GET['busqueda'] );
        $msg = $productos;
    }else{
        if( isset( $_GET['buscarCategoria'] ) ){
            $ids = $db->idCategoria( $_GET['buscarCategoria'] );
            $msg = $ids;
            if( isset( $ids ) ){
                $id = $ids['idCategoria'];
                $productos = $db->buscadorProductosCategoria( $id );
            }
        }else{
            $productos = $db->ultimosProductos( 10 ); 
        }
    }

    //unset( $_SESSION['carrito'] );

    /*else{
        header( 'Location: ./tienda.php' );
    }*/
    /*PARA LOS LISNKS DE CATEGORIAS CADA VEZ QUE SE DEN CLIC, SE AGREGA UN ID "seleccionado" PARA 
    IDENTIFICAR A EL QUE ESTA SELECCIONADO TAMBIEN EN EL BOTON FILTRAR PASARA LO MISMO QUE ESTA SELECCIONADO
    LOS VALORES DE FILTRO SE ECUENTRAR EN LOS IMPUT TEXT "maxamount" PARA E TOPE MAXIMO Y
    "minamount" para el tope minimo con el atributo value se accede a los precios tope en cada input
    PARA LOS CHECKBOXES CUANDO LO MARCAS SE AGREGA EL ATRIBUTO CHECKED O SE QUITA SI VUELVES A SELECCIONAR EL MISMO
    
    PARA QUE FNCIONE SE DEBE DE PONER LA CLASE "categorias" A LOS LINKS DE CATEGORIAS QUE SE AGREGUEN
    CON EL MISMO FORMATO Y DIVS QUE LOS ENVUELVEN
    PARA LOS CHECK SE DEBDE DE PONER LA CLASE ""checkboxesMarcados" en los span que estan justo arriba del check
    revisar el codigo para ver los ejemplos de ambos*/
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ashion Template">
    <meta name="keywords" content="Ashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Categor&iacute;as Escommerce</title>

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
                            <li class="breadcrumb-item active" aria-current="page">Categorias</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->
    <!-- Shop Section Begin -->
    <section class="shop spad" id="lista-productos">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <div class="shop__sidebar">
                        <div class="sidebar__categories">
                            <div class="section-title">
                                <h4>Categories</h4>
                            </div>
                            <div class="categories__accordion">
                                <div class="accordion" id="accordionExample">
                                    <div class="card">
                                        <div class="card-heading active">
                                            <a data-toggle="collapse" data-target="#collapseOne">Moda</a>
                                        </div>
                                        <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                                            <div class="card-body">
                                                <ul>
                                                    <li><a href="#" class="categorias">Mujeres</a></li>
                                                    <li><a href="#" class="categorias">Hombres</a></li>
                                                    <li><a href="#" class="categorias">Ni&ntilde;os</a></li>
                                                    <li><a href="#" class="categorias">Ni&ntilde;as</a></li>
                                                    <li><a href="#" class="categorias">Beb&eacute;s</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-heading">
                                            <a data-toggle="collapse" data-target="#collapseTwo">Electr&oacute;nica</a>
                                        </div>
                                        <div id="collapseTwo" class="collapse" data-parent="#accordionExample">
                                            <div class="card-body">
                                                <ul>
                                                    <li><a href="#" class="categorias">Celulares</a></li>
                                                    <li><a href="#" class="categorias">Aud&iacute;fonos</a></li>
                                                    <li><a href="#" class="categorias">Monitores</a></li>
                                                    <li><a href="#" class="categorias">Teclados</a></li>
                                                    <li><a href="#" class="categorias">Ratones</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-heading">
                                            <a data-toggle="collapse" data-target="#collapseThree">Hogar</a>
                                        </div>
                                        <div id="collapseThree" class="collapse" data-parent="#accordionExample">
                                            <div class="card-body">
                                                <ul>
                                                    <li><a href="#" class="categorias">Jard&iacute;n</a></li>
                                                    <li><a href="#" class="categorias">Muebles</a></li>
                                                    <li><a href="#" class="categorias">Electrodom&eacute;sticos</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-heading">
                                            <a data-toggle="collapse" data-target="#collapseFour">Salud y belleza</a>
                                        </div>
                                        <div id="collapseFour" class="collapse" data-parent="#accordionExample">
                                            <div class="card-body">
                                                <ul>
                                                    <li><a href="#" class="categorias">Maquillaje</a></li>
                                                    <li><a href="#" class="categorias">Skin Care</a></li>
                                                    <li><a href="#" class="categorias">Cremas corporales</a></li>
                                                    <li><a href="#" class="categorias">Shampoo</a></li>
                                                    <li><a href="#" class="categorias">Jabones</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar__filter">
                            <div class="section-title">
                                <h4>Filtrar por precio</h4>
                            </div>
                            <div class="filter-range-wrap">
                                <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                                    data-min="33" data-max="99"></div>
                                <div class="range-slider">
                                    <div class="price-input">
                                        <p>Precio:</p>
                                        <input type="text" id="minamount">
                                        <input type="text" id="maxamount">
                                    </div>
                                </div>
                            </div>
                            <a href="#" class="categorias">Filtrar</a>
                        </div>
                        <div class="sidebar__sizes">
                            <div class="section-title">
                                <h4>Filtrar por marca</h4>
                            </div>
                            <div class="size__list">
                                <label for="xxs" class="checkboxesMarcados">
                                    Por
                                    <input type="checkbox" id="xxs" name="marca1" >
                                    <span class="checkmark"></span>
                                </label>
                                <label for="xs" class="checkboxesMarcados">
                                    favor
                                    <input type="checkbox" id="xs" name="marca2" >
                                    <span class="checkmark"></span>
                                </label>
                                <label for="xss" class="checkboxesMarcados">
                                    pon
                                    <input type="checkbox" id="xss" name="marca3" >
                                    <span class="checkmark"></span>
                                </label>
                                <label for="s" class="checkboxesMarcados">
                                    las
                                    <input type="checkbox" id="s" name="marca4" >
                                    <span class="checkmark"></span>
                                </label>
                                <label for="m" class="checkboxesMarcados">
                                    marcas
                                    <input type="checkbox" id="m" name="marca5" >
                                    <span class="checkmark"></span>
                                </label>
                                <label for="ml" class="checkboxesMarcados">
                                    gracias
                                    <input type="checkbox" id="ml" name="marca6" >
                                    <span class="checkmark"></span>
                                </label>
                                <label for="l" class="checkboxesMarcados">
                                    ja
                                    <input type="checkbox" id="l" name="marca7" >
                                    <span class="checkmark"></span>
                                </label>
                                <label for="xl" class="checkboxesMarcados">
                                    ja
                                    <input type="checkbox" id="xl" name="marca8" >
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>
                        <div class="sidebar__color">
                            <div class="section-title">
                                <h4>Filtrar por modelo</h4>
                            </div>
                            <div class="size__list color__list">
                                <label for="black" class="checkboxesMarcados">
                                    y
                                    <input type="checkbox" id="black" name="modelo1" >
                                    <span class="checkmark"></span>
                                </label>
                                <label for="whites" class="checkboxesMarcados">
                                    tambien
                                    <input type="checkbox" id="whites" name="modelo2" >
                                    <span class="checkmark"></span>
                                </label>
                                <label for="reds" class="checkboxesMarcados">
                                    los
                                    <input type="checkbox" id="reds" name="modelo3" >
                                    <span class="checkmark"></span>
                                </label>
                                <label for="greys" class="checkboxesMarcados">
                                    modelos
                                    <input type="checkbox" id="greys" name="modelo4" >
                                    <span class="checkmark"></span>
                                </label>
                                <label for="blues" class="checkboxesMarcados">
                                    por
                                    <input type="checkbox" id="blues" name="modelo5" >
                                    <span class="checkmark"></span>
                                </label>
                                <label for="beige" class="checkboxesMarcados">
                                    fis
                                    <input type="checkbox" id="beige" name="modelo6" >
                                    <span class="checkmark"></span>
                                </label>
                                <label for="greens" class="checkboxesMarcados">
                                    Greens
                                    <input type="checkbox" id="greens" name="modelo7" >
                                    <span class="checkmark"></span>
                                </label>
                                <label for="yellows" class="checkboxesMarcados">
                                    Yellows
                                    <input type="checkbox" id="yellows" name="modelo8" >
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-lg-9 col-md-9">
                    <div class="row">
                        <?php
//                            foreach( $producto as $productos ){
                        //if( $_GET ){
                        if( isset( $productos ) ){
                        if( mysqli_num_rows( $productos ) > 0 ){
                            while( $row = mysqli_fetch_array( $productos, MYSQLI_ASSOC ) ){
                                //print_r( $row )
                        ?>

                        <div class="col-lg-4 col-md-6">
                            <div class="product__item sale">
                                <div class="product__item__pic set-bg"
                                    data-setbg=<?php echo '"' . $row['urlImg'] . '"'; ?>>
                                    <!-- <img src="../assets/images/productos/product-4.jpg" -->
                                    <img src=<?php echo '"' . $row['urlImg'] . '"'; ?>
                                        class="product__item__pic set-bg">
                                    <div class="label"><?php if( strcmp( $row['oferta'], "si" ) == 0 ){ echo "OFERTA"; }else{ echo "VENTA"; } ?></div>
                                    <ul class="product__hover">
                                        <li><a href="#" onclick="agregarCarrito( <?php echo $row['idProducto'] ?> )" class="agregar-carrito"><img class="agregar-carrito"
                                                    src="https://img.icons8.com/windows/32/000000/add-shopping-cart.png" /></a>
                                        </li>
                                        <!-- <p class="pid" style="display: none"></p>
                                        <p class="pod" style="display: none"></p> -->
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6><a href="./detalles-producto.html" onclick="goto('detalles-producto')"><?php echo $row['marca'] . " " . $row['modelo']; ?></a></h6>
                                    <div class="rating">
                                        <img src="https://img.icons8.com/office/16/000000/filled-star--v1.png" />
                                        <img src="https://img.icons8.com/office/16/000000/filled-star--v1.png" />
                                        <img src="https://img.icons8.com/office/16/000000/filled-star--v1.png" />
                                        <img src="https://img.icons8.com/office/16/000000/filled-star--v1.png" />
                                        <img src="https://img.icons8.com/office/16/000000/filled-star--v1.png" />
                                    </div>
                                    <div class="product__price">$ <?php echo $row['precio']; ?> <span>$ 59.0</span></div>
                                </div>
                            </div>
                        </div>
                        <?php }}}else{ echo "No hay productos"; }/*}*/  ?>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Section End -->

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
        function agregarCarrito( id ){
            //alert( typeof id );
            $.ajax({
               method: "POST",
               url: "wrap.php",
               data: { agregar: String( id ) }
           })
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
    <script src="../js/tienda.js"></script>
</body>

</html>