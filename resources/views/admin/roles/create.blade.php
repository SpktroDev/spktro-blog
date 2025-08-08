@extends('adminlte::page')

@section('title', 'Spktro Blog Admin')

@section('content_header')
    <h1>Crear role</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.roles.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Nombre del role</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" placeholder="Ingrese el nombre del role"/>
                    @error('name')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <h2 class="h3">Lista de permisos</h2>
                @foreach ($permissions as $permission)
                        {{-- @php
                            $selectedRoles = old('permissions', $permission->roles->pluck('id')->toArray());
                        @endphp --}}
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="role{{ $permission->id }}" value="{{ $permission->id }}" name="permissions[]" {{-- in_array($role->id, $selectedRoles) ? 'checked' : '' --}}>
                            <label for="role{{ $permission->id }}" class="custom-control-label mr-1">{{ $permission->description }}</label>
                        </div>
                @endforeach
                <button type="submit" class="btn btn-primary mt-3">Crear role</button>
            </form>
        </div>
    </div>
@stop
