<?php

namespace Database\Seeders;

use App\Models\Pelicula;
use Illuminate\Database\Seeder;

class PeliculaSeeder extends Seeder
{
    public function run(): void
    {
        // --- EN CARTELERA ---
        Pelicula::create(['titulo' => 'Michael', 'genero' => 'Biografía, Música', 'duracion' => '2h 10min', 'clasificacion' => 'APT', 'sinopsis' => 'Biografía del rey del pop.', 'imagen_poster' => 'imagenes/michael.jpg', 'estado' => 'cartelera']);
        Pelicula::create(['titulo' => 'Hokum', 'genero' => 'Terror', 'duracion' => '1h 47min', 'clasificacion' => '+14', 'sinopsis' => 'Terror puro.', 'imagen_poster' => 'imagenes/hokum.jpg', 'estado' => 'cartelera']);
        Pelicula::create(['titulo' => 'Obsesión', 'genero' => 'Suspenso', 'duracion' => '1h 50min', 'clasificacion' => '+18', 'sinopsis' => 'Thriller psicológico.', 'imagen_poster' => 'imagenes/obsesion.jpg', 'estado' => 'cartelera']);

        // --- PREVENTA ---
        Pelicula::create(['titulo' => 'Bleach: Thousand-Year Blood War', 'genero' => 'Anime, Acción', 'duracion' => '1h 25min', 'clasificacion' => '+14', 'sinopsis' => '23 Junio 2026', 'imagen_poster' => 'imagenes/Thousand Year Blood War.jpg', 'estado' => 'preventa']);
        Pelicula::create(['titulo' => 'Supergirl', 'genero' => 'Acción, Aventura', 'duracion' => '1h 48min', 'clasificacion' => '+14', 'sinopsis' => '23 Junio 2026', 'imagen_poster' => 'imagenes/supergirl.jpg', 'estado' => 'preventa']);
        Pelicula::create(['titulo' => 'Minions y Monstruos', 'genero' => 'Animación', 'duracion' => '1h 30min', 'clasificacion' => 'APT', 'sinopsis' => '01 Julio 2026', 'imagen_poster' => 'imagenes/Minions y Monstruos.jpg', 'estado' => 'preventa']);
        Pelicula::create(['titulo' => 'Sia: Nostalgic For The Present', 'genero' => 'Concierto', 'duracion' => '1h 15min', 'clasificacion' => '+14', 'sinopsis' => '23 Julio 2026', 'imagen_poster' => 'imagenes/Sia Nostalgic For The Present.jpg', 'estado' => 'preventa']);
        Pelicula::create(['titulo' => 'Spider-man Un nuevo dia', 'genero' => 'Acción', 'duracion' => '2h 25min', 'clasificacion' => 'APT', 'sinopsis' => '29 Julio 2026', 'imagen_poster' => 'imagenes/Spider man Un nuevo dia.jpg', 'estado' => 'preventa']);
        Pelicula::create(['titulo' => 'André Rieu Viva Maastricht', 'genero' => 'Concierto', 'duracion' => '2h 45min', 'clasificacion' => 'APT', 'sinopsis' => '29 Agosto 2026', 'imagen_poster' => 'imagenes/André Rieu\'s 2026 Sommerkonzert Viva M....jpg', 'estado' => 'preventa']);

        // --- PRÓXIMOS ESTRENOS ---
        Pelicula::create(['titulo' => 'En la Zona Gris', 'genero' => 'Thriller', 'duracion' => '1h 40min', 'clasificacion' => '+14', 'sinopsis' => 'Próximamente', 'imagen_poster' => 'imagenes/enlazonagris.jpg', 'estado' => 'estrenos']);
        Pelicula::create(['titulo' => 'Toy Story 5', 'genero' => 'Animación', 'duracion' => '1h 42min', 'clasificacion' => 'APT', 'sinopsis' => 'Próximamente', 'imagen_poster' => 'imagenes/Toy Story 5.jpg', 'estado' => 'estrenos']);
        Pelicula::create(['titulo' => 'El día de la revelación', 'genero' => 'Ciencia Ficción', 'duracion' => '2h 26min', 'clasificacion' => '+14', 'sinopsis' => 'Próximamente', 'imagen_poster' => 'imagenes/El Dia de la Revelacion.jpg', 'estado' => 'estrenos']);
        Pelicula::create(['titulo' => 'Amos del Universo', 'genero' => 'Acción', 'duracion' => '2h 21min', 'clasificacion' => '+14', 'sinopsis' => 'Próximamente', 'imagen_poster' => 'imagenes/Amos del Universo.jpg', 'estado' => 'estrenos']);
        Pelicula::create(['titulo' => 'Paucartambo', 'genero' => 'Documental', 'duracion' => '1h 11min', 'clasificacion' => 'APT', 'sinopsis' => 'Próximamente', 'imagen_poster' => 'imagenes/Paucartambo.jpg', 'estado' => 'estrenos']);
        Pelicula::create(['titulo' => 'Scary Movie Terrorificamente Incorrecta', 'genero' => 'Comedia', 'duracion' => '1h 38min', 'clasificacion' => '+18', 'sinopsis' => 'Próximamente', 'imagen_poster' => 'imagenes/scarymovie.jpg', 'estado' => 'estrenos']);
        Pelicula::create(['titulo' => 'El Afinador', 'genero' => 'Thriller', 'duracion' => '1h 49min', 'clasificacion' => '+14', 'sinopsis' => '25 Junio 2026', 'imagen_poster' => 'imagenes/el afinador.jpg', 'estado' => 'estrenos']);
        Pelicula::create(['titulo' => 'El juego de la muerte: La cacería', 'genero' => 'Terror', 'duracion' => '2h 01min', 'clasificacion' => '+14', 'sinopsis' => '25 Junio 2026', 'imagen_poster' => 'imagenes/El Juego de la Muerte La Caceria.jpg', 'estado' => 'estrenos']);
        Pelicula::create(['titulo' => 'La novia del diablo', 'genero' => 'Terror', 'duracion' => '2h', 'clasificacion' => '+14', 'sinopsis' => '25 Junio 2026', 'imagen_poster' => 'imagenes/La novia del diablo.jpg', 'estado' => 'estrenos']);
        Pelicula::create(['titulo' => 'Leviticus Ritual de sangre', 'genero' => 'Terror', 'duracion' => '1h 28min', 'clasificacion' => '+14', 'sinopsis' => '25 Junio 2026', 'imagen_poster' => 'imagenes/Leviticus Ritual de sangre.jpg', 'estado' => 'estrenos']);
        Pelicula::create(['titulo' => 'Letras Robadas', 'genero' => 'Comedia', 'duracion' => '1h 33min', 'clasificacion' => '+14', 'sinopsis' => '02 Julio 2026', 'imagen_poster' => 'imagenes/Letras Robadas.jpg', 'estado' => 'estrenos']);
        Pelicula::create(['titulo' => 'Moana 2', 'genero' => 'Familiar, Animación', 'duracion' => '1h 35min', 'clasificacion' => 'APT', 'sinopsis' => '08 Julio 2026', 'imagen_poster' => 'imagenes/Moana.jpg', 'estado' => 'estrenos']);
    }
}