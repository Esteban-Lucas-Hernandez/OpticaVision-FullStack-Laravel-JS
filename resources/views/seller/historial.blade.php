<x-admin-layout title="Historial de compras">
    <x-slot name="header">
        <div>
            <h1 class="page-title">Historial de compras</h1>
            <p class="page-subtitle">Gestiona las solicitudes de compra de tus productos</p>
        </div>
    </x-slot>

    <div class="admin-card">
        <div class="admin-table-wrap">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Comprador</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($purchases as $purchase)
                        <tr data-purchase-id="{{ $purchase->id }}">
                            <td class="font-medium text-gray-900">{{ $purchase->product->name }}</td>
                            <td>{{ $purchase->buyer->name }}</td>
                            <td>{{ $purchase->created_at->format('d/m/Y H:i') }}</td>
                            <td class="purchase-status">
                                @php $status = $purchase->status ?? 'pendiente'; @endphp
                                @if($status === 'aceptada')
                                    <span class="admin-badge-success">Aceptada</span>
                                @elseif($status === 'rechazada')
                                    <span class="admin-badge-danger">Rechazada</span>
                                @else
                                    <span class="admin-badge-warning">Pendiente</span>
                                @endif
                            </td>
                            <td class="purchase-actions">
                                @if($purchase->status === 'pendiente' || is_null($purchase->status))
                                    <form action="{{ route('purchase.update', $purchase->id) }}" method="POST" class="update-status-form flex gap-2">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" name="status" value="aceptada" class="admin-btn-primary py-1.5 px-3 text-xs" style="background-color: #16a34a;">
                                            <i class="fas fa-check"></i> Aceptar
                                        </button>
                                        <button type="submit" name="status" value="rechazada" class="admin-btn-danger py-1.5 px-3 text-xs">
                                            <i class="fas fa-times"></i> Rechazar
                                        </button>
                                    </form>
                                @else
                                    <span class="text-sm text-gray-500">—</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-12 text-gray-500">
                                <i class="fas fa-inbox text-3xl mb-3 block text-gray-300"></i>
                                No hay compras pendientes.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @push('scripts')
    <script>
        document.querySelectorAll('.update-status-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                const status = e.submitter.value;
                const purchaseId = this.closest('tr').getAttribute('data-purchase-id');

                fetch(this.getAttribute('action'), {
                    method: 'PUT',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ status })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        const row = document.querySelector(`tr[data-purchase-id="${purchaseId}"]`);
                        const badgeClass = status === 'aceptada' ? 'admin-badge-success' : 'admin-badge-danger';
                        const label = status.charAt(0).toUpperCase() + status.slice(1);
                        row.querySelector('.purchase-status').innerHTML = `<span class="${badgeClass}">${label}</span>`;
                        row.querySelector('.purchase-actions').innerHTML = `<span class="text-sm text-gray-500">—</span>`;
                        if (typeof Swal !== 'undefined') {
                            Swal.fire('Éxito', 'Estado actualizado', 'success');
                        } else {
                            alert('Estado actualizado: ' + label);
                        }
                    } else {
                        const msg = data.message || 'Ocurrió un error';
                        if (typeof Swal !== 'undefined') {
                            Swal.fire('Error', msg, 'error');
                        } else {
                            alert('Error: ' + msg);
                        }
                    }
                })
                .catch(err => {
                    if (typeof Swal !== 'undefined') {
                        Swal.fire('Error', err.message, 'error');
                    } else {
                        alert('Error: ' + err.message);
                    }
                });
            });
        });
    </script>
    @endpush
</x-admin-layout>
