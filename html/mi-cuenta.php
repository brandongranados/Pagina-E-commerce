<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/Escommerce/class/db.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/Escommerce/class/Vendedor.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/Escommerce/class/Cliente.php';
    session_start();

    if( isset( $_SESSION['user'] ) ){
        $db = new database();
        $actual = unserialize( $_SESSION['user'] );
    }else{
        header( 'Location: ./login.php' );
    }

    if( $_POST ){
        $contra = $_POST['password'];
        $contr = $_POST['pass'];
        if( strcmp( $contra, $contr ) == 0 ){
            $res = $db->cambiarContrasena( $actual->rfc, $contra );
            if( $res ){
                $msg = "Contraseña cambiada";
            }else{
                $msg = "Algo salió mal";
            }
        }else{
            $msg = "Contraseñas no coinciden";
        }
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
    <title>Mi cuenta</title>

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
                            <li class="breadcrumb-item"><a href="./index.html" id="indexBread"><img
                                        src="https://img.icons8.com/material-sharp/24/000000/home.png" />Inicio</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Mi cuenta</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <form action="mi-cuenta.php" class="checkout__form" method="post">
                <div class="row">
                    <div class="col-lg-8">
                        <h5>Datos de mi cuenta</h5>
                        <?php
                            if( $_POST ){
                                echo $msg;
                                //echo $res;
                            }
                        ?>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="checkout__form__input">
                                    <p>Nombre:</p>
                                    <input type="text" disabled value="<?php echo $actual->usuario ?>">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="checkout__form__input">
                                    <p>Email:</p>
                                    <input type="text" disabled value="<?php echo $actual->getCorreo() ?>">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="checkout__form__input">
                                    <p>RFC:</p>
                                    <input type="text" disabled value="<?php echo $actual->rfc ?>">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="checkout__form__input">
                                    <p>Contrase&ntilde;a nueva</p>
                                    <input type="password" name="password">
                                </div>
                                <div class="checkout__form__input">
                                    <p>Confirmar contrase&ntilde;a</p>
                                    <input type="password" name="pass">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="d-grid">
                                    <button class="btn btn-lg btn-primary btn-login text-uppercase fw-bold mb-2"
                                        type="submit">Cambiar contrase&ntilde;a</button>
                                    <div class="text-center">
                                        <a class="small" href="registrarCuenta.php">Te gustar&iacute;a empezar a vender tus productos? Haz click aqu&iacute;!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-4">
                        <div class="blog__sidebar">
                            <div class="blog__sidebar__item">
                                <div class="section-title">
                                    <h4>M&aacute;s informaci&oacute;n</h4>
                                </div>
                                <ul>
                                    <li><a href="./historial.html">Mis pedidos <span></span></a></li>
                                    <li><a href="./carrito.php">Mi carrito <span></span></a></li>
				                    <?php if($actual->getTipo()=="cliente"){ ?>
                                    <li><a href="./ser-vendedor.php">Vender<span></span></a></li>
				                    <?php } ?>
				                    <?php if($actual->getTipo()=="vendedor"){ ?>
                                    <li><a href="./ser-vendedor.php">Agregar producto al inventario<span></span></a></li>
                                    <li><a href="./inventario.html">Inventario <span></span></a></li>
                                    <?php } ?>
                                    <!--!! Esto solo en caso de que la cuenta -->
                                    <!--!! sea de un vendedor -->
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </section>
    <!-- Checkout Section End -->

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
