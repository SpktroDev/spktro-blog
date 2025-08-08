@extends('adminlte::page')

@section('title', 'Spktro Blog Admin')

@section('content_header')
    <h1>Editar role</h1>
@stop

@section('content')
    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{ session('info') }}</strong>
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.roles.update', $role) }}" method="POST">
                @csrf
                @method('PUT')
                @include('admin.roles.partials.form')
                <button type="submit" class="btn btn-primary mt-3">Actualizar role</button>
            </form>
        </div>
    </div>
@stop