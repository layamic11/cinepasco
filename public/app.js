// ================= VARIABLES GLOBALES =================
window.usuarioLogueado = false;
window.rolUsuario = 'visitante';
window.nombreUsuarioActual = '';
window.emailUsuarioActual = '';

document.addEventListener('DOMContentLoaded', () => {

    // 🧠 1. RESTAURADOR DE MEMORIA (SESIÓN PERSISTENTE)
    const sesionGuardada = localStorage.getItem('cinepasco_sesion');
    if (sesionGuardada) {
        const user = JSON.parse(sesionGuardada);
        window.usuarioLogueado = true;
        window.rolUsuario = user.rol;
        window.nombreUsuarioActual = user.nombre;
        window.emailUsuarioActual = user.email;

        let btnHeader = document.getElementById('btn-abrir-login');
        if (btnHeader) {
            let nuevoBtn = btnHeader.cloneNode(true);
            btnHeader.parentNode.replaceChild(nuevoBtn, btnHeader);
            nuevoBtn.innerHTML = `<i class="fas fa-user-check"></i> <span style="font-family: 'Segoe UI', sans-serif; font-size: 15px; font-weight: bold; margin-left: 5px;">${user.nombre}</span>`;
            nuevoBtn.style.color = "#4db8ff";
            nuevoBtn.title = "Mi Perfil";

            nuevoBtn.addEventListener('click', () => {
                document.querySelectorAll('.nav-link').forEach(l => l.classList.remove('active'));
                window.cambiarVista('sec-perfil');
                window.cargarDatosPerfil();
            });
        }

        if (user.rol === 'admin') {
            const btnAdmin = document.getElementById('nav-admin');
            if (btnAdmin) btnAdmin.style.display = 'inline-block';
        }
    }

    const carritoGuardado = localStorage.getItem('cinepasco_carrito');
    if (carritoGuardado) {
        const cart = JSON.parse(carritoGuardado);
        const counter = document.getElementById('cart-counter');
        const price = document.getElementById('cart-price');
        if(counter) counter.innerText = cart.items;
        if(price) price.innerText = `S/ ${parseFloat(cart.total).toFixed(2)}`;
    }
    
    // ================= 2. FONDO ESPACIAL ANIMADO =================
    const background = document.getElementById('space-background');
    const stars = [];

    function createStars() {
        if (!background) return;
        background.innerHTML = ''; 
        for (let i = 0; i < 150; i++) { 
            const star = document.createElement('div');
            star.classList.add('star');
            const size = Math.random() * 4 + 1 + 'px'; 
            star.style.width = size;
            star.style.height = size;
            const x = Math.random() * 100;
            const y = Math.random() * 100;
            star.style.left = x + 'vw';
            star.style.top = y + 'vh';
            star.style.animationDelay = (Math.random() * 5) + 's';
            star.style.animationDuration = (Math.random() * 2 + 1) + 's';
            background.appendChild(star);
            stars.push(star);
        }
    }

    function createShootingStar() {
        if (!background) return;
        const shootingStar = document.createElement('div');
        shootingStar.classList.add('shooting-star');
        shootingStar.style.top = (Math.random() * 50) + 'vh';
        shootingStar.style.left = (Math.random() * 100) + 'vw';
        shootingStar.style.transform = `rotate(${(Math.random() * -30 - 30)}deg) translateX(0)`; 
        shootingStar.style.animationDuration = (Math.random() * 1.5 + 0.5) + 's'; 
        background.appendChild(shootingStar);
        setTimeout(() => { shootingStar.remove(); }, 2000); 
    }

    setInterval(createShootingStar, 800); 
    createStars();

    // ================= 3. NAVEGACIÓN SPA REAL =================
    const navLinks = document.querySelectorAll('.nav-link');
    const sections = document.querySelectorAll('main > section');

    window.cambiarVista = function(targetId) {
        if (!targetId) return;
        sections.forEach(sec => {
            sec.classList.remove('vista-activa');
            sec.classList.add('vista-oculta');
        });
        const targetSection = document.getElementById(targetId);
        if (targetSection) {
            targetSection.classList.remove('vista-oculta');
            targetSection.classList.add('vista-activa');
        }
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault(); 
            const targetId = this.getAttribute('data-target');
            navLinks.forEach(l => l.classList.remove('active'));
            this.classList.add('active');
            window.cambiarVista(targetId);
            
            if(targetId === 'sec-peliculas') { window.activarSubVistaPeliculas('cartelera'); }
            if(targetId === 'sec-comida') { window.filtrarDulceria('todos', document.querySelector('.dulceria-nav li')); }
        });
    });

    const btnLogo = document.getElementById('btn-logo');
    if(btnLogo) {
        btnLogo.addEventListener('click', function() {
            navLinks.forEach(l => l.classList.remove('active'));
            window.cambiarVista('sec-inicio');
        });
    }

    window.irAPeliculasTab = function(subViewName) {
        navLinks.forEach(l => l.classList.remove('active'));
        const peliLink = document.querySelector('[data-target="sec-peliculas"]');
        if (peliLink) peliLink.classList.add('active');
        window.cambiarVista('sec-peliculas');
        window.activarSubVistaPeliculas(subViewName);
    }

    window.activarSubVistaPeliculas = function(subViewName) {
        const subTabs = document.querySelectorAll('.tab-central-link');
        subTabs.forEach(tab => tab.classList.remove('active'));
        const currentActiveTab = document.querySelector(`.tab-central-link[data-subview="${subViewName}"]`);
        if(currentActiveTab) currentActiveTab.classList.add('active');

        const subViews = document.querySelectorAll('.peli-sub-vista');
        subViews.forEach(view => view.classList.add('vista-oculta'));

        const targetView = document.getElementById(`sub-peli-${subViewName}`);
        if(targetView) targetView.classList.remove('vista-oculta');
    }

    const tabsCentrales = document.querySelectorAll('.tab-central-link');
    tabsCentrales.forEach(tab => {
        tab.addEventListener('click', function() {
            window.activarSubVistaPeliculas(this.getAttribute('data-subview'));
        });
    });

    const btnAbrirLogin = document.getElementById('btn-abrir-login');
    if (btnAbrirLogin) {
        btnAbrirLogin.addEventListener('click', () => {
            if (!window.usuarioLogueado) {
                const modal = document.getElementById('modal-login');
                if(modal) {
                    modal.classList.add('activo');
                    document.body.style.overflow = 'hidden'; 
                }
            }
        });
    }

    // ================= 4. SLIDERS Y CARROUSELES =================
    let currentHeroSlide = 0;
    const heroSlides = document.querySelectorAll('.hero-slide');
    const heroDots = document.querySelectorAll('.hero-dots .dot');
    let heroInterval;

    window.moveHeroSlider = function(direction) {
        currentHeroSlide += direction;
        if (currentHeroSlide >= heroSlides.length) currentHeroSlide = 0;
        if (currentHeroSlide < 0) currentHeroSlide = heroSlides.length - 1;
        updateHeroSlider();
        resetHeroInterval();
    }
    window.setHeroSlide = function(index) {
        currentHeroSlide = index;
        updateHeroSlider();
        resetHeroInterval();
    }
    function updateHeroSlider() {
        if(!heroSlides.length) return;
        heroSlides.forEach(slide => slide.classList.remove('active'));
        heroDots.forEach(dot => dot.classList.remove('active'));
        heroSlides[currentHeroSlide].classList.add('active');
        heroDots[currentHeroSlide].classList.add('active');
    }
    function startHeroInterval() { heroInterval = setInterval(() => { moveHeroSlider(1); }, 5000); }
    function resetHeroInterval() { clearInterval(heroInterval); startHeroInterval(); }
    if(heroSlides.length > 0) startHeroInterval();

    function setupSlider(trackId, prevBtnId, nextBtnId) {
        const track = document.getElementById(trackId);
        const prevBtn = document.getElementById(prevBtnId);
        const nextBtn = document.getElementById(nextBtnId);
        if (!track || !prevBtn || !nextBtn) return;
        let currentIndex = 0;
        nextBtn.addEventListener('click', () => {
            const items = track.querySelectorAll('.cine-card');
            if (currentIndex < items.length - 4) { 
                currentIndex++;
                track.style.transform = `translateX(-${(track.querySelector('.cine-card').offsetWidth + 20) * currentIndex}px)`;
            }
        });
        prevBtn.addEventListener('click', () => {
            if (currentIndex > 0) {
                currentIndex--;
                track.style.transform = `translateX(-${(track.querySelector('.cine-card').offsetWidth + 20) * currentIndex}px)`;
            }
        });
    }
    setupSlider('track-preventa', 'prev-preventa', 'next-preventa');
    setupSlider('track-estrenos', 'prev-estrenos', 'next-estrenos');
});

// ================= MODALES DE SESIÓN =================
window.abrirRegistro = function() {
    const modalLog = document.getElementById('modal-login');
    if(modalLog) modalLog.classList.remove('activo');
    const modalReg = document.getElementById('modal-registro');
    if(modalReg) modalReg.classList.add('activo');
    document.body.style.overflow = 'hidden';
}

window.abrirLogin = function() {
    const modalReg = document.getElementById('modal-registro');
    if(modalReg) modalReg.classList.remove('activo');
    const modalLog = document.getElementById('modal-login');
    if(modalLog) modalLog.classList.add('activo');
    document.body.style.overflow = 'hidden';
}

window.cerrarModalRegistro = function() {
    const modalReg = document.getElementById('modal-registro');
    if(modalReg) modalReg.classList.remove('activo');
    document.body.style.overflow = 'auto';
}

window.cerrarModalLogin = function() {
    const modalLog = document.getElementById('modal-login');
    if(modalLog) modalLog.classList.remove('activo');
    document.body.style.overflow = 'auto';
}

// ================= AUTENTICACIÓN CONTROLADORES =================
function guardarSesionYActualizar(datos, emailInput) {
    window.usuarioLogueado = true;
    window.rolUsuario = datos.rol; 
    
    const nombreLimpio = datos.mensaje.replace('¡Bienvenido ', '').replace('¡Cuenta creada con éxito! Bienvenido ', '').replace('!', '');
    window.nombreUsuarioActual = nombreLimpio;
    window.emailUsuarioActual = emailInput;

    localStorage.setItem('cinepasco_sesion', JSON.stringify({
        nombre: nombreLimpio,
        email: emailInput,
        rol: datos.rol
    }));

    let btnHeader = document.getElementById('btn-abrir-login');
    if (btnHeader) {
        let nuevoBtn = btnHeader.cloneNode(true);
        btnHeader.parentNode.replaceChild(nuevoBtn, btnHeader);
        nuevoBtn.innerHTML = `<i class="fas fa-user-check"></i> <span style="font-family: 'Segoe UI', sans-serif; font-size: 15px; font-weight: bold; margin-left: 5px;">${nombreLimpio}</span>`;
        nuevoBtn.style.color = "#4db8ff";
        nuevoBtn.title = "Mi Perfil";

        nuevoBtn.addEventListener('click', () => {
            document.querySelectorAll('.nav-link').forEach(l => l.classList.remove('active'));
            window.cambiarVista('sec-perfil');
            window.cargarDatosPerfil();
        });
    }

    if (datos.rol === 'admin') {
        const btnAdmin = document.getElementById('nav-admin');
        if (btnAdmin) btnAdmin.style.display = 'inline-block';
    }
}

window.ejecutarLogin = async function() {
    const email = document.getElementById('login-email').value;
    const pass = document.getElementById('login-password').value;
    if(email === '' || pass === '') return alert("Completa tus datos.");

    try {
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const respuesta = await fetch('/iniciar-sesion', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': token, 'Accept': 'application/json' },
            body: JSON.stringify({ email: email, password: pass })
        });
        const datos = await respuesta.json();

        if (respuesta.ok && datos.status === 'success') {
            guardarSesionYActualizar(datos, email);
            cerrarModalLogin();
            document.getElementById('form-login').reset();
        } else { alert("Acceso Denegado: " + datos.mensaje); }
    } catch (error) { console.error(error); }
};

window.ejecutarRegistro = async function() {
    const nombre = document.getElementById('registro-nombre').value;
    const email = document.getElementById('registro-email').value;
    const pass = document.getElementById('registro-password').value;
    if(nombre === '' || email === '' || pass === '') return alert("Completa tus datos.");

    try {
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const respuesta = await fetch('/registro', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': token, 'Accept': 'application/json' },
            body: JSON.stringify({ name: nombre, email: email, password: pass })
        });
        const datos = await respuesta.json();

        if (respuesta.ok && datos.status === 'success') {
            guardarSesionYActualizar(datos, email);
            cerrarModalRegistro();
            document.getElementById('form-registro').reset();
            alert(datos.mensaje);
        } else { alert("Error al registrar."); }
    } catch (error) { console.error(error); }
};

// ================= PERFIL DE USUARIO GLOBAL =================
window.cargarDatosPerfil = function() {
    const nombreDisplay = document.getElementById('perfil-nombre-display');
    const emailDisplay = document.getElementById('perfil-email-display');
    const emailInput = document.getElementById('perfil-email-input');
    
    if(nombreDisplay) nombreDisplay.innerText = window.nombreUsuarioActual || 'USUARIO';
    if(emailDisplay) emailDisplay.innerHTML = `<i class="fas fa-circle" style="color: #28a745; font-size: 10px; margin-right: 5px;"></i> Visto por última vez: En línea`;
    if(emailInput) emailInput.innerText = window.emailUsuarioActual || 'correo@cinepasco.com';
    
    mostrarBoletoEnPerfil();
}

window.cerrarSesionReal = function() {
    if(confirm("¿Estás seguro que deseas salir de tu cuenta?")) {
        localStorage.removeItem('cinepasco_sesion');
        localStorage.removeItem('cinepasco_carrito');
        window.location.reload(); 
    }
}

window.mostrarBoletoEnPerfil = function() {
    const datosGuardados = localStorage.getItem("miBoletoCinePasco");
    const contenedor = document.getElementById("contenedor-mis-boletos");
    const statEntradas = document.getElementById("stat-entradas");
    
    if (datosGuardados && contenedor) {
        if(statEntradas) statEntradas.innerText = "1"; 
        const boleto = JSON.parse(datosGuardados);
        contenedor.innerHTML = `
            <div style="background: rgba(255, 255, 255, 0.05); backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.15); padding: 25px; border-radius: 15px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 4px 20px rgba(0,0,0,0.2);">
                <div>
                    <span style="background: rgba(77, 184, 255, 0.1); color: #4db8ff; border: 1px solid rgba(77, 184, 255, 0.3); padding: 5px 12px; border-radius: 6px; font-size: 11px; font-weight: bold; letter-spacing: 1px;">PAGO APROBADO</span>
                    <h4 style="margin: 15px 0 5px 0; color: #fff; font-size: 22px; font-weight: 700;">${boleto.pelicula}</h4>
                    <p style="margin: 0; color: #ccc; font-size: 14px;"><i class="fas fa-map-marker-alt" style="color: #ffcc00; margin-right: 5px;"></i> ${boleto.sala}</p>
                    <p style="margin: 10px 0 0 0; color: #888; font-size: 13px;"><i class="fas fa-calendar-check" style="margin-right: 5px;"></i> ${boleto.fechaCompra}</p>
                </div>
                <div style="text-align: center; background: rgba(255, 255, 255, 0.9); padding: 12px; border-radius: 12px;">
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=110x110&data=${boleto.codigoQR}" alt="QR Code" style="display: block; border-radius: 5px;">
                    <p style="margin: 8px 0 0 0; color: #000; font-weight: bold; font-family: monospace; font-size: 13px;">${boleto.codigoQR}</p>
                </div>
            </div>
        `;
    }
}

// ================= DULCERÍA OPERATIVA (SINGLETON + RESCATE) =================
window.filtrarDulceria = function(categoria, elementoClickeado) {
    if (elementoClickeado) {
        document.querySelectorAll('.dulceria-nav li').forEach(li => li.classList.remove('active'));
        elementoClickeado.classList.add('active');
    }
    document.querySelectorAll('.dulce-ref-card').forEach(tarjeta => {
        if (categoria === 'todos' || tarjeta.getAttribute('data-categoria') === categoria) {
            tarjeta.style.display = 'flex'; 
        } else {
            tarjeta.style.display = 'none'; 
        }
    });
}

window.agregarAlCarritoDulceria = async function(nombreProducto, precioProducto) {
    if (!window.usuarioLogueado) {
        const modal = document.getElementById('modal-login');
        if(modal) {
            modal.classList.add('activo');
            document.body.style.overflow = 'hidden';
        }
        return; 
    }

    let totalNuevo = 0;
    let itemsNuevos = 0;

    try {
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const respuesta = await fetch('/carrito/agregar-real', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': token, 'Accept': 'application/json' },
            body: JSON.stringify({ nombre: nombreProducto, precio: precioProducto })
        });
        
        if (respuesta.ok) {
            const datos = await respuesta.json();
            totalNuevo = datos.nuevo_total;
            itemsNuevos = datos.cantidad_items;
        } else {
            throw new Error("Servidor ocupado.");
        }
    } catch (error) {
        let cartGuardado = JSON.parse(localStorage.getItem('cinepasco_carrito')) || { total: 0, items: 0 };
        totalNuevo = parseFloat(cartGuardado.total) + parseFloat(precioProducto);
        itemsNuevos = parseInt(cartGuardado.items) + 1;
    }

    localStorage.setItem('cinepasco_carrito', JSON.stringify({
        total: totalNuevo,
        items: itemsNuevos
    }));

    const counter = document.getElementById('cart-counter');
    const price = document.getElementById('cart-price');
    if(counter) counter.innerText = itemsNuevos;
    if(price) price.innerText = `S/ ${parseFloat(totalNuevo).toFixed(2)}`;
    
    alert(`🍿 ¡Agregaste ${nombreProducto} a tu pedido!`);
}

window.agregarAlCarritoFunnel = function(nombreProducto, precioProducto) {
    compraActual.dulceriaTotal += parseFloat(precioProducto);
    alert(`🍿 ¡Agregaste ${nombreProducto} a tu función!`);
}

window.vaciarCarrito = function() {
    if(confirm('¿Seguro que deseas cancelar todo tu pedido de dulcería?')) {
        localStorage.removeItem('cinepasco_carrito');
        const counter = document.getElementById('cart-counter');
        const price = document.getElementById('cart-price');
        if(counter) counter.innerText = '0';
        if(price) price.innerText = 'S/ 0.00';
    }
}

// ================= PROCESO GENERAL DE COMPRAS =================
let compraActual = { pelicula: '', asientos: [], totalPagar: 0, dulceriaTotal: 0 };

window.verDetalles = function(titulo, genero, duracion, censura, imgId) {
    const imgElement = document.getElementById(imgId);
    if (imgElement) document.getElementById('detalle-poster').src = imgElement.src;
    document.getElementById('detalle-titulo').innerText = titulo;
    document.getElementById('detalle-genero').innerText = genero;
    document.getElementById('detalle-duracion').innerText = duracion;
    document.getElementById('detalle-censura').innerText = censura;
    
    document.querySelectorAll('.nav-link').forEach(l => l.classList.remove('active'));
    window.cambiarVista('sec-detalle');
}

window.iniciarProcesoCompra = function(titulo, imgId, e) {
    const ev = e || (typeof event !== 'undefined' ? event : null);
    if (ev && ev.stopPropagation) ev.stopPropagation();

    if (!window.usuarioLogueado) {
        const modal = document.getElementById('modal-login');
        if(modal) { modal.classList.add('activo'); document.body.style.overflow = 'hidden'; }
        return; 
    }

    compraActual.pelicula = titulo;
    compraActual.asientos = [];
    compraActual.totalPagar = 0;
    compraActual.dulceriaTotal = 0; 
    
    const cart = JSON.parse(localStorage.getItem('cinepasco_carrito'));
    if(cart) compraActual.dulceriaTotal = parseFloat(cart.total);
    
    generarMapaAsientos();
    
    if(document.getElementById('cant-adulto')) document.getElementById('cant-adulto').innerText = '0';
    if(document.getElementById('cant-nino')) document.getElementById('cant-nino').innerText = '0';
    if(document.getElementById('total-entradas')) document.getElementById('total-entradas').innerText = 'Total: S/ 0.00';
    
    document.querySelectorAll('.nav-link').forEach(l => l.classList.remove('active'));
    window.cambiarVista('sec-compra');
    window.irAPaso(1);
}

function generarMapaAsientos() {
    const mapa = document.getElementById('mapa-butacas');
    if(!mapa) return;
    mapa.innerHTML = '';
    const filas = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'];
    filas.forEach(letraFila => {
        const divFila = document.createElement('div');
        divFila.className = 'fila-butacas';
        const etiqueta = document.createElement('div');
        etiqueta.className = 'letra-fila';
        etiqueta.innerText = letraFila;
        divFila.appendChild(etiqueta);
        for (let col = 1; col <= 12; col++) {
            const asiento = document.createElement('div');
            asiento.className = 'asiento disponible';
            if(Math.random() < 0.15) asiento.className = 'asiento ocupado';
            asiento.addEventListener('click', () => {
                if(asiento.classList.contains('ocupado')) return;
                asiento.classList.toggle('seleccionado');
                const idAsiento = `${letraFila}${col}`;
                if(asiento.classList.contains('seleccionado')) compraActual.asientos.push(idAsiento);
                else compraActual.asientos = compraActual.asientos.filter(a => a !== idAsiento);
                const resumen = document.getElementById('resumen-asientos');
                if(resumen) resumen.innerText = `Asientos: ${compraActual.asientos.length > 0 ? compraActual.asientos.join(', ') : 'Ninguno'}`;
            });
            divFila.appendChild(asiento);
        }
        mapa.appendChild(divFila);
    });
}

window.irAPaso = function(numPaso) {
    if(numPaso === 2 && compraActual.asientos.length === 0) return alert("Selecciona al menos un asiento.");
    for(let i=1; i<=4; i++) {
        const paso = document.getElementById(`paso-${i}`);
        if(paso) { paso.classList.add('vista-oculta'); paso.classList.remove('vista-activa'); }
    }
    const pasoTarget = document.getElementById(`paso-${numPaso}`);
    if(pasoTarget) { pasoTarget.classList.remove('vista-oculta'); pasoTarget.classList.add('vista-activa'); }
    
    if(numPaso === 4) {
        const granTotalFinal = parseFloat(compraActual.totalPagar) + parseFloat(compraActual.dulceriaTotal);
        if(document.getElementById('gran-total')) document.getElementById('gran-total').innerText = `S/ ${granTotalFinal.toFixed(2)}`;
    }
}

window.cambiarTicket = function(tipo, cantidad) {
    const span = document.getElementById(`cant-${tipo}`);
    if(!span) return;
    let actual = parseInt(span.innerText);
    actual += cantidad;
    if(actual < 0) actual = 0;
    span.innerText = actual;
    
    const totalSoles = (parseInt(document.getElementById('cant-adulto').innerText) * 18) + (parseInt(document.getElementById('cant-nino').innerText) * 14);
    compraActual.totalPagar = totalSoles;
    if(document.getElementById('total-entradas')) document.getElementById('total-entradas').innerText = `Total: S/ ${totalSoles.toFixed(2)}`;
}

window.procesarCompraFinal = function() {
    const asientosStr = compraActual.asientos.join(', ');
    const boleto = {
        pelicula: compraActual.pelicula,
        sala: `CinePasco Centro - Asientos: ${asientosStr}`,
        fechaCompra: new Date().toLocaleString(),
        codigoQR: Math.random().toString(36).substr(2, 9).toUpperCase() + "-PAS"
    };
    
    localStorage.setItem("miBoletoCinePasco", JSON.stringify(boleto));
    localStorage.removeItem("cinepasco_carrito"); 
    
    window.cambiarVista('sec-perfil');
    window.cargarDatosPerfil();
    alert("¡Pago exitoso! Tu entrada digital ya está en tu perfil.");
}

window.cambiarPantallaInmersiva = function(imgSrc, element) {
    const pantalla = document.getElementById('pantalla-principal-inmersiva');
    if(pantalla) {
        pantalla.style.opacity = 0; 
        setTimeout(() => {
            pantalla.src = imgSrc;
            pantalla.style.opacity = 1;
        }, 150);
    }
    document.querySelectorAll('.item-peli-inmersiva').forEach(el => el.classList.remove('activo'));
    element.classList.add('activo');
}