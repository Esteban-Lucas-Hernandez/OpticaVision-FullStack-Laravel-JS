<x-admin-layout title="Mi perfil">
    <x-slot name="header">
        <div>
            <h1 class="page-title">Mi perfil</h1>
            <p class="page-subtitle">Gestiona tu información personal y seguridad</p>
        </div>
    </x-slot>

    <div class="space-y-6">
        {{-- Información del perfil --}}
        <div class="admin-card p-6 sm:p-8">
            <header class="mb-6">
                <h2 class="text-lg font-semibold text-gray-900">Información del perfil</h2>
                <p class="mt-1 text-sm text-gray-500">Actualiza tu nombre y correo electrónico.</p>
            </header>

            <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                @csrf
            </form>

            <form method="post" action="{{ route('profile.update') }}" class="space-y-5">
                @csrf
                @method('patch')

                <div>
                    <label class="admin-label" for="name">Nombre</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" class="admin-input">
                    @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="admin-label" for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required autocomplete="username" class="admin-input">
                    @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror

                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                        <div class="mt-3">
                            <p class="text-sm text-gray-700">
                                Tu correo no está verificado.
                                <button form="send-verification" class="underline text-sm text-brand hover:text-brand-dark">
                                    Reenviar correo de verificación
                                </button>
                            </p>
                            @if (session('status') === 'verification-link-sent')
                                <p class="mt-1 text-sm text-green-600 font-medium">
                                    Se ha enviado un nuevo enlace de verificación.
                                </p>
                            @endif
                        </div>
                    @endif
                </div>

                <div class="flex items-center gap-4 pt-2">
                    <button type="submit" class="admin-btn-primary">
                        <i class="fas fa-save"></i> Guardar
                    </button>
                    @if (session('status') === 'profile-updated')
                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-green-600">
                            Guardado.
                        </p>
                    @endif
                </div>
            </form>
        </div>

        {{-- Cambiar contraseña --}}
        <div class="admin-card p-6 sm:p-8">
            <header class="mb-6">
                <h2 class="text-lg font-semibold text-gray-900">Cambiar contraseña</h2>
                <p class="mt-1 text-sm text-gray-500">Asegúrate de usar una contraseña segura.</p>
            </header>

            <form method="post" action="{{ route('password.update') }}" class="space-y-5">
                @csrf
                @method('put')

                <div>
                    <label class="admin-label" for="current_password">Contraseña actual</label>
                    <input type="password" id="current_password" name="current_password" autocomplete="current-password" class="admin-input">
                    @error('current_password', 'updatePassword') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="admin-label" for="password">Nueva contraseña</label>
                    <input type="password" id="password" name="password" autocomplete="new-password" class="admin-input">
                    @error('password', 'updatePassword') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="admin-label" for="password_confirmation">Confirmar contraseña</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" autocomplete="new-password" class="admin-input">
                    @error('password_confirmation', 'updatePassword') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div class="flex items-center gap-4 pt-2">
                    <button type="submit" class="admin-btn-primary">
                        <i class="fas fa-save"></i> Guardar
                    </button>
                    @if (session('status') === 'password-updated')
                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-green-600">
                            Guardado.
                        </p>
                    @endif
                </div>
            </form>
        </div>

        {{-- Eliminar cuenta --}}
        <div class="admin-card p-6 sm:p-8 border-red-200">
            <header class="mb-6">
                <h2 class="text-lg font-semibold text-red-700">Eliminar cuenta</h2>
                <p class="mt-1 text-sm text-gray-500">Una vez eliminada, toda tu información se perderá permanentemente.</p>
            </header>

            <button x-data x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')" class="admin-btn-danger">
                <i class="fas fa-exclamation-triangle"></i> Eliminar mi cuenta
            </button>

            <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
                <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
                    @csrf
                    @method('delete')

                    <h2 class="text-lg font-semibold text-gray-900">¿Estás seguro de que quieres eliminar tu cuenta?</h2>
                    <p class="mt-1 text-sm text-gray-500">Esta acción es irreversible. Ingresa tu contraseña para confirmar.</p>

                    <div class="mt-6">
                        <input type="password" name="password" placeholder="Contraseña" class="admin-input w-3/4">
                        @error('password', 'userDeletion') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div class="mt-6 flex justify-end gap-3">
                        <button type="button" x-on:click="$dispatch('close')" class="admin-btn-secondary">
                            Cancelar
                        </button>
                        <button type="submit" class="admin-btn-danger">
                            Eliminar cuenta
                        </button>
                    </div>
                </form>
            </x-modal>
        </div>
    </div>

    <style>[x-cloak] { display: none !important; }</style>
</x-admin-layout>
