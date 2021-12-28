<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/registro.css">
    <script src="../js/bootstrap.js"></script>
    <script defer src="../js/app.js"></script>
    <title>Registro</title>
</head>

<body>

    <body>
        <?php
            //require '\Escommerce\class\db.php';
            require $_SERVER['DOCUMENT_ROOT'].'/Escommerce/class/db.php';

            if( isset( $_POST) )
            {
                $rfc = htmlspecialchars($_POST['rfc']);
                $usuario = htmlspecialchars($_POST['nombreUsuario']);
                $email = htmlspecialchars($_POST['correo']);
                $password = htmlspecialchars($_POST['contraUsuario']);
                $tipo = "cliente";
                $db = new database();
                //echo $rfc;
                //$connect = $db->conectar();       // El método conectar únicamente se usa dentro de db por seguridad de acceso. Los demás métodos son los que van a llamarlo de forma interna.
                //echo $db->signup( $rfc, $nombre, $usuario, $email, password_hash( $password, PASSWORD_BCRYPT ), $tipo );
                $salida = $db->signup( $rfc,$usuario, $email, $password, $tipo );
                //$db->desconectar($db);
            }
        ?>

        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-xl-9 mx-auto">
                    <div class="card flex-row my-5 border-0 shadow rounded-3 overflow-hidden">
                        <div class="card-img-left d-none d-md-flex">
                            <!-- Background image for card set in CSS! -->
                        </div>
                        <div class="card-body p-4 p-sm-5">
                            <button class="btn" type="button" aria-label="Regresar a inicio">
                                <a href="index.html"><img
                                        src="https://img.icons8.com/windows/32/000000/long-arrow-left.png" /></a>
                            </button>
                            <h5 class="card-title text-center mb-5 fw-light fs-5">Registro</h5>
                            <form action="registrarCuenta.php" method="post">
                                <div class="form-floating mb-3">
                                    <input type="text" name="nombreUsuario" class="form-control"
                                        id="inputNombreUsuario" placeholder="Nombre de usuario" required autofocus>
                                    <label for="inputNombreUsuario">Nombre de usuario</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" name="rfc" class="form-control"
                                        id="inputNombreCompleto" placeholder="Nombre de usuario" required autofocus>
                                    <label for="inputNombreCompleto">Nombre completo</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="email" name="correo" class="form-control" id="inputEmail"
                                        placeholder="nombre@ejemplo.com">
                                    <label for="inputEmail">Correo electronico</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" name="rfc" class="form-control"
                                        id="inputRFC" placeholder="Nombre de usuario" required autofocus>
                                    <label for="inputRFC">RFC</label>
                                </div>
                                <p>¿Desea empezar como vendedor?</p>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault"
                                        id="radioSi">
                                    <label class="form-check-label" for="radioSi">
                                        S&iacute;
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault"
                                        id="radioNo" checked>
                                    <label class="form-check-label" for="radioNo">
                                        No
                                    </label>
                                </div>
                                <hr>
                                <div class="form-floating mb-3">
                                    <input type="password" name="contraUsuario" class="form-control"
                                        id="floatingPassword" placeholder="Contraseña">
                                    <label for="floatingPassword">Contraseña</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control" id="floatingPasswordConfirm"
                                        placeholder="Confirmar contraseña">
                                    <label for="floatingPasswordConfirm">Confirmar contraseña</label>
                                </div>
                                <div class="d-grid mb-2">
                                    <button class="btn btn-lg btn-primary btn-login fw-bold text-uppercase"
                                        type="submit">Registrarme</button>
                                </div>
                                <a class="d-block text-center mt-2 small" href="login.html">Ya tienes cuenta? Entra
                                    aqui!</a>
                                <hr class="my-4">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</body>

</html>