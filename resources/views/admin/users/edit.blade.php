@extends('adminlte::page')

@section('title', 'Spktro Blog Admin')

@section('content_header')
    <h1>Asignar un rol</h1>
@stop

@section('content')
    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{ session('info') }}</strong>
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            <p class="h5">Nombre</p>
            <p class="form-control">{{ $user->name }}</p>
            <h2 class="h5">Listado de roles</h2>
            <form action="{{ route('admin.users.update', $user) }}" method="POST">
                @csrf
                @method('put')
                <div class="form-group">
                    @foreach ($roles as $role)
                        @php
                            $selectedRoles = old('roles', $user->roles->pluck('id')->toArray());
                        @endphp
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="role{{ $role->id }}" value="{{ $role->id }}" name="roles[]" {{ in_array($role->id, $selectedRoles) ? 'checked' : '' }}>
                            <label for="role{{ $role->id }}" class="custom-control-label mr-1">{{ $role->name }}</label>
                        </div>
                    @endforeach
                    <br/>
                    @error('roles')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary mt-3">Asignar role</button>
            </form>
        </div>
    </div>
@stop