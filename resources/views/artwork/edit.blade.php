@extends('layouts.app')

@section('content')
<h1>Modifier une œuvre</h1>
<form action="{{ route('artworks.update', $artwork->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="title">Titre</label>
        <input type="text" name="title" id="title" class="form-control" value="{{ $artwork->title }}" required>
    </div>
    <div class="form-group">
        <label for="artist">Artiste</label>
        <input type="text" name="artist" id="artist" class="form-control" value="{{ $artwork->artist }}" required>
    </div>
    <div class="form-group">
        <label for="category_id">Catégorie</label>
        <select name="category_id" id="category_id" class="form-control" required>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ $artwork->category_id == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="photo">Photo</label>
        <input type="file" name="photo" id="photo" class="form-control">
    </div>
    <button type="submit" class="btn btn-warning mt-3">Modifier</button>
</form>
@endsection