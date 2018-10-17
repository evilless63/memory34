<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Menu;
use Menu as LavMenu;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function buildMenu ($arrMenu){
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
}
