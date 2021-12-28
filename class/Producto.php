<?php

class Producto
{
    public $id_producto;
    public $Nombre;
    private $precio;
    private $marca;
    private $modelo;
    private $caracteristicas;
    private $categoria;
    private $calificacion;
    private $img;

    public function __construct($id_producto, $Nombre, $precio, $caracteristicas, $categoria, $img)
    {
        $this->id_producto = $id_producto;
        $this->Nombre = $Nombre;
        $this->precio = $precio;
        $this->caracteristicas = $caracteristicas;
        $this->categoria = $categoria;
        $this->img = $img;
    }

    public function getPrecio(){
        return $this->precio;
    }
    
    public function getMarca(){
        return $this->marca;
    }

    public function getModelo(){
        return $this->modelo;
    }

    public function getCaracteristicas(){
        return $this->caracteristicas;
    }

    public function getCategoria(){
        return $this->categoria;
    }

    public function getCalificacion(){
        return $this->calificacion;
    }

    public function getImg(){
        return $this->img;
    }

}

?>