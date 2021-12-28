<?php

class Venta
{
    public $id_venta;
    private $id_usuario;
    private $total;
    private $productos_vendidos;

    public function __construct($id_venta, $id_usuario)
    {
        $this->id_venta = $id_venta;
        $this->id_usuario = $id_usuario;
    }
}

?>