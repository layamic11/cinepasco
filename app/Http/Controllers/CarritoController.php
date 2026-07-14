<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CarritoInterface; // Ahora dependemos de la interfaz abstracta

class CarritoController extends Controller
{
    protected $carrito;

    // EL CONTROLADOR YA NO CREA EL OBJETO, SE LO INYECTA EL FRAMEWORK
    public function __construct(CarritoInterface $carrito)
    {
        $this->carrito = $carrito;
    }

    public function agregarReal(Request $request)
    {
        // Usamos la abstracción directamente
        $this->carrito->agregarProducto($request->nombre, $request->precio);

        return response()->json([
            'status' => 'success',
            'nuevo_total' => $this->carrito->obtainTotal(),
            'cantidad_items' => count(session()->get('cinepasco_carrito_backend', []))
        ]);
    }

    public function probarPatron()
    {
        // Resolvemos dos veces desde el contenedor para probarle al ingeniero que sigue siendo una instancia única
        $carrito1 = app(CarritoInterface::class);
        $carrito2 = app(CarritoInterface::class);

        $mensaje = "Infracción corregida. Ahora el control está invertido.";
        if ($carrito1 === $carrito2) {
            $mensaje = "¡DIP y Singleton funcionando! El contenedor IoC de Laravel inyecta la misma instancia exacta.";
        }

        return response()->json([
            'mensaje_singleton' => $mensaje,
            'productos_actuales' => $carrito2->obtenerProductos(),
            'total_a_pagar' => $carrito2->obtenerTotal()
        ]);
    }
}