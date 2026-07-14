<?php

namespace Database\Seeders;

use App\Models\Producto;
use Illuminate\Database\Seeder;

class ProductoSeeder extends Seeder
{
    public function run(): void
    {
        // COMBOS
        Producto::create(['nombre' => 'Combo Pareja', 'categoria' => 'combos', 'descripcion' => '2 Gaseosas Medianas + 1 Canchita Grande Salada.', 'precio' => 33.30, 'imagen' => 'imagenes/dulceria/combo_pareja.jpg']);
        Producto::create(['nombre' => 'Combo Trío', 'categoria' => 'combos', 'descripcion' => '3 Gaseosas Medianas + 1 Canchita Gigante Salada.', 'precio' => 48.20, 'imagen' => 'imagenes/dulceria/combo_trio.jpg']);
        Producto::create(['nombre' => 'Combo Frankfurter', 'categoria' => 'combos', 'descripcion' => '1 Gaseosa Mediana + 1 Frankfurter (Hot Dog).', 'precio' => 22.10, 'imagen' => 'imagenes/dulceria/hotdog.jpg']);

        // CANCHITA
        Producto::create(['nombre' => 'Canchita Gigante', 'categoria' => 'canchita', 'descripcion' => 'Porción gigante de canchita recién hecha.', 'precio' => 18.00, 'imagen' => 'imagenes/dulceria/canchita_gigante.jpg']);
        Producto::create(['nombre' => 'Canchita Mediana', 'categoria' => 'canchita', 'descripcion' => 'Porción mediana perfecta para ti solo.', 'precio' => 14.50, 'imagen' => 'imagenes/dulceria/canchita_mediana.jpg']);
        Producto::create(['nombre' => 'Cambio a Dulce', 'categoria' => 'canchita', 'descripcion' => 'Suma para cambiar tu canchita a dulce.', 'precio' => 4.00, 'imagen' => 'imagenes/dulceria/popcorn.png']);

        // BEBIDAS
        Producto::create(['nombre' => 'Gaseosa Grande', 'categoria' => 'bebidas', 'descripcion' => 'Gaseosa de 32oz bien helada.', 'precio' => 12.00, 'imagen' => 'imagenes/dulceria/gaseosa_grande.jpg']);
        Producto::create(['nombre' => 'Gaseosa Mediana', 'categoria' => 'bebidas', 'descripcion' => 'Gaseosa de 21oz de tu sabor favorito.', 'precio' => 9.50, 'imagen' => 'imagenes/dulceria/gaseosa.jpg']);
        Producto::create(['nombre' => 'Agua Mineral', 'categoria' => 'bebidas', 'descripcion' => 'Agua sin gas 500ml.', 'precio' => 4.00, 'imagen' => 'imagenes/dulceria/agua_mineral.jpg']);
        Producto::create(['nombre' => 'Chicha Morada', 'categoria' => 'bebidas', 'descripcion' => 'Vaso mediano de chicha morada natural.', 'precio' => 6.50, 'imagen' => 'imagenes/dulceria/chicha_morada.jpg']);

        // SNACKS
        Producto::create(['nombre' => 'Nachos con Queso', 'categoria' => 'snacks', 'descripcion' => 'Nachos crujientes con queso cheddar.', 'precio' => 15.00, 'imagen' => 'imagenes/dulceria/nachos_queso.jpg']);
        Producto::create(['nombre' => 'Chocolate M&M\'s', 'categoria' => 'snacks', 'descripcion' => 'Bolsa de chocolates para endulzar tu peli.', 'precio' => 8.00, 'imagen' => 'imagenes/dulceria/snack_chocolate.jpg']);
        Producto::create(['nombre' => 'Gomitas Frugelés', 'categoria' => 'snacks', 'descripcion' => 'Paquete grande de gomitas frutales.', 'precio' => 7.50, 'imagen' => 'imagenes/dulceria/snack_gomitas.jpg']);

        // COLECCIONABLES
        Producto::create(['nombre' => 'Balde Spider-Man', 'categoria' => 'coleccionables', 'descripcion' => 'Balde metálico edición especial.', 'precio' => 45.00, 'imagen' => 'imagenes/dulceria/balde_coleccionable_spiderman.jpg']);
        Producto::create(['nombre' => 'Balde Star Wars', 'categoria' => 'coleccionables', 'descripcion' => 'Balde edición limitada The Mandalorian.', 'precio' => 45.00, 'imagen' => 'imagenes/dulceria/balde_coleccionable_starwars.jpg']);
        Producto::create(['nombre' => 'Balde Toy Story 5', 'categoria' => 'coleccionables', 'descripcion' => 'Balde infantil de Woody y Buzz.', 'precio' => 38.00, 'imagen' => 'imagenes/dulceria/balde_coleccionable_toystory5.jpg']);
    }
}