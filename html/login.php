<?php
        require_once $_SERVER['DOCUMENT_ROOT'].'/Escommerce/class/db.php';
        require_once $_SERVER['DOCUMENT_ROOT'].'/Escommerce/class/Cliente.php';
        require_once $_SERVER['DOCUMENT_ROOT'].'/Escommerce/class/Vendedor.php';
        session_start();
        error_reporting(E_ALL ^ E_NOTICE);
        $errors = array();

        if( isset( $_SESSION['user'] ) )
        {
            header( 'Location: ../html/index.php' );
        }

        if( !empty( $_POST['correo'] ) && !empty( $_POST['contra'] ) )
        {
            $ema = htmlspecialchars($_POST['correo']);
            $contr = htmlspecialchars($_POST['contra']);
            $db = new database();
            //$connect = $db->conectar();
            //$usuario = $connect->login($ema, password_hash($contr, PASSWORD_BCRYPT));
            $usuario = $db->login($ema);
            //$actual = new Usuario( $usuario['nombreUsuario'], $usuario['rfc'], $usuario['correo'] );
            //print_r( $usuario );
            //if( isset( $usuario ) && password_verify( $contr, $usuario['contraUsuario'] ) )
            if( isset( $usuario ) && strcmp( $contr, $usuario['contraUsuario'] ) == 0 )
            {
                if( strcmp( $usuario['tipoUser'], "vendedor" ) == 0 ){
                    $actual = new Vendedor( $usuario['nombreUsuario'], $usuario['rfc'], $usuario['correo'], $usuario['tipoUser'] );
                }else{
                    $actual = new Cliente( $usuario['nombreUsuario'], $usuario['rfc'], $usuario['correo'], $usuario['tipoUser'] );
                }
                $_SESSION['user'] = serialize( $actual );
		        $response['status']="sucess";
	    	    $response['msg']="Bienvenido". $usuario['nombreUsuario'];
                header( 'Location: ../html/index.php' );
            }else{
		        $errors []= "Error de credenciales <br> revise su correo/contraseña";
                $response['status']="error";
    	    	$response['msg']="Ocurrió un error";
    	    	$response['errors']=$errors;
            }

        }
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/bootstrap.js"></script>
    <script defer src="../js/app.js"></script>
    <title>Ingresar a mi cuenta</title>
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    
    <div class="container-fluid ps-md-0">
        <div class="row g-0">
            <div class="d-none d-md-flex col-md-4 col-lg-6 bg-image"></div>
            <div class="col-md-8 col-lg-6">
                <div class="login d-flex align-items-center py-5">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-9 col-lg-8 mx-auto">
                                <button class="btn" type="button" aria-label="Regresar a inicio">
                                    <a href="index.php"><img src="https://img.icons8.com/windows/32/000000/long-arrow-left.png"/></a>
                                </button>
                                <h3 class="login-heading mb-4">Bienvenido de regreso!</h3>
                                    
                                <!--Aqui inicia el cambio de como se reportan los errores -->
                                <?php if(isset($response)): ?>
      				<!--El dive recibe la clase de auerdo al response status -->
      					<div class="<?php echo $response['status']; ?>">

      						<p><?php echo $response['msg']; ?></p>
      						<!--Si hay errores -->
      						<?php if(isset($response['errors'])); ?>
      						<ul>
        						<?php foreach ((array)$response['errors'] as $error): ?>
        							<li><?php echo $error; ?></li>
      							<?php endforeach ?>
      						</ul>
    					</div>
    				<?php endif ?>
                                    
                                <!-- Sign In Form -->
                                <form action="login.php" method="POST">
                                    <div class="form-floating mb-3">
                                        <input type="email" name="correo" class="form-control" id="floatingInput"
                                            placeholder="nombre@ejemplo.com">
                                        <label for="floatingInput">Correo electronico</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="password" name="contra" class="form-control" id="floatingPassword"
                                            placeholder="Contraseña">
                                        <label for="floatingPassword">Contraseña</label>
                                    </div>
                                    <div class="d-grid">
                                        <button class="btn btn-lg btn-primary btn-login text-uppercase fw-bold mb-2"
                                            type="submit">Entrar</button>
                                        <div class="text-center">
                                            <a class="small" href="registrarCuenta.php">No tienes una cuenta? Haz una!</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
</body>

</html>
