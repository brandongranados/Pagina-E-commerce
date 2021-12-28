<?php
    //require '\Escommerce\class\db.php';
    require $_SERVER['DOCUMENT_ROOT'].'/Escommerce/class/db.php';

    if( $_POST)
    {
        $rfc = $_POST['rfc'];
        $nombre = $_POST['nombre'];
        $usuario = $_POST['nombreUsuario'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $tipo = $_POST['tipoUsuario'];
        $db = new database();
        echo $rfc;
        //$connect = $db->conectar();       // El método conectar únicamente se usa dentro de db por seguridad de acceso. Los demás métodos son los que van a llamarlo de forma interna.
        echo $db->signup( $rfc, $nombre, $usuario, $email, password_hash( $password, PASSWORD_BCRYPT ), $tipo );
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/registro.css">
    <script src="../js/bootstrap.js"></script>
    <title>Registro E-scommerce</title>
</head>
<body>
    <div class="reg-cabecera">
        <div class="clearfix">
            <a class="navbar-brand logo reg-cabeza" href="../html/index.html"><img src="../assets/images/LogoProyecto.png"
                        alt="Logo E-scommerce"></a>
            <strong><p class="reg-cabeza-nombre">registro</p></strong>
        </div>
    </div>
    <hr><!---LINEA DE ADORNO DEBAJO REGSITRO-->
    <form action="registro.php" method="post">
        <input type="text" name="rfc" placeholder="Escribe aquí tu rfc" maxlength="13" required>
        <input type="text" name="nombre" placeholder="Escribe aquí tu nombre" maxlength="150" required>
        <input type="text" name="nombreUsuario" placeholder="Escribe aquí tu nombre de usuario" maxlength="100" required>
        <input type="text" name="password" placeholder="Escribe aquí tu contraseña" maxlength="100" required>
        <input type="email" name="email" placeholder="example@example.com" maxlength="200" required>
        <div class="class-boton-radio"><p>Desea comenzar siendo vendedor</p></div>
        <div id="id-radio">
            <label>si</label>
            <input type="radio" class="input-radio" name="tipoUsuario" value="vendedor">
            <label>después</label>
            <input type="radio" class="input-radio" name="tipoUsuario" value="cliente" checked>
        </div>
        <div class="class-boton-radio"><button type="submit" class="boton-radio" name="reg">registrarme</button></div>
    </form>
</body>
</html>