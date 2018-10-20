<?php

namespace App\Http\Controllers\Client;
use App\Menu;
use Menu as LavMenu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Page;

class SiteController extends Controller
{
    protected $menus;

    public function __construct()
    {
        $this->menus = Menu::orderBy('order', 'asc')->get();  
        $this->menus = $this->buildMenuClient($this->menus); 
    }

    public function showMainPage()
    {
        $page = Page::where('is_main', 1)->first();
        $menus = $this->menus;
        return view('client.page.show', compact('page','menus'));
    }

    public function showPage($slug)
    {
        $page = Page::where('slug', $slug)->first();  
        $menus = $this->menus;      
        return view('client.page.show', compact('page','menus'));
    }

    protected function buildMenuClient ($arrMenu){
        $mBuilder = LavMenu::make('MyNav', function($m) use ($arrMenu){
            foreach($arrMenu as $item){
                /*
                 * Для родительского пункта меню формируем элемент меню в корне
                 * и с помощью метода id присваиваем каждому пункту идентификатор
                 */

                if($item->pages()->first()->is_main === 1) {
                $slug = '/';   
                } else {
                    $slug = $item->pages()->first()->slug;
                }

                if($item->parent_id == 0){
                    $m->add($item->title, ['route' => ['client.page.show', 'slug' => $slug]])->id($item->id)->attr(['is_active' => $item->is_active, 'is_footer' => $item->is_footer]);
                }
                //иначе формируем дочерний пункт меню
                else {
                    //ищем для текущего дочернего пункта меню в объекте меню ($m)
                    //id родительского пункта (из БД)
                    if($m->find($item->parent_id)){
                        $m->find($item->parent_id)->add($item->title, ['route' => ['client.page.show', 'slug' => $slug]])->id($item->id)->attr(['is_active' => $item->is_active, 'is_footer' => $item->is_footer]);
                   }
                }
            }
        });

        return $mBuilder;
    }
}
