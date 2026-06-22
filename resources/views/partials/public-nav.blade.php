<nav class="navbar scrolled" id="navbar">
    <div class="nav-container">
        <a href="{{ url('/') }}" class="nav-logo">
            <i class="fas fa-glasses nav-logo-icon"></i>
            <span class="nav-logo-text">Óptica <strong>Vision</strong></span>
        </a>

        <button class="hamburger" id="hamburger" aria-label="Abrir menú">
            <span></span><span></span><span></span>
        </button>

        <ul class="menu" id="menu">
            <li><a href="{{ url('/#inicio') }}" class="nav-link">Colecciones</a></li>
            <li><a href="{{ url('/#servicios') }}" class="nav-link">Servicios</a></li>
            <li><a href="{{ url('/#ofertas') }}" class="nav-link">Exámenes</a></li>
            <li><a href="{{ url('/#nosotros') }}" class="nav-link">Nosotros</a></li>
            <li><a href="{{ url('/#contacto') }}" class="nav-link">Ubicaciones</a></li>
        </ul>

        <div class="nav-actions">
            @auth
            <div class="nav-user-menu">
                <button class="nav-user-btn" id="userMenuToggle">
                    <i class="fas fa-user-circle"></i>
                    <span class="user-name-short">{{ Auth::user()->name }}</span>
                    <i class="fas fa-chevron-down nav-chevron"></i>
                </button>
                <div class="user-dropdown" id="userDropdown">
                    <div class="user-dropdown-header">
                        <i class="fas fa-user-circle" style="font-size:2rem; color:#059669;"></i>
                        <div>
                            <p class="ud-name">{{ Auth::user()->name }}</p>
                            <p class="ud-email">{{ Auth::user()->email }}</p>
                        </div>
                    </div>
                    <div class="user-dropdown-divider"></div>
                    @if(Auth::user()->rol === 'admin' || Auth::user()->rol === 'vendedor')
                        <a href="{{ Auth::user()->rol === 'admin' ? route('admin.usuarios') : route('admin.dashboard') }}" class="ud-admin-btn">
                            <i class="fas fa-cog"></i> Panel de {{ Auth::user()->rol === 'admin' ? 'administración' : 'vendedor' }}
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

            <a href="{{ url('/#contacto') }}" class="nav-btn-cta">Reservar Cita</a>
        </div>
    </div>
</nav>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const hamburger = document.getElementById('hamburger');
    const menu = document.getElementById('menu');
    if (hamburger && menu) {
        hamburger.addEventListener('click', () => menu.classList.toggle('show'));
    }

    const userToggle = document.getElementById('userMenuToggle');
    const userDropdown = document.getElementById('userDropdown');
    if (userToggle && userDropdown) {
        userToggle.addEventListener('click', (e) => {
            e.stopPropagation();
            userDropdown.classList.toggle('show');
        });
        document.addEventListener('click', () => userDropdown.classList.remove('show'));
    }
});
</script>
