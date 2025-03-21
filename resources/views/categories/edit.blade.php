@extends('layouts.app')

@section('content')
<h1>Modifier la catégorie</h1>
<form action="{{ route('categories.update', $category->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="name">Nom</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ $category->name }}" required>
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" id="description" class="form-control">{{ $category->description }}</textarea>
    </div>
    <button type="submit" class="btn btn-warning mt-3">Modifier</button>
</form>
@endsection