@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create New Album</h2>
    <form method="POST" action="{{ route('albums.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" class="form-control" id="description" name="description" placeholder="Enter description">
        </div>
        <div class="form-group">
            <input type="file" id="cover_image" name="cover_image" >
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection