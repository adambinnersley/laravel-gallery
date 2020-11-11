<?php

namespace Gallery\Gallery\Http\Controllers;

use Illuminate\Http\Request;
use Gallery\Gallery\Models\Album;
use Illuminate\Support\Facades\Storage;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $albums = Album::get();
        return view('gallery.albums.index')->with('albums', $albums);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('gallery.albums.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'cover_image' => 'required|image',
        ]);

        $name = str_replace(' ', '-', $request->file('cover_image')->getClientOriginalName());
        $filename = pathinfo($name, PATHINFO_FILENAME);
        $extension = $request->file('cover_image')->extension(); 
        $filenameToStore = $filename . '_' . time() . '.' . $extension;

        $request->file('cover_image')->storeAs('public/album_covers', $filenameToStore);

        $album = new Album();
        $album->name = $request->input('name');
        $album->description = $request->input('description');
        $album->cover_image = $filenameToStore;
        $album->save();

        return redirect()->route('gallery.albums.index')->with('success', 'Album created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $album = Album::with('photos')->find($id);
        return view('gallery.albums.show')->with('album', $album);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Incomplete
        $album = Album::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Incomplete
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Incomplete
        $album = Album::with('photos')->find($id);
        
        if(Storage::delete('public/albums/'.$album->id.'/')){
            $album->delete();

            return redirect()->route('home')->with('success', 'Gallery Album deleted successfully!');
        }
    }
}
