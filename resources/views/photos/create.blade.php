@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Upload New Photo</h2>
    <form method="POST" action="{{ route('photos.store')}}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="album_id" value="{{ $album_id }}" />
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Enter title">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" class="form-control" id="description" name="description" placeholder="Enter description">
        </div>
        <div class="form-group">
            <input type="file" id="photo" name="photo" >
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection