<?php
    session_start();
    require '..\class\db.php';

    if( isset( $_SESSION['user_id'] ) ){
        header( 'Location: ../index.html' );
    }

    if( $_POST ){
        $email = $_POST['email'];
        $contra = $_POST['password'];
        $db = new database();
        $connect = $db->conectar();
        $usuario = $connect->login( $email, password_hash( $contra, PASSWORD_BCRYPT ) );
        if( count( $usuario ) > 0 && password_verify( $contra, $usuario['contraseña'] ) ){
            $_SESSION['user_id'] = $results['rfc'];
            $message = "Bienvenido ". $results['nombre'];
            header( 'Location: ../index.html' );
        }

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesión E-scommerce</title>
</head>
<body>
    <div>
        <span>
            <p>Iniciar sesión</p>
        </span>
        <hr><!---LINEA DE ADORNO DEBAJO REGSITRO-->
    </div><br>

    <?php
        if( $_POST ){
            echo "<p>" . $msg . "</p>";
        }
    ?>

    <form action="login.php" method="post">
        <input type="email" name="email" placeholder="example@example.com" maxlength="200" required>
        <input type="text" name="password" placeholder="Escribe aquí tu contraseña" maxlength="100" required>
        <input type="submit" value="Iniciar sesión">
    </form>
</body>
</html>