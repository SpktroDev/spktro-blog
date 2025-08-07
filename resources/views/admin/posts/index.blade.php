@extends('adminlte::page')

@section('title', 'Spktro Blog Admin')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.5/css/responsive.bootstrap4.css">
@endsection

@section('content_header')
    <a class="btn btn-info btn-sm float-right" href="{{ route('admin.posts.create') }}">Nuevo post</a>
    <h1>Listado de posts</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-striped" id="tblPosts">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th colspan="2"></th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@stop

@section('js')
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.bootstrap4.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.5/js/dataTables.responsive.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.5/js/responsive.bootstrap4.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            $('#tblPosts').DataTable({
                responsive: true,
                autoWidth: false,
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
                },
                ajax: '{{ route("datatable.posts") }}',
                columns: [
                    { data: "id" },
                    { data: "name" },
                    { data: "edit", orderable: false, searchable: false, width: "10px" },
                    { data: "delete", orderable: false, searchable: false, width: "10px" },
                ],
            });
        });
    </script>
@endsection

