<div>
    <div class="p-5">
        <h2 class="mb-3 h2 text-indigo-600">Regístrate</h2>
        <form wire:submit="process">
            <div class="form-group">
                <label for="name" class="form-label">Nombre y Apellido</label>
                <input type="text" name="name" id="name" wire:model.live="name" />
                @error('name') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="email" class="form-label">Correo electrónico</label>
                <input type="text" name="email" id="email" wire:model.live="email" />
                @error('email') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" name=password" id="password" wire:model.live="password" />
                @error('password') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
            </div>

            <button class="btn btn-sm btn-primary w-full justify-center text-center mt-5" type="submit">Aceptar</button>
        </form>
    </div>

</div>
