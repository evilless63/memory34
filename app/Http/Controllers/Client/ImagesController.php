<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
use Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\Album;
use App\Image;

class ImagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $album = Album::find($id);
        return view('admin.image.create', compact('album'));
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

            'album_id' => 'required|numeric|exists:albums,id',
            'image'=>'required|image'
        
        );
        
        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()){
            return Redirect::route('add_image',array('id' =>Input::get('album_id')))
            ->withErrors($validator)
            ->withInput();
        }
    
        $file = Input::file('image');
        $random_name = str_random(8);
        $destinationPath = 'albums/';
        $extension = $file->getClientOriginalExtension();
        $filename=$random_name.'_album_image.'.$extension;
        $uploadSuccess = Input::file('image')->move($destinationPath, $filename);
        Image::create(array(
            'description' => Input::get('description'),
            'image' => $filename,
            'album_id'=> Input::get('album_id')
        ));
    
        return Redirect::route('album.show', array('id'=>Input::get('album_id')));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $image = Image::find($id);
        $albumId = $image->album_id;
        $image->delete();
        
        return Redirect::route('album.show', array('id'=>$albumId));
    }

    public function postMove(Request $request)
    {
    $rules = array(

        'new_album' => 'required|numeric|exists:albums,id',
        'photo'=>'required|numeric|exists:images,id'

    );

    $validator = Validator::make($request::all(), $rules);
        if($validator->fails()){

            return Redirect::route('index');
        }

        $image = Image::find($request::get('photo'));
        $image->album_id = $request::get('new_album');
        $image->save();
        return Redirect::route('album.show',array('id'=>$request::get('new_album')));
    }
}
