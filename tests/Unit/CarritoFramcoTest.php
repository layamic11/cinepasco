<?php

namespace Tests\Unit;

use App\Services\CarritoSingleton;
use Tests\TestCase;

class CarritoFramcoTest extends TestCase
{
    public function test_calcula_total_del_carrito()
    {
        session()->forget('cinepasco_carrito_backend');

        $carrito = new CarritoSingleton();

        $carrito->agregarProducto('Entrada General', 15);
        $carrito->agregarProducto('Canchita', 10);

        $this->assertEquals(25, $carrito->obtenerTotal());
    }
}
