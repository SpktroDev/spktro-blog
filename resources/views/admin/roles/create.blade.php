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
                @include('admin.roles.partials.form')
                <button type="submit" class="btn btn-primary mt-3">Crear role</button>
            </form>
        </div>
    </div>
@stop