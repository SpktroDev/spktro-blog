@extends('adminlte::page')

@section('title', 'Spktro Blog Admin')

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet">
    <style>
        .hidden {
            display: none !important;
        }
        .image-wrapper {
            position: relative;
            width: 100%;
            padding-top: 56.25%; /* 16:9 aspect ratio */
        }
        .image-wrapper img {
            position: absolute;
            width: 100%;
            height: 100%;
            object-fit: cover;
            top: 0;
            left: 0;
        }
    </style>
@endsection

@section('content_header')
    <h1>Crear nuevo post</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @include('admin.posts.partials.form')
                <button type="submit" class="btn btn-primary mt-3">Crear post</button>
            </form>
        </div>
    </div>
@stop

@section('js')
    <script src="{{ asset('vendor/jQuery-Plugin-stringToSlug-1.3/jquery.stringToSlug.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
    <script>
        $(document).ready( function() {
            $("#name").stringToSlug({
                setEvents: 'keyup keydown blur',
                getPut: '#slug',
                space: '-'
            });
        });

        const quillExtract = new Quill('#editorExtract', {
            theme: 'snow'
        });

        quillExtract.on('text-change', function(){
            document.querySelector('#extract').value = quillExtract.root.innerHTML;
        });

        const quillBody = new Quill('#editorBody', {
            theme: 'snow'
        });

        quillBody.on('text-change', function(){
            document.querySelector('#body').value = quillBody.root.innerHTML;
        });

        function previewImage(event, querySelector){

            //Recuperamos el input que desencadeno la acción
            let input = event.target;
            
            //Recuperamos la etiqueta img donde cargaremos la imagen
            let imgPreview = document.querySelector(querySelector);

            // Verificamos si existe una imagen seleccionada
            if(!input.files.length) return
            
            //Recuperamos el archivo subido
            let file = input.files[0];

            //Creamos la url
            let objectURL = URL.createObjectURL(file);
            
            //Modificamos el atributo src de la etiqueta img
            imgPreview.src = objectURL;
                        
        }
   </script>
@stop
