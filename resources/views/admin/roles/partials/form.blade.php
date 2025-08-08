<div class="form-group">
    <label for="name">Nombre del role</label>
    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $role->name ?? '') }}" placeholder="Ingrese el nombre del role"/>
    @error('name')
        <span class="invalid-feedback">{{ $message }}</span>
    @enderror
</div>
<h2 class="h3">Lista de permisos</h2>
@foreach ($permissions as $permission)
    @php
        $selectedPermissions = old('permissions', $role->permissions->pluck('id')->toArray());
    @endphp
    <div class="custom-control custom-checkbox">
        <input class="custom-control-input" type="checkbox" id="role{{ $permission->id }}" value="{{ $permission->id }}" name="permissions[]" {{ in_array($permission->id, $selectedPermissions) ? 'checked' : '' }}>
        <label for="role{{ $permission->id }}" class="custom-control-label mr-1">{{ $permission->description }}</label>
    </div>
@endforeach