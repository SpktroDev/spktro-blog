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
                </div>
                <div class="form-group">
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input" type="radio" id="draft" name="status" value="1" />
                        <label for="draft" class="custom-control-label">Borrador</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input" type="radio" id="published" name="status" value="2" />
                        <label for="published" class="custom-control-label">Publicado</label>
                    </div>
                </div>
                <div class="from-group">
                    <label>
                        <input type="radio" name="status" value="1" class="form-control-file"/>
                        <span class="ml-1">Borrador</span>
                    </label>
                    <label>
                        <input type="radio" name="status" value="2" class="form-control-file"/>
                        <span class="ml-1">Publicado</span>
                    </label>
                </div>
                {{-- <div>
                    <p class="text-sm font-medium mb-1">Estado</p>
                    <div class="flex space-x-3">
                        <label class="flex item-centers">
                            <input type="radio" name="is_published" value="0" @checked(old('is_published', $post->is_published) == 0)/>
                            <span class="ml-1">No publicado</span>
                        </label>
                        <label class="flex item-centers">
                            <input type="radio" name="is_published" value="1" @checked(old('is_published', $post->is_published) == 1)/>
                            <span class="ml-1">Publicado</span>
                        </label>
                    </div>
                </div> --}}

                <div class="mb-2">
                    <p class="font-weight-bold text-sm mb-1">Extracto</p>
                    <div id="editorExtract">{!! old('extract') !!}</div>
                    <textarea name="extract" id="extract" class="hidden">{{old('extract')}}</textarea>
                </div>
                <div class="mb-2">
                    <p class="font-weight-bold text-sm mb-1">Cuerpo del post</p>
                    <div id="editorBody">{!! old('body') !!}</div>
                    <textarea name="body" id="body" class="hidden">{{old('body')}}</textarea>
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
