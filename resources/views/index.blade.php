<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>CinePasco | Catálogo Premium</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

    <div id="space-background"></div>

    <header>
        <div class="logo" id="btn-logo" style="cursor: pointer;">
            <i class="fas fa-video"></i> CinePasco
        </div>
        <nav class="main-nav">
            <ul>
                <li><a href="#" class="nav-link" data-target="sec-peliculas">Películas</a></li>
                <li><a href="#" class="nav-link" data-target="sec-cines">Cines</a></li>
                <li><a href="#" class="nav-link" data-target="sec-comida">Dulcería</a></li>
                <li><a href="#" class="nav-link" data-target="sec-promociones">Promociones</a></li>
                
                <li id="nav-admin" style="display: none;"><a href="#" class="nav-link" data-target="sec-admin" style="color: #ff3b3b; font-weight: bold;"><i class="fas fa-lock"></i> Panel Admin</a></li>
            </ul>
         </nav>
        <div class="header-icons">
            <i class="fas fa-search"></i>
            <i class="fas fa-user" id="btn-abrir-login" style="cursor: pointer;" title="Iniciar Sesión"></i>
            <i class="fas fa-question-circle"></i>
        </div>
    </header>

    <main>
        <section id="sec-inicio" class="vista-activa">
            
            <section class="main-hero-slider">
                <div class="hero-slides-container">
                    <div class="hero-slide active"><img src="{{ asset('imagenes/baner/baner1.jpg') }}" alt="Promo 1"></div>
                    <div class="hero-slide"><img src="{{ asset('imagenes/baner/baner2.jpg') }}" alt="Promo 2"></div>
                    <div class="hero-slide"><img src="{{ asset('imagenes/baner/baner3.jpg') }}" alt="Promo 3"></div>
                    <div class="hero-slide"><img src="{{ asset('imagenes/baner/baner4.jpg') }}" alt="Promo 4"></div>
                    <div class="hero-slide"><img src="{{ asset('imagenes/baner/baner5.png') }}" alt="Promo 5"></div>
                    <div class="hero-slide"><img src="{{ asset('imagenes/baner/baner6.png') }}" alt="Promo 6"></div>
                </div>
                <button class="hero-btn-arrow prev" onclick="moveHeroSlider(-1)"><i class="fas fa-chevron-left"></i></button>
                <button class="hero-btn-arrow next" onclick="moveHeroSlider(1)"><i class="fas fa-chevron-right"></i></button>
                <div class="hero-dots">
                    <span class="dot active" onclick="setHeroSlide(0)"></span>
                    <span class="dot" onclick="setHeroSlide(1)"></span>
                    <span class="dot" onclick="setHeroSlide(2)"></span>
                    <span class="dot" onclick="setHeroSlide(3)"></span>
                    <span class="dot" onclick="setHeroSlide(4)"></span>
                    <span class="dot" onclick="setHeroSlide(5)"></span>
                </div>
            </section>

            <section class="quick-filters">
                <button>Por película <i class="fas fa-chevron-down"></i></button>
                <button>Por distrito <i class="fas fa-chevron-down"></i></button>
                <button>Por cine <i class="fas fa-chevron-down"></i></button>
                <button>Por fecha <i class="fas fa-chevron-down"></i></button>
                <button class="filter-btn-main">FILTRAR</button>
            </section>

            <section class="cartelera-inmersiva-section">
                <h1 class="titulo-cartelera-neon">CARTELERA DESTACADA</h1>
                <div class="contenedor-inmersivo">
                    <img src="{{ asset('imagenes/vista cine.jpg') }}" class="bg-inmersivo" alt="Fondo Cine">
                    <div class="brillo-rojo-neon"></div>

                    <div class="panel-flotante-peliculas">
                        <div class="header-panel-inmersivo">
                            <span>Filtrar por</span><i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="lista-peliculas-inmersiva">
                            @foreach($cartelera as $key => $pelicula)
                                <div class="item-peli-inmersiva {{ $key == 0 ? 'activo' : '' }}" 
                                  onmouseenter="cambiarPantallaInmersiva('{{ asset($pelicula->imagen_poster) }}', this)">
                                    <img src="{{ asset($pelicula->imagen_poster) }}" alt="{{ $pelicula->titulo }}" id="peli-inm-{{ $pelicula->id }}">
                                    <div class="info-peli-inmersiva">
                                        <h4>{{ $pelicula->titulo }}</h4>
                                        <p>{{ $pelicula->genero }}</p>
                                        <div class="horarios-inmersivos">
                                            <button class="btn-hora activo" onclick="iniciarProcesoCompra('{{ addslashes($pelicula->titulo) }}', 'peli-inm-{{ $pelicula->id }}')">08:30 PM</button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="zona-pantalla-cine">
                        <div class="pantalla-cine-glow">
                            <img src="{{ asset($cartelera[0]->imagen_poster ?? 'imagenes/michael.jpg') }}" id="pantalla-principal-inmersiva" alt="Pantalla">
                        </div>
                    </div>
                </div>
                
                <div class="btn-centrado-cartelera">
                    <button class="see-more-box-btn" onclick="window.irAPeliculasTab('cartelera')">VER TODO EL CATÁLOGO</button>
                </div>
            </section>

            <section class="horizontal-slider-section">
                <div class="slider-header">
                    <h2>PREVENTA</h2>
                    <div class="slider-controls">
                        <button class="btn-ver-mas-seccion" onclick="window.irAPeliculasTab('preventa')">Ver más <i class="fas fa-chevron-right"></i></button>
                        <button class="btn-arrow" id="prev-preventa"><i class="fas fa-chevron-left"></i></button>
                        <button class="btn-arrow" id="next-preventa"><i class="fas fa-chevron-right"></i></button>
                    </div>
                </div>
                <div class="slider-viewport">
                    <div class="slider-track" id="track-preventa">
                        @foreach($preventa as $pelicula)
                        <div class="cine-card" onclick="verDetalles('{{ addslashes($pelicula->titulo) }}', '{{ $pelicula->genero }}', '{{ $pelicula->duracion }}', '{{ $pelicula->clasificacion }}', 'img-prev-{{ $pelicula->id }}')">
                            <div class="poster-wrap"><span class="tag-duration">{{ $pelicula->duracion }}</span><img src="{{ asset($pelicula->imagen_poster) }}" alt="{{ $pelicula->titulo }}" id="img-prev-{{ $pelicula->id }}"></div>
                            <div class="card-info"><div class="card-title-row"><h3>{{ $pelicula->titulo }}</h3><span class="tag-age apt">{{ $pelicula->clasificacion }}</span></div><p class="card-formats">REAL 3D • D-BOX</p></div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </section>

            <section class="horizontal-slider-section">
                <div class="slider-header">
                    <h2>PRÓXIMOS ESTRENOS</h2>
                    <div class="slider-controls">
                        <button class="btn-ver-mas-seccion" onclick="window.irAPeliculasTab('estrenos')">Ver más <i class="fas fa-chevron-right"></i></button>
                        <button class="btn-arrow" id="prev-estrenos"><i class="fas fa-chevron-left"></i></button>
                        <button class="btn-arrow" id="next-estrenos"><i class="fas fa-chevron-right"></i></button>
                    </div>
                </div>
                <div class="slider-viewport">
                    <div class="slider-track" id="track-estrenos">
                        @foreach($estrenos as $pelicula)
                        <div class="cine-card" onclick="verDetalles('{{ addslashes($pelicula->titulo) }}', '{{ $pelicula->genero }}', '{{ $pelicula->duracion }}', '{{ $pelicula->clasificacion }}', 'img-est-{{ $pelicula->id }}')">
                            <div class="poster-wrap"><img src="{{ asset($pelicula->imagen_poster) }}" alt="{{ $pelicula->titulo }}" id="img-est-{{ $pelicula->id }}"></div>
                            <div class="card-info"><div class="card-title-row"><h3>{{ $pelicula->titulo }}</h3><span class="tag-age m14">{{ $pelicula->clasificacion }}</span></div><p class="card-date">{{ $pelicula->sinopsis }}</p></div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </section>
        </section>

        <section id="sec-peliculas" class="vista-oculta">
            <div class="pagina-peliculas">
                <div class="cabecera-seccion-central">
                    <h1>Catálogo Completo</h1>
                    <div class="tabs-peliculas-central">
                        <span class="tab-central-link active" data-subview="cartelera">En cartelera</span>
                        <span class="tab-central-link" data-subview="preventa">Preventa</span>
                        <span class="tab-central-link" data-subview="estrenos">Próximos estrenos</span>
                    </div>
                </div>
                <div class="contenedor-peliculas">
    
                    <aside class="sidebar-filtros-premium">
                        <div class="filtro-header-premium"><i class="fas fa-sliders-h"></i> Filtrar Por:</div>
                        <div class="acordeon-filtro-premium">
                            <div class="acordeon-titulo-premium">Ciudad <i class="fas fa-minus"></i></div>
                            <ul class="acordeon-contenido-premium abierto">
                                <li>Cerro de Pasco</li>
                                <li>Huánuco</li>
                            </ul>
                        </div>
                    </aside>

                    <div class="contenido-sub-grids">
                        
                        <div class="grid-peliculas peli-sub-vista" id="sub-peli-cartelera">
                            @foreach($cartelera as $pelicula)
                            <div class="tarjeta-peli-premium">
                                <div class="cinta-estreno-premium">Cartelera</div>
                                <img src="{{ asset($pelicula->imagen_poster) }}" alt="{{ $pelicula->titulo }}" id="peli-c{{ $pelicula->id }}">
                                
                                <div class="info-peli-premium">
                                    <h3>{{ $pelicula->titulo }}</h3>
                                    <p>{{ $pelicula->genero }} | {{ $pelicula->duracion }} | {{ $pelicula->clasificacion }}</p>
                                    
                                    <div class="botones-peli-premium">
                                        <button onclick="iniciarProcesoCompra('{{ addslashes($pelicula->titulo) }}', 'peli-c{{ $pelicula->id }}')"><i class="fas fa-ticket-alt"></i> Comprar</button>
                                        <button onclick="verDetalles('{{ addslashes($pelicula->titulo) }}', '{{ $pelicula->genero }}', '{{ $pelicula->duracion }}', '{{ $pelicula->clasificacion }}', 'peli-c{{ $pelicula->id }}')"><i class="fas fa-plus"></i> Detalles</button>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <div class="grid-peliculas peli-sub-vista vista-oculta" id="sub-peli-preventa">
                            @foreach($preventa as $pelicula)
                            <div class="tarjeta-peli-premium">
                                <div class="cinta-estreno-premium">Preventa</div>
                                <img src="{{ asset($pelicula->imagen_poster) }}" alt="{{ $pelicula->titulo }}" id="peli-p{{ $pelicula->id }}">
                                <div class="info-peli-premium">
                                    <h3>{{ $pelicula->titulo }}</h3>
                                    <p>{{ $pelicula->genero }} | {{ $pelicula->duracion }}</p>
                                    <div class="botones-peli-premium">
                                        <button onclick="iniciarProcesoCompra('{{ addslashes($pelicula->titulo) }}', 'peli-p{{ $pelicula->id }}')"><i class="fas fa-ticket-alt"></i> Reservar</button>
                                        <button onclick="verDetalles('{{ addslashes($pelicula->titulo) }}', '{{ $pelicula->genero }}', '{{ $pelicula->duracion }}', '{{ $pelicula->clasificacion }}', 'peli-p{{ $pelicula->id }}')"><i class="fas fa-plus"></i> Detalles</button>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <div class="grid-peliculas peli-sub-vista vista-oculta" id="sub-peli-estrenos">
                            @foreach($estrenos as $pelicula)
                            <div class="tarjeta-peli-premium">
                                <div class="cinta-estreno-premium">Pronto</div>
                                <img src="{{ asset($pelicula->imagen_poster) }}" alt="{{ $pelicula->titulo }}" id="peli-e{{ $pelicula->id }}">
                                <div class="info-peli-premium">
                                    <h3>{{ $pelicula->titulo }}</h3>
                                    <p>{{ $pelicula->sinopsis }}</p>
                                    <div class="botones-peli-premium">
                                        <button onclick="verDetalles('{{ addslashes($pelicula->titulo) }}', '{{ $pelicula->genero }}', '{{ $pelicula->duracion }}', '{{ $pelicula->clasificacion }}', 'peli-e{{ $pelicula->id }}')" style="width: 100%;"><i class="fas fa-plus"></i> Ver Detalles</button>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </section>

        <section id="sec-detalle" class="vista-oculta">
            <div class="trailer-header" id="trailer-container">
                <div style="position:absolute; top:0; left:0; width:100%; height:100%; z-index:-1; overflow:hidden;">
                    <img src="{{ asset('imagenes/vista cine.jpg') }}" style="width:100%; height:100%; object-fit:cover; opacity:0.3; filter:blur(5px);">
                </div>
                <div class="play-btn-overlay"><i class="fas fa-play-circle"></i><p>Mira el tráiler</p></div>
            </div>
            <div class="detalle-info-bar">
                <div class="info-izquierda">
                    <h1 id="detalle-titulo">Título</h1>
                    <p class="detalle-meta"><span id="detalle-genero">Género</span> | <span id="detalle-duracion">Duración</span> | <span id="detalle-censura">Censura</span></p>
                </div>
                <div class="info-derecha">
                    <button class="btn-comprar-principal" onclick="iniciarProcesoCompra(document.getElementById('detalle-titulo').innerText, 'detalle-poster')"><i class="fas fa-ticket-alt"></i> Comprar Entradas</button>
                </div>
            </div>
            <div class="detalle-cuerpo">
                <div class="detalle-sinopsis">
                    <img src="" alt="Poster" id="detalle-poster">
                    <div class="sinopsis-texto">
                        <h2>Sinopsis.</h2>
                        <p>Una producción espectacular traída para los fanáticos del buen cine en Cerro de Pasco.</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="sec-compra" class="vista-oculta">
            <div class="contenedor-compra">
                <div class="barra-progreso">
                    <div class="paso-progreso activo" id="ind-paso-1"><i class="fas fa-chair"></i> Asientos</div>
                    <div class="paso-progreso" id="ind-paso-2"><i class="fas fa-ticket-alt"></i> Entradas</div>
                    <div class="paso-progreso" id="ind-paso-3"><i class="fas fa-hamburger"></i> Dulcería</div>
                    <div class="paso-progreso" id="ind-paso-4"><i class="fas fa-credit-card"></i> Pago</div>
                </div>
                <div class="cuerpo-compra">
                    <div class="paso-compra vista-activa" id="paso-1">
                        <div class="layout-asientos">
                            <div class="seccion-simulador">
                                <h3>Vista desde tu asiento</h3>
                                <div class="escenario-3d">
                                    <div class="pantalla-simulada" id="pantalla-3d">
                                        <img src="{{ asset('imagenes/vista cine.jpg') }}" id="img-simulador-peli" alt="Pantalla Cine">
                                    </div>
                                </div>
                                <p class="texto-simulador">Pasa el ratón por los asientos para simular la vista hacia la pantalla.</p>
                            </div>
                            <div class="seccion-mapa">
                                <div class="pantalla-curva">PANTALLA</div>
                                <div id="mapa-butacas" class="mapa-butacas"></div>
                                <div class="leyenda-asientos">
                                    <span><div class="bolita disponible"></div> Disponible</span>
                                    <span><div class="bolita seleccionado"></div> Seleccionado</span>
                                    <span><div class="bolita ocupado"></div> Ocupada</span>
                                </div>
                            </div>
                        </div>
                        <div class="pie-paso">
                            <span id="resumen-asientos">Asientos: Ninguno</span>
                            <button class="btn-siguiente" onclick="irAPaso(2)">Siguiente: Entradas <i class="fas fa-arrow-right"></i></button>
                        </div>
                    </div>

                    <div class="paso-compra vista-oculta" id="paso-2">
                        <h2>¿Cuántas entradas necesitas?</h2>
                        <div class="lista-tickets">
                            <div class="ticket-item">
                                <div><h4>Adulto (2D)</h4><p>S/ 18.00</p></div>
                                <div class="contador-ticket"><button onclick="cambiarTicket('adulto', -1)">-</button><span id="cant-adulto">0</span><button onclick="cambiarTicket('adulto', 1)">+</button></div>
                            </div>
                            <div class="ticket-item">
                                <div><h4>Niño / Adulto Mayor</h4><p>S/ 14.00</p></div>
                                <div class="contador-ticket"><button onclick="cambiarTicket('nino', -1)">-</button><span id="cant-nino">0</span><button onclick="cambiarTicket('nino', 1)">+</button></div>
                            </div>
                        </div>
                        <div class="pie-paso">
                            <button class="btn-volver" onclick="irAPaso(1)"><i class="fas fa-arrow-left"></i> Volver</button>
                            <span id="total-entradas" style="font-weight:bold; font-size:18px;">Total: S/ 0.00</span>
                            <button class="btn-siguiente" onclick="irAPaso(3)">Siguiente: Dulcería <i class="fas fa-arrow-right"></i></button>
                        </div>
                    </div>

                    <div class="paso-compra vista-oculta" id="paso-3">
                        <h2>Agrega a tu pedido</h2>
                            <div class="grid-comida" style="max-height: 380px; overflow-y: auto; padding-right: 10px; gap: 15px; scrollbar-width: thin;">
                                @foreach($productos as $producto)
                                <div class="comida-item">
                                    <img src="{{ asset($producto->imagen) }}" alt="{{ $producto->nombre }}" @if($producto->categoria == 'canchita' && str_contains($producto->nombre, 'Dulce')) style="background: white;" @endif>
                                    <h4>{{ $producto->nombre }}</h4>
                                    <span>S/ {{ number_format($producto->precio, 2) }}</span>
                                    <button class="btn-agregar-comida" onclick="agregarAlCarritoFunnel('{{ addslashes($producto->nombre) }}', {{ $producto->precio }})">Agregar</button>
                                </div>
                                @endforeach
                            </div>
                        <div class="pie-paso">
                            <button class="btn-volver" onclick="irAPaso(2)"><i class="fas fa-arrow-left"></i> Volver</button>
                            <button class="btn-siguiente" onclick="irAPaso(4)">Ir a Pagar <i class="fas fa-arrow-right"></i></button>
                        </div>
                    </div>

                    <div class="paso-compra vista-oculta" id="paso-4">
                        <h2>Finalizar Compra</h2>
                        <div class="layout-pago">
                            <div class="metodos-pago">
                                <h3>Método de pago</h3>
                                <div class="opcion-pago"><input type="radio" name="pago" checked> <label><i class="fas fa-credit-card"></i> Tarjeta</label></div>
                            </div>
                            <div class="resumen-final">
                                <h3>Resumen del Pedido</h3>
                                <h3>Total a Pagar: <span id="gran-total" style="color:#4db8ff;">S/ 0.00</span></h3>
                                <button class="btn-pagar-final" onclick="procesarCompraFinal()">PAGAR Y GENERAR BOLETO</button>
                            </div>
                        </div>
                        <div class="pie-paso">
                            <button class="btn-volver" onclick="irAPaso(3)"><i class="fas fa-arrow-left"></i> Volver</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="sec-cines" class="vista-oculta">
            <div class="pagina-cines">
                <h1>Nuestros Cines</h1>
                <div class="grid-cines">
                    
                    <div class="tarjeta-cine">
                        <div class="imagen-cine">
                            <img src="{{ asset('imagenes/cines/plazacarrion.jpeg') }}" alt="CinePasco Centro">
                        </div>
                        <div class="info-cine">
                            <h3>CinePasco Centro</h3>
                            <p>Av. Los Incas S/N (Frente a Plaza Carrión)</p>
                        </div>
                    </div>

                    <div class="tarjeta-cine">
                        <div class="imagen-cine">
                            <img src="{{ asset('imagenes/cines/parquecomercio.jpeg') }}" alt="CinePasco Comercio">
                        </div>
                        <div class="info-cine">
                            <h3>CinePasco Comercio</h3>
                            <p>Jr. San Martín (Cerca al Parque del Comercio)</p>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <section id="sec-comida" class="vista-oculta">
            <div class="pagina-dulceria-wrapper">
                
                <div class="dulceria-nav">
                    <ul>
                        <li class="active" onclick="filtrarDulceria('todos', this)">TODOS</li>
                        <li onclick="filtrarDulceria('combos', this)">COMBOS</li>
                        <li onclick="filtrarDulceria('canchita', this)">CANCHITA</li>
                        <li onclick="filtrarDulceria('bebidas', this)">BEBIDAS</li>
                        <li onclick="filtrarDulceria('snacks', this)">SNACKS</li>
                        <li onclick="filtrarDulceria('coleccionables', this)">COLECCIONABLES</li>
                    </ul>
                </div>

                <div class="dulceria-grid-ref" id="contenedor-productos-dulceria">
                    @foreach($productos as $producto)
                    <div class="dulce-ref-card" data-categoria="{{ $producto->categoria }}">
                        <div class="dulce-ref-img">
                            @if($producto->categoria == 'combos') <div class="tag-promo">-20%</div> @endif
                            <img src="{{ asset($producto->imagen) }}" alt="{{ $producto->nombre }}" @if($producto->categoria == 'canchita' && str_contains($producto->nombre, 'Dulce')) style="background: white;" @endif>
                        </div>
                        <div class="dulce-ref-info">
                            <h4>*{{ strtoupper($producto->nombre) }}</h4>
                            <p>{{ $producto->descripcion }}</p>
                            <div class="ref-price-row">
                                <span>S/ {{ number_format($producto->precio, 2) }}</span>
                                <button class="btn-ref-add" onclick="agregarAlCarritoDulceria('{{ addslashes($producto->nombre) }}', {{ $producto->precio }})"><i class="fas fa-plus"></i></button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="floating-cart">
                    <div class="cart-left">
                        <div class="cart-icon-box"><i class="fas fa-popcorn"></i> <span id="cart-counter">0</span></div>
                        <div class="cart-total-text"><h3 id="cart-price">S/ 0.00</h3><p>Mi pedido de Dulcería</p></div>
                    </div>
                    <div class="cart-right">
                        <button class="btn-cancel" onclick="vaciarCarrito()">Cancelar</button>
                        <button class="btn-continue" onclick="procesarPagoDulceria()">Continuar</button>
                    </div>
                </div>

            </div>
        </section>

        <!-- AQUI ESTÁN LOS CAMBIOS DEL BACKOFFICE -->
        <section id="sec-admin" class="vista-oculta">
            <div class="pagina-generica" style="max-width: 1200px; margin: 0 auto; text-align: left; padding-top: 30px; padding-bottom: 50px;">
                <h1 style="color: #ff3b3b; font-size: 35px;"><i class="fas fa-cogs"></i> Centro de Control (Backoffice)</h1>
                <p style="color: #aaa; margin-bottom: 30px;">Bienvenido, Gerente. Aquí tienes el control total de CinePasco.</p>
                
                <div style="display: flex; gap: 30px; flex-wrap: wrap;">
                    
                    <div style="background: #121519; padding: 25px; border-radius: 10px; flex: 1; min-width: 400px; border: 1px solid #333;">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                            <h3 style="margin:0; font-size: 22px;">🍿 Películas</h3>
                            <!-- CAMBIO 1: Botón "Nueva Película" convertido a enlace ruta -->
                            <a href="{{ route('peliculas.create') }}" style="background: #003b73; color: white; padding: 10px 15px; border: none; border-radius: 5px; cursor: pointer; font-weight: bold; text-decoration: none; display: inline-block;">
                                <i class="fas fa-plus"></i> Nueva
                            </a>
                        </div>
                        
                        <div style="max-height: 400px; overflow-y: auto; padding-right: 10px; scrollbar-width: thin;">
                            <table style="width: 100%; border-collapse: collapse; color: white;">
                                <tr style="border-bottom: 1px solid #444; text-align: left; color: #888;">
                                    <th style="padding-bottom: 10px;">Título</th>
                                    <th style="padding-bottom: 10px;">Estado</th>
                                    <th style="padding-bottom: 10px;">Acciones</th>
                                </tr>
                                @foreach($todasPeliculas as $peli)
                                <tr style="border-bottom: 1px solid #222;">
                                    <td style="padding: 15px 0;">{{ $peli->titulo }}</td>
                                    <td>
                                        <span style="background: {{ $peli->estado == 'cartelera' ? '#28a745' : ($peli->estado == 'preventa' ? '#ffcc00' : '#17a2b8') }}; color: {{ $peli->estado == 'preventa' ? '#000' : 'white' }}; padding: 3px 8px; border-radius: 20px; font-size: 12px; font-weight: bold;">
                                            {{ ucfirst($peli->estado) }}
                                        </span>
                                    </td>
                                    <td style="display: flex; gap: 5px; align-items: center; padding-top: 10px;">
                                        <!-- CAMBIO 2: Botón Editar Película convertido a ruta con ID -->
                                        <a href="{{ route('peliculas.edit', $peli->id) }}" style="background: #ffcc00; color: #000; text-decoration: none; border: none; padding: 8px; border-radius: 3px; cursor: pointer; display: inline-block;" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        
                                        <!-- CAMBIO 3: Botón Eliminar Película envuelto en Formulario DELETE -->
                                        <form action="{{ route('peliculas.destroy', $peli->id) }}" method="POST" style="margin: 0; display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" style="background: #c0003a; color: white; border: none; padding: 8px; border-radius: 3px; cursor: pointer;" title="Eliminar" onclick="return confirm('¿Seguro que deseas eliminar {{ $peli->titulo }}?');">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>

                    <div style="background: #121519; padding: 25px; border-radius: 10px; flex: 1; min-width: 400px; border: 1px solid #333;">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                            <h3 style="margin:0; font-size: 22px;">🥤 Dulcería</h3>
                            <!-- CAMBIO 4: Botón "Nuevo Producto" convertido a enlace ruta -->
                            <a href="{{ route('dulceria.create') }}" style="background: #003b73; color: white; padding: 10px 15px; border: none; border-radius: 5px; cursor: pointer; font-weight: bold; text-decoration: none; display: inline-block;">
                                <i class="fas fa-plus"></i> Nuevo
                            </a>
                        </div>
                        
                        <div style="max-height: 400px; overflow-y: auto; padding-right: 10px; scrollbar-width: thin;">
                            <table style="width: 100%; border-collapse: collapse; color: white;">
                                <tr style="border-bottom: 1px solid #444; text-align: left; color: #888;">
                                    <th style="padding-bottom: 10px;">Producto</th>
                                    <th style="padding-bottom: 10px;">Precio</th>
                                    <th style="padding-bottom: 10px;">Acciones</th>
                                </tr>
                                @foreach($productos as $prod)
                                <tr style="border-bottom: 1px solid #222;">
                                    <td style="padding: 15px 0;">{{ $prod->nombre }}</td>
                                    <td style="color: #4db8ff; font-weight: bold;">S/ {{ number_format($prod->precio, 2) }}</td>
                                    <td style="display: flex; gap: 5px; align-items: center; padding-top: 10px;">
                                        <!-- CAMBIO 5: Botón Editar Producto convertido a ruta con ID -->
                                        <a href="{{ route('dulceria.edit', $prod->id) }}" style="background: #ffcc00; color: #000; text-decoration: none; border: none; padding: 8px; border-radius: 3px; cursor: pointer; display: inline-block;" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <!-- CAMBIO 6: Botón Eliminar Producto envuelto en Formulario DELETE -->
                                        <form action="{{ route('dulceria.destroy', $prod->id) }}" method="POST" style="margin: 0; display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" style="background: #c0003a; color: white; border: none; padding: 8px; border-radius: 3px; cursor: pointer;" title="Eliminar" onclick="return confirm('¿Seguro que deseas eliminar {{ $prod->nombre }}?');">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- FIN DE LOS CAMBIOS -->

        <section id="sec-promociones" class="vista-oculta"><div class="pagina-generica"><h1>Promociones Exclusivas</h1><p>Descuentos para la UNDAC.</p></div></section>
<!-- SECCIÓN DE PERFIL DE USUARIO (ESTILO AQUAGLASS / CONSOLA) -->
        <section id="sec-perfil" class="vista-oculta">
            <div class="pagina-generica" style="max-width: 1000px; margin: 0 auto; padding-top: 50px; padding-bottom: 50px; font-family: 'Segoe UI', sans-serif;">

                <!-- HEADER DEL PERFIL (Avatar, Nombre y Estadísticas) -->
                <div style="display: flex; flex-wrap: wrap; justify-content: space-between; align-items: flex-start; background: rgba(20, 25, 35, 0.4); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 20px; padding: 40px; margin-bottom: 30px; box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);">

                    <!-- Izquierda: Avatar y Datos -->
                    <div style="display: flex; align-items: center; gap: 30px; flex-wrap: wrap;">
                        <!-- Avatar Espacial / Gamer -->
                        <div style="width: 120px; height: 120px; background: linear-gradient(135deg, #00d2ff, #3a7bd5); border-radius: 25px; display: flex; justify-content: center; align-items: center; box-shadow: 0 10px 25px rgba(0, 210, 255, 0.3);">
                            <i class="fas fa-user-astronaut" style="font-size: 60px; color: white;"></i>
                        </div>

                        <!-- Info Principal -->
                        <div>
                            <h1 id="perfil-nombre-display" style="color: white; font-size: 38px; margin: 0; font-weight: 800; letter-spacing: 1px; text-transform: uppercase;">USUARIO</h1>
                            <p id="perfil-email-display" style="color: #aaa; margin: 5px 0 20px 0; font-size: 15px;"><i class="fas fa-circle" style="color: #28a745; font-size: 10px; margin-right: 5px;"></i> Visto por última vez: En línea</p>

                            <!-- Estadísticas tipo Red Social -->
                            <div style="display: flex; gap: 30px; color: white;">
                                <div style="cursor: pointer; transition: 0.2s;" onmouseover="this.style.opacity='0.7'" onmouseout="this.style.opacity='1'">
                                    <strong style="font-size: 22px; display: block;">1</strong>
                                    <span style="color: #aaa; font-size: 14px;">Nivel <i class="fas fa-chevron-right" style="font-size: 10px; margin-left: 3px;"></i></span>
                                </div>
                                <div style="cursor: pointer; transition: 0.2s;" onmouseover="this.style.opacity='0.7'" onmouseout="this.style.opacity='1'">
                                    <strong style="font-size: 22px; display: block;" id="stat-entradas">0</strong>
                                    <span style="color: #aaa; font-size: 14px;">Entradas <i class="fas fa-chevron-right" style="font-size: 10px; margin-left: 3px;"></i></span>
                                </div>
                                <div style="cursor: pointer; transition: 0.2s;" onmouseover="this.style.opacity='0.7'" onmouseout="this.style.opacity='1'">
                                    <strong style="font-size: 22px; display: block;">250</strong>
                                    <span style="color: #aaa; font-size: 14px;">Puntos <i class="fas fa-chevron-right" style="font-size: 10px; margin-left: 3px;"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Derecha: Botones de Acción (Estilo Contorno) -->
                    <div style="display: flex; flex-direction: column; gap: 12px; margin-top: 10px;">
                        <button style="background: rgba(255, 255, 255, 0.05); border: 1px solid rgba(255, 255, 255, 0.3); color: white; padding: 12px 30px; border-radius: 8px; cursor: pointer; font-weight: bold; transition: all 0.3s; width: 220px;" onmouseover="this.style.background='rgba(255,255,255,0.15)'" onmouseout="this.style.background='rgba(255,255,255,0.05)'">Personalizar perfil</button>
                        <button style="background: rgba(255, 255, 255, 0.05); border: 1px solid rgba(255, 255, 255, 0.3); color: white; padding: 12px 30px; border-radius: 8px; cursor: pointer; font-weight: bold; transition: all 0.3s; width: 220px;" onmouseover="this.style.background='rgba(255,255,255,0.15)'" onmouseout="this.style.background='rgba(255,255,255,0.05)'">Configuración</button>
                        <button onclick="cerrarSesionReal()" style="background: rgba(229, 9, 20, 0.1); border: 1px solid rgba(229, 9, 20, 0.5); color: #ff4d4d; padding: 12px 30px; border-radius: 8px; cursor: pointer; font-weight: bold; transition: all 0.3s; width: 220px;" onmouseover="this.style.background='rgba(229, 9, 20, 0.3)'" onmouseout="this.style.background='rgba(229, 9, 20, 0.1)'">Cerrar sesión</button>
                    </div>

                </div>

                <!-- CUERPO DEL PERFIL (Tarjetas de Cristal) -->
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px;">
                    
                    <!-- Columna Izquierda: Biografía -->
                    <div style="background: rgba(20, 25, 35, 0.4); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 20px; padding: 35px; box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);">
                        <h3 style="margin-top: 0; color: white; font-size: 22px; font-weight: 500;">Biografía</h3>
                        <p style="color: #aaa; font-size: 15px; line-height: 1.6; margin-bottom: 30px;">Deja que el mundo sepa qué géneros prefieres, si eres un cazador de estrenos o si vas directo por los combos más grandes de la dulcería.</p>
                        
                        <div style="background: rgba(0,0,0,0.3); padding: 20px; border-radius: 12px; border: 1px solid rgba(255,255,255,0.05);">
                            <p style="margin: 0 0 8px 0; color: #888; font-size: 13px;">ID de CinePasco</p>
                            <p style="margin: 0 0 20px 0; color: #4db8ff; font-family: monospace; font-size: 16px; font-weight: bold;">#CP-<script>document.write(Math.floor(Math.random() * 90000) + 10000);</script></p>
                            
                            <p style="margin: 0 0 8px 0; color: #888; font-size: 13px;">Correo Vinculado</p>
                            <p id="perfil-email-input" style="margin: 0; color: white; font-size: 15px;">cargando...</p>
                        </div>
                    </div>

                    <!-- Columna Derecha: Ubicación / Entradas -->
                    <div style="background: rgba(20, 25, 35, 0.4); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 20px; padding: 35px; box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);">
                        <h3 style="margin-top: 0; color: white; font-size: 22px; font-weight: 500;">Mis Entradas Activas</h3>
                        <p style="color: #aaa; font-size: 15px; line-height: 1.6; margin-bottom: 25px;">Aquí se guardan tus pases digitales. Muestra el código QR desde tu celular antes de entrar a la sala.</p>

                        <!-- Contenedor del Boleto -->
                        <div id="contenedor-mis-boletos" style="max-height: 350px; overflow-y: auto; padding-right: 10px; scrollbar-width: thin;">
                            <div style="background: rgba(255, 255, 255, 0.03); border: 1px dashed rgba(255, 255, 255, 0.2); border-radius: 15px; padding: 40px; text-align: center;">
                                <i class="fas fa-ticket-alt" style="font-size: 40px; color: rgba(255,255,255,0.2); margin-bottom: 15px;"></i>
                                <p style="color: #666; margin: 0; font-size: 15px;">Aún no tienes compras registradas.</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </main>

    <div id="modal-login" class="modal-overlay vista-oculta">
        <div class="modal-cuerpo" style="background: #181818; padding: 40px; border-radius: 10px; width: 400px; text-align: center; color: white; position: relative;">
            <button onclick="cerrarModalLogin()" style="position: absolute; top: 15px; right: 20px; background: none; border: none; color: #888; font-size: 20px; cursor: pointer;">&times;</button>
            <h2 style="margin-bottom: 10px; font-size: 16px; color: #aaa; text-transform: uppercase; letter-spacing: 2px;">Iniciar sesión</h2>
            <h1 style="font-size: 24px; margin-bottom: 25px; font-weight: bold; color: #fff;">¡HOLA! QUÉ BUENO VERTE.</h1>
            
            <form id="form-login" onsubmit="event.preventDefault();">
                <input type="email" id="login-email" placeholder="Correo electrónico" style="width: 100%; padding: 15px; margin-bottom: 15px; background: #333; border: none; border-radius: 5px; color: white;" required>
                <input type="password" id="login-password" placeholder="Contraseña" style="width: 100%; padding: 15px; margin-bottom: 25px; background: #333; border: none; border-radius: 5px; color: white;" required>
                
                <button type="button" onclick="ejecutarLogin()" class="btn-rojo-login" style="width: 100%; padding: 15px; background: #e50914; color: white; border: none; border-radius: 5px; font-weight: bold; font-size: 16px; cursor: pointer;">INICIAR SESIÓN</button>
            </form>
            <p style="color: #888; font-size: 14px; margin-top: 20px;">¿Aún no tienes cuenta? <a href="#" onclick="abrirRegistro()" style="color: #e50914; text-decoration: none; font-weight: bold;">Regístrate aquí</a></p>
            <p style="margin-top: 10px;"><a href="#" style="color: #e50914; text-decoration: none; font-size: 14px;">¿Olvidaste tu contraseña?</a></p>
        </div>
    </div>

    <div id="modal-registro" class="modal-overlay vista-oculta">
        <div class="modal-cuerpo" style="background: #181818; padding: 40px; border-radius: 10px; width: 400px; text-align: center; color: white; position: relative;">
            <button onclick="cerrarModalRegistro()" style="position: absolute; top: 15px; right: 20px; background: none; border: none; color: #888; font-size: 20px; cursor: pointer;">&times;</button>
            <h2 style="margin-bottom: 10px; font-size: 16px; color: #aaa; text-transform: uppercase; letter-spacing: 2px;">Crear cuenta</h2>
            <h1 style="font-size: 24px; margin-bottom: 25px; font-weight: bold; color: #fff;">ÚNETE A CINEPASCO</h1>
            
            <form id="form-registro" onsubmit="event.preventDefault();">
                <input type="text" id="registro-nombre" placeholder="Nombre completo" style="width: 100%; padding: 15px; margin-bottom: 15px; background: #333; border: none; border-radius: 5px; color: white;" required>
                <input type="email" id="registro-email" placeholder="Correo electrónico" style="width: 100%; padding: 15px; margin-bottom: 15px; background: #333; border: none; border-radius: 5px; color: white;" required>
                <input type="password" id="registro-password" placeholder="Crea una contraseña (mín. 6 caracteres)" style="width: 100%; padding: 15px; margin-bottom: 25px; background: #333; border: none; border-radius: 5px; color: white;" required>
                
                <button type="button" onclick="ejecutarRegistro()" class="btn-rojo-login" style="width: 100%; padding: 15px; background: #e50914; color: white; border: none; border-radius: 5px; font-weight: bold; font-size: 16px; cursor: pointer;">REGISTRARME</button>
            </form>
            <p style="color: #888; font-size: 14px; margin-top: 20px;">¿Ya tienes cuenta? <a href="#" onclick="abrirLogin()" style="color: #e50914; text-decoration: none; font-weight: bold;">Inicia sesión</a></p>
        </div>
    </div>

    <div id="modal-restriccion" class="modal-overlay vista-oculta">
        <div class="modal-restriccion-cuerpo">
            <div class="restriccion-header">
                <div class="badge-edad" id="badge-edad-texto">+14</div>
                <h2>Película Restringida</h2>
            </div>
            <p id="texto-restriccion">Película con clasificación +14, apta para audiencia mayor de 14 años. Se podrá solicitar documento de identidad al ingreso.</p>
            <div class="restriccion-botones">
                <button class="btn-rest-cancelar" onclick="cerrarModalRestriccion()">Cancelar</button>
                <button class="btn-rest-continuar" id="btn-continuar-accion">Continuar</button>
            </div>
        </div>
    </div>

    <footer>
        <div class="footer-cols">
            <div class="col"><h3>Acerca de CinePasco</h3><ul><li>Nosotros</li><li>Trabaja con nosotros</li></ul></div>
            <div class="col"><h3>Ayuda y Contacto</h3><ul><li>Centro de Ayuda</li><li>Contáctanos</li></ul></div>
        </div>
        <div class="footer-bottom"><p>CinePasco S.A.C. | Todos los derechos reservados 2026.</p></div>
    </footer>

    <script src="{{ asset('app.js') }}"></script>
</body>
</html>