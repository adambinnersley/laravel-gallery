<?php

namespace Gallery\Gallery\Http\Controllers;

use Illuminate\Http\Request;
use Gallery\Gallery\Models\Photo;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $photos = Photo::get();
        return view('gallery.photos.index')->with('photos', $photos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(int $albumID)
    {
        return view('gallery.photos.create')->with('album_id', $albumID);
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
            'title' => 'required',
            'description' => 'required',
            'photo' => 'required|image',
        ]);

        $name = str_replace(' ', '-', $request->file('photo')->getClientOriginalName());
        $filename = pathinfo($name, PATHINFO_FILENAME);
        $extension = $request->file('photo')->extension(); 
        $filenameToStore = $filename . '_' . time() . '.' . $extension;

        $request->file('photo')->storeAs('public/albums/'. $request->album_id, $filenameToStore);

        $photo = new Photo();
        $photo->album_id = $request->input('album_id');
        $photo->title = $request->input('title');
        $photo->description = $request->input('description');
        $photo->photo = $filenameToStore;
        $photo->size = $request->file('photo')->getSize();
        $photo->save();

        return redirect()->route('gallery.albums.show', $request->input('album_id'))->with('success', 'Photo added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $photo = Photo::find($id);
        return view('gallery.photos.show')->with('photo', $photo);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $photo = Photo::find($id);
        if(Storage::delete('public/albums/'.$photo->album_id.'/'.$photo->photo)){
            $photo->delete();

            return redirect()->route('albums.index')->with('success', 'Photo deleted successfully!');
        }
    }
}
