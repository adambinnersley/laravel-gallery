@extends('layouts.app')

@section('content')
<div class="container">
    <h3>{{ $photo->title }}</h3>
    <p>{{ $photo->description }}</p>
    <form action="{{ route('photos.destroy', $photo->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger float-right">DELETE</button>
    </form>
    <a href="{{ route('albums.show', $photo->album->id) }}" class="btn btn-info">Go Back</a>
    <small>Size: {{ $photo->size }}</small>
    <hr />
    <img src="/storage/albums/{{ $photo->album->id }}/{{ $photo->photo }}" alt="{{ $photo->title }}" width="100%" />
    <hr />
</div>
@endsection