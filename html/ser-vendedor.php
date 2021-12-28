<?php
    require $_SERVER['DOCUMENT_ROOT'].'/Escommerce/class/db.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/Escommerce/class/Cliente.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/Escommerce/class/Vendedor.php';
    session_start();

    if( isset( $_SESSION['user'] ) ){
        //$db = new database();
        $actual = unserialize( $_SESSION['user'] );
    }
       
if( $_POST )
    {
        $rfc = $actual->rfc;
        $idCategoria = htmlspecialchars($_POST['categoria']);
        $precio = htmlspecialchars($_POST['precio']);
        $marca = htmlspecialchars($_POST['marca']);
        $modelo = htmlspecialchars( $_POST['modelo'] );
        $caracteristicas = htmlspecialchars( $_POST['caracteristicas'] );
        $urlImg = htmlspecialchars( $_POST['urlImg'] );
        $oferta="no";
        $tipo = $actual->getTipo();
        $db = new database();
	$msg=$db->agregarProducto($rfc, $idCategoria, $precio, $marca, $modelo, $caracteristicas, $urlImg, $oferta);
	
	if($tipo!="vendedor"){
		echo ("ENTRA EN LA FUNCION");
		$exec=$db->cambiarTipo($rfc,"vendedor");
		if($exec){
			echo ("Se ha cambiado su tipo de usuario a vendedor");
		}
		
	}
	echo $msg;

        
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
    <title>Convertirse en vendedor</title>

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
    <!--INICIO de barra de navegacion-->
    <?php
        require_once "./cabeza.php";
    ?>
    <!--Fin de barra de navegacion-->
    <main class="container-fluid">
        <form class="clearfix" action="ser-vendedor.php" method="post">
            <section class="w-50 h-100 float-start max-"><!--SECCION IZQUIERDA MARCA MODELO ETC-->
                    <div class="form-control w-75 calcular custom-file" style="position: relative; overflow: hidden;">
                        <label for="file-subir" id="file-subir-label" class="text-center"><img style="max-width: 40%; max-height: 40%; position: absolute; top: 25%; left: 32%;" src="../assets/images/upload.png"></label>
                        <input id="file-subir" name="urlImg" type="file" class="h-100" style="display: none;" accept=".png, .jpg, .jpeg, .gif" required>
                        <img src="#" id="imagenSubir" style="display: none; width: 100%; height: 100%;">
                    </div>
                    <div class="w-75 calcular d-inline-flex">
                        <input class="form-control text-center" type="text" name="marca" maxlength="100" placeholder="Marca de producto" required>
                    </div>
                    <div class="w-75 calcular d-inline-flex">
                        <input class="form-control text-center" type="text" name="modelo" maxlength="100" placeholder="Modelo de producto" required>
                    </div>
                    <div class="w-75 calcular d-inline-flex">
                        <input class="form-control text-center" type="number" name="precio" placeholder="Precio de producto" required>
                    </div>
                    <div class="calcular d-inline-flex w-50">
                        <select class="text-center w-100" name="categoria" required>
                            <option value="0">Ropa mujer</option>
                            <option value="1">Ropa hombre</option>
                            <option value="2">Ropa ni&ntilde;o</option>
                            <option value="3">Ropa ni&ntilde;a</option>
                            <option value="4">Ropa beb&eacute;</option>
                            <option value="5">Celular</option>
                            <option value="6">Aud&iacute;fonos</option>
                            <option value="7">Monitores</option>
                            <option value="8">Teclados</option>
                            <option value="9">Ratones</option>
                            <option value="10">Jard&iacute;n</option>
                            <option value="11">Muebes</option>
                            <option value="12">Electrodom&eacute;sticos</option>
                            <option value="13">Maquillaje</option>
                            <option value="14">Skincare</option>
                            <option value="15">Cremas</option>
                            <option value="16">Shampoo</option>
                            <option value="17">Jabones</option>
                        </select>
                    </div>
                </section><!--SECCION IZQUIERDA MARCA MODELO ETC-->

            <section class="w-50 float-end"><!--SECCION DEECHA CARACTERISTICAS-->
                <div class=" w-75 calcular">
                    <label for="caracteristicas" class="form-label h1 text-center m-auto d-block">Caracter&iacute;sticas</label>
                    <textarea class="form-control" name="caracteristicas" id="caracteristicas" rows="25" cols="20" maxlength="500" required></textarea>
                </div>
                <div class="calcular">
                    <button class="d-block btn btn-dark w-75" type="submit" value="enviar">Envia producto</button>
                </div>
            </section><!--SECCION DEECHA CARACTERISTICAS-->
        </form>
    </main>

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
    <script src="../js/ser-vendedor.js"></script>
</body>

</html>
