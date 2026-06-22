<x-admin-layout title="Gestionar usuarios">
    <x-slot name="header">
        <div>
            <h1 class="page-title">Gestión de usuarios</h1>
            <p class="page-subtitle">Administra los roles de todos los usuarios del sistema</p>
        </div>
    </x-slot>

    <div class="admin-card">
        <div class="admin-table-wrap">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Rol actual</th>
                        <th>Cambiar rol</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @isset($usuarios)
                        @foreach($usuarios as $u)
                            <tr>
                                <td class="font-medium text-gray-900">
                                    <div class="flex items-center gap-2">
                                        <div class="w-8 h-8 rounded-full bg-brand-light flex items-center justify-center text-brand text-xs font-bold">
                                            {{ strtoupper(substr($u->name, 0, 2)) }}
                                        </div>
                                        {{ $u->name }}
                                    </div>
                                </td>
                                <td>{{ $u->email }}</td>
                                <td>
                                    @if($u->rol === 'admin')
                                        <span class="admin-badge-danger">Admin</span>
                                    @elseif($u->rol === 'vendedor')
                                        <span class="admin-badge-success">Vendedor</span>
                                    @else
                                        <span class="admin-badge-neutral">Cliente</span>
                                    @endif
                                </td>
                                <td>
                                    <form action="{{ route('admin.cambiarRol', $u->id) }}" method="POST" class="flex items-center gap-2">
                                        @csrf
                                        @method('PUT')
                                        <select name="rol" class="admin-input w-auto py-1.5 text-sm">
                                            <option value="cliente" {{ $u->rol == 'cliente' ? 'selected' : '' }}>Cliente</option>
                                            <option value="vendedor" {{ $u->rol == 'vendedor' ? 'selected' : '' }}>Vendedor</option>
                                            <option value="admin" {{ $u->rol == 'admin' ? 'selected' : '' }}>Admin</option>
                                        </select>
                                        <button type="submit" class="admin-btn-primary py-1.5 px-3 text-xs">
                                            <i class="fas fa-save"></i> Guardar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @endisset
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
