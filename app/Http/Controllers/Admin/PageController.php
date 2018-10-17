<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Page;
use App\Album;
use Validator;
use Transliterate;

class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => array('show')]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::all();
        return view('admin.page.index', compact('pages'));  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.page.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validateRequest($request);

        $request = $this->checkMainPage($request);

        Page::create(array_merge($request->all(), ['slug' => $this->makeSlug($request)]));   

        return redirect(route('page.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $page = Page::findorfail($id);        
        return view('admin.page.show', compact('page'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = Page::findorfail($id);
        $albums = Album::whereNotIn('id', $page->albums()->get()->pluck('id'))->get();
        return view('admin.page.edit', compact('page','albums'));
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
        $this->validateRequest($request);
        
        $page = Page::findorfail($id);
        $request = $this->checkMainPage($request, $id);

        $page->update($request->except('_method','_token'));  
        $albums = Album::find($request->albums);
        $page->albums()->attach($albums);

        $albums = Album::whereNotIn('id', $page->albums()->get()->pluck('id'))->get();
        return view('admin.page.edit', compact('page','albums'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $page = Page::findorfail($id);

        if($page->is_main) {
            return redirect(route('page.index'));
        }

        $actual_menu = count($page->menus) > 0 ? $page->menus[0] : null;
        $page->menus()->detach($actual_menu);


        $page->albums()->detach($page->albums);
        $page->delete();

        return redirect(route('page.index'));
    }

    public function detachAlbum(Request $request)
    {
        $page = Page::findOrFail($request->pageId);
        $page->albums()->detach($request->albumId);
        $albums = Album::whereNotIn('id', $page->albums()->get()->pluck('id'))->get();
        return view('admin.page.edit', compact('page','albums'));
    }

    protected function makeSlug($request)
    {

        $slug = Transliterate::make($request->title, ['type' => 'url', 'lowercase' => true]);
        $pagesWithSlug = Page::where('slug', $slug)->get();

        if($pagesWithSlug->count() <> 0) {
            $slug = $slug . "-1";  
        }

        return $slug;
    }

    protected function validateRequest($request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect(route('page.create'))
                        ->withErrors($validator)
                        ->withInput();
        }
    }

    public function uploadImage(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'upload' => 'required|image',
        ]);
    
        $funcNum = $request->input('CKEditorFuncNum');
    
        if ($validator->fails()) {
            return response(
                "<script>
                    window.parent.CKEDITOR.tools.callFunction({$funcNum}, '', '{$validator->errors()->first()}');
                </script>"
            );
        }
    
        $image = $request->file('upload');
        $image->store('public/uploads');
        $url = asset('storage/uploads/'.$image->hashName());
    
        return response(
            "<script>
                window.parent.CKEDITOR.tools.callFunction({$funcNum}, '{$url}', 'Изображение успешно загружено');
            </script>"
        );
    }

    protected function checkMainPage(Request $request, $id = 0){

        $mPage = Page::where('is_main', 1)->where('id', '<>', $id)->first();
 
        if((int)$request->is_main === 1) {
            if($mPage <> null){
                $mPage->is_main = 0;
                $mPage->save();
            } 
        } elseif((int)$request->is_main === 0) {
            if($mPage == null){
                $request->merge(['is_main' => 1]);
            } 
        }

        return $request;
    }
}
