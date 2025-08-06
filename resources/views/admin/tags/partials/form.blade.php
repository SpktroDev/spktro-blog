<div class="form-group">
    <label for="name">Nombre</label>
    <input type="text" name="name" id="name" class="form-control" placeholder="Ingrese el nombre de la etiqueta ..." value="{{ old('name', $tag->name ?? '') }}" />
    @error('name')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
<div class="form-group">
    <label for="slug">Slug</label>
    <input type="text" name="slug" id="slug" class="form-control" placeholder="Ingrese el slug de la etiqueta" value="{{ old('slug', $tag->slug ?? '') }}" readonly />
    @error('slug')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
<div class="form-group">
    <label for="color">Color</label>
    <select name="color" id="color" class="form-control">
        <option value="">Seleccione un color</option>
        @foreach ($colors as $key => $color)
            <option value="{{ $key }}" {{ old('color', $tag->color ?? '') == $key ? 'selected' : '' }}>{{ ucfirst($color) }}</option>
        @endforeach
    </select>
    @error('color')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>