<?php

namespace App\Services;

class CarritoSingleton implements CarritoInterface
{
    // El Contenedor de Laravel manejará la instancia única. 
    // Hacemos el constructor público para que el framework pueda instanciarlo una sola vez.
    public function __construct() { }

    public function agregarProducto($nombre, $precio)
    {
        $productos = session()->get('cinepasco_carrito_backend', []);
        $productos[] = [
            'nombre' => $nombre,
            'precio' => $precio
        ];
        session()->put('cinepasco_carrito_backend', $productos);
    }

    public function obtenerTotal()
    {
        $productos = session()->get('cinepasco_carrito_backend', []);
        $total = 0;
        foreach ($productos as $item) {
            $total += $item['precio'];
        }
        return $total;
    }

    public function vaciarCarrito()
    {
        session()->forget('cinepasco_carrito_backend');
    }

    public function obtenerProductos()
    {
        return session()->get('cinepasco_carrito_backend', []);
    }
}