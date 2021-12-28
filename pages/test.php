<?php
if(isset($_GET['reg']))
{
    $rfc = $_GET['rfc'];
    $nombre = $_GET['nombreUsuario'];
    $email = $_GET['email'];
    $tipo = $_GET['tipoUsuario'];
}
?>

<form action="test.php" method="get">
    <input type="text" name="datos" value="<?php echo $rfc?>">
    <input type="text" name="datos" value="<?php echo $nombre?>">
    <input type="text" name="datos" value="<?php echo $email?>">
    <input type="text" name="datos" value="<?php echo $tipo?>">
</form>