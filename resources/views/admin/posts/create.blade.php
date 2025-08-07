@extends('adminlte::page')

@section('title', 'Spktro Blog Admin')

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet">
    <style>
        .hidden {
            display: none !important;
        }
    </style>
@endpush

@section('content_header')
    <h1>Crear nuevo post</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.posts.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Ingrese el nombre del post ..." value="{{ old('name') }}" autocomplete="off"/>
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="slug">Slug</label>
                    <input type="text" name="slug" id="slug" class="form-control" placeholder="Ingrese el slug del post" value="{{ old('slug') }}" readonly />
                    @error('slug')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="category_id">Categoria</label>
                    <select name="category_id" id="category_id" class="form-control">
                        <option value="">Seleccione una categoria</option>
                        @foreach ($categories as $key => $category)
                            <option value="{{ $key }}" {{ old('category_id') == $key ? 'selected' : '' }}>{{ ucfirst($category) }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <p class="font-weight-bold">Etiquetas</p>
                    @foreach ($tags as $tag)
                        <label class="mr-2">
                            <input type="checkbox" name="tags[]" value="{{ $tag->id }}" {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }}>
                            {{ $tag->name }}
                        </label>
                    @endforeach
                    <br/>
                    @error('tags')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group d-flex">
                    <div class="custom-control custom-radio mr-2">
                        <input class="custom-control-input" type="radio" id="draft" name="status" value="1" checked />
                        <label for="draft" class="custom-control-label">Borrador</label>
                    </div>
                    <div class="custom-control custom-radio ml-2">
                        <input class="custom-control-input" type="radio" id="published" name="status" value="2" />
                        <label for="published" class="custom-control-label">Publicado</label>
                    </div>
                    @error('status')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-2">
                    <p class="font-weight-bold text-sm mb-1">Extracto</p>
                    <div id="editorExtract">{!! old('extract') !!}</div>
                    <textarea name="extract" id="extract" class="hidden">{{old('extract')}}</textarea>
                    @error('extract')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-2">
                    <p class="font-weight-bold text-sm mb-1">Cuerpo del post</p>
                    <div id="editorBody">{!! old('body') !!}</div>
                    <textarea name="body" id="body" class="hidden">{{old('body')}}</textarea>
                    @error('body')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
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
   </script>
@stop
