<x-admin-layout title="Editar producto">
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="page-title">Editar producto</h1>
                <p class="page-subtitle">Modifica los datos de «{{ $product->name }}»</p>
            </div>
            <a href="{{ route('admin.products.index') }}" class="admin-btn-secondary shrink-0">
                <i class="fas fa-arrow-left"></i> Volver a productos
            </a>
        </div>
    </x-slot>

    <div class="admin-card p-6 sm:p-8">
        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div class="sm:col-span-2">
                    <label class="admin-label">Nombre del producto</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" required class="admin-input">
                </div>

                <div class="sm:col-span-2">
                    <label class="admin-label">Descripción</label>
                    <textarea name="description" id="description" rows="3" required class="admin-input">{{ old('description', $product->description) }}</textarea>
                </div>

                <div>
                    <label class="admin-label">Precio ($)</label>
                    <input type="number" step="0.01" name="price" id="price" value="{{ old('price', $product->price) }}" required class="admin-input">
                </div>

                <div>
                    <label class="admin-label">Stock disponible</label>
                    <input type="number" name="stock" id="stock" value="{{ old('stock', $product->stock) }}" min="0" required class="admin-input">
                </div>

                <div>
                    <label class="admin-label">Categoría</label>
                    <select name="category_id" id="category_id" required class="admin-input">
                        <option value="">Seleccione una categoría</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="admin-label">Marca</label>
                    <input type="text" name="brand" id="brand" value="{{ old('brand', $product->brand) }}" required class="admin-input">
                </div>

                <div>
                    <label class="admin-label">Género</label>
                    <select name="gender" id="gender" required class="admin-input">
                        <option value="Unisex" {{ old('gender', $product->gender) == 'Unisex' ? 'selected' : '' }}>Unisex</option>
                        <option value="Hombre" {{ old('gender', $product->gender) == 'Hombre' ? 'selected' : '' }}>Hombre</option>
                        <option value="Mujer" {{ old('gender', $product->gender) == 'Mujer' ? 'selected' : '' }}>Mujer</option>
                    </select>
                </div>

                <div>
                    <label class="admin-label">¿Está en oferta?</label>
                    <select name="on_offer" id="on_offer" class="admin-input">
                        <option value="0" {{ old('on_offer', $product->on_offer) == 0 ? 'selected' : '' }}>No</option>
                        <option value="1" {{ old('on_offer', $product->on_offer) == 1 ? 'selected' : '' }}>Sí</option>
                    </select>
                </div>

                <div>
                    <label class="admin-label">Imágenes actuales</label>
                    <div class="flex flex-wrap gap-2 mt-1">
                        @foreach($product->images as $image)
                            <img src="{{ asset('storage/' . $image->path) }}" alt="Imagen" class="w-16 h-16 object-cover rounded-lg border border-gray-200">
                        @endforeach
                    </div>
                </div>

                <div>
                    <label class="admin-label">Nuevas imágenes (máx. 4, reemplazan las actuales)</label>
                    <input type="file" name="images[]" multiple accept="image/*"
                           class="admin-input file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-brand file:text-white hover:file:bg-brand-dark"
                           onchange="validateFiles(this)">
                </div>
            </div>

            <div class="flex flex-col sm:flex-row gap-3 pt-4 border-t border-gray-100">
                <button type="submit" class="admin-btn-primary">
                    <i class="fas fa-save"></i> Guardar cambios
                </button>
                <a href="{{ route('admin.products.index') }}" class="admin-btn-secondary text-center">
                    Cancelar
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
