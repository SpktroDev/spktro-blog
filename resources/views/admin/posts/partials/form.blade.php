<div class="form-group">
    <label for="name">Nombre</label>
    <input type="text" name="name" id="name" class="form-control" placeholder="Ingrese el nombre del post ..." value="{{ old('name', $post->name ?? '') }}" autocomplete="off"/>
    @error('name')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
<div class="form-group">
    <label for="slug">Slug</label>
    <input type="text" name="slug" id="slug" class="form-control" placeholder="Ingrese el slug del post" value="{{ old('slug', $post->slug ?? '') }}" readonly />
    @error('slug')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
<div class="form-group">
    <label for="category_id">Categoria</label>
    <select name="category_id" id="category_id" class="form-control">
        {{-- <option value="">Seleccione una categoria</option> --}}
        @foreach ($categories as $key => $category)
            <option value="{{ $key }}" {{ old('category_id', $post->category_id ?? '') == $key ? 'selected' : '' }}>{{ ucfirst($category) }}</option>
        @endforeach
    </select>
    @error('category_id')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
@php
    $selectedTags = old('tags', isset($post) ? $post->tags->pluck('id')->toArray() : []);
@endphp
<div class="form-group">
    <p class="font-weight-bold">Etiquetas</p>
    @foreach ($tags as $tag)
        <label class="mr-2">
            <input type="checkbox" name="tags[]" value="{{ $tag->id }}" {{ in_array($tag->id, $selectedTags) ? 'checked' : '' }}>
            {{ $tag->name }}
        </label>
    @endforeach
    <br/>
    @error('tags')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
@php
    $status = old('status', $post->status ?? '1'); // '1' por defecto si no hay nada
@endphp
<div class="form-group d-flex">
    <div class="custom-control custom-radio mr-2">
        <input class="custom-control-input" type="radio" id="draft" name="status" value="1" {{ $status == '1' ? 'checked' : '' }} />
        <label for="draft" class="custom-control-label">Borrador</label>
    </div>
    <div class="custom-control custom-radio ml-2">
        <input class="custom-control-input" type="radio" id="published" name="status" value="2" {{ $status == '2' ? 'checked' : '' }} />
        <label for="published" class="custom-control-label">Publicado</label>
    </div>
    @error('status')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
<div class="row mb-3">
    <div class="col">
        <div class="image-wrapper">
            @isset ($post->image)
                <img id="picture" src="{{ Storage::url($post->image->url) }}" alt="" />
            @else
                <img id="picture" src="https://cdn.pixabay.com/photo/2017/10/24/07/12/hacker-2883630_1280.jpg" alt="" />
            @endisset
        </div>
    </div>
    <div class="col">
        <label for="file" class="btn btn-primary btn-block">Seleccionar imagen</label>
        <input type="file" name="file" id="file" class="hidden" accept="image/*" onchange="previewImage(event, '#picture')" />
        @error('file')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <p class="text-muted">La imagen debe ser menor a 2MB y formato jpg, png o jpeg</p>
    </div>
</div>
<div class="mb-2">
    <p class="font-weight-bold text-sm mb-1">Extracto</p>
    <div id="editorExtract">{!! old('extract', $post->extract ?? '') !!}</div>
    <textarea name="extract" id="extract" class="hidden">{{old('extract', $post->extract ?? '')}}</textarea>
    @error('extract')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
<div class="mb-2">
    <p class="font-weight-bold text-sm mb-1">Cuerpo del post</p>
    <div id="editorBody">{!! old('body', $post->body ?? '') !!}</div>
    <textarea name="body" id="body" class="hidden">{{old('body', $post->body ?? '')}}</textarea>
    @error('body')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>