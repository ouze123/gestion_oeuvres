@extends('layouts.app')

@section('content')
<h1>Ajouter une œuvre</h1>
<form action="{{ route('artworks.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="title">Titre</label>
        <input type="text" name="title" id="title" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="artist">Artiste</label>
        <input type="text" name="artist" id="artist" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="category_id">Catégorie</label>
        <select name="category_id" id="category_id" class="form-control" required>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="photo">Photo</label>
        <input type="file" name="photo" id="photo" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary mt-3">Ajouter</button>
</form>
@endsection