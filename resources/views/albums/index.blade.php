@extends('layouts.app')

@section('content')
<div class="container">
    @if (count($albums) > 0)
    <div class="row">
        @foreach($albums as $album)
        <div class="col-md-4">
            <div class="card mb-4 box-shadow">
                <img class="card-img-top" src="/storage/album_covers/{{ $album->cover_image }}" alt="{{ $album->name }}">
                <div class="card-body">
                    <p class="card-text">{{ $album->description }}</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ route('albums.show', $album->id) }}" class="btn btn-sm btn-outline-secondary">View</a>    
                        <small class="text-muted">{{ $album->name }}</small>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
        <h3>No albums yet.</h3>
    @endif
</div>
@endsection