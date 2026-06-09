<!-- SweetAlert2 y Font Awesome (sin espacios extra) -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="{{ asset('css/show.css') }}">
<div class="container my-5">
    <div class="row align-items-start">
        <!-- Galería de Imágenes (lado izquierdo) -->
       <div class="container-info">
         <div class="col-lg-6">
            <!-- Imagen Principal -->
            <div class="product-gallery-main mb-3 text-center">
                <img id="mainImage"
                     src="{{ $product->images->first()->url }}"
                     alt="Imagen principal del producto"
                     class="img-fluid rounded shadow-sm"
                     style="max-height: 500px; object-fit: contain;">
            </div>

            <!-- Miniaturas -->
            <div class="product-gallery-thumbnails d-flex gap-2 justify-content-center flex-wrap p-2"
                 style="border-radius: 10px; background-color: #f8f9fa;">
                @foreach($product->images as $img)
                    <img src="{{ $img->url }}"
                         alt="Miniatura"
                         class="gallery-thumb border rounded"
                         style="width: 100px; height: 100px; object-fit: cover; cursor: pointer;"
                         onclick="document.getElementById('mainImage').src = this.src;">
                @endforeach
            </div>
        </div>

        <!-- Información del Producto (lado derecho) -->
        <div class="col-lg-6">
            <h1 class="display-6 fw-bold text-dark">{{ $product->name }}</h1>

            @if($product->on_offer)
                <p class="text-danger fw-bold fs-5">¡En oferta!</p>
            @endif

            <p class="lead text-primary fw-semibold">Precio: ${{ number_format($product->price, 2) }}</p>

            <p class="text-muted" style="line-height: 1.7;">
                {{ $product->description }}
            </p>

            <!-- Botón Comprar -->
            <button id="btnComprar" class="btn btn-dark btn-lg mt-3 px-4 py-2 w-100">
                <i class="fas fa-shopping-cart me-2">🛒 Comprar ahora</i> 
            </button>

            <div class="mt-3 text-center">
                <a href="/" class="btn btn-outline-secondary btn-sm">
                    ⬅ Volver al catálogo
                </a>
            </div>
        </div>
    </div>
       </div>

    <!-- Sección adicional: Detalles del producto (abajo) -->
    <div class="row mt-5">
        <div class="col-12">
            <h3 class="border-bottom pb-2" style="color: #2c3e50;">Detalles del producto</h3>
            <ul class="list-unstyled mt-3">
                <li class="mb-2"><i class="fas fa-check text-success me-2"></i> <strong>Material del marco:</strong> Acetato premium resistente</li>
                <li class="mb-2"><i class="fas fa-check text-success me-2"></i> <strong>Protección UV:</strong> 100% UV400</li>
                <li class="mb-2"><i class="fas fa-check text-success me-2"></i> <strong>Diseño:</strong> Ergonómico, sin presión en las orejas</li>
                <li class="mb-2"><i class="fas fa-check text-success me-2"></i> <strong>Incluye:</strong> Funda semirrígida + Paño de limpieza</li>
            </ul>
        </div>
    </div>
    
</div>

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
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

<script>
    document.getElementById('btnComprar').addEventListener('click', function () {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "Vas a comprar este producto",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sí, comprar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (!result.isConfirmed) return;

            fetch("{{ route('purchase.store', $product->id) }}", {
    method: "POST",
    headers: {
        "X-CSRF-TOKEN": "{{ csrf_token() }}",
        "Content-Type": "application/json"
    },
    body: JSON.stringify({}),
    credentials: 'same-origin' // <-- Add this line
})
.then(async res => {
    let data;
    try {
        data = await res.json();
    } catch (e) {
        // Esto captura el HTML de error
        throw new Error("No se pudo procesar la compra. Asegúrate de estar autenticado.");
    }

    if (!data.success) {
        throw new Error(data.message || 'No se pudo completar la compra.');
    }
    return data;
})
.then(data => {
    Swal.fire({
        title: '✅ Compra registrada',
        text: 'Pendiente de aprobación del vendedor',
        icon: 'success'
    });
})
.catch(err => {
    Swal.fire({
        icon: 'error',
        title: 'Ups...',
        text: err.message
    });
});

        });
    });
</script>

<!-- Estilos personalizados (solo para mejorar el diseño visual) -->