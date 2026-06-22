<x-admin-layout title="Crear producto">
    <x-slot name="header">
        <div>
            <h1 class="page-title">Crear producto</h1>
            <p class="page-subtitle">Agrega un nuevo artículo a tu catálogo</p>
        </div>
    </x-slot>

    <div class="admin-card p-6 sm:p-8">
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div class="sm:col-span-2">
                    <label class="admin-label">Nombre del producto</label>
                    <input type="text" name="name" placeholder="Ej. Ray-Ban Aviator" required class="admin-input">
                </div>

                <div class="sm:col-span-2">
                    <label class="admin-label">Descripción</label>
                    <textarea name="description" placeholder="Describe el producto..." required rows="3" class="admin-input"></textarea>
                </div>

                <div>
                    <label class="admin-label">Precio ($)</label>
                    <input type="number" step="0.01" name="price" placeholder="0.00" required class="admin-input">
                </div>

                <div>
                    <label class="admin-label">Stock disponible</label>
                    <input type="number" name="stock" value="10" min="0" required class="admin-input">
                </div>

                <div>
                    <label class="admin-label">Categoría</label>
                    <select name="category_id" required class="admin-input">
                        <option value="">Seleccione una categoría</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="admin-label">Marca</label>
                    <input type="text" name="brand" placeholder="Ej. Ray-Ban, Arnette" required class="admin-input">
                </div>

                <div>
                    <label class="admin-label">Género</label>
                    <select name="gender" required class="admin-input">
                        <option value="Unisex">Unisex</option>
                        <option value="Hombre">Hombre</option>
                        <option value="Mujer">Mujer</option>
                    </select>
                </div>

                <div>
                    <label class="admin-label">Imágenes (máx. 4)</label>
                    <input type="file" name="images[]" multiple accept="image/*"
                           class="admin-input file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-brand file:text-white hover:file:bg-brand-dark"
                           onchange="validateFiles(this)">
                </div>
            </div>

            <div class="flex items-center gap-2 pt-2">
                <input type="checkbox" name="on_offer" value="1" id="on_offer"
                       class="rounded border-gray-300 text-brand focus:ring-brand">
                <label for="on_offer" class="text-sm text-gray-700">Marcar como oferta</label>
            </div>

            <div class="flex flex-col sm:flex-row gap-3 pt-4 border-t border-gray-100">
                <button type="submit" class="admin-btn-primary">
                    <i class="fas fa-save"></i> Guardar producto
                </button>
                <a href="{{ route('admin.products.index') }}" class="admin-btn-secondary text-center">
                    Ver mis productos
                </a>
            </div>
        </form>
    </div>

    @push('scripts')
    <script>
        function validateFiles(input) {
            if (input.files.length > 4) {
                alert('Solo puedes subir un máximo de 4 imágenes.');
                input.value = '';
            }
        }
    </script>
    @endpush
</x-admin-layout>
