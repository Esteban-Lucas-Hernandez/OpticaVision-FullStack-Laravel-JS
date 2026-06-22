<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Óptica Vision - Catálogo de Productos</title>
        <meta name="description" content="Óptica Vision - Especialistas en salud visual. Catálogo de lentes, armazones y servicios ópticos profesionales." />
        <link
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
            rel="stylesheet"
        />
        <link
            href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Outfit:wght@400;500;600;700;800&display=swap"
            rel="stylesheet"
        />
        <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
    />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    </head>
    <body>
        <!-- NAV PREMIUM -->
        <nav class="navbar" id="navbar">
            <div class="nav-container">

                <!-- Logo -->
                <a href="#inicio" class="nav-logo">
                    <i class="fas fa-glasses nav-logo-icon"></i>
                    <span class="nav-logo-text">Óptica <strong>Vision</strong></span>
                </a>

                <!-- Botón hamburguesa -->
                <button class="hamburger" id="hamburger" aria-label="Abrir menú">
                    <span></span><span></span><span></span>
                </button>

                <!-- Menú central -->
                <ul class="menu" id="menu">
                    <li><a href="#inicio" class="nav-link">Colecciones</a></li>
                    <li><a href="#servicios" class="nav-link">Servicios</a></li>
                    <li><a href="#ofertas" class="nav-link">Exámenes</a></li>
                    <li><a href="#nosotros" class="nav-link">Nosotros</a></li>
                    <li><a href="#contacto" class="nav-link">Ubicaciones</a></li>
                </ul>

                <!-- Acciones derecha -->
                <div class="nav-actions">
                    <!-- Búsqueda -->
                    <button class="nav-search-btn" id="searchToggle" aria-label="Buscar">
                        <i class="fas fa-search"></i>
                    </button>

                    @auth
                    <!-- Notificaciones -->
                    <div class="nav-notif-wrap">
                        <button id="btnNotifications" class="nav-notif-btn" aria-label="Notificaciones">
                            <i class="fas fa-bell"></i>
                            <span id="notificationBadge" class="notif-badge"></span>
                        </button>
                        <div id="notificationsBox" class="notif-dropdown">
                            <p class="notif-title"><strong>Últimas compras</strong></p>
                            <ul id="notificationsList" class="notif-list"></ul>
                        </div>
                    </div>

                    <!-- Usuario + Logout -->
                    <div class="nav-user-menu">
                        <button class="nav-user-btn" id="userMenuToggle">
                            <i class="fas fa-user-circle"></i>
                            <span class="user-name-short">{{ Auth::user()->name }}</span>
                            <i class="fas fa-chevron-down nav-chevron"></i>
                        </button>
                        <div class="user-dropdown" id="userDropdown">
                            <div class="user-dropdown-header">
                                <i class="fas fa-user-circle" style="font-size:2rem; color:#0ea5e9;"></i>
                                <div>
                                    <p class="ud-name">{{ Auth::user()->name }}</p>
                                    <p class="ud-email">{{ Auth::user()->email }}</p>
                                </div>
                            </div>
                            <div class="user-dropdown-divider"></div>
                            @if(Auth::user()->rol === 'admin' || Auth::user()->rol === 'vendedor')
                                <a href="{{ Auth::user()->rol === 'admin' ? route('admin.usuarios') : route('admin.dashboard') }}" class="ud-admin-btn">
                                    <i class="fas fa-cog"></i> Panel de {{ Auth::user()->rol === 'admin' ? 'administraci\u00f3n' : 'vendedor' }}
                                </a>
                            @endif
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="ud-logout-btn">
                                    <i class="fas fa-sign-out-alt"></i> Cerrar sesión
                                </button>
                            </form>
                        </div>
                    </div>
                    @endauth

                    @guest
                    <a href="{{ route('login') }}" class="nav-btn-ghost">Ingresar</a>
                    @endguest

                    <!-- CTA Principal -->
                    <a href="#contacto" class="nav-btn-cta">Reservar Cita</a>
                </div>

            </div>

            <!-- Barra de búsqueda expandible -->
            <div class="nav-search-bar" id="searchBar">
                <div class="search-bar-inner">
                    <i class="fas fa-search search-bar-icon"></i>
                    <input type="text" id="searchInput" placeholder="Buscar lentes, armazones, servicios..." class="search-bar-input" />
                    <button class="search-bar-close" id="searchClose"><i class="fas fa-times"></i></button>
                </div>
            </div>
        </nav>

        <!-- HERO SECTION -->
        <section id="inicio" class="hero-section">
            <div class="hero-bg"></div>
            <div class="hero-overlay"></div>
            <div class="hero-content">
                <div class="hero-promo-card">
                    <p class="hero-promo-tag">Temporada de Sol</p>
                    <h1 class="hero-promo-title">Nueva Colección<br>de Sol</h1>
                    <p class="hero-promo-desc">Descubre la claridad perfecta con nuestra nueva línea de gafas de sol de diseñador. Protección UV con estilo editorial.</p>
                    <a href="#productos" class="hero-promo-btn">Explorar Colección</a>
                </div>
            </div>
            <!-- Dots decorativos del hero -->
            <div class="hero-dots">
                <span class="dot dot-active"></span>
                <span class="dot"></span>
                <span class="dot"></span>
            </div>
        </section>


        <main>

    {{-- Usamos la clase .card-container para el div que envuelve los productos --}}
   <section id="productos" class="card-section">
       <h2>Catálogo de Productos</h2>
       
       <div class="catalog-container">
           <!-- Barra Lateral de Filtros (Sidebar) -->
           <aside class="filter-sidebar">
               <div class="filter-group">
                   <label for="search-input-catalog">Buscar</label>
                   <input type="text" id="search-input-catalog" placeholder="Buscar por nombre o descripción..." />
               </div>

               <div class="filter-group">
                   <label>Categoría</label>
                   <div class="filter-options" id="category-filters">
                       <button class="filter-btn active" data-category="all">Todos</button>
                       @foreach($categories as $category)
                           <button class="filter-btn" data-category="{{ $category->id }}">{{ $category->name }}</button>
                       @endforeach
                   </div>
               </div>

               <div class="filter-group">
                   <label>Género</label>
                   <div class="filter-options" id="gender-filters">
                       <button class="filter-btn active" data-gender="all">Todos</button>
                       <button class="filter-btn" data-gender="Hombre">Hombre</button>
                       <button class="filter-btn" data-gender="Mujer">Mujer</button>
                       <button class="filter-btn" data-gender="Unisex">Unisex</button>
                   </div>
               </div>

               <div class="filter-group">
                   <label for="brand-select">Marca</label>
                   <select id="brand-select">
                       <option value="all">Todas las marcas</option>
                       @foreach($brands as $brand)
                           <option value="{{ $brand }}">{{ $brand }}</option>
                       @endforeach
                   </select>
               </div>

               <div class="filter-group">
                   <label>Rango de Precio</label>
                   <div class="price-range-inputs">
                       <input type="number" id="min-price" placeholder="Mín" min="0" />
                       <span>-</span>
                       <input type="number" id="max-price" placeholder="Máx" min="0" />
                   </div>
               </div>

               <div class="filter-group checkbox-group">
                   <label>
                       <input type="checkbox" id="offer-checkbox" /> En Oferta
                   </label>
               </div>

               <button id="clear-filters-btn" class="clear-btn">Limpiar Filtros</button>
           </aside>

           <!-- Cuadrícula de Productos -->
           <div class="products-grid-wrapper">
               <div class="products-grid" id="products-grid">
                   @foreach($products as $product)
                       <div class="card product-card" 
                            data-id="{{ $product->id }}"
                            data-name="{{ strtolower($product->name) }}"
                            data-description="{{ strtolower($product->description) }}"
                            data-category="{{ $product->category_id }}"
                            data-brand="{{ $product->brand }}"
                            data-gender="{{ $product->gender }}"
                            data-price="{{ $product->price }}"
                            data-offer="{{ $product->on_offer ? '1' : '0' }}">
                           
                           @if($product->on_offer)
                               <span class="badge-offer">Oferta</span>
                           @endif

                           @if($product->images->first())
                               <img src="{{ $product->images->first()->url }}" alt="{{ $product->name }}" />
                           @else
                               <img src="https://placehold.co/600x400?text=Sin+Imagen" alt="{{ $product->name }}" />
                           @endif

                           <div class="card-content">
                               <span class="product-category-tag">{{ $product->category->name ?? 'Sin Categoría' }}</span>
                               <h3>{{ $product->name }}</h3>
                               <div class="product-meta">
                                   <span><i class="fas fa-tag"></i> {{ $product->brand ?? 'Genérica' }}</span>
                                   <span><i class="fas fa-venus-mars"></i> {{ $product->gender ?? 'Unisex' }}</span>
                               </div>
                               <p>{{ Str::limit($product->description, 80) }}</p>
                               <div class="price-action">
                                   <span class="price-tag">${{ number_format($product->price, 0, ',', '.') }}</span>
                                   <a href="{{ route('products.show', $product->id) }}">
                                       <button class="btn-view-more">Ver más</button>
                                   </a>
                               </div>
                           </div>
                       </div>
                   @endforeach
               </div>
               
               <!-- Mensaje de no resultados -->
               <div id="no-results" class="no-results hidden">
                   <i class="fas fa-search"></i>
                   <p>No se encontraron productos con los filtros seleccionados.</p>
               </div>
           </div>
       </div>
   </section>

            <!-- SECCIÓN OFERTAS - Solo agregando clases CSS -->
            <!-- SECCIÓN OFERTAS -->
<section id="ofertas" class="card-section offers-section">
    <h2>Ofertas especiales</h2>

    @if($offers->isEmpty())
        <p>No hay productos en oferta actualmente.</p>
    @else
        <div class="swiper offers-carousel">
            <div class="swiper-wrapper">
                @foreach($offers as $product)
                    <div class="swiper-slide">
                        <div class="card">
                            @if($product->images->first())
                                <img src="{{ $product->images->first()->url }}" alt="{{ $product->name }}" />
                            @endif

                            <h3>{{ $product->name }}</h3>
                            <p>{{ $product->description }}</p>

                            {{-- Usamos la clase para destacar la oferta --}}
                            <p class="offer-price">¡Precio especial!</p>

                            <p style="color: #10b981">Precio: ${{ number_format($product->price, 0, ',', '.') }}</p>

                            <a href="{{ route('products.show', $product->id) }}">
                                <button>Ver más</button>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Controles de navegación -->
            <div class="swiper-pagination"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    @endif
</section>


            <!-- SECCIÓN SERVICIOS -->
            <section id="servicios" class="section-container fade-in">
                <h2 class="section-title">Nuestros Servicios Profesionales</h2>
                <div class="services-grid">
                    <div class="service-card">
                        <i class="fas fa-eye"></i>
                        <h3>Examen Visual Completo</h3>
                        <p>
                            Evaluaciones profesionales con equipos de última
                            generación para detectar problemas visuales y
                            enfermedades oculares.
                        </p>
                    </div>
                    <div class="service-card">
                        <i class="fas fa-glasses"></i>
                        <h3>Lentes Oftálmicos</h3>
                        <p>
                            Amplio catálogo de lentes con tratamientos
                            antirreflejante, fotocromáticos y progresivos de las
                            mejores marcas.
                        </p>
                    </div>
                    <div class="service-card">
                        <i class="fas fa-sun"></i>
                        <h3>Lentes de Sol</h3>
                        <p>
                            Protección UV completa con diseños modernos y
                            graduaciones personalizadas para cada necesidad.
                        </p>
                    </div>
                    <div class="service-card">
                        <i class="fas fa-tools"></i>
                        <h3>Reparaciones</h3>
                        <p>
                            Servicio técnico especializado en reparación y
                            ajuste de monturas con garantía de calidad.
                        </p>
                    </div>
                    <div class="service-card">
                        <i class="fas fa-shipping-fast"></i>
                        <h3>Entrega Express</h3>
                        <p>
                            Servicio de entrega rápida para que tengas tus
                            lentes listos en el menor tiempo posible.
                        </p>
                    </div>
                    <div class="service-card">
                        <i class="fas fa-certificate"></i>
                        <h3>Garantía Extendida</h3>
                        <p>
                            Respaldo completo en todos nuestros productos con
                            política de cambio y satisfacción garantizada.
                        </p>
                    </div>
                </div>
            </section>

            <!-- SECCIÓN NOSOTROS -->
            <section id="nosotros" class="section-container fade-in">
                <h2 class="section-title">Acerca de Nosotros</h2>
                <div class="about-content">
                    <p>
                        Con más de dos décadas de experiencia en el sector
                        óptico, Óptica Vision se ha consolidado como líder en el
                        cuidado de la salud visual. Contamos con un equipo de
                        profesionales especializados y tecnología de vanguardia
                        para ofrecerte soluciones ópticas personalizadas que se
                        adapten perfectamente a tu estilo de vida.
                    </p>
                    <div class="stats-grid">
                        <div class="stat-item">
                            <i class="fas fa-users"></i>
                            <h3>25,000+</h3>
                            <p>Clientes Satisfechos</p>
                        </div>
                        <div class="stat-item">
                            <i class="fas fa-award"></i>
                            <h3>20+</h3>
                            <p>Años de Experiencia</p>
                        </div>
                        <div class="stat-item">
                            <i class="fas fa-eye"></i>
                            <h3>1,200+</h3>
                            <p>Modelos Disponibles</p>
                        </div>
                        <div class="stat-item">
                            <i class="fas fa-star"></i>
                            <h3>4.9/5</h3>
                            <p>Calificación Promedio</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- SECCIÓN TESTIMONIOS -->
            <section id="testimonios" class="section-container fade-in">
                <h2 class="section-title">Testimonios de Nuestros Clientes</h2>
                <div class="testimonials-grid">
                    <div class="testimonial-card">
                        <p>
                            "Excelente atención profesional y productos de la
                            más alta calidad. El equipo es muy conocedor y me
                            ayudaron a encontrar exactamente lo que necesitaba
                            para mi problema visual específico."
                        </p>
                        <h4>— Dr. María González, Médica</h4>
                    </div>
                    <div class="testimonial-card">
                        <p>
                            "El servicio es impecable, desde el examen visual
                            hasta la entrega de los lentes. La calidad de las
                            monturas y cristales es excepcional. Definitivamente
                            mi óptica de confianza."
                        </p>
                        <h4>— Carlos Rodríguez, Ingeniero</h4>
                    </div>
                    <div class="testimonial-card">
                        <p>
                            "Profesionales altamente capacitados y tecnología de
                            punta. Los lentes progresivos que me fabricaron son
                            perfectos. La adaptación fue muy rápida y cómoda."
                        </p>
                        <h4>— Ana López, Arquitecta</h4>
                    </div>
                </div>
            </section>

            <!-- SECCIÓN FAQ -->
            <section id="faq" class="section-container fade-in">
                <h2 class="section-title">Preguntas Frecuentes</h2>
                <div class="faq-container">
                    <div class="faq-item">
                        <div class="faq-question">
                            <span>¿Cómo puedo agendar un examen visual?</span>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="faq-answer">
                            <p>
                                Puedes agendar tu cita llamando a nuestro número
                                telefónico, visitando nuestra tienda física, o a
                                través de nuestro sistema de citas online.
                                Recomendamos agendar con anticipación para
                                garantizar disponibilidad en el horario de tu
                                preferencia.
                            </p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-question">
                            <span>¿Qué métodos de pago aceptan?</span>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="faq-answer">
                            <p>
                                Aceptamos efectivo, tarjetas de crédito y débito
                                de todas las franquicias, transferencias
                                bancarias, y ofrecemos planes de financiamiento
                                sin intereses hasta 12 meses para compras
                                superiores a cierto monto.
                            </p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-question">
                            <span>¿Cuál es la garantía de los productos?</span>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="faq-answer">
                            <p>
                                Ofrecemos garantía completa: 2 años en monturas
                                contra defectos de fabricación, 1 año en
                                cristales oftálmicos, y 6 meses en lentes de
                                contacto. Adicionalmente, incluimos ajustes
                                gratuitos durante el primer año.
                            </p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-question">
                            <span
                                >¿Cuánto tiempo tardan en fabricar los
                                lentes?</span
                            >
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="faq-answer">
                            <p>
                                Los tiempos varían según el tipo de lente:
                                cristales simples 24-48 horas, bifocales y
                                antirreflejantes 3-5 días hábiles, progresivos
                                de alta gama 7-10 días hábiles. Para casos
                                urgentes, ofrecemos servicio express con costo
                                adicional.
                            </p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-question">
                            <span>¿Realizan reparaciones de monturas?</span>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="faq-answer">
                            <p>
                                Sí, contamos con taller especializado para
                                reparaciones. Soldadura de monturas metálicas,
                                cambio de plaquetas nasales, ajuste de patillas,
                                y reparaciones menores. La mayoría se realizan
                                mientras esperas.
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- SECCIÓN SUSCRIPCIÓN -->
            <section id="suscripcion" class="fade-in">
                <div class="subscription-section">
                    <h2>Mantente Informado</h2>
                    <p>
                        Suscríbete a nuestro newsletter para recibir ofertas
                        exclusivas, consejos de salud visual, información sobre
                        nuevos productos y promociones especiales para clientes
                        VIP.
                    </p>
                    <form class="form-container">
                        <input
                            type="email"
                            placeholder="Ingresa tu correo electrónico"
                            required
                        />
                        <button type="submit">Suscribirse</button>
                    </form>
                </div>
            </section>

            <!-- SECCIÓN CONTACTO -->
            <section id="contacto" class="section-container fade-in">
                <h2 class="section-title">Información de Contacto</h2>
                <div class="contact-grid">
                    <div class="contact-card">
                        <i class="fas fa-map-marker-alt"></i>
                        <h3>Ubicación</h3>
                        <p>
                            Av. Principal #123<br />Centro Comercial Plaza
                            Mayor<br />Piso 2, Local 205<br />Turbána, Bolívar
                        </p>
                    </div>
                    <div class="contact-card">
                        <i class="fas fa-phone"></i>
                        <h3>Teléfonos</h3>
                        <p>
                            Fijo: (605) 123-4567<br />Móvil: (301) 234-5678<br />WhatsApp:
                            (320) 345-6789
                        </p>
                    </div>
                    <div class="contact-card">
                        <i class="fas fa-envelope"></i>
                        <h3>Email</h3>
                        <p>
                            info@opticavision.co<br />ventas@opticavision.co<br />citas@opticavision.co
                        </p>
                    </div>
                    <div class="contact-card">
                        <i class="fas fa-clock"></i>
                        <h3>Horarios de Atención</h3>
                        <p>
                            Lunes a Viernes: 8:00 AM - 6:00 PM<br />Sábados:
                            8:00 AM - 4:00 PM<br />Domingos: 10:00 AM - 2:00 PM
                        </p>
                    </div>
                </div>
            </section>
        </main>

        <!-- FOOTER -->
        <footer>
            <div class="footer-content">
                <div class="footer-links">
                    <a href="#inicio">Inicio</a>
                    <a href="#productos">Productos</a>
                    <a href="#ofertas">Ofertas</a>
                    <a href="#servicios">Servicios</a>
                    <a href="#nosotros">Nosotros</a>
                    <a href="#testimonios">Testimonios</a>
                    <a href="#faq">FAQ</a>
                    <a href="#contacto">Contacto</a>
                </div>

                <div class="social-links">
                    <a href="#" title="Facebook"
                        ><i class="fab fa-facebook-f"></i
                    ></a>
                    <a href="#" title="Instagram"
                        ><i class="fab fa-instagram"></i
                    ></a>
                    <a href="#" title="Twitter"
                        ><i class="fab fa-twitter"></i
                    ></a>
                    <a href="#" title="WhatsApp"
                        ><i class="fab fa-whatsapp"></i
                    ></a>
                    <a href="#" title="LinkedIn"
                        ><i class="fab fa-linkedin-in"></i
                    ></a>
                </div>

                <div class="footer-bottom">
                    <p>
                        &copy; 2025 Óptica Vision. Todos los derechos
                        reservados.
                    </p>
                    <p>
                        Registro Sanitario INVIMA: NSOC-SO123456 | RUT:
                        900.123.456-7
                    </p>
                </div>
            </div>
        </footer>

        <!-- SCRIPTS NAVBAR + NOTIFICACIONES -->
        <script>
            document.addEventListener("DOMContentLoaded", () => {

                // ── NAVBAR: Scroll effect ──────────────────────────────
                const navbar = document.getElementById("navbar");
                window.addEventListener("scroll", () => {
                    navbar.classList.toggle("scrolled", window.scrollY > 20);
                });

                // ── NAVBAR: Hamburger ──────────────────────────────────
                const hamburger = document.getElementById("hamburger");
                const menu = document.getElementById("menu");
                hamburger.addEventListener("click", () => {
                    hamburger.classList.toggle("open");
                    menu.classList.toggle("show");
                });

                // Cerrar menú al hacer clic en un enlace
                menu.querySelectorAll(".nav-link").forEach(link => {
                    link.addEventListener("click", () => {
                        hamburger.classList.remove("open");
                        menu.classList.remove("show");
                    });
                });

                // ── NAVBAR: Search bar toggle ──────────────────────────
                const searchToggle = document.getElementById("searchToggle");
                const searchBar = document.getElementById("searchBar");
                const searchClose = document.getElementById("searchClose");
                const searchInput = document.getElementById("searchInput");

                if (searchToggle && searchBar) {
                    searchToggle.addEventListener("click", () => {
                        searchBar.classList.toggle("open");
                        if (searchBar.classList.contains("open")) {
                            setTimeout(() => searchInput && searchInput.focus(), 100);
                        }
                    });
                    searchClose && searchClose.addEventListener("click", () => {
                        searchBar.classList.remove("open");
                    });
                }

                // ── NAVBAR: User dropdown ──────────────────────────────
                const userMenuToggle = document.getElementById("userMenuToggle");
                const userDropdown = document.getElementById("userDropdown");

                if (userMenuToggle && userDropdown) {
                    userMenuToggle.addEventListener("click", (e) => {
                        e.stopPropagation();
                        const isOpen = userDropdown.classList.toggle("open");
                        userMenuToggle.classList.toggle("open", isOpen);
                    });
                    document.addEventListener("click", (e) => {
                        if (!userMenuToggle.contains(e.target) && !userDropdown.contains(e.target)) {
                            userDropdown.classList.remove("open");
                            userMenuToggle.classList.remove("open");
                        }
                    });
                }

                // ── Active nav link on scroll ──────────────────────────
                const sections = document.querySelectorAll("section[id]");
                const navLinks = document.querySelectorAll(".nav-link");
                const observerNav = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            navLinks.forEach(l => l.classList.remove("active"));
                            const active = document.querySelector(`.nav-link[href="#${entry.target.id}"]`);
                            if (active) active.classList.add("active");
                        }
                    });
                }, { threshold: 0.4 });
                sections.forEach(s => observerNav.observe(s));

                // ── NOTIFICACIONES ─────────────────────────────────────
                const btn = document.getElementById("btnNotifications");
                const box = document.getElementById("notificationsBox");
                const list = document.getElementById("notificationsList");
                const badge = document.getElementById("notificationBadge");

                // === Lógica para el badge de notificaciones ===
                const checkNotificationStatus = async () => {
                    if (!btn) return; // Solo si el botón existe (usuario autenticado)

                    const lastCheck = localStorage.getItem('lastNotificationCheck');
                    let url = '/notifications/status';
                    if (lastCheck) {
                        // Adjuntar como parámetro de consulta
                        url += `?since=${encodeURIComponent(lastCheck)}`;
                    }

                    try {
                        const response = await fetch(url);
                        if (!response.ok) return;

                        const data = await response.json();

                        if (data.count > 0) {
                            badge.textContent = data.count > 9 ? '9+' : data.count;
                            badge.style.display = 'flex';
                        } else {
                            badge.style.display = 'none';
                        }
                    } catch (error) {
                        console.error("Error al verificar estado de notificaciones:", error);
                        badge.style.display = 'none';
                    }
                };

                // Si el usuario está logueado, verificar notificaciones periódicamente
                if (btn) {
                    checkNotificationStatus();
                    setInterval(checkNotificationStatus, 30000); // Cada 30 segundos
                }

                if (btn) { // Asegurarse de que el botón existe antes de añadir el listener
                    btn.addEventListener("click", async (e) => {
                        e.stopPropagation();
                        const isVisible = box.style.display === "block";
                        box.style.display = isVisible ? "none" : "block";
                        if (!isVisible) document.addEventListener('click', () => { box.style.display = 'none'; }, { once: true });

                        if (!isVisible) { // Si se acaba de abrir
                            // Ocultar el badge y guardar la fecha de revisión
                            badge.style.display = 'none';
                            localStorage.setItem('lastNotificationCheck', new Date().toISOString());

                            list.innerHTML = "<li>Cargando...</li>";

                            try {
                                let response = await fetch("/notifications");
                                let data = await response.json();
                                list.innerHTML = "";

                                if (data.length === 0) {
                                    list.innerHTML = "<li>No hay compras recientes.</li>";
                                } else {
                                    data.forEach((p) => {
                                        const { product_name, status, purchased_at } = p;
                                        const li = document.createElement("li");
                                        li.style.borderBottom = "1px solid #eee";
                                        li.style.padding = "8px 0";

                                        const statusClass = status === 'aceptada' ? 'color: green;' : (status === 'rechazada' ? 'color: red;' : '');

                                        li.innerHTML = `
                                            ${product_name} → <strong style="${statusClass}">${status}</strong>
                                            <br>
                                            <small style="color: #666;">${new Date(purchased_at).toLocaleString()}</small>
                                        `;
                                        list.appendChild(li);
                                    });
                                }
                            } catch (error) {
                                console.error("Error cargando notificaciones:", error);
                                list.innerHTML = "<li>No se pudieron cargar las notificaciones.</li>";
                            }
                        }
                    });
                }

                // FAQ Toggle
                document
                    .querySelectorAll(".faq-question")
                    .forEach((question) => {
                        question.addEventListener("click", () => {
                            const answer = question.nextElementSibling;
                            const icon = question.querySelector("i");
                            const isVisible = answer.style.display === "block";

                            // Cerrar todas las respuestas y resetear iconos
                            document
                                .querySelectorAll(".faq-answer")
                                .forEach((ans) => {
                                    ans.style.display = "none";
                                });
                            document
                                .querySelectorAll(".faq-question")
                                .forEach((q) => {
                                    q.classList.remove("active");
                                });

                            // Mostrar/ocultar la respuesta clickeada
                            if (!isVisible) {
                                answer.style.display = "block";
                                question.classList.add("active");
                            }
                        });
                    });

                // Smooth scrolling para los enlaces del menú
                document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
                    anchor.addEventListener("click", function (e) {
                        e.preventDefault();
                        const target = document.querySelector(
                            this.getAttribute("href")
                        );
                        if (target) {
                            target.scrollIntoView({
                                behavior: "smooth",
                                block: "start",
                            });
                        }
                    });
                });

                // Animaciones al hacer scroll
                const observerOptions = {
                    threshold: 0.1,
                    rootMargin: "0px 0px -50px 0px",
                };

                const observer = new IntersectionObserver(function (entries) {
                    entries.forEach((entry) => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add("visible");
                        }
                    });
                }, observerOptions);

                document.querySelectorAll(".fade-in").forEach((el) => {
                    observer.observe(el);
                });

                // Contador animado para estadísticas
                function animateCounter(element, target, duration = 2000) {
                    let start = 0;
                    const increment = target / (duration / 16);
                    const timer = setInterval(() => {
                        start += increment;
                        if (target >= 1000) {
                            element.textContent =
                                Math.floor(start).toLocaleString() + "+";
                        } else {
                            element.textContent = Math.floor(start * 10) / 10;
                        }
                        if (start >= target) {
                            if (target >= 1000) {
                                element.textContent =
                                    target.toLocaleString() + "+";
                            } else {
                                element.textContent = target;
                            }
                            clearInterval(timer);
                        }
                    }, 16);
                }

                // Iniciar contadores cuando sean visibles
                const statsObserver = new IntersectionObserver(
                    function (entries) {
                        entries.forEach((entry) => {
                            if (entry.isIntersecting) {
                                const counters =
                                    entry.target.querySelectorAll(
                                        ".stat-item h3"
                                    );
                                counters.forEach((counter) => {
                                    const text = counter.textContent;
                                    if (text.includes("25,000")) {
                                        counter.textContent = "0";
                                        animateCounter(counter, 25000);
                                    } else if (text.includes("20")) {
                                        counter.textContent = "0";
                                        animateCounter(counter, 20);
                                    } else if (text.includes("1,200")) {
                                        counter.textContent = "0";
                                        animateCounter(counter, 1200);
                                    } else if (text.includes("4.9")) {
                                        counter.textContent = "0.0";
                                        animateCounter(counter, 4.9);
                                    }
                                });
                                statsObserver.unobserve(entry.target);
                            }
                        });
                    },
                    { threshold: 0.5 }
                );

                const statsSection = document.querySelector("#nosotros");
                if (statsSection) {
                    statsObserver.observe(statsSection);
                }
            });
        </script>
        <script>
    // Inicialización para el carrusel de PRODUCTOS
    const productsSwiper = new Swiper('.products-carousel', {
      // Bucle infinito
      loop: true,
      
      // Espacio entre cada tarjeta
      spaceBetween: 30,

      // Paginación (los puntos inferiores)
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },

      // Flechas de navegación
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },

      // Configuración Responsive (número de slides por pantalla)
      breakpoints: {
        // Cuando la ventana es >= 320px
        320: {
          slidesPerView: 1,
          spaceBetween: 20
        },
        // Cuando la ventana es >= 768px
        768: {
          slidesPerView: 2,
          spaceBetween: 30
        },
        // Cuando la ventana es >= 1024px
        1024: {
          slidesPerView: 3,
          spaceBetween: 30
        },
        // Cuando la ventana es >= 1200px
        1200: {
            slidesPerView: 4,
            spaceBetween: 30
        }
      }
    });

    // Inicialización para el carrusel de OFERTAS
    // (es el mismo código, solo cambia el selector '.offers-carousel')
    const offersSwiper = new Swiper('.offers-carousel', {
      loop: true,
      spaceBetween: 30,
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
      breakpoints: {
        320: {
          slidesPerView: 1,
          spaceBetween: 20
        },
        768: {
          slidesPerView: 2,
          spaceBetween: 30
        },
        1024: {
          slidesPerView: 3,
          spaceBetween: 30
        }
      }
    });
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('search-input-catalog');
    const categoryBtns = document.querySelectorAll('#category-filters .filter-btn');
    const genderBtns = document.querySelectorAll('#gender-filters .filter-btn');
    const brandSelect = document.getElementById('brand-select');
    const minPriceInput = document.getElementById('min-price');
    const maxPriceInput = document.getElementById('max-price');
    const offerCheckbox = document.getElementById('offer-checkbox');
    const clearBtn = document.getElementById('clear-filters-btn');
    
    const productGrid = document.getElementById('products-grid');
    const productCards = document.querySelectorAll('.product-card');
    const noResults = document.getElementById('no-results');

    let activeCategory = 'all';
    let activeGender = 'all';

    // Category Buttons
    categoryBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            categoryBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            activeCategory = this.getAttribute('data-category');
            filterProducts();
        });
    });

    // Gender Buttons
    genderBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            genderBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            activeGender = this.getAttribute('data-gender');
            filterProducts();
        });
    });

    // Inputs Change Listeners
    if (searchInput) searchInput.addEventListener('input', filterProducts);
    if (brandSelect) brandSelect.addEventListener('change', filterProducts);
    if (minPriceInput) minPriceInput.addEventListener('input', filterProducts);
    if (maxPriceInput) maxPriceInput.addEventListener('input', filterProducts);
    if (offerCheckbox) offerCheckbox.addEventListener('change', filterProducts);

    // Clear Filters
    if (clearBtn) {
        clearBtn.addEventListener('click', function() {
            if (searchInput) searchInput.value = '';
            if (brandSelect) brandSelect.value = 'all';
            if (minPriceInput) minPriceInput.value = '';
            if (maxPriceInput) maxPriceInput.value = '';
            if (offerCheckbox) offerCheckbox.checked = false;
            
            categoryBtns.forEach(b => b.classList.remove('active'));
            if (categoryBtns[0]) categoryBtns[0].classList.add('active');
            activeCategory = 'all';

            genderBtns.forEach(b => b.classList.remove('active'));
            if (genderBtns[0]) genderBtns[0].classList.add('active');
            activeGender = 'all';

            filterProducts();
        });
    }

    // Main Filter Logic
    function filterProducts() {
        const query = searchInput ? searchInput.value.toLowerCase().trim() : '';
        const brand = brandSelect ? brandSelect.value : 'all';
        const minPrice = parseFloat(minPriceInput ? minPriceInput.value : '') || 0;
        const maxPrice = parseFloat(maxPriceInput ? maxPriceInput.value : '') || Infinity;
        const onlyOffers = offerCheckbox ? offerCheckbox.checked : false;

        let visibleCount = 0;

        productCards.forEach(card => {
            const cardName = card.getAttribute('data-name') || '';
            const cardDesc = card.getAttribute('data-description') || '';
            const cardCategory = card.getAttribute('data-category') || '';
            const cardBrand = card.getAttribute('data-brand') || '';
            const cardGender = card.getAttribute('data-gender') || '';
            const cardPrice = parseFloat(card.getAttribute('data-price')) || 0;
            const isOffer = card.getAttribute('data-offer') === '1';

            // Match Category
            const matchCategory = (activeCategory === 'all' || cardCategory === activeCategory);
            
            // Match Gender
            const matchGender = (activeGender === 'all' || cardGender === activeGender);
            
            // Match Brand
            const matchBrand = (brand === 'all' || cardBrand === brand);
            
            // Match Price Range
            const matchPrice = (cardPrice >= minPrice && cardPrice <= maxPrice);

            // Match Offer
            const matchOffer = (!onlyOffers || isOffer);

            // Match Search query
            const matchSearch = (!query || cardName.includes(query) || cardDesc.includes(query));

            if (matchCategory && matchGender && matchBrand && matchPrice && matchOffer && matchSearch) {
                card.classList.remove('hidden');
                visibleCount++;
            } else {
                card.classList.add('hidden');
            }
        });

        // Toggle No Results Message
        if (visibleCount === 0) {
            if (noResults) noResults.classList.remove('hidden');
            if (productGrid) productGrid.classList.add('hidden');
        } else {
            if (noResults) noResults.classList.add('hidden');
            if (productGrid) productGrid.classList.remove('hidden');
        }
    }

    // Connect Navbar Search Form to Catalog
    const navSearchForm = document.getElementById('searchForm');
    const navSearchInput = document.getElementById('searchInput');

    if (navSearchForm && navSearchInput) {
        navSearchForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const query = navSearchInput.value.trim();
            if (!query) return;

            // Update catalog search field
            if (searchInput) {
                searchInput.value = query;
            }
            
            // Scroll to catalog section
            const catalogSec = document.getElementById('productos');
            if (catalogSec) {
                catalogSec.scrollIntoView({ behavior: 'smooth' });
            }

            // Run filtering
            filterProducts();
        });
    }
});
</script>

<script>
    document.getElementById("hamburger").addEventListener("click", function() {
        document.getElementById("menu").classList.toggle("show");
    });
</script>



    </body>
</html>
