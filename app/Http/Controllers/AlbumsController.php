<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Album;
use Validator;

class AlbumsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $albums = Album::with('photos')->get();
        return view('admin.album.index', compact('albums'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.album.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(

            'name' => 'required',
            'cover_image'=>'required|image'
        
            );
            
            $validator = Validator::make($request->all(), $rules);
            if($validator->fails()){
        
            return Redirect::route('create_album_form')
            ->withErrors($validator)
            ->withInput();
        }

        $file = $request->file('cover_image');
        $random_name = str_random(8);
        $destinationPath = 'albums/';
        $extension = $file->getClientOriginalExtension();
        $filename=$random_name.'_cover.'.$extension;
        $uploadSuccess = $request->file('cover_image')
        ->move($destinationPath, $filename);
        $album = Album::create(array(
          'name' => $request->get('name'),
          'description' => $request->get('description'),
          'cover_image' => $filename,
        ));
     
        return redirect(route('album.show', $album->id)); 

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $album = Album::with('Photos')->find($id);
        dd($album);
        return view('admin.album.show', compact('album'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
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
        {
            $album = Album::find($id);
        
            $album->delete();
            return redirect(route('album.index'));
        }
    }
}
