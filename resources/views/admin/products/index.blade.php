<x-admin-layout title="Gestionar productos">
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="page-title">Mis productos</h1>
                <p class="page-subtitle">{{ $products->count() }} producto(s) en tu catálogo</p>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="admin-btn-primary shrink-0">
                <i class="fas fa-plus"></i> Nuevo producto
            </a>
        </div>
    </x-slot>

    <div class="admin-card">
        <div class="admin-table-wrap">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Categoría</th>
                        <th>Marca</th>
                        <th>Género</th>
                        <th>Stock</th>
                        <th>Precio</th>
                        <th>Oferta</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($products as $product)
                        <tr>
                            <td class="font-medium text-gray-900">{{ $product->name }}</td>
                            <td>{{ $product->category->name ?? 'N/A' }}</td>
                            <td>{{ $product->brand ?? 'N/A' }}</td>
                            <td>{{ $product->gender ?? 'N/A' }}</td>
                            <td>
                                @if($product->stock <= 5)
                                    <span class="admin-badge-warning">{{ $product->stock }}</span>
                                @else
                                    {{ $product->stock }}
                                @endif
                            </td>
                            <td class="font-semibold text-brand-dark">${{ number_format($product->price, 2) }}</td>
                            <td>
                                @if($product->on_offer)
                                    <span class="admin-badge-success">Sí</span>
                                @else
                                    <span class="admin-badge-neutral">No</span>
                                @endif
                            </td>
                            <td>
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('admin.products.edit', $product) }}" class="admin-btn-warning">
                                        <i class="fas fa-edit"></i> Editar
                                    </a>
                                    <form action="{{ route('admin.products.destroy', $product) }}"
                                          method="POST"
                                          onsubmit="return confirm('¿Estás seguro de eliminar este producto?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="admin-btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-12 text-gray-500">
                                <i class="fas fa-box-open text-3xl mb-3 block text-gray-300"></i>
                                No hay productos aún.
                                <a href="{{ route('admin.dashboard') }}" class="text-brand hover:underline ml-1">Crear el primero</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
