<?php

namespace App\Services;

interface CarritoInterface
{
    public function agregarProducto($nombre, $precio);
    public function obtenerTotal();
    public function vaciarCarrito();
}