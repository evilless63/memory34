<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;
use Validator;
use Menu as LavMenu;

class MenuController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menu::orderBy('order', 'asc')->get();
        $menus = $this->buildMenu($menus);
        return view('admin.menu.index', compact('menus'));  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parent_menus = Menu::all();
        return view('admin.menu.create', compact('parent_menus'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect(route('menu.create'))
                        ->withErrors($validator)
                        ->withInput();
        }

        Menu::create($request->all());   

        return redirect(route('menu.index'));    
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
        $menu = Menu::findorfail($id);
        $parent_menu_actual = Menu::find($menu->parent_id);
        $parent_menus = Menu::where('id', '<>', $id )->get();
        return view('admin.menu.edit', compact('menu','parent_menus','parent_menu_actual'));
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
        $validator = Validator::make($request->all(), [
            'title' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect(route('menu.create'))
                        ->withErrors($validator)
                        ->withInput();
        }

        Menu::where('id', $id)->update($request->except('_method','_token'));  

        $reqArray = ['is_active' => $request->is_active, 'is_footer' => $request->is_footer];
        $this->setRequisites($id, $reqArray);

        return redirect(route('menu.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function buildMenu ($arrMenu){
        $mBuilder = LavMenu::make('MyNav', function($m) use ($arrMenu){
            foreach($arrMenu as $item){
                /*
                 * Для родительского пункта меню формируем элемент меню в корне
                 * и с помощью метода id присваиваем каждому пункту идентификатор
                 */
                if($item->parent_id == 0){
                    $m->add($item->title, $item->path)->id($item->id)->attr(['is_active' => $item->is_active, 'is_footer' => $item->is_footer]);
                }
                //иначе формируем дочерний пункт меню
                else {
                    //ищем для текущего дочернего пункта меню в объекте меню ($m)
                    //id родительского пункта (из БД)
                    if($m->find($item->parent_id)){
                        $m->find($item->parent_id)->add($item->title, $item->path)->id($item->id)->attr(['is_active' => $item->is_active, 'is_footer' => $item->is_footer]);
                   }
                }
            }
        });
        return $mBuilder;
    }

    protected function setRequisites ($parentId, $reqArray) {
        $children = Menu::where('parent_id', $parentId)->get();

        if($children == null) {
            return;
        }

        foreach($children as $child) {

            foreach($reqArray as $key=>$value) {
                if($value <> 1) {
                    $child->$key = $value;
                }
            }

            $child->update();
            $this->setRequisites($child->id, $reqArray);

        } 
    }
}
