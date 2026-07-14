<?php

namespace App\Http\Controllers;

use App\Models\Pelicula;
use App\Models\Producto;
use Illuminate\Http\Request;

class PeliculaController extends Controller
{
    protected $pelicula;
    protected $producto;

    // =====================================================================
    // PRINCIPIO SOLID (DIP): Inyección en el constructor (INTACTO)
    // =====================================================================
    public function __construct(Pelicula $pelicula, Producto $producto)
    {
        $this->pelicula = $pelicula;
        $this->producto = $producto;
    }

    public function index()
    {
        $cartelera = $this->pelicula->where('estado', 'cartelera')->get();
        $preventa = $this->pelicula->where('estado', 'preventa')->get();
        $estrenos = $this->pelicula->where('estado', 'estrenos')->get();
        
        $productos = $this->producto->all();
        
        $todasPeliculas = $this->pelicula->all();

        return view('index', compact('cartelera', 'preventa', 'estrenos', 'productos', 'todasPeliculas'));
    }

    // =====================================================================
    // FUNCIONES RESTAURADAS PARA EL PANEL DE ADMINISTRADOR
    // =====================================================================
    
    // 1. Esta es la función que te estaba pidiendo el error
    public function create()
    {
        return view('peliculas.create');
    }

    // 2. Agrego la función store por si también se borró (sirve para guardar el formulario)
    public function store(Request $request)
    {
        // Guardamos usando la instancia inyectada para seguir respetando el DIP
        $this->pelicula->create([
            'titulo' => $request->titulo,
            'genero' => $request->genero,
            'estado' => $request->estado,
            // Agregamos datos por defecto para que no falle la base de datos
            'duracion' => 'Por definir',
            'clasificacion' => 'APT',
            'imagen_poster' => 'imagenes/default.jpg'
        ]);

        return redirect('/')->with('success', 'Película creada exitosamente');
    }
}