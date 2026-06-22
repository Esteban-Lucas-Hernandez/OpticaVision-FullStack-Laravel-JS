<x-admin-layout title="Historial de compras">
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="page-title">Historial de compras</h1>
                <p class="page-subtitle">Revisa todas las compras realizadas en la plataforma</p>
            </div>
            <div class="flex flex-wrap items-center gap-2 shrink-0">
                <a href="{{ route('admin.purchases.download.pdf') }}" class="admin-btn-danger">
                    <i class="fas fa-file-pdf"></i> PDF
                </a>
                <a href="{{ route('admin.purchases.download.excel') }}" class="admin-btn-primary" style="background-color: #16a34a;">
                    <i class="fas fa-file-excel"></i> Excel
                </a>
                <form action="{{ route('admin.purchases.clear') }}" method="POST"
                      onsubmit="return confirm('¿Estás seguro de que quieres eliminar todo el historial? Esta acción no se puede deshacer.');">
                    @csrf
                    <button type="submit" class="admin-btn-warning">
                        <i class="fas fa-trash"></i> Limpiar
                    </button>
                </form>
            </div>
        </div>
    </x-slot>

    <div class="admin-card">
        <div class="admin-table-wrap">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Comprador</th>
                        <th>Vendedor</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($purchases as $purchase)
                        <tr>
                            <td class="font-medium text-gray-900">{{ $purchase->product->name }}</td>
                            <td>{{ $purchase->buyer->name }}</td>
                            <td>{{ $purchase->seller->name ?? 'Sin asignar' }}</td>
                            <td>{{ $purchase->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                @php
                                    $status = $purchase->status ?? 'pendiente';
                                @endphp
                                @if($status === 'aceptada')
                                    <span class="admin-badge-success">Aceptada</span>
                                @elseif($status === 'rechazada')
                                    <span class="admin-badge-danger">Rechazada</span>
                                @else
                                    <span class="admin-badge-warning">Pendiente</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-12 text-gray-500">
                                <i class="fas fa-shopping-bag text-3xl mb-3 block text-gray-300"></i>
                                No hay compras registradas.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
